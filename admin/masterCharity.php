<?php
include ("partials/navbarLoggedin.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Master Charity</title>
    <link rel="stylesheet" type="text/css" href=".<?= ROOT_URL ?>css/styles.css">
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
<!-- 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(function () {
        // Load navbar content using jQuery
        $("#getnavbar").load("./partials/navbarLoggedin.php");
    });
</script> -->

<body>
    <!-- <div id="getnavbar"></div> -->
    <div class="homepageHeader">
        <h1>Master Charity</h1>
        <p>Edit or delete the charity details(This page is only available for System Administrator)</p>
    </div>

    <!-- Using bootstrap table to list ALL the charity from ALL the categories, this page this only available for System Administrator who can edit every charity in the site -->
    <!-- In this page we'll fetch all the data from charity table and list it, in assignment 2 -->

    <div class="container col-9">
        <div class="col-12" style="text-align:right;">
            <a href="<?= ROOT_URL ?>createCharity.php" class="btn btn-primary btn-sm active" role="button"
                aria-pressed="true">Create
                New Charity</a>
            <a href="<?= ROOT_URL ?>admin/userDetails.php" class="btn btn-primary btn-sm active" role="button"
                aria-pressed="true">Edit User
                Role</a>
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
                            <!-- Call to action buttons -->
                            <ul class="list-inline m-0">
                                <li class="list-inline-item">
                                    <button class="btn btn-light"><a href="createCharity.html"><i
                                                class="fa-solid fa-pen-to-square" style="font-size:12px;"></i><span
                                                style="margin-left: 8px;">EDIT</span></a></button>
                                </li>
                                <li class="list-inline-item">
                                    <!-- <button class="btn btn-light"> <i class="fa-solid fa-trash-can"style="font-size:12px;">DELETE</i></button> -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-trash-can" style="font-size:12px;"><span
                                                style="margin-left: 8px;">Delete</span></i>
                                    </button>

                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Charity for students</td>
                        <td>Supporting indvidual with disablilities</td>
                        <td>Education</td>
                        <td>$5000</td>
                        <td>90%</td>
                        <td>
                            <!-- Call to action buttons -->
                            <ul class="list-inline m-0">
                                <li class="list-inline-item">
                                    <button class="btn btn-light"><a href="createCharity.html"><i
                                                class="fa-solid fa-pen-to-square" style="font-size:12px;"></i><span
                                                style="margin-left: 8px;">EDIT</span></a></button>
                                </li>
                                <li class="list-inline-item">
                                    <!-- <button class="btn btn-light"> <i class="fa-solid fa-trash-can"style="font-size:12px;">DELETE</i></button> -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-trash-can" style="font-size:12px;"><span
                                                style="margin-left:8px;">Delete</span></i>
                                    </button>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Save tree</td>
                        <td>Planting trees</td>
                        <td>Environment</td>
                        <td>$10000</td>
                        <td>40%</td>
                        <td>
                            <!-- Call to action buttons -->
                            <ul class="list-inline m-0">
                                <li class="list-inline-item">
                                    <button class="btn btn-light"><a href="createCharity.html"><i
                                                class="fa-solid fa-pen-to-square" style="font-size:12px;"></i><span
                                                style="margin-left: 8px;">EDIT</span></a></button>
                                </li>
                                <li class="list-inline-item">
                                    <!-- <button class="btn btn-light"> <i class="fa-solid fa-trash-can"style="font-size:12px;">DELETE</i></button> -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-trash-can" style="font-size:12px;"><span
                                                style="margin-left: 8px;">Delete</span></i>
                                    </button>

                                </li>
                            </ul>
                        </td>
                    </tr>

                </tbody>
            </table>




            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
                            <button type="button" class="btn btn-primary">Yes</button>
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

</body>

</html>