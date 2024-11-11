<?php 
include("./layouts/session.php"); // include session

include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// Query for fetching customer data
$query = "SELECT id, name, email, phone, city FROM customers WHERE user_email = ?";

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email); // Bind user's email
$stmt->execute();
$result = $stmt->get_result();

// Set the headers for CSV file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="customer_list.csv"');

// Open PHP output stream for writing to the CSV
$output = fopen('php://output', 'w');

// Write the column headers to the CSV file
fputcsv($output, ['Customer Name', 'Email', 'Phone', 'City']);

// Add data to the CSV file
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            htmlspecialchars($row['name']),
            htmlspecialchars($row['email']),
            htmlspecialchars($row['phone']),
            htmlspecialchars($row['city'])
        ]);
    }
}

// Close the file pointer
fclose($output);

