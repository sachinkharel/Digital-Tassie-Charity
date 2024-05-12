<?php
require 'config/database.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Check if JSON decoding was successful
    if ($data === null) {
        // If JSON decoding failed, return a JSON response with an error message
        http_response_code(400);
        echo json_encode(array('error' => 'Invalid JSON data'));
        exit;
    }

    // Extract data from the JSON object
    $amount = $data['amount'];
    $postId = $data['postId'];
    $donated_by = $_SESSION['user-id'];
    $goalAmount = $data['goalAmount'];
    $totalDonation = $data['totaldonation'];
    $updateDonation = $totalDonation + $amount;
    $updateProgress = ($updateDonation / $goalAmount) * 100;


    try {
        // Perform the donation insertion into the database
        // Perform the donation insertion into the database
        $insert_donation = "INSERT INTO donation (amt, donated_by, donated_to) VALUES (?, ?, ?)";
        $update_progress = "UPDATE posts SET progress = '$updateProgress', totalDonation = '$updateDonation' WHERE id = $postId";
        $stmt = mysqli_prepare($connection, $insert_donation);
        $stmt1 = mysqli_prepare($connection, $update_progress);
        mysqli_stmt_bind_param($stmt, "sss", $amount, $donated_by, $postId); // Corrected to "sss"
        mysqli_stmt_execute($stmt);
        mysqli_stmt_execute($stmt1);



        // Check if the insertion was successful
        if ($stmt === false) {
            // If insertion failed, return a JSON response with an error message
            http_response_code(500);
            echo json_encode(array('error' => 'Error inserting donation amount: ' . mysqli_error($connection)));
            exit;
        } else {
            // If insertion was successful, return a JSON response with a success message
            echo json_encode(array('success' => 'Donation successful!'));
            exit;
        }
    } catch (Exception $e) {
        // If an exception occurred, return a JSON response with an error message
        http_response_code(500);
        echo json_encode(array('error' => 'Error occurred while saving donation: ' . $e->getMessage()));
        exit;
    }
} else {
    // If the request method is not POST, return a JSON response with an error message
    http_response_code(405);
    echo json_encode(array('error' => 'Method not allowed'));
    exit;
}
?>