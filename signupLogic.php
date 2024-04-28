<?php
session_start();
require 'config/database.php';

if (isset($_POST['submit'])) {
    // Sanitize and validate input
    $firstname = filter_var($_POST['fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_NUMBER_INT);
    $profileimage = $_FILES['profileimage'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $user_check_query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($connection, $user_check_query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $_SESSION['signup'] = "Email already exists";
    } else {
        // File Upload Handling
        $time = time();
        $avatar_name = $time . $profileimage['name'];
        $avatar_temp_name = $profileimage['tmp_name'];
        $avatar_destination_path = 'images/' . $avatar_name;

        $allowed_types = ['png', 'jpg', 'jpeg'];
        $extension = pathinfo($avatar_name, PATHINFO_EXTENSION);

        if (in_array($extension, $allowed_types)) {
            if ($profileimage['size'] < 2000000) {
                // Move uploaded file to destination
                if (move_uploaded_file($avatar_temp_name, $avatar_destination_path)) {
                    // File upload successful
                } else {
                    $_SESSION['signup'] = 'Error uploading file';
                }
            } else {
                $_SESSION['signup'] = 'File size too big! Upload < 2 mb';
            }
        } else {
            $_SESSION['signup'] = 'Upload jpeg, jpg or png!';
        }

    }

    if (isset($_SESSION['signup'])) {
        header('location:' . ROOT_URL . 'signup.php');
        die();
    } else {
        // Insert user into database
        $insert_user_query = "INSERT INTO users (firstname, lastname, email, password, dateofbirth, avatar, is_admin, can_postin) 
        VALUES (?, ?, ?, ?, ?, ?, 0, 'Education')";
        $stmt = mysqli_prepare($connection, $insert_user_query);
        mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $email, $hashed_password, $dob, $avatar_name);
        mysqli_stmt_execute($stmt);

        if ($stmt === false) {
            $_SESSION["signup"] = "Error inserting user data: " . mysqli_error($connection);
            header("location:" . ROOT_URL . "signup.php");
            die();
        } else {
            $_SESSION["signup-success"] = "Registration successful. Please Login!";
            header("location:" . ROOT_URL . "login.php");
            die();
        }
    }

} else {
    // Handle case where form is not submitted
    header('location:' . ROOT_URL . 'signup.php');
}
?>