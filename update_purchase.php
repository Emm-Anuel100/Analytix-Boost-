<?php
include("./layouts/session.php");

// Include database connection
require('conn.php');

$conn = connectMainDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $purchaseId = intval($_POST['id']);
    $email = $_SESSION['email']; // user's email

    // Retrieve form data
    $supplier_name = $_POST['supplier_name'];
    $purchase_date = $_POST['purchase_date_'];
    $product_name = $_POST['product_name_'];
    $cost_per_unit = $_POST['cost_per_unit_'];
    $pack_quantity = $_POST['pack_quantity_'];
    $items_per_pack = $_POST['items_per_pack_'];
    $status = $_POST['status_'];
    $amount_paid = $_POST['amount_paid_'];
    $amount_due = $_POST['amount_due_'];
    $grand_total = $_POST['total_'];
    $order_tax = $_POST['tax_'];
    $notes = $_POST['notes_'];

    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE purchases SET supplier_name = ?, purchase_date = ?, product_name = ?, 
                            cost_per_unit = ?, pack_quantity = ?, items_per_pack = ?, status = ?, amount_paid = ?, 
                            amount_due = ?, grand_total = ?, order_tax = ?, notes = ? WHERE id = ? AND user_email = ?");

    $stmt->bind_param("sssdiisddidsis", $supplier_name, $purchase_date, $product_name, $cost_per_unit, 
                      $pack_quantity, $items_per_pack, $status, $amount_paid, $amount_due, $grand_total, 
                      $order_tax, $notes, $purchaseId, $email);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close(); // close statement
    $conn->close(); // close connection
}


