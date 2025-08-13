<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
