<?php 
include("./layouts/session.php"); // include session

include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

$user_email = $_SESSION['email']; // User's email

// Fetch data from purchases and products tables
$query = "
    SELECT 
        p.product_name,
        p.grand_total AS purchased_amount,
        p.pack_quantity * p.items_per_pack AS purchased_qty,
        pr.quantity AS instock_qty,
        pr.image AS product_image
    FROM 
        purchases AS p
    JOIN 
        products AS pr ON p.product_name = pr.product_name AND p.user_email = pr.email
    WHERE 
        p.user_email = ? 
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Set headers to download file as a CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=purchase_order_report.csv');

// Open file in PHP output stream
$output = fopen('php://output', 'w');

// Add column headers
fputcsv($output, ['#', 'Product', 'Purchased Amount', 'Purchased QTY', 'Instock QTY']);

// Populate rows with data
$index = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $index++,
            $row['product_name'],
            number_format($row['purchased_amount'], 2),
            intval($row['purchased_qty']),
            intval($row['instock_qty'])
        ]);
    }
} else {
    fputcsv($output, ['No records found']);
}

$stmt->close(); // close statement
$conn->close(); // close connection

fclose($output); // Close output stream

