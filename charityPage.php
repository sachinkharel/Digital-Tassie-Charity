<?php
include ("partials/navbar.php");

if (isset($_GET['post_id'])) {
    // Get the post ID from the URL parameter
    $post_id = $_GET['post_id'];

    // Fetch the charity details from the database using the post ID
    $fetch_post_query = "SELECT * FROM posts WHERE id = '$post_id'";
    $fetch_post_result = mysqli_query($connection, $fetch_post_query);

    // Check if charity with the provided post ID exists
    if (mysqli_num_rows($fetch_post_result) > 0) {
        // Fetch charity details
        $post_details = mysqli_fetch_assoc($fetch_post_result);
    } else {
        // Charity with the provided post ID not found or not authorized to update
        // Redirect to manageCharity.php with an error message
        $_SESSION["charity-page"] = "Charity not found";
        header("Location: charityList.php");
        exit(); // Stop further execution
    }
} else {
    // Post ID not provided
    // Redirect to manageCharity.php with an error message
    $_SESSION["charity-page"] = "Post ID not provided.";
    header("Location: manageCharity.php");
    exit(); // Stop further execution
}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Charity Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(function () {
        // Load navbar content using jQuery
        $("#getnavbar").load("./partials/navbar.php");
    });
</script> -->

<body>
    <!-- <div id="getnavbar"></div> -->

    <div class="container mt-5">

        <div class="row justify-content-center mt-5">
            <div class="col-md-6 text-center">
                <h3><?= $post_details['name'] ?></h3>
                <!-- <p id="charityName"></p> -->
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6 text-center">
                <h5><?= $post_details['category'] ?></h5>
                <!-- <p id="charityCategory"></p> -->
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6 text-center">
                <p>Progress: <?= $post_details['progress'] ?>%</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?= $post_details['progress'] ?>%;"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progressBar"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6 text-center">
                <p><?= $post_details['desc'] ?></p>
                <!-- <p id="charityDescription"></p> -->
                <img src="<?= ROOT_URL . 'images/' . $post_details['flyer'] ?>" alt="Charity Image" class="img-fluid">

            </div>
        </div>
    </div>

    <!-- This is data fetching script just to pull the data from user's cookie storage to fill charityPage,
    in assignment 2 we'll fetch these data directly from database using charity id to show details in this page -->

    <!-- The below(commented code) was the first attempt but I thought it's better to pull it from cookie storage which 
        closely related to pulling from database as per the feeling hehe -->
    <!-- <script>
        // var urlParams = new URLSearchParams(window.location.search);
        // var encodedData = urlParams.get('data');
        // var formData = JSON.parse(decodeURIComponent(encodedData));

        // document.getElementById("charityName").textContent = formData.charityName;
        // document.getElementById("charityDescription").textContent = formData.charityDescription;
        // document.getElementById("progressBar").style.width = formData.goalAmount + "%";
        // document.getElementById("charityCategory").textContent = formData.charityCategory;

        var formDataString = sessionStorage.getItem('formData');
        if (formDataString) {
            var formData = JSON.parse(formDataString);
            document.getElementById("charityName").textContent = formData.charityName;
            document.getElementById("charityDescription").textContent = formData.charityDescription;
            document.getElementById("charityCategory").textContent = formData.charityCategory;
            var progressBar = document.getElementById("progressBar");
            progressBar.style.width = parseFloat(formData.goalAmount) + "%";
            progressBar.textContent = formData.goalAmount + "%";
        }
    </script> -->

</body>

</html>