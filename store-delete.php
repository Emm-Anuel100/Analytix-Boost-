<?php
// include('./layouts/session.php');
include('conn.php');

// Establish the connection to the user's database
$conn = connectMainDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $store_id = $_POST['id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM store WHERE id = ?");
    $stmt->bind_param('i', $store_id);

    if ($stmt->execute()) {
        // Successfully deleted
        http_response_code(200); // OK
    } else {
        // Error deleting
        http_response_code(500); // Internal Server Error
    }

    $stmt->close();
}
?>
