<?php
include ("partials/navbarLoggedin.php");

// fetch all user except current logged in

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION["user_is_admin"]) {
        // Check if the form data is present
        if (isset($_POST['is_admin']) && isset($_POST['can_postin'])) {
            // Loop through each user data
            foreach ($_POST['is_admin'] as $userId => $isAdmin) {
                // Compare submitted values with original values
                $originalIsAdmin = $_POST['original_is_admin'][$userId];
                $originalCanPostIn = $_POST['original_can_postin'][$userId];

                // Check if the values have changed
                if ($isAdmin != $originalIsAdmin || $_POST['can_postin'][$userId] != $originalCanPostIn) {
                    // Perform database update only if values have changed

                    // Sanitize input values to prevent SQL injection
                    $isAdmin = mysqli_real_escape_string($connection, $isAdmin);
                    $canPostIn = mysqli_real_escape_string($connection, $_POST['can_postin'][$userId]);

                    $query = "UPDATE users SET is_admin = '$isAdmin', can_postin = '$canPostIn' WHERE id = $userId";

                    // Execute the SQL query using your database connection

                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        // Redirect back to the userDetails.php page after updating
                        header("Location: userDetails.php");
                        exit();
                    } else {
                        // Handle database update error
                        echo "Error updating user details: " . mysqli_error($connection);
                    }
                }
            }
        } else {
            // Handle error if form data is not present
            echo "Form data missing!";
        }
    } else {
        $_SESSION["update-user-error"] = "Only System Administrator can change user deatails!";
        header("Location: userDetails.php");
        exit();
    }

} else {
    // Handle error if request method is not POST
    echo "Invalid request method!";
}


?>