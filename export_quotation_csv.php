<?php 
include("./layouts/session.php"); // include session

include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

$user_email = $_SESSION['email']; // User's email

// Fetch quotation and product details with JOIN on product name, filtered by user email
$query = "
    SELECT q.id, q.product_name, q.customer_name, q.description, q.status, q.reference, p.image
    FROM quotation AS q
    LEFT JOIN products AS p ON q.product_name = p.product_name
    WHERE q.user_email = ? ORDER BY q.id";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="quotations.csv"');

// Open output stream for CSV
$output = fopen('php://output', 'w');

// Write CSV header row
fputcsv($output, ['Product Name', 'Customer Name', 'Description', 'Status', 'Reference']);

// Check if there are results for CSV
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get product details for CSV
        $product_name = htmlspecialchars($row['product_name']);
        $customer_name = htmlspecialchars($row['customer_name']);
        $description = htmlspecialchars($row['description']);
        $status = htmlspecialchars($row['status']);
        $reference = htmlspecialchars($row['reference']);

        // Add a row to the CSV
        fputcsv($output, [$product_name, $customer_name, $description, $status, $reference]);
    }
} else {
    fputcsv($output, ['No quotations available.']);
}

// Close output stream
fclose($output);
$conn->close();
exit(); // Ensure no further output is sent after the CSV

