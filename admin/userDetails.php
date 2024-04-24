<?php
include ("partials/navbarLoggedin.php");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Master Charity</title>
  <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384- GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(function () {
    // Load navbar content using jQuery
    $("#getnavbar").load("navbarLoggedin.html");
  });
</script> -->

<body>
  <!-- <div id="getnavbar"></div> -->
  <div class="homepageHeader">
    <h1>User Details</h1>
    <p>Edit users to select their role and category(This page is only available for System Administrator)</p>
  </div>
  <!-- Using bootstrap table to list all the users, this page this only available for System Administrator who can edit user role and category -->
  <!-- In this page we'll fetch all the data from user table and list it, in assignment 2 -->
  <div class="container col-9">
    <div class="row">
      <table class=" table table-bordered" id="managetable">
        <thead>
          <tr>
            <th>S.N.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Category</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Rajesh Chaudhary</td>
            <td>raayz987@mail.com</td>
            <td>
              <select class="form-select" aria-label="Default select example">
                <option selected>Choose Role</option>
                <option value="1">System Manager</option>
                <option value="2">Project Administrator</option>
              </select>
            </td>
            <td>
              <select class="form-select" aria-label="Default select example">
                <option selected>Choose Category</option>
                <option value="1">Health</option>
                <option value="2">Education</option>
                <option value="3">Environment</option>
              </select>
            </td>
          </tr>


          <tr>
            <td>2</td>
            <td>Rajesh Chaudhary</td>
            <td>raayz987@mail.com</td>
            <td>
              <select class="form-select" aria-label="Default select example">
                <option selected>Choose Role</option>
                <option value="1">System Manager</option>
                <option value="2">Project Administrator</option>
              </select>
            </td>
            <td>
              <select class="form-select" aria-label="Default select example">
                <option selected>Choose Category</option>
                <option value="1">Health</option>
                <option value="2">Education</option>
                <option value="3">Environment</option>
              </select>
            </td>
          </tr>

          <tr>
            <td>3</td>
            <td>Rajesh Chaudhary</td>
            <td>raayz987@mail.com</td>
            <td>
              <select class="form-select" aria-label="Default select example">
                <option selected>Choose Role</option>
                <option value="1">System Manager</option>
                <option value="2">Project Administrator</option>
              </select>
            </td>
            <td>
              <select class="form-select" aria-label="Default select example">
                <option selected>Choose Category</option>
                <option value="1">Health</option>
                <option value="2">Education</option>
                <option value="3">Environment</option>
              </select>
            </td>
          </tr>

        </tbody>
      </table>


      <!-- div for pagination -->
      <div class="container-fluid">

        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1">&lt;</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item disabled">
              <a class="page-link" href="#">&gt;</a>
            </li>
          </ul>
        </nav>
      </div>

</body>

</html>