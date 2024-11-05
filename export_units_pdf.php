<?php
require 'fpdf/fpdf.php';
include 'conn.php'; // Database connection

// Start session and get user email
session_start();
$user_email = $_SESSION['email'];

// Fetch the data
$conn = connectMainDB();

$sql = "SELECT * FROM units WHERE user_email = '$user_email' ORDER BY name";
$result = $conn->query($sql);

// Initialize FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Set font and add title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, 'Units List', 0, 1, 'C');

// Add generated on text with timestamp
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, 'Generated on: ' . date('d-m-Y H:i:s a'), 0, 1, 'C');
$pdf->Ln(10); // Add some space before the table

// Set font for the table header (bold and bigger)
$pdf->SetFont('Arial', 'B', 12);

// Table headers
$pdf->Cell(40, 10, 'Unit', 1);
$pdf->Cell(30, 10, 'Short Name', 1);
$pdf->Cell(40, 10, 'No. of Products', 1);
$pdf->Cell(40, 10, 'Created On', 1);
$pdf->Cell(30, 10, 'Status', 1);
$pdf->Ln();

// Set font for table rows (regular and smaller)
$pdf->SetFont('Arial', '', 11);

// Fetch data from the result and print each row into the PDF
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get unit name and short name
        $unit_name = $row['name'];
        $unit_short_name = $row['short_name'];

        // Count the total products for each unit
        $product_count_sql = "SELECT COUNT(*) as total_units FROM products WHERE unit = '$unit_short_name' AND email = '$user_email'";
        $product_count_result = $conn->query($product_count_sql);
        $product_count_row = $product_count_result->fetch_assoc();
        $total_units = $product_count_row['total_units'];

        // Format the created on date
        $created_on = date('d M Y', strtotime($row['timestamp']));
        $status = ucfirst($row['status']); // Capitalize status

        // Insert data into PDF (normal text for rows)
        $pdf->Cell(40, 10, $unit_name, 1);
        $pdf->Cell(30, 10, $unit_short_name, 1);
        $pdf->Cell(40, 10, $total_units, 1);
        $pdf->Cell(40, 10, $created_on, 1);
        $pdf->Cell(30, 10, $status, 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(180, 10, 'No data available', 1, 1, 'C');
}

// Output PDF
$pdf->Output('I', 'units_report.pdf'); // 'I' displays in browser, 'D' forces download
