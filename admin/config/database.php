<?php
require 'constants.php';

// Connection to the database
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check if there's an error with the connection
if ($connection->connect_errno) {
    die('DATABASE CONNECTION ERROR: ' . $connection->connect_error);
} else {
    // echo 'Connected successfully!';
}

// Optionally, you can set the character set to utf8mb4 for better Unicode support
if (!$connection->set_charset("utf8mb4")) {
    die("Error loading character set utf8mb4: " . $connection->error);
}
?>