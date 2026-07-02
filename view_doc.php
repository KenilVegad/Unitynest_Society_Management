<?php
// Set file path relative to project
$file_path = 'uploads/property_67f0cc37ab251_Practical-4.pdf';

// Check if file exists
if (file_exists($file_path)) {
    // Force browser to open PDF inline
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit;
} else {
    echo "<h2 style='color:red; text-align:center;'>PDF file not found.</h2>";
}
?>