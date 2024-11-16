<?php
include 'conn.php'; // Include database connection 

include("./layouts/session.php"); // Ensure session is active

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $supplier_id = $_GET['id'];
    $user_email = htmlspecialchars($_SESSION['email']);

    // Connect to the database
    $conn = connectMainDB();
    
    // Prepare query to fetch supplier data for authenticated user
    $stmt = $conn->prepare("SELECT id, name, email, phone, address, city, rc_code, description
     FROM suppliers WHERE id = ? AND user_email = ?");

    $stmt->bind_param("is", $supplier_id, $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No matching supplier found.']);
    }

    $stmt->close(); // Close the statement
    $conn->close(); // Close the connection
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid supplier ID.']);
}
?>
