<?php

namespace App\Http\Controllers;

use App\Models\BillHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BillHeaderController extends Controller
{
    public function index()
    {
        $billHeader = BillHeader::getActive();
        return view('admin.settings.bill-header', compact('billHeader'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string|max:20',
            'company_email' => 'nullable|email|max:255',
            'company_website' => 'nullable|url|max:255',
            'tax_number' => 'nullable|string|max:100',
            'invoice_prefix' => 'nullable|string|max:10',
            'footer_text' => 'nullable|string',
        ]);

        // Deactivate all existing headers
        BillHeader::where('is_active', true)->update(['is_active' => false]);

        $data = $request->except('company_logo');

        // Handle logo upload
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('bill-headers', 'public');
            $data['company_logo'] = $logoPath;
        }

        $data['is_active'] = true;

        BillHeader::create($data);

        return redirect()->route('admin.settings.bill-header')->with('success', 'Bill header settings saved successfully!');
    }

    public function update(Request $request, BillHeader $billHeader)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string|max:20',
            'company_email' => 'nullable|email|max:255',
            'company_website' => 'nullable|url|max:255',
            'tax_number' => 'nullable|string|max:100',
            'invoice_prefix' => 'nullable|string|max:10',
            'footer_text' => 'nullable|string',
        ]);

        $data = $request->except('company_logo');

        // Handle logo upload
        if ($request->hasFile('company_logo')) {
            // Delete old logo if exists
            if ($billHeader->company_logo) {
                Storage::disk('public')->delete($billHeader->company_logo);
            }
            $logoPath = $request->file('company_logo')->store('bill-headers', 'public');
            $data['company_logo'] = $logoPath;
        }

        $billHeader->update($data);

        return redirect()->route('admin.settings.bill-header')->with('success', 'Bill header settings updated successfully!');
    }

    public function getActiveHeader()
    {
        $header = BillHeader::getActive();
        return response()->json($header);
    }
}
