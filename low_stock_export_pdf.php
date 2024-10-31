<?php
include("./layouts/session.php");

require('./fpdf/fpdf.php'); // Invoke FPDF

// Include database connection
require('conn.php');

$conn = connectMainDB();

// Create instance of FPDF class with landscape orientation
$pdf = new FPDF('L'); // 'L' for landscape orientation
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Add a title
$pdf->Cell(0, 10, 'Stock Inventory List', 0, 1, 'C');

// Add a line break for spacing
$pdf->Ln(10); // Adjust the number for more or less space

// Add generated timestamp
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Generated on: ' . date('Y-m-d  H:i:s a'), 0, 1, 'C');

// Add a line break before the table
$pdf->Ln(5); // Adjust the number for more or less space

// Add column headers
$pdf->SetFont('Arial', 'B', 13); // Header font size
$pdf->Cell(45, 10, 'Warehouse', 1);
$pdf->Cell(35, 10, 'Store', 1);
$pdf->Cell(70, 10, 'Product', 1);
$pdf->Cell(40, 10, 'Category', 1);
$pdf->Cell(30, 10, 'SKU', 1);
$pdf->Cell(30, 10, 'Qty', 1);
$pdf->Cell(35, 10, 'Price', 1);
$pdf->Ln();

// Sanitize the email session for safety
$email = trim($conn->real_escape_string($_SESSION['email']));

// Query to fetch products data
$query = "
    SELECT warehouse, store, product_name, category, sku, quantity, price 
    FROM products 
    WHERE email = '$email'
";
$result = $conn->query($query);

// Loop through the result set and add data to the PDF
if ($result->num_rows > 0) {
    $pdf->SetFont('Arial', '', 12); // Set font size for the content
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(45, 10, htmlspecialchars($row['warehouse']), 1);
        $pdf->Cell(35, 10, htmlspecialchars($row['store']), 1);
        $pdf->Cell(70, 10, htmlspecialchars($row['product_name']), 1);
        $pdf->Cell(40, 10, htmlspecialchars($row['category']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($row['sku']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($row['quantity']), 1);
        $pdf->Cell(35, 10, number_format($row['price'], 2), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No products found.', 0, 1, 'C');
}

// Output the PDF
$pdf->Output('I', 'products.pdf'); 

