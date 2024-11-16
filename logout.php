<?php
session_start();

// Unset  verification sessions
unset($_SESSION['authenticated']);
unset($_SESSION['email']);
header("Location: signin.php");
exit();

?>