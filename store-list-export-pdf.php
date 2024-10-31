<?php
require('./layouts/session.php'); 
require('./fpdf/fpdf.php');
// Set the timezone to Africa/Lagos
date_default_timezone_set('Africa/Lagos'); 

// Include database connection
require('conn.php'); 

// Establish the connection to the user's database
$conn = connectMainDB();

// Create instance of FPDF with custom page size (A3 landscape)
$pdf = new FPDF('L', 'mm', array(297, 210)); // 'L' for landscape orientation
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Add title
$pdf->Cell(0, 10, 'Store List', 0, 1, 'C');

// Add timestamp
$pdf->SetFont('Arial', 'I', 12); // Italic font for the timestamp
$pdf->Cell(0, 10, 'Generated on: ' . date('Y-m-d H:i:s a'), 0, 1, 'C'); // Timestamp
$pdf->Ln(10); // Add space after the timestamp

// Add column headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(50, 10, 'Store Name', 1);
$pdf->Cell(50, 10, 'User Name', 1);
$pdf->Cell(40, 10, 'Phone', 1);
$pdf->Cell(90, 10, 'Email', 1);
$pdf->Cell(30, 10, 'Status', 1);
$pdf->Ln();

// Fetch data from the database
$user_email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT store_name, user_name, phone, email, status FROM store WHERE user_email = ?");
$stmt->bind_param('s', $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Add data to PDF
$pdf->SetFont('Arial', '', 11);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(50, 10, htmlspecialchars($row['store_name']), 1);
    $pdf->Cell(50, 10, htmlspecialchars($row['user_name']), 1);
    $pdf->Cell(40, 10, htmlspecialchars($row['phone']), 1);
    $pdf->Cell(90, 10, htmlspecialchars($row['email']), 1);
    $pdf->Cell(30, 10, htmlspecialchars($row['status']), 1);
    $pdf->Ln();
}

// Close the statement
$stmt->close();

// Output the PDF
$pdf->Output('I', 'store_list.pdf'); // I for inline view
exit();
?>
