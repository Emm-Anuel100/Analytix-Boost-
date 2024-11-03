<?php 
include("./layouts/session.php"); // Include session
include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// Set the content type and headers for the CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="purchase_record.csv"');

// Open output stream for writing
$output = fopen('php://output', 'w');

// Write the column headers
fputcsv($output, [
    'User Email', 
    'Supplier', 
    'Purchase Date', 
    'Product', 
    'Cost Per Unit', 
    'Pack Quantity', 
    'Items Per Pack', 
    'Status', 
    'Order Tax', 
    'Amount Paid', 
    'Amount Due', 
    'Notes', 
    'Grand Total', 
    'Reference'
]);

// Query to fetch purchase records
$query = "SELECT user_email, supplier_name, purchase_date, product_name, cost_per_unit, pack_quantity, items_per_pack, status, order_tax, amount_paid, amount_due, notes, grand_total, reference 
          FROM purchases WHERE user_email = ?";
          
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email); // Use $user_email here
$stmt->execute();
$result = $stmt->get_result();

// Fetch and write each row to the CSV
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Prepare the row data
        $data = [
            $row['user_email'],
            $row['supplier_name'],
            date("d M Y", strtotime($row['purchase_date'])), // Formatting date
            $row['product_name'],
            number_format($row['cost_per_unit'], 2), // Assuming this is a monetary value
            $row['pack_quantity'],
            $row['items_per_pack'],
            $row['status'],
            number_format($row['order_tax'], 2),
            number_format($row['amount_paid'], 2),
            number_format($row['amount_due'], 2),
            $row['notes'],
            number_format($row['grand_total'], 2),
            $row['reference'],
        ];
        fputcsv($output, $data); // Write row to CSV
    }
} else {
    // Optionally, write a row indicating no data found
    fputcsv($output, ['No purchases found.']);
}

// Close output stream
fclose($output);
$stmt->close();
$conn->close();

