<?php
include("./layouts/session.php");

// Include database connection
require('conn.php');

$conn = connectMainDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $purchaseId = intval($_POST['id']);
    $email = htmlspecialchars($_SESSION['email']); // user's email for security

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT * FROM purchases WHERE id = ? AND user_email = ?");
    $stmt->bind_param("is", $purchaseId, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "Record not found"]);
    }

    $stmt->close(); // close statement
    $conn->close(); // close connection
}


