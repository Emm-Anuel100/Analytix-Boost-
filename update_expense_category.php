<?php 
include("./layouts/session.php"); // Include session
include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $category_name = $_POST['category_name_'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE expense_category SET category_name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $category_name, $description, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}