<?php
include("./layouts/session.php"); // include session
include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

// User's email
$user_email = htmlspecialchars($_SESSION['email']);

// Set headers to download file as CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Warehouse_Report.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Define and write column headers
fputcsv($output, ['#', 'Name', 'Contact Person', 'Phone', 'Total Products',
 'Country', 'State', 'Email', 'Created On', 'Status']);

// Fetch data from the warehouse table
$sql = "SELECT * FROM warehouse WHERE user_email = '$user_email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        // Get total products count for each warehouse
        $warehouse_name = $row['name'];
        $product_count_sql = "SELECT COUNT(*) as total_products FROM products WHERE warehouse = '$warehouse_name' AND email = '$user_email'";
        $product_count_result = $conn->query($product_count_sql);
        $total_products = $product_count_result->fetch_assoc()['total_products'];

        // Write each row to CSV
        fputcsv($output, [
            $i++,
            $row['name'],
            $row['contact_person'],
            $row['phone'],
            $total_products,
            $row['country'],
            $row['state'],
            $row['email'],
            date('d M Y', strtotime($row['timestamp'])),
            $row['status']
        ]);
    }
}

// Close the output stream
fclose($output);
exit;
