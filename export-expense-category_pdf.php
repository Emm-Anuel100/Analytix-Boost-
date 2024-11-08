<?php 
include("./layouts/session.php"); // include session
require('fpdf/fpdf.php'); // Include the FPDF library

include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

$user_email = $_SESSION['email']; // User's email

// Fetch the categories from the database
$sql = "SELECT id, category_name, description FROM expense_category
 WHERE user_email = '$user_email' ORDER BY id DESC"; // Newest first

$result = $conn->query($sql);

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Add a title
$pdf->Cell(200, 10, 'Expense Categories Report', 0, 1, 'C');

// Add a new line after the title
$pdf->Ln(5);

// Add the generated timestamp
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(200, 10, 'Generated at: ' . date('Y-m-d H:i:s a'), 0, 1, 'C');

// Add another line after the timestamp
$pdf->Ln(10);

// Set the initial X position for table header
$pdf->SetX(50);

// Add table headers
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, '#', 1, 0, 'C'); // Serial number column
$pdf->Cell(30, 10, 'Category Name', 1, 0, 'C');
$pdf->Cell(70, 10, 'Description', 1, 1, 'C');

// Add a new line after the header row
$pdf->Ln(2);


// Add data rows
$pdf->SetFont('Arial', '', 10);
$serialNumber = 1; // Initialize serial number
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        // Set the initial X position for table rows
        $pdf->SetX(50);

        $pdf->Cell(10, 10, $serialNumber, 1, 0, 'C'); // Display serial number
        $pdf->Cell(30, 10, htmlspecialchars($row['category_name']), 1);
        $pdf->Cell(70, 10, htmlspecialchars($row['description']), 1, 1);
        $serialNumber++; // Increment the serial number
    }
} else {
    $pdf->Cell(200, 10, 'No data available', 1, 1, 'C');
}

// Output PDF to browser
$pdf->Output('I', 'Expense Categories Report.pdf'); // 'I' for inline

