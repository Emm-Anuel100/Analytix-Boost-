<?php 
include("./layouts/session.php"); // include session
include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

// User's email
$user_email = htmlspecialchars($_SESSION['email']); 

// Include FPDF library
require('fpdf/fpdf.php');

// Fetch data from the warehouse table
$sql = "SELECT * FROM warehouse WHERE user_email = '$user_email'";
$result = $conn->query($sql);

// Initialize PDF in landscape mode
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 18);

// Add title
$pdf->Cell(0, 10, 'Warehouse List', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Generated at: ' . date('d-m-Y H:i:s'), 0, 1, 'C');
$pdf->Ln(5);

// Set header font and style
$pdf->SetFont('Arial', 'B', 10);

// Header
$pdf->Cell(10, 8, '#', 1, 0, 'C');
$pdf->Cell(30, 8, 'Name', 1, 0, 'C');
$pdf->Cell(40, 8, 'Contact Person', 1, 0, 'C');
$pdf->Cell(30, 8, 'Phone', 1, 0, 'C');
$pdf->Cell(25, 8, 'Total Products', 1, 0, 'C');
$pdf->Cell(20, 8, 'Country', 1, 0, 'C');
$pdf->Cell(20, 8, 'State', 1, 0, 'C');
$pdf->Cell(60, 8, 'Email', 1, 0, 'C');
$pdf->Cell(30, 8, 'Created On', 1, 0, 'C');
$pdf->Cell(15, 8, 'Status', 1, 0, 'C');
$pdf->Ln();

// Data rows with thinner row height
$pdf->SetFont('Arial', '', 9);  // Set regular font for data rows
$row_height = 6; // Thin row height

if ($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        $warehouse_name = $row['name'];
        
        // Count total products per warehouse
        $product_count_sql = "SELECT COUNT(*) as total_products FROM products WHERE warehouse = '$warehouse_name' AND email = '$user_email'";
        $product_count_result = $conn->query($product_count_sql);
        $total_products = $product_count_result->fetch_assoc()['total_products'];

        $pdf->Cell(10, $row_height, $i++, 1, 0, 'C');
        $pdf->Cell(30, $row_height, $row['name'], 1, 0, 'C');
        $pdf->Cell(40, $row_height, $row['contact_person'], 1, 0, 'C');
        $pdf->Cell(30, $row_height, $row['phone'], 1, 0, 'C');
        $pdf->Cell(25, $row_height, $total_products, 1, 0, 'C');
        $pdf->Cell(20, $row_height, $row['country'], 1, 0, 'C');
        $pdf->Cell(20, $row_height, $row['state'], 1, 0, 'C');
        $pdf->Cell(60, $row_height, $row['email'], 1, 0, 'C');
        $pdf->Cell(30, $row_height, date('d M Y', strtotime($row['timestamp'])), 1, 0, 'C');
        $pdf->Cell(15, $row_height, $row['status'], 1, 0, 'C');
        $pdf->Ln();
    }
}

// Output the PDF
$pdf->Output('I', 'Warehouse_Report.pdf');

