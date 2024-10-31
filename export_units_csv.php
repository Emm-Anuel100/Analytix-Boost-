<?php
include 'conn.php'; // Database connection

// Start session and get user email
session_start();
$user_email = $_SESSION['email'];

// Fetch the data
$conn = connectMainDB();
$sql = "SELECT * FROM units WHERE user_email = '$user_email' ORDER BY name";
$result = $conn->query($sql);

// Set the headers to force download as CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=units_report.csv');

// Open the output stream
$output = fopen('php://output', 'w');

// Write the column headers
fputcsv($output, ['Unit', 'Short Name', 'No. of Products', 'Created On', 'Status']);

// Fetch the data from the result and write each row to the CSV
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get unit name and short name
        $unit_name = $row['name'];
        $unit_short_name = $row['short_name'];

        // Count the total products for each unit
        $product_count_sql = "SELECT COUNT(*) as total_units FROM products WHERE unit = '$unit_short_name' AND email = '$user_email'";
        $product_count_result = $conn->query($product_count_sql);
        $product_count_row = $product_count_result->fetch_assoc();
        $total_units = $product_count_row['total_units'];

        // Format the created on date
        $created_on = date('d M Y', strtotime($row['timestamp']));
        $status = ucfirst($row['status']); // Capitalize status

        // Write data to CSV
        fputcsv($output, [$unit_name, $unit_short_name, $total_units, $created_on, $status]);
    }
} else {
    // If no data is available, add a row to the CSV file
    fputcsv($output, ['No data available']);
}

// Close the output stream
fclose($output);
