<?php
include 'conn.php'; // Include connection file

$conn = connectMainDB();

$id = htmlspecialchars($_GET['id']);

$sql = "SELECT * FROM warehouse WHERE id = '$id'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

echo json_encode($data);
