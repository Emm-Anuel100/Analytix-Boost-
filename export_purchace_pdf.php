<?php 
include("./layouts/session.php"); // include session

include 'conn.php'; // Include database connection

require('fpdf/fpdf.php'); // FPDF Library

// Establish the connection
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// Query to fetch purchase records
$query = "SELECT * FROM purchases WHERE user_email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email); // Use $user_email here
$stmt->execute();
$result = $stmt->get_result();

// Initialize PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Title
$pdf->Cell(0, 10, 'Purchase Record', 0, 1, 'C');
$pdf->Ln(5);

// Generate timestamp
$generated_at = date("d M Y H:i:s a");

// Set font for timestamp to normal (not bold)
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Generated at: ' . $generated_at, 0, 1, 'C'); // Add timestamp
$pdf->Ln(5); // Optional spacing before table

// Column headers
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, 'Supplier', 1);
$pdf->Cell(30, 10, 'Product', 1);
$pdf->Cell(20, 10, 'Order Tax', 1);
$pdf->Cell(25, 10, 'Reference', 1);
$pdf->Cell(25, 10, 'Date', 1);
$pdf->Cell(20, 10, 'Status', 1);
$pdf->Cell(20, 10, 'Total', 1);
$pdf->Cell(20, 10, 'Paid', 1);
$pdf->Cell(20, 10, 'Due', 1);
$pdf->Ln();

// Set font for table rows
$pdf->SetFont('Arial', '', 10);

// Fetch and display each row
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $row['supplier_name'], 1);
        $pdf->Cell(30, 10, $row['product_name'], 1);
        $pdf->Cell(20, 10, number_format($row['order_tax'], 2), 1);
        $pdf->Cell(25, 10, $row['reference'], 1);
        $pdf->Cell(25, 10, date("d M Y", strtotime($row['purchase_date'])), 1);
        
        // Status with limited text length
        $status = strlen($row['status']) > 8 ? substr($row['status'], 0, 8) . '...' : $row['status'];
        $pdf->Cell(20, 10, $status, 1);

        $pdf->Cell(20, 10, number_format($row['grand_total'], 2), 1);
        $pdf->Cell(20, 10, number_format($row['amount_paid'], 2), 1);
        $pdf->Cell(20, 10, number_format($row['amount_due'], 2), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No purchases found.', 1, 1, 'C');
}

// Output PDF in browser
$pdf->Output("I", "Purchase_Record.pdf");

// Close statement and connection
$stmt->close();
$conn->close();

