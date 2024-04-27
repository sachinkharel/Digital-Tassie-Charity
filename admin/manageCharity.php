<?php
include ("partials/navbarLoggedin.php");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Manage Charity</title>
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
    $("#getnavbar").load("./partials/navbarLoggedin.php");
  });
</script> -->

<body>
  <!-- <div id="getnavbar"></div> -->
  <div class="homepageHeader">
    <h1>Manage Charity</h1>
  </div>

  <!-- Using bootstrap table to list only the charity from one the category which user is assigned to,
           this page this only available for Project Administrator who can edit charity from their assigned category  -->
  <!-- In this page we'll fetch only the data from charity table checking the category assigned to the user and list it, in assignment 2 -->

  <div class="container col-9">
    <div class="col-12" style="text-align:right;">
      <a href="../createCharity.php" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Create New
        Charity</a>
    </div>
    <div class="row mt-3">
      <table class="table table-bordered" id="managetable">
        <tr>
          <th>S.N.</th>
          <th>Name</th>
          <th>Description</th>
          <th>Category</th>
          <th>Goal Amount</th>
          <th>Progress</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Charity for disable</td>
            <td>Supporting indvidual with disablilities</td>
            <td>Health</td>
            <td>$5000</td>
            <td>60%</td>
            <td>
              <!-- Buttons for EDIT UPDATE and DELETE the charity  -->
              <ul class="list-inline m-0">
                <li class="list-inline-item">
                  <button class="btn btn-light"><a href="createCharity.html"><i class="fa-solid fa-pen-to-square"
                        style="font-size:12px;"></i><span> EDIT</span></a></button>
                </li>

                <li class="list-inline-item">
                  <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateModal">
                    <i class="fas fa-spinner" style="font-size:10px;"><span> Update</span></i>
                  </button>

                </li>
                <li class="list-inline-item">
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-trash-can" style="font-size:12px;"><span> Delete</span></i>
                  </button>

                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Charity for students</td>
            <td>Supporting indvidual with disablilities</td>
            <td>Health</td>
            <td>$5000</td>
            <td>90%</td>
            <td>
              <!-- Buttons for EDIT UPDATE and DELETE the charity  -->
              <ul class="list-inline m-0">
                <li class="list-inline-item">
                  <button class="btn btn-light"><a href="createCharity.html"><i class="fa-solid fa-pen-to-square"
                        style="font-size:12px;"></i><span> EDIT</span></a></button>
                </li>
                <li class="list-inline-item">
                  <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateModal">
                    <i class="fas fa-spinner" style="font-size:10px;"><span> Update</span></i>
                  </button>

                </li>
                <li class="list-inline-item">
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-trash-can" style="font-size:12px;"><span> Delete</span></i>
                  </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td>Save tree</td>
            <td>Planting trees</td>
            <td>Health</td>
            <td>$10000</td>
            <td>40%</td>
            <td>
              <!-- Buttons for EDIT UPDATE and DELETE the charity  -->
              <ul class="list-inline m-0">
                <li class="list-inline-item">
                  <button class="btn btn-light"><a href="createCharity.html"><i class="fa-solid fa-pen-to-square"
                        style="font-size:12px;"></i><span> EDIT</span></a></button>
                </li>
                <li class="list-inline-item">
                  <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateModal">
                    <i class="fas fa-spinner" style="font-size:10px;"><span> Update</span></i>
                  </button>

                </li>
                <li class="list-inline-item">
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-trash-can" style="font-size:12px;"><span> Delete</span></i>
                  </button>

                </li>
              </ul>
            </td>
          </tr>

        </tbody>
      </table>





      <!-- Delete Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Charity</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Do you want to delete this charity?
              </p>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>

            </div>
          </div>
        </div>
      </div>

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



      <!-- Update modal -->
      <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Update Progress</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <form>
                <div class="mb-3">
                  <label for="progress" class="form-label">Enter Progress Percentage</label>
                  <input type="number" class="form-control" id="progress" min="0" max="100" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>


</body>

</html>