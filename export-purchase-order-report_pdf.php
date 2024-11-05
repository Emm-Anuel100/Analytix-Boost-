<?php
include("./layouts/session.php"); // include session

require 'fpdf/fpdf.php'; // Fpdf Libray
include 'conn.php'; // Database connection

// get user email
$user_email = htmlspecialchars($_SESSION['email']);

// Fetch the data
$conn = connectMainDB();

// Define sorting order
// $order = isset($_POST['sort_order']) && $_POST['sort_order'] === 'Oldest' ? 'ASC' : 'DESC';

// Fetch data from purchases and products tables
$query = "
    SELECT 
        p.product_name,
        p.grand_total AS purchased_amount,
        p.pack_quantity * p.items_per_pack AS purchased_qty,
        pr.quantity AS instock_qty,
        pr.image AS product_image
    FROM 
        purchases AS p
    JOIN 
        products AS pr ON p.product_name = pr.product_name AND p.user_email = pr.email
    WHERE 
        p.user_email = ? 
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Initialize FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Purchase Order Report', 0, 1, 'C');

$pdf->Ln(10); // Line break before the table

// Add generated timestamp
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Generated at: ' . date("Y-m-d H:i:s a"), 0, 1, 'C'); // Centered timestamp

$pdf->Ln(10); // Line break before the table

// Table headers
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, '#', 1, 0, 'C');
$pdf->Cell(50, 10, 'Product', 1, 0, 'C');
$pdf->Cell(40, 10, 'Purchased Amount', 1, 0, 'C');
$pdf->Cell(40, 10, 'Purchased QTY', 1, 0, 'C');
$pdf->Cell(40, 10, 'Instock QTY', 1, 1, 'C');

// Table data
$pdf->SetFont('Arial', '', 10);
$index = 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $index++, 1, 0, 'C');
        $pdf->Cell(50, 10, $row['product_name'], 1, 0);
        $pdf->Cell(40, 10, number_format($row['purchased_amount'], 2), 1, 0);
        $pdf->Cell(40, 10, intval($row['purchased_qty']), 1, 0);
        $pdf->Cell(40, 10, intval($row['instock_qty']), 1, 1);
    }
} else {
    $pdf->Cell(180, 10, 'No records found', 1, 1, 'C');
}

$stmt->close();
$conn->close();

// Output PDF to browser
$pdf->Output('I', 'purchase_order_report.pdf');
