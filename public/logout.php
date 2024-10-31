<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = [];

// If you want to destroy the session entirely, use the following line
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit; // Ensure no further code is executed
?>
