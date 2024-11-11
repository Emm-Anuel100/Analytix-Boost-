<?php
include("./layouts/session.php"); // Include session

include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// Set headers to force download the file as a CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Expenses_Report_List.csv');

// Open the output stream
$output = fopen('php://output', 'w');

// Define CSV headers
$csvHeaders = ['Category', 'Reference', 'Date', 'Status', 'Amount', 'Description'];
fputcsv($output, $csvHeaders);

// Fetch expenses data using the same query
$query = "SELECT category_name, reference, date, status, amount, description 
          FROM expenses WHERE user_email = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are expenses to display
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Output each row as a CSV line
        fputcsv($output, $row);
    }
} else {
    // If no data found, write a message in the CSV
    fputcsv($output, ['No expenses found']);
}

// Close the output stream
fclose($output);
exit;

