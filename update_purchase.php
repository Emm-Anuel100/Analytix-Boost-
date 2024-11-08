<?php
include("./layouts/session.php");

// Include database connection
require('conn.php');

$conn = connectMainDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $purchaseId = intval($_POST['id']);
    $email = htmlspecialchars($_SESSION['email']); // user's email

    // Retrieve form data
    $supplier_name = $_POST['supplier_name'];
    $purchase_date = $_POST['purchase_date_'];
    // $product_name = $_POST['product_name_'];
    $cost_per_unit = $_POST['cost_per_unit_'];
    $pack_quantity = $_POST['pack_quantity_'];
    $items_per_pack = $_POST['items_per_pack_'];
    $status = $_POST['status_'];
    $amount_paid = $_POST['amount_paid_'];
    $amount_due = $_POST['amount_due_'];
    $order_tax = $_POST['tax_'];
    $notes = $_POST['notes_'];

    // Calculate grand total of the product (cost_per_unit, pack_quantity, and items_per_pack)
    $grand_total = $cost_per_unit * $pack_quantity * $items_per_pack;

    // Retrieve the current values of pack_quantity and items_per_pack from the database
    $currentValuesStmt = $conn->prepare("SELECT pack_quantity, items_per_pack FROM purchases WHERE id = ? AND user_email = ?");
    $currentValuesStmt->bind_param("is", $purchaseId, $email);
    $currentValuesStmt->execute();
    $currentValuesStmt->bind_result($current_pack_quantity, $current_items_per_pack);
    $currentValuesStmt->fetch();
    $currentValuesStmt->close();

    // Prepare and execute the update statement for purchases table
    $stmt = $conn->prepare("UPDATE purchases SET supplier_name = ?, purchase_date = ?,
                            cost_per_unit = ?, pack_quantity = ?, items_per_pack = ?, status = ?, amount_paid = ?, 
                            amount_due = ?, grand_total = ?, order_tax = ?, notes = ? WHERE id = ? AND user_email = ?");
                            
    $stmt->bind_param("ssdiisddidsis", $supplier_name, $purchase_date, $cost_per_unit, 
                      $pack_quantity, $items_per_pack, $status, $amount_paid, $amount_due, $grand_total, 
                      $order_tax, $notes, $purchaseId, $email);

    if ($stmt->execute()) {
        // Check if status is "Received" and if pack_quantity or items_per_pack values have changed
        if ($status === 'Received') {
            // Calculate the quantity change based on the differences
            $pack_quantity_difference = $pack_quantity - $current_pack_quantity;
            $items_per_pack_difference = $items_per_pack - $current_items_per_pack;

            // Determine the quantity adjustment based on what was changed
            $quantityAdjustment = 0;
            if ($pack_quantity_difference != 0) {
                $quantityAdjustment = $pack_quantity_difference * $items_per_pack;
            } elseif ($items_per_pack_difference != 0) {
                $quantityAdjustment = $current_pack_quantity * $items_per_pack_difference;
            }

            // If there's a quantity adjustment, update the products table
            if ($quantityAdjustment != 0) {
                $updateProductStmt = $conn->prepare("UPDATE products SET quantity = quantity + ? WHERE product_name = ? AND email = ?");
                $updateProductStmt->bind_param("iss", $quantityAdjustment, $product_name, $email);

                if ($updateProductStmt->execute()) {
                    echo "success";
                } else {
                    echo "error";
                }

                $updateProductStmt->close(); // Close the products update statement
            } else {
                echo "success"; // If no quantity adjustment is needed, still indicate success for the purchases update
            }
        } else {
            echo "success"; // If status is not "Received", only update the purchases table
        }
    } else {
        echo "error";
    }

    $stmt->close(); // Close the purchases update statement
    $conn->close(); // Close the connection
}

