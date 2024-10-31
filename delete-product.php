<?php 
include("./layouts/session.php");
include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $product_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
   $imageName = isset($_POST['image']) ? $_POST['image'] : '';

   if ($product_id > 0) {
       // Prepare SQL query to delete the product
       $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
       $stmt->bind_param('i', $product_id);

       if ($stmt->execute()) {
           // Delete the image from the uploads folder
           if (!empty($imageName) && file_exists('uploads/' . $imageName)) {
               unlink('uploads/' . $imageName);  // Remove the file
           }
           echo 'success';  // Send success response
       } else {
           echo 'error';  // Send error response
       }

       $stmt->close();
   } else {
       echo 'error';
   }
}

