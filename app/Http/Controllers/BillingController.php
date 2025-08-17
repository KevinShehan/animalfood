<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\BillHeader;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class BillingController extends Controller
{
    public function index()
    {
        try {
            // No need to load data here since we're fetching via AJAX
            return view('admin.billing.index');
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading billing page: ' . $e->getMessage());
        }
    }

    public function list()
    {
        try {
            return view('admin.billing.list');
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading billing list page: ' . $e->getMessage());
        }
    }

    public function exportBills(Request $request)
    {
        try {
            $query = Order::with(['customer', 'user'])
                         ->whereNotNull('invoice_number')
                         ->orderBy('created_at', 'desc');

            // Apply filters
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('invoice_number', 'like', "%{$search}%")
                      ->orWhere('order_number', 'like', "%{$search}%")
                      ->orWhereHas('customer', function($customerQuery) use ($search) {
                          $customerQuery->where('name', 'like', "%{$search}%")
                                       ->orWhere('email', 'like', "%{$search}%")
                                       ->orWhere('phone', 'like', "%{$search}%");
                      });
                });
            }

            if ($request->has('status') && !empty($request->status)) {
                switch ($request->status) {
                    case 'paid':
                        $query->where('due_amount', '<=', 0);
                        break;
                    case 'pending':
                        $query->where('due_amount', '>', 0)->where('due_date', '>=', now());
                        break;
                    case 'overdue':
                        $query->where('due_amount', '>', 0)->where('due_date', '<', now());
                        break;
                    case 'cancelled':
                        $query->where('status', 'cancelled');
                        break;
                }
            }

            if ($request->has('dateRange') && !empty($request->dateRange)) {
                $now = now();
                switch ($request->dateRange) {
                    case 'today':
                        $query->whereDate('created_at', $now->toDateString());
                        break;
                    case 'week':
                        $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
                        break;
                    case 'month':
                        $query->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year);
                        break;
                    case 'quarter':
                        $query->whereBetween('created_at', [$now->startOfQuarter(), $now->endOfQuarter()]);
                        break;
                    case 'year':
                        $query->whereYear('created_at', $now->year);
                        break;
                }
            }

            $bills = $query->get();
            $billHeader = BillHeader::getActive();

            // Calculate summary statistics
            $summary = [
                'total_bills' => $bills->count(),
                'total_amount' => $bills->sum('final_amount'),
                'total_paid' => $bills->sum('paid_amount'),
                'total_due' => $bills->sum('due_amount'),
                'paid_bills' => $bills->where('due_amount', '<=', 0)->count(),
                'pending_bills' => $bills->where('due_amount', '>', 0)->where('due_date', '>=', now())->count(),
                'overdue_bills' => $bills->where('due_amount', '>', 0)->where('due_date', '<', now())->count(),
                'cancelled_bills' => $bills->where('status', 'cancelled')->count(),
            ];

            // Transform data for PDF
            $billsData = $bills->map(function ($bill) {
                return [
                    'bill_number' => $bill->invoice_number,
                    'order_number' => $bill->order_number,
                    'customer_name' => $bill->customer->name ?? 'N/A',
                    'customer_email' => $bill->customer->email ?? 'N/A',
                    'date' => $bill->invoice_date ? $bill->invoice_date->format('M d, Y') : $bill->created_at->format('M d, Y'),
                    'due_date' => $bill->due_date ? $bill->due_date->format('M d, Y') : 'N/A',
                    'amount' => number_format($bill->final_amount, 2),
                    'paid_amount' => number_format($bill->paid_amount, 2),
                    'due_amount' => number_format($bill->due_amount, 2),
                    'status' => $this->getBillStatus($bill),
                    'created_by' => $bill->user->name ?? 'System',
                ];
            });

            $exportType = $request->get('type', 'pdf');
            $reportTitle = $request->get('title', 'Bills Summary Report');
            $includeSummary = $request->get('include_summary', true);
            $includeDetails = $request->get('include_details', true);

            if ($exportType === 'pdf') {
                return $this->generatePDF($billsData, $summary, $billHeader, $reportTitle, $includeSummary, $includeDetails);
            } else {
                return $this->generatePrintPreview($billsData, $summary, $billHeader, $reportTitle, $includeSummary, $includeDetails);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error generating export: ' . $e->getMessage()
            ], 500);
        }
    }

    private function generatePDF($billsData, $summary, $billHeader, $reportTitle, $includeSummary, $includeDetails)
    {
        $html = view('admin.billing.exports.pdf', compact(
            'billsData', 
            'summary', 
            'billHeader', 
            'reportTitle', 
            'includeSummary', 
            'includeDetails'
        ))->render();

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'bills_report_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    private function generatePrintPreview($billsData, $summary, $billHeader, $reportTitle, $includeSummary, $includeDetails)
    {
        return view('admin.billing.exports.print-preview', compact(
            'billsData', 
            'summary', 
            'billHeader', 
            'reportTitle', 
            'includeSummary', 
            'includeDetails'
        ));
    }

    public function getBills(Request $request): JsonResponse
    {
        try {
            $query = Order::with(['customer', 'user'])
                         ->whereNotNull('invoice_number')
                         ->orderBy('created_at', 'desc');

            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('invoice_number', 'like', "%{$search}%")
                      ->orWhere('order_number', 'like', "%{$search}%")
                      ->orWhereHas('customer', function($customerQuery) use ($search) {
                          $customerQuery->where('name', 'like', "%{$search}%")
                                       ->orWhere('email', 'like', "%{$search}%")
                                       ->orWhere('phone', 'like', "%{$search}%");
                      });
                });
            }

            // Status filter
            if ($request->has('status') && !empty($request->status)) {
                switch ($request->status) {
                    case 'paid':
                        $query->where('due_amount', '<=', 0);
                        break;
                    case 'pending':
                        $query->where('due_amount', '>', 0)->where('due_date', '>=', now());
                        break;
                    case 'overdue':
                        $query->where('due_amount', '>', 0)->where('due_date', '<', now());
                        break;
                    case 'cancelled':
                        $query->where('status', 'cancelled');
                        break;
                }
            }

            // Date range filter
            if ($request->has('dateRange') && !empty($request->dateRange)) {
                $now = now();
                switch ($request->dateRange) {
                    case 'today':
                        $query->whereDate('created_at', $now->toDateString());
                        break;
                    case 'week':
                        $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
                        break;
                    case 'month':
                        $query->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year);
                        break;
                    case 'quarter':
                        $query->whereBetween('created_at', [$now->startOfQuarter(), $now->endOfQuarter()]);
                        break;
                    case 'year':
                        $query->whereYear('created_at', $now->year);
                        break;
                }
            }

            // Pagination
            $perPage = $request->get('per_page', 15);
            $bills = $query->paginate($perPage);

            // Transform data for frontend
            $bills->getCollection()->transform(function ($bill) {
                return [
                    'id' => $bill->id,
                    'bill_number' => $bill->invoice_number,
                    'order_number' => $bill->order_number,
                    'customer' => [
                        'name' => $bill->customer->name ?? 'N/A',
                        'email' => $bill->customer->email ?? 'N/A',
                        'phone' => $bill->customer->phone ?? 'N/A',
                    ],
                    'date' => $bill->invoice_date ? $bill->invoice_date->format('M d, Y') : $bill->created_at->format('M d, Y'),
                    'due_date' => $bill->due_date ? $bill->due_date->format('M d, Y') : 'N/A',
                    'amount' => number_format($bill->final_amount, 2),
                    'paid_amount' => number_format($bill->paid_amount, 2),
                    'due_amount' => number_format($bill->due_amount, 2),
                    'status' => $this->getBillStatus($bill),
                    'status_class' => $this->getBillStatusClass($bill),
                    'created_by' => $bill->user->name ?? 'System',
                    'created_at' => $bill->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $bill->updated_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $bills->items(),
                'pagination' => [
                    'current_page' => $bills->currentPage(),
                    'last_page' => $bills->lastPage(),
                    'per_page' => $bills->perPage(),
                    'total' => $bills->total(),
                    'from' => $bills->firstItem(),
                    'to' => $bills->lastItem(),
                ],
                'summary' => [
                    'total_bills' => $bills->total(),
                    'total_amount' => number_format($bills->sum('final_amount'), 2),
                    'total_paid' => number_format($bills->sum('paid_amount'), 2),
                    'total_due' => number_format($bills->sum('due_amount'), 2),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching bills: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getBillStatus($bill): string
    {
        if ($bill->status === 'cancelled') {
            return 'Cancelled';
        }
        
        if ($bill->due_amount <= 0) {
            return 'Paid';
        }
        
        if ($bill->due_date && $bill->due_date->isPast()) {
            return 'Overdue';
        }
        
        return 'Pending';
    }

    private function getBillStatusClass($bill): string
    {
        if ($bill->status === 'cancelled') {
            return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
        }
        
        if ($bill->due_amount <= 0) {
            return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
        }
        
        if ($bill->due_date && $bill->due_date->isPast()) {
            return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
        }
        
        return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
    }

    public function getCustomers(Request $request): JsonResponse
    {
        try {
            $query = Customer::query();
            
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            }
            
            $customers = $query->where('status', 'active')->get(['id', 'name', 'email', 'phone', 'address']);
            
            // Ensure the default "Customer" entry is always first for billing
            $defaultCustomer = $customers->where('name', 'Customer')->first();
            if ($defaultCustomer) {
                $customers = $customers->reject(function($customer) {
                    return $customer->name === 'Customer';
                });
                $customers = collect([$defaultCustomer])->merge($customers);
            }
            
            return response()->json($customers);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching customers: ' . $e->getMessage()], 500);
        }
    }

    public function getProducts(Request $request): JsonResponse
    {
        try {
            $query = Product::query();
            
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('sku', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }
            
            $products = $query->where('status', 'active')
                             ->where('stock_quantity', '>', 0)
                             ->get(['id', 'name', 'sku', 'price', 'stock_quantity', 'unit', 'description']);
            
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching products: ' . $e->getMessage()], 500);
        }
    }

    public function getProductDetails($id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            
            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'price' => $product->price,
                'stock_quantity' => $product->stock_quantity,
                'unit' => $product->unit ?? 'unit',
                'description' => $product->description
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Product not found: ' . $e->getMessage()], 404);
        }
    }

    public function getCustomerDetails($id): JsonResponse
    {
        try {
            $customer = Customer::findOrFail($id);
            
            return response()->json([
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'address' => $customer->address,
                'city' => $customer->city,
                'state' => $customer->state,
                'postal_code' => $customer->postal_code
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Customer not found: ' . $e->getMessage()], 404);
        }
    }
}
