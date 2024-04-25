<?php
include ("partials/navbar.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Charity</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>css/styles.css">
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
    <div class="homepageHeader">
        <h1>Create Charity</h1>
        <p>Fill up the details below to create a charity.</p>
    </div>

    <!-- Using bootstrap form to be able to create a charity with necessary inputs,
        in assignment 2 we'll store the values from this form to category table -->

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form id="charityForm">
                    <div class="mb-3">
                        <label for="charityName" class="form-label">Charity Name</label>
                        <input type="text" class="form-control" id="charityName" required>
                    </div>
                    <div class="mb-3">
                        <label for="charityDescription" class="form-label">Charity Description</label>
                        <textarea class="form-control" id="charityDescription" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="charityCategory" class="form-label">Charity Category</label>
                        <select class="form-select" id="charityCategory" required>
                            <option value="">Select Category</option>
                            <option value="Health">Health</option>
                            <option value="Education">Education</option>
                            <option value="Environment">Environment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="goalAmount" class="form-label">Goal Amount (%)</label>
                        <input type="number" class="form-control" id="goalAmount" min="0" max="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="progress" class="form-label">Progress</label>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100" id="progressBar"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("goalAmount").addEventListener("input", function () {
            var goalAmount = document.getElementById("goalAmount").value;
            var progressBar = document.getElementById("progressBar");
            progressBar.style.width = goalAmount + "%";
        });
    </script>

    <!-- This script is to give the experience of how will the charity page look like when we create the charity,
        here we've used user's browser local cookie storage to store and to be able to fetch that data on charity.html page, 
        in assignment 2 we'll store this value on our database charity table -->
    <script>
        document.getElementById("charityForm").addEventListener("submit", function (event) {
            event.preventDefault();
            var formData = {
                charityName: document.getElementById("charityName").value,
                charityDescription: document.getElementById("charityDescription").value,
                charityCategory: document.getElementById("charityCategory").value,
                goalAmount: document.getElementById("goalAmount").value
            };
            // var encodedData = encodeURIComponent(JSON.stringify(formData));
            // window.location.href = "charityPage.html?data=" + encodedData;

            sessionStorage.setItem('formData', JSON.stringify(formData));
            window.location.href = "<?= ROOT_URL ?>charityPage.php";


        });
    </script>
</body>

</html>