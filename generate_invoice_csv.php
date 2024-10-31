<?php
include("./layouts/session.php");
require 'conn.php'; // include connection

$conn = connectMainDB();
$user_email = $_SESSION['email'];  // user email

// Default sorting order
$order = "DESC"; // Newest by default

// Check if a sorting option is selected
if (isset($_GET['sort_option'])) {
    $sortOption = $_GET['sort_option'];
    
    if ($sortOption == 'oldest') {
        $order = "ASC"; // Oldest first
    } else {
        $order = "DESC"; // Newest first
    }
}

// Fetch sales data from the database
$sql = "SELECT reference, customer, date, grand_total, amount_paid, amount_due, change_element, status 
        FROM sales WHERE user_email = ? ORDER BY date $order";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Set headers for CSV download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=invoice.csv');

// Open output stream for writing
$output = fopen('php://output', 'w');

// Write CSV column headers
fputcsv($output, ['Customer', 'Reference No', 'Date', 'Grand Total', 'Paid', 'Amount Due', 'Status']);

// Fetch and write data row by row
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['customer'],
        $row['reference'],
        $row['date'],
        number_format($row['grand_total'], 2),
        number_format($row['amount_paid'], 2),
        number_format($row['amount_due'], 2),
        $row['status']
    ]);
}

// Close the output stream
fclose($output);
exit();


