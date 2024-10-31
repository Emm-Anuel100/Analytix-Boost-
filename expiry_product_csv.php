<?php
include("./layouts/session.php");

// Include database connection
require('conn.php');

$conn = connectMainDB();

// Sanitize email (for safety)
$email = trim($conn->real_escape_string($_SESSION['email']));

// Check for expired products
$query = "SELECT * FROM expired_products WHERE email = '$email'";
$result = $conn->query($query);

// Set headers to indicate that the output is a CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="expired_products.csv"');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Add column headers
fputcsv($output, ['Product Name', 'Store', 'SKU', 'Manufactured Date', 'Expiry Date']);

// Fetch data and write it to the CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['product_name'],
        $row['store'],
        $row['sku'],
        $row['manufactured_date'],
        $row['expiry_date']
    ]);
}

// Close the file pointer
fclose($output);

