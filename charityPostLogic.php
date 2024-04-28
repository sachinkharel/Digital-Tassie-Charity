<?php
require 'config/database.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['charityName'], FILTER_SANITIZE_SPECIAL_CHARS);
    $body = filter_var($_POST['charityDesc'], FILTER_SANITIZE_SPECIAL_CHARS);
    $category = filter_var($_POST['chairtyCategory'], FILTER_SANITIZE_SPECIAL_CHARS);
    $goal = filter_var($_POST['charityGoal'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['charityImage'];

    if (!$title) {
        $_SESSION["add-post"] = "Enter Charity Name";
    } elseif (!$category) {
        $_SESSION["add-post"] = "No Category";
    } elseif (!$body) {
        $_SESSION["add-post"] = "Enter Charity Description";
    } elseif (!$thumbnail["name"]) {
        $_SESSION["add-post"] = "Upload a Flyer";
    } else {
        $time = time();
        $thumbnail_name = $time . $thumbnail["name"];
        $thumbnail_tmp_name = $thumbnail["tmp_name"];
        $thumbnail_destination_path = 'images/' . $thumbnail_name;

        $allowed_types = ['png', 'jpg', 'jpeg'];
        $extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);

        if (in_array($extension, $allowed_types)) {
            if ($thumbnail['size'] < 2000000) {
                // Move uploaded file to destination
                if (move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path)) {
                    // File upload successful
                } else {
                    $_SESSION['add-post'] = 'Error uploading file';
                }
            } else {
                $_SESSION['add-post'] = 'File size too big! Upload < 2 mb';
            }
        } else {
            $_SESSION['add-post'] = 'Upload jpeg, jpg or png!';
        }

    }

    if (isset($_SESSION["add-post"])) {
        $_SESSION["add-post-data"] = $_POST;
        header("location: " . ROOT_URL . 'createCharity.php');
    } else {
        $insert_post = "INSERT INTO posts (name, `desc`, flyer, category, author_id, goalamt, is_featured) 
        VALUES (?, ?, ?, ?, ?, ?, 0)";
        $stmt = mysqli_prepare($connection, $insert_post);
        mysqli_stmt_bind_param($stmt, "ssssss", $title, $body, $thumbnail_name, $category, $author_id, $goal);
        mysqli_stmt_execute($stmt);

        if ($stmt === false) {
            $_SESSION["add-post"] = "Error inserting charity data: " . mysqli_error($connection);
            header("location:" . ROOT_URL . "createCharity.php");
            die();
        } else {
            $_SESSION["add-post-success"] = "New Charity Posted!";
            header("location:" . ROOT_URL . "createCharity.php");
            die();
        }
    }


} else {
    $_SESSION['add-post'] = 'Surumai gayo';
    header("location:" . ROOT_URL . "createCharity.php");
    die();
}