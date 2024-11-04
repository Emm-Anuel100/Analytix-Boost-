<?php
include("./layouts/session.php");
include 'conn.php'; // Include database connection

$conn = connectMainDB();

// Always return a JSON response
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name']; 
    $date = $_POST['date'];
    $status = $_POST['status'];
    $amount_returned = $_POST['amount_returned'];
    $grand_total_return = $_POST['grand_total']; // This is the amount to subtract
    $reference_id = $_POST['reference'];
    $return_reason = $_POST['return_reason'];

    // Check if 'products' exists and is not empty
    if (!isset($_POST['products']) || empty($_POST['products'])) {
        echo json_encode(['success' => false, 'message' => 'Products data is missing.']);
        exit;
    }

    // Decode the products array
    $products_returned = json_decode($_POST['products'], true);

    if (!$products_returned) {
        echo json_encode(['success' => false, 'message' => 'Failed to decode products JSON.']);
        exit;
    }

    // Sanitize the email session for safety
    $user_email = trim($conn->real_escape_string($_SESSION['email']));

    // Fetch the sales data for the reference and user_email
    $selectQuery = $conn->prepare("SELECT grand_total, products FROM sales WHERE reference = ? AND user_email = ?");
    $selectQuery->bind_param('ss', $reference_id, $user_email);
    $selectQuery->execute();
    $result = $selectQuery->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'No matching sale found.']);
        exit;
    }

    $sales_data = $result->fetch_assoc();
    $grand_total_existing = $sales_data['grand_total'];
    $products_existing = $sales_data['products'];

    // Update grand total by subtracting the returned grand total
    $new_grand_total = $grand_total_existing - $grand_total_return;
    $new_grand_total = round($new_grand_total, 1); // Round to 1 decimal place

    // Parse the existing products string into an array
    $products_array = explode('; ', $products_existing);

    // Convert existing products into a more workable format
    $parsed_products = [];
    foreach ($products_array as $product_str) {
        preg_match('/(.*) \(quantity: (\d+), price: ([\d.]+), image: (.*), discount type: (.*), discount value: ([\d.]+), tax: ([\d.]+), unit: (.*), total cost: ([\d.]+)\)/', $product_str, $matches);
        if ($matches) {
            $parsed_products[] = [
                'name' => $matches[1],
                'quantity' => (int)$matches[2],
                'price' => (float)$matches[3],
                'image_url' => $matches[4],
                'discountType' => $matches[5],
                'discountValue' => (float)$matches[6],
                'taxValue' => (float)$matches[7],
                'unit' => $matches[8],
                'totalCost' => (float)$matches[9]
            ];
        }
    }

    // Adjust product quantities based on the returned products
    foreach ($products_returned as $returned_product) {
        foreach ($parsed_products as &$existing_product) {
            if ($existing_product['name'] === $returned_product['name']) {
                $existing_product['quantity'] -= $returned_product['quantity'];
                // Recalculate the total cost for the product
                $existing_product['totalCost'] = $existing_product['quantity'] * $existing_product['price'];
                if ($existing_product['quantity'] <= 0) {
                    // Remove the product if the quantity is zero or negative
                    $existing_product = null;
                }
                break;
            }
        }
        $parsed_products = array_filter($parsed_products); // Remove null entries
    }

    foreach ($products_returned as $returned_product) {
        $user_email = htmlspecialchars($_SESSION['email']); // user's email

        // Fetch the existing product quantity from the products table
        $fetchProductQuery = $conn->prepare("SELECT quantity FROM products WHERE product_name = ? AND email = '$user_email'");
        $fetchProductQuery->bind_param('s', $returned_product['name']);
        $fetchProductQuery->execute();
        $productResult = $fetchProductQuery->get_result();
    
        if ($productResult->num_rows === 0) {
            throw new Exception("Product not found in products table.");
        }
    
        $productData = $productResult->fetch_assoc();
        $currentQuantity = (int)$productData['quantity'];
    
        // Add the returned quantity back to the current stock quantity
        $newQuantity = $currentQuantity + $returned_product['quantity'];
    
        // Update the quantity in the products table
        $updateProductQuery = $conn->prepare("UPDATE products SET quantity = ? WHERE product_name = ? AND email = '$user_email'");
        $updateProductQuery->bind_param('is', $newQuantity, $returned_product['name']);
    
        if (!$updateProductQuery->execute()) {
            throw new Exception("Failed to update product quantity: " . $updateProductQuery->error);
        }
    
        // Close the statement after use
        $fetchProductQuery->close();
        $updateProductQuery->close();
    }

    // Format the updated products back into the original string format
    $updated_products = [];
    foreach ($parsed_products as $product) {
        $updated_products[] = "{$product['name']} (quantity: {$product['quantity']}, price: {$product['price']}, image: {$product['image_url']}, discount type: {$product['discountType']}, discount value: {$product['discountValue']}, tax: {$product['taxValue']}, unit: {$product['unit']}, total cost: {$product['totalCost']})";
    }
    $updated_products_string = implode('; ', $updated_products);

    // Start transaction to ensure both queries succeed or fail together
    $conn->begin_transaction();

    try {
        // Update the sales table with the new grand total and product list
        $updateQuery = $conn->prepare("UPDATE sales SET grand_total = ?, products = ? WHERE reference = ? AND user_email = ?");
        $updateQuery->bind_param('dsss', $new_grand_total, $updated_products_string, $reference_id, $user_email);

        if (!$updateQuery->execute()) {
            throw new Exception("Failed to update sales: " . $updateQuery->error);
        }

        // After updating the sales table
        if (empty($updated_products_string)) {
            // If the products column is empty, delete the row from the sales table
            $deleteSaleQuery = $conn->prepare("DELETE FROM sales WHERE reference = ? AND user_email = ?");
            $deleteSaleQuery->bind_param('ss', $reference_id, $user_email);

            if (!$deleteSaleQuery->execute()) {
                throw new Exception("Failed to delete empty sale row: " . $deleteSaleQuery->error);
            }

            // Close the delete query
            $deleteSaleQuery->close();
        }

        // Initialize an array to hold the formatted product strings
            $returnedProductsArray = [];

            // Loop through each returned product and format the details into a string
            foreach ($products_returned as $returned_product) {
                $productDetails = "{$returned_product['name']} (quantity: {$returned_product['quantity']}, price: {$returned_product['price']}, image: {$returned_product['image_url']}, discount type: {$returned_product['discountType']}, discount value: {$returned_product['discountValue']}, tax: {$returned_product['taxValue']}, unit: {$returned_product['unit']}, total cost: {$returned_product['totalCost']})";
                $returnedProductsArray[] = $productDetails; // Add the formatted product to the array
            }

            // Combine the returned product strings into a single string
            $productsString = implode('; ', $returnedProductsArray); // Semicolon separates each product (serves as a Delimeter)


        $insertReturnQuery = $conn->prepare("INSERT INTO sales_return (customer, date, status, amount_returned, grand_total_returned, products, reference, user_email, return_reason) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertReturnQuery->bind_param('sssidssss', $customer_name, $date, $status, $amount_returned, $grand_total_return, $productsString, $reference_id, $user_email, $return_reason);

        if (!$insertReturnQuery->execute()) {
            throw new Exception("Failed to insert into sales_return: " . $insertReturnQuery->error);
        }

        // Commit transaction if both queries are successful
        $conn->commit();
        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

    // Close the statements
    $updateQuery->close();
    $insertReturnQuery->close();
    $selectQuery->close();

    } else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    }

// Close the database connection
$conn->close();


