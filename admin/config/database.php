<?php
require 'constants.php';

//connection to the database

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_errno($connection)) {
    echo 'DATABASE CONNECTION ERROR - ' . mysqli_error($connection);
}