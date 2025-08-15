<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use App\Models\Customer;
use App\Models\Order;
use App\Models\CustomerCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display payment transactions
     */
    public function index(Request $request)
    {
        $query = PaymentTransaction::with(['customer', 'order', 'user'])
                                  ->orderBy('created_at', 'desc');

        // Filtering
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('date_from')) {
            $query->where('payment_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('payment_date', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('transaction_number', 'like', "%{$search}%")
                  ->orWhere('reference_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $payments = $query->paginate(15);
        $customers = Customer::orderBy('name')->get();
        
        $paymentMethods = ['cash', 'card', 'bank_transfer', 'credit', 'cheque', 'mobile_payment'];
        $paymentTypes = ['payment', 'refund', 'credit_adjustment', 'late_fee'];

        return view('admin.payments.index', compact('payments', 'customers', 'paymentMethods', 'paymentTypes'));
    }

    /**
     * Show payment form
     */
    public function create(Request $request)
    {
        $customerId = $request->get('customer_id');
        $orderId = $request->get('order_id');

        $customer = $customerId ? Customer::with('credit')->find($customerId) : null;
        $order = $orderId ? Order::find($orderId) : null;

        $customers = Customer::orderBy('name')->get();
        $paymentMethods = ['cash', 'card', 'bank_transfer', 'credit', 'cheque', 'mobile_payment'];

        return view('admin.payments.create', compact('customers', 'customer', 'order', 'paymentMethods'));
    }

    /**
     * Store payment
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'order_id' => 'nullable|exists:orders,id',
            'type' => 'required|in:payment,refund,credit_adjustment,late_fee',
            'payment_method' => 'required|in:cash,card,bank_transfer,credit,cheque,mobile_payment',
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'reference_number' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::transaction(function () use ($request) {
            // Create payment transaction
            $payment = PaymentTransaction::create([
                'customer_id' => $request->customer_id,
                'order_id' => $request->order_id,
                'user_id' => auth()->id(),
                'type' => $request->type,
                'payment_method' => $request->payment_method,
                'amount' => $request->amount,
                'payment_date' => $request->payment_date,
                'reference_number' => $request->reference_number,
                'description' => $request->description,
                'notes' => $request->notes,
                'status' => 'completed',
            ]);

            // Update order if specified
            if ($request->order_id && $request->type === 'payment') {
                $order = Order::find($request->order_id);
                $order->increment('paid_amount', $request->amount);
                $order->decrement('due_amount', $request->amount);
                
                // Update payment status
                if ($order->due_amount <= 0) {
                    $order->payment_status = 'paid';
                } elseif ($order->paid_amount > 0) {
                    $order->payment_status = 'partial';
                }
                $order->save();
            }

            // Update customer credit
            $customerCredit = CustomerCredit::where('customer_id', $request->customer_id)->first();
            if ($customerCredit && $request->type === 'payment') {
                $customerCredit->updateBalance($request->amount, 'payment');
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Payment recorded successfully!',
            'redirect' => route('admin.payments.index')
        ]);
    }

    /**
     * Show payment details
     */
    public function show(PaymentTransaction $payment)
    {
        $payment->load(['customer', 'order', 'user']);
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Process bulk payment
     */
    public function bulkPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'payment_method' => 'required|in:cash,card,bank_transfer,credit,cheque,mobile_payment',
            'total_amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'reference_number' => 'nullable|string|max:100',
            'orders' => 'required|array|min:1',
            'orders.*.order_id' => 'required|exists:orders,id',
            'orders.*.amount' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::transaction(function () use ($request) {
            $totalPaid = 0;

            foreach ($request->orders as $orderPayment) {
                // Create individual payment transaction
                PaymentTransaction::create([
                    'customer_id' => $request->customer_id,
                    'order_id' => $orderPayment['order_id'],
                    'user_id' => auth()->id(),
                    'type' => 'payment',
                    'payment_method' => $request->payment_method,
                    'amount' => $orderPayment['amount'],
                    'payment_date' => $request->payment_date,
                    'reference_number' => $request->reference_number,
                    'description' => 'Bulk payment',
                    'status' => 'completed',
                ]);

                // Update order
                $order = Order::find($orderPayment['order_id']);
                $order->increment('paid_amount', $orderPayment['amount']);
                $order->decrement('due_amount', $orderPayment['amount']);
                
                if ($order->due_amount <= 0) {
                    $order->payment_status = 'paid';
                } elseif ($order->paid_amount > 0) {
                    $order->payment_status = 'partial';
                }
                $order->save();

                $totalPaid += $orderPayment['amount'];
            }

            // Update customer credit
            $customerCredit = CustomerCredit::where('customer_id', $request->customer_id)->first();
            if ($customerCredit) {
                $customerCredit->updateBalance($totalPaid, 'payment');
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Bulk payment processed successfully!',
            'redirect' => route('admin.payments.index')
        ]);
    }

    /**
     * Get customer outstanding orders
     */
    public function getCustomerOutstanding(Customer $customer)
    {
        $orders = Order::where('customer_id', $customer->id)
                      ->where('due_amount', '>', 0)
                      ->with(['orderItems.product'])
                      ->orderBy('due_date', 'asc')
                      ->get();

        $data = $orders->map(function($order) {
            return [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'invoice_number' => $order->invoice_number,
                'order_date' => $order->created_at->format('Y-m-d'),
                'due_date' => $order->due_date ? $order->due_date->format('Y-m-d') : null,
                'total_amount' => $order->final_amount,
                'paid_amount' => $order->paid_amount,
                'due_amount' => $order->due_amount,
                'is_overdue' => $order->is_overdue,
                'days_overdue' => $order->due_date ? now()->diffInDays($order->due_date, false) : 0,
            ];
        });

        return response()->json($data);
    }

    /**
     * Reverse payment
     */
    public function reverse(PaymentTransaction $payment)
    {
        if ($payment->status !== 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Only completed payments can be reversed.'
            ], 422);
        }

        DB::transaction(function () use ($payment) {
            // Create reversal transaction
            PaymentTransaction::create([
                'customer_id' => $payment->customer_id,
                'order_id' => $payment->order_id,
                'user_id' => auth()->id(),
                'type' => $payment->type === 'payment' ? 'refund' : 'payment',
                'payment_method' => $payment->payment_method,
                'amount' => $payment->amount,
                'payment_date' => now(),
                'description' => 'Reversal of transaction: ' . $payment->transaction_number,
                'status' => 'completed',
            ]);

            // Update order if applicable
            if ($payment->order_id && $payment->type === 'payment') {
                $order = Order::find($payment->order_id);
                $order->decrement('paid_amount', $payment->amount);
                $order->increment('due_amount', $payment->amount);
                
                if ($order->due_amount > 0) {
                    $order->payment_status = $order->paid_amount > 0 ? 'partial' : 'pending';
                }
                $order->save();
            }

            // Update customer credit
            $customerCredit = CustomerCredit::where('customer_id', $payment->customer_id)->first();
            if ($customerCredit && $payment->type === 'payment') {
                $customerCredit->updateBalance($payment->amount, 'purchase');
            }

            // Mark original payment as reversed
            $payment->update(['status' => 'cancelled']);
        });

        return response()->json([
            'success' => true,
            'message' => 'Payment reversed successfully!'
        ]);
    }
}