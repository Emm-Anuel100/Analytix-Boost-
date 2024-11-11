<?php 
include("./layouts/session.php"); // Include session

include 'conn.php'; // Include database connection

require('fpdf/fpdf.php'); // FPDF Library

// Establish the connection
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// Query for fetching customer data 
$query = "SELECT id, name, email, phone, city FROM customers WHERE user_email = ?";

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email); // Bind user's email
$stmt->execute();
$result = $stmt->get_result();

// Initialize the PDF document with landscape orientation
$pdf = new FPDF('L', 'mm', 'A4'); // 'L' for Landscape, 'mm' for millimeters, 'A4' for paper size
$pdf->AddPage();

// Set title and header for the PDF
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Customer List', 0, 1, 'C');

$pdf->Ln(); // Line break

// Add the "Generated on: Timestamp" below the title
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Generated on: ' . date('Y-m-d H:i:s a'), 0, 1, 'C');

$pdf->Ln(); // Line break

// Move the X-axis position to shift the table to the right
$pdf->SetX(20); // Move 20mm from the left margin to the right

// Add column headers with adjusted widths
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 10, 'Customer Name', 1, 0, 'C');
$pdf->Cell(80, 10, 'Email', 1, 0, 'C');
$pdf->Cell(40, 10, 'Phone', 1, 0, 'C');
$pdf->Cell(40, 10, 'City', 1, 1, 'C');

// Add data to the PDF
$pdf->SetFont('Arial', '', 12);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Move the X-axis position to shift the table to the right
        $pdf->SetX(20); // Move 20mm from the left margin to the right
        $pdf->Cell(80, 10, htmlspecialchars($row['name']), 1, 0, 'C');
        $pdf->Cell(80, 10, htmlspecialchars($row['email']), 1, 0, 'C');
        $pdf->Cell(40, 10, htmlspecialchars($row['phone']), 1, 0, 'C');
        $pdf->Cell(40, 10, htmlspecialchars($row['city']), 1, 1, 'C');
    }
}

// Output the PDF
$pdf->Output('I', 'customer_list.pdf'); // 'I' for Inline view

