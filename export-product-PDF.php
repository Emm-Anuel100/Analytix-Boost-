<?php
include("./layouts/session.php"); // include session
// Set the timezone to Africa/Lagos
date_default_timezone_set('Africa/Lagos');

// Ensure the session has a valid email
if (!isset($_SESSION['email']) || !$_SESSION['authenticated'] ) {
	header('Location: signin.php');
}

// Include database connection
include 'conn.php';

// Include FPDF library
require('fpdf/fpdf.php');

// Initialize FPDF object with landscape orientation
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

// Set font for the main title
$pdf->SetFont('Arial', 'B', 16);

// Add the main title
$title = 'Product List';
$pdf->Cell(0, 10, $title, 0, 1, 'C');

// Set font for the date and time
$pdf->SetFont('Arial', '', 12);
$dateTime = "Generated on: " . date('Y-m-d H:i:s a'); // Get current date and time

// Calculate the width of the date/time string
$dateTimeWidth = $pdf->GetStringWidth($dateTime);

// Set position for the date/time (align it right)
$pdf->SetX(-$dateTimeWidth - 10); // 10 units padding from the right edge

// Add the date and time
$pdf->Cell(0, 10, $dateTime, 0, 1, 'R'); // 'R' for right alignment

$pdf->Ln(10); // Line break to add space after the title and date/time

// Set font for the table header
$pdf->SetFont('Arial', 'B', 12);

// Adjust the column widths to fit content better
$colWidths = [
    'S/N' => 15,  // Slightly narrower for serial number
    'Name' => 35, // Slightly wider for product name
    'Slug' => 35, // Adjust width for slug
    'Store' => 40, // Adjust width for store
    'SKU' => 30,  // Keep SKU as it is
    'Category' => 30, // Slightly narrower for category
    'Expiry' => 30, // Keep brand as it is
    'Price' => 25, // Adjust price width
    'Unit' => 20,  // Slightly narrower for unit
    'Quantity' => 20 // Slightly narrower for quantity
];

// Set table header with adjusted widths
foreach ($colWidths as $colName => $colWidth) {
    $pdf->Cell($colWidth, 10, $colName, 1, 0, 'C');
}
$pdf->Ln();


// Connect to the database
$conn = connectMainDB();

// Sanitize email (for safety)
$email = $conn->real_escape_string($_SESSION['email']);

// Fetch and sort product data by ID
$query = "SELECT id, email, product_name, slug, store, sku, category, expiry_on, price, unit, quantity FROM products WHERE email = ? 
              ORDER BY created_at DESC";
    // Prepare statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);  // "s" denotes string type
    $stmt->execute();
    $result = $stmt->get_result();

// Set font for the table content (not bold)
$pdf->SetFont('Arial', '', 12);

// Initialize row counter
$rowNumber = 1;

// Add data to PDF with adjusted widths
while ($row = $result->fetch_assoc()) {
    $pdf->Cell($colWidths['S/N'], 10, $rowNumber++, 1, 0, 'C');
    $pdf->Cell($colWidths['Name'], 10, $row['product_name'], 1, 0, 'C');
    $pdf->Cell($colWidths['Slug'], 10, $row['slug'], 1, 0, 'C');
    $pdf->Cell($colWidths['Store'], 10, $row['store'], 1, 0, 'C');
    $pdf->Cell($colWidths['SKU'], 10, $row['sku'], 1, 0, 'C');
    $pdf->Cell($colWidths['Category'], 10, $row['category'], 1, 0, 'C');
    $pdf->Cell($colWidths['Expiry'], 10, $row['expiry_on'], 1, 0, 'C');
    $pdf->Cell($colWidths['Price'], 10, $row['price'], 1, 0, 'C');
    $pdf->Cell($colWidths['Unit'], 10, $row['unit'], 1, 0, 'C');
    $pdf->Cell($colWidths['Quantity'], 10, $row['quantity'], 1, 0, 'C');
    $pdf->Ln();
}

// Output PDF to browser
$pdf->Output('I', 'product-list.pdf'); // 'I' for inline

