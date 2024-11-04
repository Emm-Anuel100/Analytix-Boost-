<?php
include("./layouts/session.php"); // include session
// Set the timezone to Africa/Lagos
date_default_timezone_set('Africa/Lagos');

// Ensure the session has a valid email
if (!isset($_SESSION['email']) || !$_SESSION['authenticated']) {
	header('Location: signin.php');
}

// Include database connection
include 'conn.php';

// Establish the connection to the user's database
$conn = connectMainDB();

// Sanitize email (for safety)
$email = $conn->real_escape_string($_SESSION['email']);

// Fetch and sort product data by ID
$query = "SELECT id, email, product_name, slug, store, sku, category, expiry_on, price, unit, quantity FROM products WHERE email = ? 
              ORDER BY created_at DESC";
    // Prepare statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);  // "s" denotes string type
    $stmt->execute();
    $result = $stmt->get_result();

// Output CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="product-list.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Set the header row
fputcsv($output, ['id', 'Name', 'Slug', 'Store','SKU', 'Category', 'Expiry', 'Price', 'Unit', 'Quantity']);

// Add data to the CSV file
$counter = 1; // To create sequential IDs
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $counter,
        $row['product_name'],
        $row['slug'],
        $row['store'],
        $row['sku'],
        $row['category'],
        $row['expiry_on'],
        $row['price'],
        $row['unit'],
        $row['quantity']
    ]);
    $counter++;
}

// Close the output stream
fclose($output);
exit;

