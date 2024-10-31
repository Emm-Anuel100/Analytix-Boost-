<?php
include("./layouts/session.php");

// Include database connection
require('conn.php');

$conn = connectMainDB();

// Sanitize email (for safety)
$email = trim($conn->real_escape_string($_SESSION['email']));

// Check for expired products
$query = "SELECT * FROM sales WHERE user_email = '$email'";
$result = $conn->query($query); 

// Set headers to indicate that the output is a CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="sales_list.csv"');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Add column headers
fputcsv($output, ['Customer', 'Reference', 'Amount Paid', 'Change Element', 'Amount Due', 'Grand Total', 'Status', 'Date']);

// Fetch data and write it to the CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['customer'],
        $row['reference'],
        $row['amount_paid'],
        $row['change_element'],
        $row['amount_due'],
        $row['grand_total'],
        $row['status'],
        $row['date']
    ]);
}

// Close the file pointer
fclose($output);

