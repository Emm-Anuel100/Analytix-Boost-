<?php
include 'conn.php'; // Include database connection

include("./layouts/session.php"); // Include session for user authentication

// Check if the supplier ID is provided and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $supplier_id = $_GET['id'];
    $user_email = htmlspecialchars($_SESSION['email']);

    // Connect to the database
    $conn = connectMainDB();

    // Prepare the delete query to ensure only the authenticated user's suppliers can be deleted
    $stmt = $conn->prepare("DELETE FROM suppliers WHERE id = ? AND user_email = ?");
    $stmt->bind_param("is", $supplier_id, $user_email);

    if ($stmt->execute()) {
        // Check if a row was actually deleted
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Supplier deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No matching supplier found.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error executing delete operation.']);
    }

    $stmt->close(); // Close the statement
    $conn->close(); // Close the connection
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid supplier ID.']);
}
?>
