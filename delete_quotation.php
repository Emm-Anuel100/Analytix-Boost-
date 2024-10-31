<?php
session_start();

include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $user_email = $_SESSION['email']; // Ensure you are checking the user's email if necessary

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM quotation WHERE id = ? AND user_email = ?");
    $stmt->bind_param("is", $id, $user_email); // Assuming 'id' is an integer and 'user_email' is a string

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Quotation deleted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting quotation: ' . $stmt->error]);
    }

    $stmt->close();
}


