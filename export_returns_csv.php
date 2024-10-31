<?php
// Start a new session
require('layouts/session.php');

$user_email = $_SESSION['email']; // User's email

// Database connection
include('conn.php'); 

// Establish the connection to the user's database
$conn = connectMainDB();

// Set headers for CSV download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=sales_returns_report.csv');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output the column headings
fputcsv($output, ['Customer', 'Reference', 'Status', 'Grand Total', 'Amount', 'Date', 'Generated On']);

// Get current timestamp
$currentTimestamp = date('Y-m-d H:i:s a');

// Fetch sales return data
$query = "SELECT date, customer, reference, status, grand_total_returned, amount_returned 
          FROM sales_return 
          WHERE user_email = '$user_email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Fetch data and write to the CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['customer'], 
            $row['reference'], 
            $row['status'], 
            $row['grand_total_returned'], 
            $row['amount_returned'], 
            $row['date'],
            $currentTimestamp // Adding the timestamp to each row
        ]);
    }
} else {
    // If no data, add a single line indicating that
    fputcsv($output, ['No records found.']);
}

// Close the output stream
fclose($output);

