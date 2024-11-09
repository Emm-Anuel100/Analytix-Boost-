<?php 
include("./layouts/session.php"); // include session

include 'conn.php'; // Include database connection

require('fpdf/fpdf.php'); // FPDF Library

// Establish the connection
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email



