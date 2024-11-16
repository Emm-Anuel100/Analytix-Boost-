<?php 
include("./layouts/session.php"); // include session
include 'conn.php'; // Include database connection
require('fpdf/fpdf.php'); // FPDF Library

// Establish the connection
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// Fetch supplier data
$stmt = $conn->prepare("SELECT id, name, rc_code, email, phone, city FROM suppliers WHERE user_email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Initialize FPDF with landscape orientation
$pdf = new FPDF('L', 'mm', 'A4'); // 'L' for landscape orientation, A4 paper size
$pdf->AddPage();

// Set font for the document
$pdf->SetFont('Arial', 'B', 16);

// Add title
$pdf->Cell(0, 10, 'Supplier Data Report', 0, 1, 'C');

// Add generated timestamp below title
$pdf->SetFont('Arial', 'I', 10); // Italic font for timestamp
$pdf->Cell(0, 10, 'Generated at: ' . date('Y-m-d H:i:s'), 0, 1, 'C');

// Add a line break
$pdf->Ln(10);

// Add table headers
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, '#', 1, 0, 'C');
$pdf->Cell(80, 10, 'Supplier Name', 1, 0, 'C');
$pdf->Cell(30, 10, 'RC Code', 1, 0, 'C');
$pdf->Cell(80, 10, 'Email', 1, 0, 'C'); // Increased width for Email column
$pdf->Cell(30, 10, 'Phone', 1, 0, 'C');
$pdf->Cell(40, 10, 'City', 1, 1, 'C');

// Set font for table data
$pdf->SetFont('Arial', '', 10);

// Initialize a counter for numbering
$counter = 1;

// Loop through results and add data to the table
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Use the counter instead of the id
        $pdf->Cell(10, 10, $counter++, 1, 0, 'C'); // Increment counter for numbering
        $pdf->Cell(80, 10, $row['name'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['rc_code'], 1, 0, 'C');
        $pdf->Cell(80, 10, $row['email'], 1, 0, 'C'); // Adjusted width for Email column
        $pdf->Cell(30, 10, $row['phone'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['city'], 1, 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, 'No suppliers found.', 1, 1, 'C');
}

// Output the PDF to the browser
$pdf->Output('I', 'supplier_List.pdf');

// Close the database connection
$conn->close();
?>
