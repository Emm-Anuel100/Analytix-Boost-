<?php
include("./layouts/session.php");

// Include database connection
require('conn.php');

$conn = connectMainDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $purchaseId = intval($_POST['id']);

    // Sanitize email (for safety)
    $email = trim($conn->real_escape_string($_SESSION['email']));
        
    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM purchases WHERE id = ? AND user_email = ?");
    $stmt->bind_param("is", $purchaseId, $email);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close(); // close statement
    $conn->close(); // close connection
}

