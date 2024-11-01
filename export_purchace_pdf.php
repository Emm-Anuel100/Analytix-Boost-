<?php 
include("./layouts/session.php"); // include session

include 'conn.php'; // Include database connection

// Establish the connection
$conn = connectMainDB();

$user_email = $_SESSION['email']; // User's email








