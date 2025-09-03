<?php

require_once 'vendor/autoload.php';

echo "Testing DomPDF Class Availability\n";
echo "==================================\n";

echo "Dompdf\\Dompdf: " . (class_exists('Dompdf\\Dompdf') ? "EXISTS" : "NOT FOUND") . "\n";
echo "Dompdf\\Options: " . (class_exists('Dompdf\\Options') ? "EXISTS" : "NOT FOUND") . "\n";

// Try to create instances
try {
    $dompdf = new \Dompdf\Dompdf();
    echo "Dompdf instance created successfully\n";
} catch (\Exception $e) {
    echo "Dompdf creation failed: " . $e->getMessage() . "\n";
}

try {
    $options = new \Dompdf\Options();
    echo "Options instance created successfully\n";
} catch (\Exception $e) {
    echo "Options creation failed: " . $e->getMessage() . "\n";
}

// Test basic functionality
try {
    $options = new \Dompdf\Options();
    $dompdf = new \Dompdf\Dompdf($options);
    $dompdf->loadHtml('<html><body><h1>Test</h1></body></html>');
    $dompdf->render();
    echo "Basic PDF generation test: SUCCESS\n";
} catch (\Exception $e) {
    echo "Basic PDF generation test: FAILED - " . $e->getMessage() . "\n";
}
