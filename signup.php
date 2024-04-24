<?php
include ("partials/navbar.php");
?>

<!DOCTYPE html>

<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384- GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

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

    <div class="container col-4 mt-5">
        <h2 class="mb-4 text-center">Signup</h2>
        <form>
            <div class="mb-3">
                <label for="fname" class="form-label">First name</label>
                <input type="text" id="fname" name="fname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last name</label>
                <input type="text" id="lname" name="lname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" id="email" name="email" class="form-control" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <!-- took the pattern regex from stackoverflow https://stackoverflow.com/questions/19605150/regex-for-password-must-contain-at-least-eight-characters-at-least-one-number-a -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control"
                    pattern="^(?=.*[A-Z].*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{5,10}$"
                    title="Password must be 5-10 characters with 2 uppercase, 1 number, and 1 special character."
                    required>
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm Password</label>
                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control"
                    pattern="^(?=.*[A-Z].*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{5,10}$"
                    title="Password must be 5-10 characters with 2 uppercase, 1 number, and 1 special character."
                    required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" id="terms" name="terms" value="agree" class="form-check-input" required>
                <label class="form-check-label" for="terms">I acknowledge that I have read and understand the terms and
                    conditions.</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- checking if the password and confirmpassword is matched by pulling their data  by ID and storing it in a variable to execute the check -->
    <script>
        var password = document.getElementById("password");
        var confirmpassword = document.getElementById("confirmpassword");

        function passwordCheck() {
            if (password.value != confirmpassword.value) {
                confirmpassword.setCustomValidity("Passwords Don't Match");
            } else {
                confirmpassword.setCustomValidity('');
            }
        }
        password.onchange = passwordCheck;
        confirmpassword.onkeyup = passwordCheck;
    </script>

    <!-- checking if user is minimum of 14 users when registering in this website by using new Date() JS object https://www.w3schools.com/js/js_dates.asp-->
    <script>
        function calculateAge(dateOfBirth) {
            var dob = new Date(dateOfBirth);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();

            if (today.getMonth() < dob.getMonth() || (today.getMonth() == dob.getMonth() && today.getDate() < dob.getDate())) {
                age--;
            }

            return age;
        }
        // pulling the dateOfBirth by ID to do the check
        function validateDateOfBirth() {
            var dob = document.getElementById("dob").value;
            var age = calculateAge(dob);

            if (age < 14) {
                document.getElementById("dob").setCustomValidity("You must be at least 14 years old to register.");
            } else {
                document.getElementById("dob").setCustomValidity("");
            }
        }

        document.getElementById("dob").addEventListener("input", validateDateOfBirth);
    </script>
</body>

</html>