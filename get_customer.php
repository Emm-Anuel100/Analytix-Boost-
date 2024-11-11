<?php
include 'conn.php';
$conn = connectMainDB();

$data = json_decode(file_get_contents("php://input"));
$customerId = $data->id;

$query = "SELECT * FROM customers WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $response['success'] = true;
    $response['customer'] = $result->fetch_assoc();
} else {
    $response['success'] = false;
}

echo json_encode($response);
?>
