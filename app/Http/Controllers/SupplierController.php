<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('created_at', 'desc')->get();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|string|regex:/^[0-9+\-\s\(\)]+$/|max:20',
            'secondary_phone' => 'nullable|string|regex:/^[0-9+\-\s\(\)]+$/|max:20',
            'address' => 'required|string|max:500',
            'contact_person' => 'required|string|max:255',
            'tax_number' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive',
            'is_blacklisted' => 'nullable|boolean',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['supplier_id'] = Supplier::generateSupplierId();
        $data['is_blacklisted'] = $request->boolean('is_blacklisted');

        $supplier = Supplier::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Supplier added successfully!',
            'supplier' => $supplier
        ]);
    }

    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'phone' => 'required|string|regex:/^[0-9+\-\s\(\)]+$/|max:20',
            'secondary_phone' => 'nullable|string|regex:/^[0-9+\-\s\(\)]+$/|max:20',
            'address' => 'required|string|max:500',
            'contact_person' => 'required|string|max:255',
            'tax_number' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive',
            'is_blacklisted' => 'nullable|boolean',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['is_blacklisted'] = $request->boolean('is_blacklisted');

        $supplier->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Supplier updated successfully!',
            'supplier' => $supplier
        ]);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json([
            'success' => true,
            'message' => 'Supplier deleted successfully!'
        ]);
    }
} 