<?php 
include("./layouts/session.php"); // Include session
include 'conn.php'; // Include database connection

// Include FPDF library
require 'fpdf/fpdf.php'; 

// Establish the connection
$conn = connectMainDB();

$user_email = $_SESSION['email']; // User's email

// Fetch quotation and product details with JOIN on product name, filtered by user email
$query = "
    SELECT q.id, q.product_name, q.customer_name, q.description, q.status, q.reference, p.image
    FROM quotation AS q
    LEFT JOIN products AS p ON q.product_name = p.product_name
    WHERE q.user_email = ? ORDER BY q.id";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Set title
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Quotation List', 0, 1, 'C');

// Add the timestamp at the bottom of the PDF
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Generated on: ' . date('Y-m-d H:i:s a'), 0, 1, 'C');
$pdf->Ln(10); // Add some space before the timestamp

// Set font for the header
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(40, 10, 'Product Name', 1); // Column 1
$pdf->Cell(40, 10, 'Customer Name', 1); // Column 2
$pdf->Cell(40, 10, 'Description', 1); // Column 3
$pdf->Cell(30, 10, 'Status', 1); // Column 4
$pdf->Cell(30, 10, 'Reference', 1); // Column 5
$pdf->Ln(); // Move to the next line

// Set font for the body
$pdf->SetFont('Arial', '', 10);

// Check if there are results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get product details
        $product_name = htmlspecialchars($row['product_name']);
        $customer_name = htmlspecialchars($row['customer_name']);
        $description = htmlspecialchars($row['description']);
        $status = htmlspecialchars($row['status']);
        $reference = htmlspecialchars($row['reference']);

        // Add a row to the table
        $pdf->Cell(40, 10, $product_name, 1);
        $pdf->Cell(40, 10, $customer_name, 1);
        $pdf->Cell(40, 10, $description, 1);
        $pdf->Cell(30, 10, $status, 1);
        $pdf->Cell(30, 10, $reference, 1);
        $pdf->Ln(); // Move to the next line
    }
} else {
    $pdf->Cell(0, 10, 'No quotations available.', 0, 1);
}

// Output the PDF to the browser
$pdf->Output('I', 'quotations.pdf'); // 'I' means inline (in browser)

// Close the database connection
$conn->close();  


