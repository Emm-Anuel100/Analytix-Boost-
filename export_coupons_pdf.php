<?php 
include("./layouts/session.php"); // Include session
include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

require('fpdf/fpdf.php');

$user_email = $_SESSION['email']; // Retrieve the user email

// Prepare the query
$couponQuery = "
    SELECT product_name, name, code, type, discount_value, coupon_limit, end_date, status 
    FROM coupons 
    WHERE user_email = ?";

$stmt = $conn->prepare($couponQuery);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Create instance of FPDF in landscape mode
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Add title
$pdf->Cell(0, 10, 'Coupon List', 0, 1, 'C'); // Centered title with bold font
$pdf->Ln(5); // Line break after title

// Add the "Generated at" timestamp below the title
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Generated at: ' . date('Y-m-d H:i:s a'), 0, 1, 'C'); // Centered timestamp
$pdf->Ln(5); // Line break after timestamp

// Set font for table header
$pdf->SetFont('Arial', 'B', 12);

// Add a spacer to shift the table to the right
$pdf->Cell(30, 10, '', 0, 0); // Spacer cell

// Set table header
$pdf->Cell(40, 10, 'Product Name', 1);
$pdf->Cell(30, 10, 'Name', 1);
$pdf->Cell(25, 10, 'Code', 1);
$pdf->Cell(20, 10, 'Type', 1);
$pdf->Cell(30, 10, 'Discount', 1);
$pdf->Cell(20, 10, 'Limit', 1);
$pdf->Cell(30, 10, 'End Date', 1);
$pdf->Cell(20, 10, 'Status', 1);
$pdf->Ln();

// Set font for table content
$pdf->SetFont('Arial', '', 12);

// Fetch and display each coupon with a spacer
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(30, 10, '', 0, 0); // Spacer cell
    $pdf->Cell(40, 10, $row['product_name'], 1);
    $pdf->Cell(30, 10, $row['name'], 1);
    $pdf->Cell(25, 10, $row['code'], 1);
    $pdf->Cell(20, 10, $row['type'], 1);
    $pdf->Cell(30, 10, $row['discount_value'], 1);
    $pdf->Cell(20, 10, $row['coupon_limit'], 1);
    $pdf->Cell(30, 10, $row['end_date'], 1);
    $pdf->Cell(20, 10, $row['status'], 1);
    $pdf->Ln();
}

// Output PDF
$pdf->Output('I', 'coupons_List.pdf'); // 'I' for inline view

