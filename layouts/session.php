<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
   header("Location: signin.php");
   exit();
}

