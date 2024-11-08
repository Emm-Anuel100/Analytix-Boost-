<?php
include("./layouts/session.php"); // include session
include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare delete query
    $stmt = $conn->prepare("DELETE FROM expense_category WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "error" => "ID is missing"]);
}


