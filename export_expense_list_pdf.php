<?php 
include("./layouts/session.php"); // include session

include 'conn.php'; // Include database connection

require('fpdf/fpdf.php'); // FPDF Library

// Establish the connection
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Add title
$pdf->Cell(0, 10, 'Expenses Report List', 0, 1, 'C');
$pdf->Ln(5);

// Add generated timestamp
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Generated at: ' . date('Y-m-d H:i:s'), 0, 1, 'C');
$pdf->Ln(10);

// Set up table header
$pdf->SetFont('Arial', 'B', 12);
$header = ['Category', 'Reference', 'Date', 'Status', 'Amount', 'Description'];
$widths = [30, 30, 25, 20, 25, 50];

// Print table headers
foreach ($header as $i => $col) {
    $pdf->Cell($widths[$i], 10, $col, 1, 0, 'C');
}
$pdf->Ln();

// Fetch expenses data
$query = "SELECT category_name, reference, date, status, amount, description 
          FROM expenses WHERE user_email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are expenses to display
if ($result->num_rows > 0) {
    $pdf->SetFont('Arial', '', 10);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell($widths[0], 10, $row['category_name'], 1);
        $pdf->Cell($widths[1], 10, $row['reference'], 1);
        $pdf->Cell($widths[2], 10, $row['date'], 1);
        $pdf->Cell($widths[3], 10, $row['status'], 1);
        $pdf->Cell($widths[4], 10, $row['amount'], 1);
        $pdf->Cell($widths[5], 10, $row['description'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No expenses found', 1, 0, 'C');
}

// Output the PDF
$pdf->Output('I', 'Expenses_Report_List.pdf'); // 'I' Display Inline

