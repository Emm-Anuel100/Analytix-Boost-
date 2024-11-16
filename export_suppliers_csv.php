<?php 
include("./layouts/session.php"); // include session
include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// Fetch supplier data
$stmt = $conn->prepare("SELECT id, name, rc_code, email, phone, city FROM suppliers WHERE user_email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Set headers to force the file download as CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Supplier_List.csv"');

// Open the output stream to write CSV data
$output = fopen('php://output', 'w');

// Add the header row for CSV
fputcsv($output, ['#', 'Supplier Name', 'RC Code', 'Email', 'Phone', 'City']);

// Initialize a counter for sequential numbering
$counter = 1;

// Loop through results and write them as CSV rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Use the counter for numbering, then increment it
        fputcsv($output, [$counter++, $row['name'], $row['rc_code'], $row['email'], $row['phone'], $row['city']]);
    }
} else {
    // If no data is found, output a message
    fputcsv($output, ['No suppliers found']);
}

// Close the output stream
fclose($output);

// Close the database connection
$conn->close();
?>   
