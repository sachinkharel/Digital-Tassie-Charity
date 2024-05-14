<?php
include ("partials/navbarLoggedin.php");

$current_admin_id = $_SESSION['user-id'];
$query = "SELECT * FROM posts WHERE author_id = $current_admin_id";
$posts = mysqli_query($connection, $query);

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!--
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
    <p>List of all the charities created by you.</p>
  </div>

  <!-- Using bootstrap table to list only the charity from one the category which user is assigned to,
           this page this only available for Project Administrator who can edit charity from their assigned category  -->
  <!-- In this page we'll fetch only the data from charity table checking the category assigned to the user and list it, in assignment 2 -->

  <div class="container col-9">
    <div class="col-12" style="text-align:right;">
      <a href="createCharity.php" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Create New
        Charity</a>
    </div>
    <div class="row mt-3">
      <?php
      if (isset($_SESSION["update-post"])) {
        // Output the error message
        echo "<div class='alert alert-success'>{$_SESSION["update-post"]}</div>";
        // Remove the error message from the session to prevent it from being displayed again
        unset($_SESSION["update-post"]);
      }
      ?>
      <?php if (mysqli_num_rows($posts) > 0): ?>
        <table class="table table-bordered" id="managetable">
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Goal Amount</th>
            <th>Total Donation</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            <?php while ($post = mysqli_fetch_assoc($posts)): ?>
              <tr id="post_<?= $post['id']; ?>">
                <td><?= "{$post['name']}" ?></td>
                <td><?= "{$post['desc']}" ?></td>
                <td><?= "{$post['category']}" ?></td>
                <td>$<?= "{$post['goalamt']}" ?></td>
                <td>$<?= "{$post['totaldonation']}" ?></td>
                <td>
                  <!-- Buttons for EDIT UPDATE and DELETE the charity  -->
                  <div class="btn-group" role="group" aria-label="Action Buttons">
                    <button type="button" onclick="window.location.href='updateCharity.php?post_id=<?= $post['id'] ?>'"
                      class="btn btn-sm btn-secondary">
                      <i class="fas fa-sync-alt"></i> Update
                    </button>
                    <button type="button" class="btn btn-sm btn-danger ms-1" data-bs-toggle="modal"
                      data-bs-target="#deleteModal" onclick="setPostId(<?= $post['id'] ?>)">
                      <i class="fas fa-trash-alt"></i> Delete
                    </button>
                  </div>
                </td>
              </tr>
              <tr>

              <?php endwhile ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class='alert alert-danger'>No posts found!</div>
      <?php endif ?>


      <script>
        var postIdToDelete;

        function setPostId(postId) {
          postIdToDelete = postId;
        }
        function deletePost() {
          $('#deleteModal').modal('hide');
          $.ajax({
            type: "POST",
            url: "deletePost.php",
            data: { post_id: postIdToDelete },
            dataType: "json",
            success: function (response) {
              if (response.success) {
                // Reload the page or update UI as needed
                $("#post_" + postIdToDelete).remove();
              } else {
                alert("Failed to delete post: " + response.error);
              }
            },
            error: function (xhr, status, error) {
              var errorMessage = xhr.status + ': ' + xhr.statusText;
              alert('Error - ' + errorMessage);
              console.log('Response:', xhr.responseText); // Log the entire response
              console.log('Error:', error);
            }
          });
        }
      </script>


      <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <button type="button" class="btn btn-primary" onclick="deletePost()">Yes</button>
              <button type=" button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>

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