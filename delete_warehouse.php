<?php
include 'conn.php'; // Include connection file
$conn = connectMainDB();

if (isset($_POST['id'])) {
    $warehouse_id = htmlspecialchars($_POST['id']);
    
    // Prepare the delete query
    $sql = "DELETE FROM warehouse WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $warehouse_id);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false]);
}
