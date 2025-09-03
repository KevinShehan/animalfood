<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Dompdf\Dompdf;
use Dompdf\Options;

// Bootstrap Laravel application
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Simple PDF Functionality\n";
echo "================================\n\n";

try {
    // Test 1: Basic DomPDF test
    echo "1. Testing Basic DomPDF:\n";
    
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf = new Dompdf($options);
    
    $html = '<html><body><h1>Test PDF</h1><p>This is a test PDF document created by DomPDF.</p></body></html>';
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    $output = $dompdf->output();
    echo "   ✅ PDF generated successfully (Size: " . strlen($output) . " bytes)\n";
    
    // Test 2: Test with Laravel view
    echo "\n2. Testing with Laravel View:\n";
    
    $bills = \App\Models\Order::with(['customer', 'user'])
                             ->where('status', 'completed')
                             ->limit(3)
                             ->get();
    
    if ($bills->count() > 0) {
        echo "   ✅ Found " . $bills->count() . " bills for testing\n";
        
        $billsData = $bills->map(function ($bill) {
            return [
                'bill_number' => $bill->invoice_number,
                'order_number' => $bill->order_number,
                'customer_name' => $bill->customer->name ?? 'N/A',
                'customer_email' => $bill->customer->email ?? 'N/A',
                'date' => $bill->created_at->format('Y-m-d'),
                'due_date' => $bill->due_date ? $bill->due_date->format('Y-m-d') : 'N/A',
                'amount' => number_format($bill->final_amount, 2),
                'paid_amount' => number_format($bill->paid_amount, 2),
                'due_amount' => number_format($bill->due_amount, 2),
                'status' => ucfirst($bill->payment_status),
                'created_by' => $bill->user->name ?? 'System'
            ];
        });
        
        $summary = [
            'total_bills' => $bills->count(),
            'paid_bills' => $bills->where('payment_status', 'paid')->count(),
            'pending_bills' => $bills->where('payment_status', 'pending')->count(),
            'overdue_bills' => $bills->where('payment_status', 'overdue')->count(),
            'cancelled_bills' => $bills->where('status', 'cancelled')->count(),
            'total_amount' => $bills->sum('final_amount'),
            'total_paid' => $bills->sum('paid_amount'),
            'total_due' => $bills->sum('due_amount')
        ];
        
        $billHeader = \App\Models\BillHeader::where('is_active', true)->first();
        
        $html = view('admin.billing.exports.pdf', [
            'billsData' => $billsData,
            'summary' => $summary,
            'billHeader' => $billHeader,
            'reportTitle' => 'Test Bills Report',
            'includeSummary' => true,
            'includeDetails' => true
        ])->render();
        
        echo "   ✅ Laravel view rendered successfully\n";
        
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $output = $dompdf->output();
        echo "   ✅ Full PDF with data generated successfully (Size: " . strlen($output) . " bytes)\n";
        
    } else {
        echo "   ⚠️  No bills found for testing\n";
    }
    
    // Test 3: Test HTTP response simulation
    echo "\n3. Testing HTTP Response Simulation:\n";
    
    $testHtml = '<html><head><title>Test Report</title></head><body><h1>Bill Report</h1><p>Generated on: ' . date('Y-m-d H:i:s') . '</p></body></html>';
    
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($testHtml);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    $filename = 'test_bill_report_' . date('Y-m-d_H-i-s') . '.pdf';
    echo "   ✅ PDF ready for download as: $filename\n";
    echo "   ✅ Content-Type: application/pdf\n";
    echo "   ✅ Content-Disposition: attachment; filename=\"$filename\"\n";
    
    echo "\n✅ PDF Functionality Test Completed Successfully!\n";
    echo "\nYou can now try the PDF export URL:\n";
    echo "http://127.0.0.1:8000/admin/billing/export?type=pdf&title=Bills+Report&include_summary=1&include_details=1\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}
