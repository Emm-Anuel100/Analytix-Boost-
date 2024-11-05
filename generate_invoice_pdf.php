<?php
include("./layouts/session.php");

require 'conn.php'; // include connection
require 'fpdf/fpdf.php';  // Include the FPDF library

$conn = connectMainDB();
$user_email = $_SESSION['email'];  // user email

// Default sorting order
$order = "DESC"; // Newest by default

// Check if a sorting option is selected
if (isset($_GET['sort_option'])) {
    $sortOption = $_GET['sort_option'];
    
    if ($sortOption == 'oldest') {
        $order = "ASC"; // Oldest first
    } else {
        $order = "DESC"; // Newest first
    }
}

// Fetch sales data from the database
$sql = "SELECT reference, customer, date, grand_total, amount_paid, amount_due, change_element, status 
        FROM sales WHERE user_email = ? ORDER BY date $order";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Create a new PDF document
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(270, 10, 'Sales Invoice List', 0, 1, 'C');

// Add timestamp
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(270, 10, 'Generated on: ' . date('Y-m-d H:i:s a'), 0, 1, 'R');

// Add table headers
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, 'Customer', 1);
$pdf->Cell(40, 10, 'Reference No', 1);
$pdf->Cell(30, 10, 'Date', 1);
$pdf->Cell(40, 10, 'Grand Total', 1);
$pdf->Cell(40, 10, 'Paid', 1);
$pdf->Cell(40, 10, 'Amount Due', 1);
$pdf->Cell(40, 10, 'Status', 1);
$pdf->Ln();

// Fetch data and populate the PDF
$pdf->SetFont('Arial', '', 10);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(40, 10, $row['customer'], 1);
    $pdf->Cell(40, 10, $row['reference'], 1);
    $pdf->Cell(30, 10, $row['date'], 1);
    $pdf->Cell(40, 10, number_format($row['grand_total'], 2), 1);
    $pdf->Cell(40, 10, number_format($row['amount_paid'], 2), 1);
    $pdf->Cell(40, 10, number_format($row['amount_due'], 2), 1);
    $pdf->Cell(40, 10, $row['status'], 1);
    $pdf->Ln();
}

// Output the PDF to the browser
$pdf->Output('I', 'sales_report.pdf');

