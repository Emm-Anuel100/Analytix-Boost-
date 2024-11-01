<?php 
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();

header('Content-Type: application/json');

// Get the JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Check if ID is provided
if (isset($data['id'])) {
    $couponId = $data['id'];

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM coupons WHERE id = ?");
    $stmt->bind_param("i", $couponId);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Coupon deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete the coupon.']);
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Coupon ID not provided.']);
}



