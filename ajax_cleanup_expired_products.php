<?php
// Include database connection
require 'conn.php';

// Connect to the database
$conn = connectMainDB();

// Get the current date
$currentDate = date('Y-m-d'); // Current date in YYYY-MM-DD format

// Query to select products that have expired more than 7 days ago
$query = "DELETE FROM expired_products 
          WHERE STR_TO_DATE(expiry_date, '%d-%m-%Y') < DATE_SUB(CURDATE(), INTERVAL 7 DAY)";

// Prepare and execute the statement
$stmt = $conn->prepare($query);
$stmt->execute();

// Prepare response
$response = [];
if ($stmt->affected_rows > 0) {
    $response['message'] = "Expired products older than 7 days have been deleted successfully.";
    $response['status'] = true;
} else {
    $response['message'] = "No expired products older than 7 days found.";
    $response['status'] = false;
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
