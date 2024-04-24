<?php
include ("partials/navbar.php");
?>


<!DOCTYPE html>
<html>

<head>
  <title>DTC</title>

  <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>css/styles.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384- GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />

  <style>
    .carousel-image-container {
      width: 100%;
      height: 400px;
      /* Set a fixed height for all carousel items */
    }

    .carousel-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Ensure the image fills the container while maintaining aspect ratio */
    }
  </style>
</head>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>

<!-- THE NAVBAR IS NOW INCLUDED USING PHP ABOVE -->

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
    <h1>Digital Tassie Charity</h1>
    <p>
      You can create your own Charity in this platform. Feel free to
      <a target="_blank" href="<?= ROOT_URL ?>createCharity.php">create charity</a>.
    </p>
  </div>

  <!-- Carousel from bootstap -->
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="carousel-image-container">
          <img src="./images/charityphoto1.jpeg" class="d-block w-100 carousel-image" alt="Charity Slides" />
        </div>
      </div>
      <div class="carousel-item">
        <div class="carousel-image-container">
          <img src="./images/charityphoto2.avif" class="d-block w-100 carousel-image" alt="Charity Slides" />
        </div>
      </div>
      <div class="carousel-item">
        <div class="carousel-image-container">
          <img src="./images/charityphoto3.jpeg" class="d-block w-100 carousel-image" alt="Charity Slides" />
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" style="filter: invert(100%)" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" style="filter: invert(100%)" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="sponsorsCont">
    <table class="table table-borderless">
      <tr>
        <td rowspan="2">
          <h4>Category</h4>
        </td>
        <td class="col-6">Health</td>
      </tr>
      <tr>
        <td>Education</td>
      </tr>
      <tr>
        <td></td>
        <td>Environment</td>
      </tr>
    </table>
  </div>

  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col">
          <p class="m-0">
            &copy; Digital Tassie Charity; <a href="#">Privacy</a> &bull;
            <a href="#">Terms</a>
          </p>
        </div>
        <div class="col text-end">
          <p><a href="#getnavbar">Back to top</a></p>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>