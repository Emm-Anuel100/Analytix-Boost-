<?php
include "./layouts/session.php";

include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sale_id'])) {
    $saleId = $_POST['sale_id'];

    echo $saleId;

    // Delete query
    $sql = "DELETE FROM sales WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $saleId);

    if ($stmt->execute()) {
        echo "Sale deleted successfully";
    } else {
        echo "Error deleting sale: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
}


