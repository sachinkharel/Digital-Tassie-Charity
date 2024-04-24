<?php
include ("partials/navbar.php");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>css/styles.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384- GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
</head>
<!-- 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(function () {
    // Load navbar content using jQuery
    $("#getnavbar").load("./partials/navbar.php");
  });
</script> -->

<body>
  <!-- <div id="getnavbar"></div> -->
  <div class="container col-4 mt-5">
    <h2 class="mb-4 text-center">Login</h2>
    <form id="loginForm">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" required />
        <div id="emailHelp" class="form-text">
          We'll never share your email with anyone else.
        </div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <a href="#" class="ms-2">Forgot your password?</a>
    </form>
  </div>

  <!-- We are doing a dummy login just to give the login experience,
    in assignment 2 we'll have a real login where we'll do check from the database user table -->
  <script>
    $(document).ready(function () {
      $("#loginForm").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        var email = $("#email").val();
        var password = $("#password").val();

        // Check if username and password are correct
        if (email === "dtc@123" && password === "DTC@123") {
          // Redirect to another page
          window.location.href = "manageCharity.html";
        } else {
          alert("Invalid email or password. Please try again.");
        }
      });
    });
  </script>
</body>

</html>