<?php
include("./layouts/session.php"); // start session
include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the barcode from the request
    $input = json_decode(file_get_contents("php://input"), true);

    $barcode = $input['barcode'];
    // Get the email from the session
    $email = $_SESSION['email'];

    // Query to fetch product details by barcode
    $query = $conn->prepare(
        "SELECT id, email, product_name, price, discount_type, discount_value, tax_value, unit, image
        FROM products WHERE product_barcode = ? AND email = ?");
        
        // Bind both the barcode and email to the query
        $query->bind_param('ss', $barcode, $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        
        // Calculate the discount and tax
        $price = $product['price'];
        $discount_type = $product['discount_type'];
        $discount_value = $product['discount_value'];
        $tax_value = $product['tax_value'];

        // Handle discount logic
        if ($discount_type == 'Percentage') {
            $discounted_amount = $price * ($discount_value / 100); // Percentage discount
        } else {
            $discounted_amount = $discount_value; // Cash discount
        }

        // Calculate total cost after discount
        $total_cost_after_discount = $price - $discounted_amount;

        // Add tax to the total cost
        $total_cost = $total_cost_after_discount + $tax_value;

        echo json_encode([
            'success' => true,
            'product' => [
                'name' => $product['product_name'],
                'price' => $product['price'],
                'discount_type' => $product['discount_type'],
                'discount_value' => $product['discount_value'],
                'tax_value' => $product['tax_value'],
                'unit' => $product['unit'],
                'total_cost' => $total_cost,
                'image_url' => $product['image'] // assuming you have an image URL field
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
    }

    $conn->close();
}
