
<?php
include("./layouts/session.php");

// Include database connection
require('conn.php');

$conn = connectMainDB();

// Set the header to indicate that this is a CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="stock_inventory_list.csv"');

// Open the output stream for writing
$output = fopen('php://output', 'w');

// Add column headers
fputcsv($output, ['Warehouse', 'Store', 'Product', 'Category', 'SKU', 'Qty', 'Price']);

// Sanitize the email session for safety
$email = trim($conn->real_escape_string($_SESSION['email']));

// Query to fetch products data
$query = "
    SELECT warehouse, store, product_name, category, sku, quantity, price 
    FROM products 
    WHERE email = '$email'
";
$result = $conn->query($query);

// Loop through the result set and add data to the CSV
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Write each row to the CSV
        fputcsv($output, [
            htmlspecialchars($row['warehouse']),
            htmlspecialchars($row['store']),
            htmlspecialchars($row['product_name']),
            htmlspecialchars($row['category']),
            htmlspecialchars($row['sku']),
            htmlspecialchars($row['quantity']),
            number_format($row['price'], 2) // Format the price to 2 decimal places
        ]);
    }
} else {
    // Optionally handle no products found case
    fputcsv($output, ['No products found.']);
}

// Close the output stream
fclose($output);
exit();

