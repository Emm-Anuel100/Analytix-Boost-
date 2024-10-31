<?php
include "./layouts/session.php";
include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();

$user_email = $_SESSION['email']; // user's email

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $saleId = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM sales_return WHERE id = ? AND user_email = '$user_email'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $saleId);

    if ($stmt->execute()) {
        echo "Sale return deleted successfully"; // Ensure this matches the success check in the JS
    } else {
        echo "Error deleting sale return: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();



