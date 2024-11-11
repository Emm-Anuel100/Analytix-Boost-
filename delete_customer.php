<?php
include 'conn.php';
$conn = connectMainDB();

$data = json_decode(file_get_contents("php://input"));
$customerId = $data->id;

$query = "DELETE FROM customers WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customerId);
$response = [];

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
?>
