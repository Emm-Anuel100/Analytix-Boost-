<?php
include("./layouts/session.php");
include 'conn.php'; // Include database connection

$conn = connectMainDB();

// Always return a JSON response
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $customer_name = $_POST['customer_name']; 
    $date = $_POST['date'];
    $payment_by = $_POST['payment_by'];
    $amount_paid = $_POST['amount_paid'];
    $status = $_POST['status'];
    $amount_due = $_POST['amount_due'];
    $change_element = $_POST['change_element'];
    $grand_total = $_POST['grand_total']; 

    // Check if 'products' exists and is not empty
    if (!isset($_POST['products']) || empty($_POST['products'])) {
        echo json_encode(['success' => false, 'message' => 'Products data is missing.']);
        exit; // Stop further processing
    }

    // Decode the products array
    $products = json_decode($_POST['products'], true);

    if (!$products) {
        echo json_encode(['success' => false, 'message' => 'Failed to decode products JSON.']);
        exit;
    }    

    // Log the products array for debugging
    file_put_contents('php://stderr', print_r($products, true));

    // Sanitize the email session for safety
    $user_email = trim($conn->real_escape_string($_SESSION['email']));

    // Generate a random reference ID
    $reference_id = generateReferenceId(); 

    // Initialize the products array for formatting
    $productsArray = [];

    // Loop through each product and format the details into a string
    foreach ($products as $product) {
        $productDetails = "{$product['name']} (quantity: {$product['quantity']}, price: {$product['price']}, image: {$product['image_url']}, discount type: {$product['discountType']}, discount value: {$product['discountValue']}, tax: {$product['taxValue']}, unit: {$product['unit']}, total cost: {$product['totalCost']})";                      
        $productsArray[] = $productDetails; // Add the formatted product to the products array

        // ** Update the quantity of the product in the products table using the product id **
        $product_id = $product['name']; // Assuming each product in the form has a unique product_id
        $quantityBought = (int) $product['quantity'];

        // Update the product quantity in the products table by subtracting the bought quantity
        $updateQuantityQuery = $conn->prepare("UPDATE products SET quantity = quantity - ? WHERE product_name = ?");
        $updateQuantityQuery->bind_param('is', $quantityBought, $product_id);

        // Execute the update query
        if (!$updateQuantityQuery->execute()) {
            echo json_encode(['success' => false, 'message' => 'Failed to update product quantity: ' . $updateQuantityQuery->error]);
            exit;
        }

        $updateQuantityQuery->close();
    }

    // Combine all product strings into one
    $productsString = implode('; ', $productsArray); // Semicolon as a separator for individual products

    // Prepare the SQL query for inserting the sale
    $insertQuery = $conn->prepare("INSERT INTO sales (customer, date, payment_by, amount_paid, status, amount_due, change_element, grand_total, products, reference, user_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $insertQuery->bind_param('sssisiidsss', $customer_name, $date, $payment_by, $amount_paid, $status, $amount_due, $change_element, $grand_total, $productsString, $reference_id, $user_email);

    // Execute the query and check if it was successful
    if ($insertQuery->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to insert data: ' . $insertQuery->error]);
    }

    // Close the statement
    $insertQuery->close();

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

// Close the database connection
$conn->close();

// Function to generate a random reference ID
function generateReferenceId($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    
    return $randomString;
}


// include("./layouts/session.php");
// include 'conn.php'; // Include database connection

// $conn = connectMainDB();

// // Always return a JSON response
// header('Content-Type: application/json');

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // Get the form data
//     $customer_name = $_POST['customer_name']; 
//     $date = $_POST['date'];
//     $payment_by = $_POST['payment_by'];
//     $amount_paid = $_POST['amount_paid'];
//     $status = $_POST['status'];
//     $amount_due = $_POST['amount_due'];
//     $change_element = $_POST['change_element'];
//     $grand_total = $_POST['grand_total']; 

//     // Check if 'products' exists and is not empty
//     if (!isset($_POST['products']) || empty($_POST['products'])) {
//         echo json_encode(['success' => false, 'message' => 'Products data is missing.']);
//         exit; // Stop further processing
//     }

//     // Decode the products array
//     $products = json_decode($_POST['products'], true);

//     if (!$products) {
//         echo json_encode(['success' => false, 'message' => 'Failed to decode products JSON.']);
//         exit;
//     }    

//     // Log the products array for debugging
//    file_put_contents('php://stderr', print_r($products, true));

//     // Sanitize the email session for safety
//     $user_email = trim($conn->real_escape_string($_SESSION['email']));

//     // Generate a random reference ID
//     $reference_id = generateReferenceId(); 

//     // Initialize the products array for formatting
//     $productsArray = [];

//     // Loop through each product and format the details into a string
//     foreach ($products as $product) {
//         $productDetails = "{$product['name']} (quantity: {$product['quantity']}, price: {$product['price']}, image: {$product['image_url']}, discount type: {$product['discountType']}, discount value: {$product['discountValue']}, tax: {$product['taxValue']}, unit: {$product['unit']}, total cost: {$product['totalCost']})";                      
//         $productsArray[] = $productDetails; // Add the formatted product to the products array
//     }

//     // Combine all product strings into one
//     $productsString = implode('; ', $productsArray); // Semicolon as a separator for individual products

//     // Prepare the SQL query
//     $insertQuery = $conn->prepare("INSERT INTO sales (customer, date, payment_by, amount_paid, status, amount_due, change_element, grand_total, products, reference, user_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

//     // Bind parameters
//     $insertQuery->bind_param('sssisiidsss', $customer_name, $date, $payment_by, $amount_paid, $status, $amount_due, $change_element, $grand_total, $productsString, $reference_id, $user_email);

//     // Execute the query and check if it was successful
//     if ($insertQuery->execute()) {
//         echo json_encode(['success' => true]);
//     } else {
//         echo json_encode(['success' => false, 'message' => 'Failed to insert data: ' . $insertQuery->error]);
//     }

//     // Close the statement
//     $insertQuery->close();

// } else {
//     echo json_encode(['success' => false, 'message' => 'Invalid request.']);
// }

// // Close the database connection
// $conn->close();

// // Function to generate a random reference ID
// function generateReferenceId($length = 10) {
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $charactersLength = strlen($characters);
//     $randomString = '';
    
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//     }
    
//     return $randomString;
// }


