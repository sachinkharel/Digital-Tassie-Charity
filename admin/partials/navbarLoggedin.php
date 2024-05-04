<?php
require '../partials/navbar.php';

if (!isset($_SESSION['user-id'])) {
    header(('location:' . ROOT_URL . 'login.php'));
    die();
}

?>