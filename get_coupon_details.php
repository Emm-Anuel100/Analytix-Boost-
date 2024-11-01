<?php
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();

$user_email = $_SESSION['email']; // user's email

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM coupons WHERE id = ? AND user_email = '$user_email'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['error' => 'Coupon not found']);
    }
}



