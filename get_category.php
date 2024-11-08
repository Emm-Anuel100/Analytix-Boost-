<?php 
include("./layouts/session.php"); // Include session
include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL statement to fetch category data
    $stmt = $conn->prepare("SELECT id, category_name, description FROM expense_category WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Set header to JSON for AJAX response clarity
    header('Content-Type: application/json');

    if ($row = $result->fetch_assoc()) {
        // Return the data with the specified key names
        echo json_encode([
            "id" => $row['id'],
            "category_name_" => $row['category_name'], // Mapping category_name to category_name_
            "description" => $row['description']
        ]);
    } else {
        echo json_encode(["error" => "Category not found"]);
    }

    $stmt->close();
    $conn->close();
}
