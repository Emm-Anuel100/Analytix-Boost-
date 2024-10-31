<?php
include("./layouts/session.php");
// Include database connection
require 'conn.php';

// Connect to the database
$conn = connectMainDB();

require 'fpdf/fpdf.php';  // Include FPDF library

// Assuming the user email is stored in session
if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];

    // Query to fetch sales data for the logged-in user
    $sql = "SELECT * FROM sales WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    // Create the PDF document
    $pdf = new FPDF('L');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(180, 10, 'Sales Report', 0, 0, 'C');  // Adjust width to center
    $pdf->Ln();
    $pdf->Ln();

    // Generate timestamp on the top right
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(250, 10, 'Generated on: ' . date('Y-m-d H:i:s a'), 0, 1, 'R'); // Right-aligned timestamp

    $pdf->Ln();
    $pdf->SetX(32);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 10, 'Customer', 1);
    $pdf->Cell(25, 10, 'Reference', 1);
    $pdf->Cell(25, 10, 'Amount Paid', 1);
    $pdf->Cell(30, 10, 'Change Element', 1);
    $pdf->Cell(25, 10, 'Amount Due', 1);
    $pdf->Cell(30, 10, 'Grand Total', 1);
    $pdf->Cell(25, 10, 'Status', 1);
    $pdf->Cell(25, 10, 'Date', 1);
    $pdf->Ln();

    // Fetch data and populate the PDF
    while ($row = $result->fetch_assoc()) {
        $pdf->SetX(32);
        $pdf->Cell(40, 10, $row['customer'], 1);
        $pdf->Cell(25, 10, $row['reference'], 1);
        $pdf->Cell(25, 10, $row['amount_paid'], 1);
        $pdf->Cell(30, 10, $row['change_element'], 1);
        $pdf->Cell(25, 10, $row['amount_due'], 1);
        $pdf->Cell(30, 10, $row['grand_total'], 1);
        $pdf->Cell(25, 10, $row['status'], 1);
        $pdf->Cell(25, 10, $row['date'], 1);
        $pdf->Ln();
    }

    $pdf->Output('I', 'sales_list.pdf');
} else {
    echo "No user email found.";
}
