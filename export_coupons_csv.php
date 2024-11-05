<?php 
include("./layouts/session.php"); // Include session
include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // Retrieve the user email

// Prepare the query
$couponQuery = "
    SELECT product_name, name, code, type, discount_value, coupon_limit, end_date, status 
    FROM coupons 
    WHERE user_email = ?";

$stmt = $conn->prepare($couponQuery);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Set headers to download the file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="coupons.csv"');

// Open output stream for writing CSV
$output = fopen('php://output', 'w');

// Write the CSV header
fputcsv($output, ['Product Name', 'Name', 'Code', 'Type', 'Discount', 'Limit', 'End Date', 'Status']);

// Fetch and write each coupon to the CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

// Close output stream
fclose($output);
exit;



