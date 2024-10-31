<?php
// Include FPDF library
require('fpdf/fpdf.php');

// Start a new session
require('layouts/session.php');

$user_email = $_SESSION['email']; // User's email

// Database connection
include('conn.php'); 

// Establish the connection to the user's database
$conn = connectMainDB();

// Create instance of FPDF class
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Add a title
$pdf->Cell(0, 10, 'Sales Returns List', 0, 1, 'C');

$pdf->Ln();

// Add timestamp
$pdf->SetFont('Arial', '', 10); // Set font for timestamp
$currentTimestamp = date('Y-m-d H:i:s a'); // Format: YYYY-MM-DD HH:MM:SS
$pdf->Cell(0, 10, 'Generated on: ' . $currentTimestamp, 0, 1, 'C'); // Centered timestamp
$pdf->Ln(10); // Add a line break before table headers

// Table header
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 10, 'Customer', 1);
$pdf->Cell(30, 10, 'Reference', 1);
$pdf->Cell(30, 10, 'Status', 1);
$pdf->Cell(30, 10, 'Grand Total', 1);
$pdf->Cell(30, 10, 'Amount', 1);
$pdf->Cell(30, 10, 'Date', 1);
$pdf->Ln();

// Fetch sales return data
$query = "SELECT date, customer, reference, status, grand_total_returned, amount_returned 
          FROM sales_return 
          WHERE user_email = '$user_email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Fetch data and add it to the PDF
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(35, 10, $row['customer'], 1);
        $pdf->Cell(30, 10, $row['reference'], 1);
        $pdf->Cell(30, 10, $row['status'], 1);
        $pdf->Cell(30, 10, $row['grand_total_returned'], 1);
        $pdf->Cell(30, 10, $row['amount_returned'], 1);
        $pdf->Cell(30, 10, $row['date'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No records found.', 0, 1, 'C');
}

// Output the PDF
$pdf->Output('I', 'sales_returns_report.pdf');

