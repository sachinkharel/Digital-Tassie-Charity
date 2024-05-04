<?php
ob_start();
include ("partials/navbarLoggedIn.php");

$current_admin_id = $_SESSION['user-id'];

// Check if post ID is provided
if (isset($_GET['post_id'])) {
    // Get the post ID from the URL parameter
    $post_id = $_GET['post_id'];

    // Fetch the charity details from the database using the post ID
    $fetch_user_query = "SELECT is_admin from users WHERE id = '$current_admin_id'";
    $fetch_user_result = mysqli_query($connection, $fetch_user_query);
    $user_details = mysqli_fetch_assoc($fetch_user_result);
    $is_admin = $user_details['is_admin'];

    if ($is_admin == 1) {
        $fetch_post_query = "SELECT * FROM posts WHERE id = '$post_id'";
        $fetch_post_result = mysqli_query($connection, $fetch_post_query);
    } else {
        $fetch_post_query = "SELECT * FROM posts WHERE id = '$post_id' AND author_id = '$current_admin_id'";
        $fetch_post_result = mysqli_query($connection, $fetch_post_query);
    }


    // Check if charity with the provided post ID exists
    if (mysqli_num_rows($fetch_post_result) > 0) {
        // Fetch charity details
        $post_details = mysqli_fetch_assoc($fetch_post_result);
    } else {
        // Charity with the provided post ID not found or not authorized to update
        // Redirect to manageCharity.php with an error message
        $_SESSION["update-post"] = "Charity not found or unauthorized to update.";
        header("Location: manageCharity.php");
        exit(); // Stop further execution
    }
} else {
    // Post ID not provided
    // Redirect to manageCharity.php with an error message
    $_SESSION["update-post"] = "Post ID not provided.";
    header("Location: manageCharity.php");
    exit(); // Stop further execution
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Charity</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

<body>
    <div class="homepageHeader">
        <h1>Update Charity</h1>
        <p>Modify the details below to update the charity.</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form id="charityForm" action="updateCharity.php?post_id=<?= $post_id ?>" enctype="multipart/form-data"
                    method="post">
                    <div class="mb-3">
                        <label for="charityName" class="form-label">Charity Name</label>
                        <input type="text" name="charityName" class="form-control" id="charityName"
                            value="<?= $post_details['name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="charityDescription" class="form-label">Charity Description</label>
                        <textarea class="form-control" name="charityDesc" id="charityDescription" rows="3"
                            required><?= $post_details['desc'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="charityCategory" class="form-label">Charity Category</label>
                        <div class="form-control" name="charityCategory" id="charityCategory">
                            <?= $post_details['category'] ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="goalAmount" class="form-label">Goal Amount</label>
                        <input type="number" placeholder="USD" class="form-control" name="charityGoal" id="goalAmount"
                            value="<?= $post_details['goalamt'] ?>" min="0" max="10000" required>
                    </div>
                    <div class="mb-3">
                        <label for="charityimage" class="form-label">Charity Flyer</label>
                        <input type="file" id="charityimage" name="charityImage" class="form-control"
                            onchange="updatepreviewImage(this)"> <br>
                        <img id="previewImage" src="<?= ROOT_URL . 'images/' . $post_details['flyer'] ?>"
                            class="img-fluid" alt="Existing Charity Flyer"><br>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    function updatepreviewImage(input) {
        var preview = document.getElementById('previewImage');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Update the src attribute of the img element with the newly selected image
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            // If no file is selected, reset the src attribute to the existing image
            preview.src = "<?= ROOT_URL . 'images/' . $post_details['flyer'] ?>";
        }
    }
</script>

<?php
// Update charity details in the database
if (isset($_POST['submit'])) {
    // Handle form submission
    // Retrieve form data
    $charityName = $_POST['charityName'];
    $charityDesc = $_POST['charityDesc'];
    $charityGoal = $_POST['charityGoal'];

    // Check if a new image file has been uploaded
    if ($_FILES['charityImage']['error'] === UPLOAD_ERR_OK) {
        // Delete the previous image file
        $previous_image_path = '../images/' . $post_details['flyer'];
        if (file_exists($previous_image_path)) {
            unlink($previous_image_path);
        }

        // Upload the new image file
        $time = time();
        $thumbnail_name = $time . $_FILES['charityImage']['name'];
        $thumbnail_tmp_name = $_FILES['charityImage']['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        $allowed_types = ['png', 'jpg', 'jpeg'];
        $extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);

        if (in_array($extension, $allowed_types)) {
            if ($_FILES['charityImage']['size'] < 2000000) {
                // Move uploaded file to destination
                if (move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path)) {
                    // File upload successful, proceed to update charity details in the database
                } else {
                    $_SESSION['update-post'] = 'Error uploading file' . $_FILES['charityImage']['error'];
                    header("Location: updateCharity.php?post_id=$post_id");
                    exit(); // Stop further execution
                }
            } else {
                $_SESSION['update-post'] = 'File size too big! Upload < 2 mb';
                header("Location: updateCharity.php?post_id=$post_id");
                exit(); // Stop further execution
            }
        } else {
            $_SESSION['update-post'] = 'Upload jpeg, jpg or png!';
            header("Location: updateCharity.php?post_id=$post_id");
            exit(); // Stop further execution
        }
    }

    // Update charity details in the database using the provided post ID
    $update_query = "UPDATE posts SET name = '$charityName', `desc` = '$charityDesc', goalamt = '$charityGoal', flyer = '$thumbnail_name' WHERE id = '$post_id'";
    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        // Update successful
        $_SESSION["update-post"] = "Charity updated successfully.";
        header("Location: manageCharity.php");
        exit(); // Stop further execution
    } else {
        // Update failed
        $_SESSION["update-post"] = "Failed to update charity. Please try again.";
        header("Location: updateCharity.php?post_id=$post_id");
        exit(); // Stop further execution
    }
}
ob_end_flush();
?>