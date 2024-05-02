<?php
require 'config/database.php';
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Perform the deletion query
    $query = "DELETE FROM posts WHERE id = $post_id";
    if (mysqli_query($connection, $query)) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => "Failed to delete post"));
    }
} else {
    echo json_encode(array("success" => false, "error" => "Invalid request"));
}
?>