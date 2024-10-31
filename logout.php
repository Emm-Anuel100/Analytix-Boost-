<?php
session_start();

// Unset  verification session
unset($_SESSION['authenticated']);
unset($_SESSION['email']);
header("Location: signin.php");
exit();

?>