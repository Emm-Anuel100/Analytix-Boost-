<?php
session_start();
include 'conn.php'; // database connection

// Establish the connection to the database
$conn = connectMainDB();

// Check if the request is an AJAX POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and get the ID
    $unit_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    // Check if unit_id is valid
    if ($unit_id > 0) {
        // Prepare the SQL statement to delete the unit
        $sql = "DELETE FROM units WHERE id = ? AND user_email = ?";
        
        // Assuming you have the user's email in the session
        $user_email = $_SESSION['email'];

        // Prepare and bind
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("is", $unit_id, $user_email);
            
            // Execute the statement
            if ($stmt->execute()) {
                // Check if any row was affected
                if ($stmt->affected_rows > 0) {
                    // Respond with success
                    echo json_encode(['success' => true, 'message' => 'Unit deleted successfully.']);
                } else {
                    // No rows affected, unit might not exist
                    echo json_encode(['success' => false, 'message' => 'No such unit found.']);
                }
            } else {
                // Execution failed
                echo json_encode(['success' => false, 'message' => 'Error executing delete query.']);
            }

            $stmt->close();
        } else {
            // Statement preparation failed
            echo json_encode(['success' => false, 'message' => 'Error preparing delete query.']);
        }
    } else {
        // Invalid unit ID
        echo json_encode(['success' => false, 'message' => 'Invalid unit ID.']);
    }
} else {
    // Not an AJAX request
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
