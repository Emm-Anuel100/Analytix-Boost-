<?php
include("./layouts/session.php");

// Include your PDF library (FPDF, TCPDF, etc.)
require('./fpdf/fpdf.php'); // Adjust the path accordingly

// Include database connection
require('conn.php');

$conn = connectMainDB();

// Sanitize email (for safety)
$email = trim($conn->real_escape_string($_SESSION['email']));

// Check for expired products
$query = "SELECT * FROM expired_products WHERE email = '$email'";
$result = $conn->query($query);

// Initialize PDF generation in landscape mode
$pdf = new FPDF('P'); // 'p' for portrait orientation
$pdf->AddPage();

// Set title font (bold)
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Expired Products', 0, 1, 'C'); // Title centered, no border
$pdf->Ln(5); // Add a line break

// Add timestamp
$pdf->SetFont('Arial', '', 12); // Set font for timestamp
$currentTimestamp = date('Y-m-d H:i:s a'); // Format: YYYY-MM-DD HH:MM:SS
$pdf->Cell(0, 10, 'Generated on: ' . $currentTimestamp, 0, 1, 'C'); // Centered timestamp
$pdf->Ln(10); // Add a line break before table headers

// Set the border color to gray
$pdf->SetDrawColor(169, 169, 169); // RGB for light gray

// Set font for the headers (bold)
$pdf->SetFont('Arial', 'B', 13);

// Define cell height (to simulate vertical padding)
$cellHeight = 12;

// Add table headers with gray borders and increased height for padding
$pdf->Cell(45, $cellHeight, 'Product Name', 1); // 1 adds a border
$pdf->Cell(35, $cellHeight, 'Store', 1);
$pdf->Cell(35, $cellHeight, 'SKU', 1);
$pdf->Cell(50, $cellHeight, 'Manufactured', 1);
$pdf->Cell(30, $cellHeight, 'Expiry', 1);
$pdf->Ln();

// Set font for the table rows (regular)
$pdf->SetFont('Arial', '', 11);

// Fetch data and add it to the PDF with gray borders and padding
while ($row = $result->fetch_assoc()) {
    // Simulate horizontal padding by adding a space before the text
    $pdf->Cell(45, $cellHeight, ' ' . $row['product_name'], 1); 
    $pdf->Cell(35, $cellHeight, ' ' . $row['store'], 1);
    $pdf->Cell(35, $cellHeight, ' ' . $row['sku'], 1);
    $pdf->Cell(50, $cellHeight, ' ' . $row['manufactured_date'], 1);
    $pdf->Cell(30, $cellHeight, ' ' . $row['expiry_date'], 1);
    $pdf->Ln();
}

// Output the PDF
$pdf->Output('I', 'expired_products.pdf'); // Send the PDF to the browser for display

