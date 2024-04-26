<?php
require 'config/database.php';
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page
header("Location: " . ROOT_URL . "login.php");
exit();
?>