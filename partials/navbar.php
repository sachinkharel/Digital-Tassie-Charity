<?php
require 'config/database.php';

if (isset($_SESSION['user-id'])) {
  // Fetch user details including avatar path from the database
  $userId = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
  // Query to fetch user details based on user ID
  $user_query = "SELECT avatar FROM users WHERE id = $userId";
  $user_result = mysqli_query($connection, $user_query);

  // Check if the query was successful and if user details were fetched
  if ($user_result && mysqli_num_rows($user_result) > 0) {
    $user_data = mysqli_fetch_assoc($user_result);
    $avatar_path = $user_data['avatar'];
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Digital Tassie Charity</title>
  <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body>
  <!-- navbar from bootstrap -->
  <!-- We differeniated the navbar in two parts because one will be used for public view and this one -> here will be used for LoggedIn view -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">DTC</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= ROOT_URL ?>charityHome.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= ROOT_URL ?>charityList.php">Charity List</a>
          </li>

          <?php if (isset($_SESSION['user-id'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= ROOT_URL ?>admin/manageCharity.php">Manage Charity</a>
            </li>
            <?php if (($_SESSION['user_is_admin'])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URL ?>admin/masterCharity.php">Master Charity</a>
              </li>
            <?php } ?>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= ROOT_URL ?>admin/createCharity.php">Create Charity</a>
            </li>
          <?php } ?>
        </ul>

        <?php if (isset($_SESSION['user-id'])) { ?>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="<?= ROOT_URL . "images/" . $avatar_path; ?>" alt="Guest" width="30" height="30"
                  class="rounded-circle">
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><span class="dropdown-item-text d-block text-center">Welcome, DTC</span></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="./admin/manageCharity.php">Manage Charity</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= ROOT_URL ?>logout.php">Logout</a></li>
              </ul>

            <?php } else { ?>
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <a href="<?= ROOT_URL ?>login.php" class="btn btn-primary nav-link me-2 text-white">Login</a>
                </li>
                <li class="nav-item">
                  <a href="<?= ROOT_URL ?>signup.php" class="btn btn-success nav-link text-white">Sign
                    Up</a>
                </li>
              </ul>
            <?php } ?>

          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>


</body>

</html>