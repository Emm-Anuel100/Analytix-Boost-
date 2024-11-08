<?php 
include("./layouts/session.php"); // include session

include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

$user_email = $_SESSION['email']; // User's email

// Fetch the categories from the database
$sql = "SELECT id, category_name, description FROM expense_category
 WHERE user_email = '$user_email' ORDER BY id DESC"; // Newest first

$result = $conn->query($sql);

// Set the headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="expense_categories.csv"');

// Open the output stream for CSV
$output = fopen('php://output', 'w');

// Add the column headers to the CSV
fputcsv($output, ['#', 'Category Name', 'Description']);

// Add data rows
$serialNumber = 1; // Initialize serial number
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $serialNumber, 
            htmlspecialchars($row['category_name']), 
            htmlspecialchars($row['description'])
        ]);
        $serialNumber++; // Increment serial number
    }
} else {
    fputcsv($output, ['No data available']);
}

// Close the output stream
fclose($output);
exit; // Terminate the script after the CSV is generated

