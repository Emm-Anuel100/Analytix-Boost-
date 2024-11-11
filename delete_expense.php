<?php
include("./layouts/session.php");// start session

include 'conn.php'; // Include connection 

$conn = connectMainDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $expense_id = $data['expense_id'];
    $user_email = htmlspecialchars($_SESSION['email']); // User's email

    if ($expense_id && $user_email) {
        $query = "DELETE FROM expenses WHERE id = ? AND user_email = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            // Log prepare statement error
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
            exit;
        }

        $stmt->bind_param("is", $expense_id, $user_email);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Expense deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete expense: ' . $stmt->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid expense ID or user session.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
