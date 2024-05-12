<?php
include ("partials/navbar.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$current_admin_id = $_SESSION['user-id'];
$query = "SELECT * FROM posts";
$donations = "SELECT * FROM donations";
$get_donations = mysqli_query($connection, $query);
$posts = mysqli_query($connection, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>css/styles.css" />

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
        $("#getnavbar").load("./partials/navbar.php");
    });
</script> -->

<body>
    <!-- <div id="getnavbar"></div> -->
    <div class="homepageHeader">
        <h1>Charity List</h1>
        <p>List of all the charities created in this platform.</p>
    </div>

    <!-- bootstrap search bar and filter dropdown -->

    <div class="container col-9">
        <div class="row">
            <div class="col-md-9">
                <div class="input-group mb-3">
                    <input type="text" id="search-input" class="form-control" placeholder="Search...">
                    <!-- <button class="btn btn-outline-secondary" type="button">Search</button> -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <select id="category-filter" class="form-select">
                        <option value="all">All</option>
                        <option value="Health">Health</option>
                        <option value="Education">Education</option>
                        <option value="Environment">Environment</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Charity List -->
        <div id="charity-list">
            <!-- Charity items will be dynamically added here -->
        </div>
    </div>


    <div class="modal fade" id="donateModal" tabindex="-1" aria-labelledby="donateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="donateModalLabel">Donate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="donateForm">
                        <div class="mb-3">
                            <label for="donationAmount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="donationAmount" name="donationAmount"
                                required>
                            <input type="hidden" id="donatePostId" name="donatePostId">
                            <input type="hidden" id="donateGoal" name="donateGoal">
                            <input type="hidden" id="donateTotalDonation" name="donateTotalDonation">
                        </div>
                        <button type="submit" class="btn btn-primary">Donate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- We're using an array to store the data for the charity and dynamically list,
    in assignment 2 we'll pull the data from the database charity table and store it in the array 
    to then list it in this page. -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // storing the data in "charityList" array, in key-value format where "name" is the key and "Charity for Disable" is the value

            let charityList = [];

            // Fetch the data from PHP and construct the charityList array
            <?php if ($posts && mysqli_num_rows($posts) > 0): ?>
                <?php while ($post = mysqli_fetch_assoc($posts)): ?>
                    charityList.push({
                        id: '<?= $post['id'] ?>',
                        name: '<?= htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8') ?>',
                        category: '<?= htmlspecialchars($post['category'], ENT_QUOTES, 'UTF-8') ?>',
                        description: <?= json_encode($post['desc']) ?>,
                        goal: '<?= htmlspecialchars($post['goalamt'], ENT_QUOTES, 'UTF-8') ?>',
                        // progress: ( <?= $post['totaldonation'] ?> / <?= $post['goalamt'] ?>) * 100
                        totaldonation: '<?= htmlspecialchars($post['totaldonation'], ENT_QUOTES, 'UTF-8') ?>',
                        progress: ((<?= $post['totaldonation'] ?> / <?= $post['goalamt'] ?>) * 100).toFixed(1)

                    });
                <?php endwhile ?>
            <?php endif ?>
            console.log(charityList);
            const categoryFilter = document.getElementById("category-filter");
            const searchInput = document.getElementById("search-input");
            const charityListContainer = document.getElementById("charity-list");

            // creating a function which will list our charities with formatting and put it in the DOM

            function renderCharityList(charities) {
                charityListContainer.innerHTML = "";
                charities.forEach(charity => {
                    const charityDiv = document.createElement("div");
                    charityDiv.classList.add("card", "mb-3");

                    const cardBody = document.createElement("div");
                    cardBody.classList.add("card-body");

                    const progressBar = document.createElement("div");
                    progressBar.classList.add("progress", "mb-3");
                    progressBar.innerHTML = `
                        <div class="progress-bar" role="progressbar" style="width: ${charity.progress}%" aria-valuenow="${charity.progress}" aria-valuemin="0" aria-valuemax="100">${charity.progress}%</div>
                    `;

                    const formattedCharityName = charity.name.replace(/\s+/g, "-");

                    const charityLink = document.createElement("a");
                    charityLink.href = "charityPage.php?post_id=" + charity.id;
                    // encodeURIComponent(formattedCharityName);
                    charityLink.textContent = charity.name;
                    charityLink.style.textDecoration = "none";
                    charityLink.style.color = "inherit";

                    const charityTitle = document.createElement("h3");
                    charityTitle.classList.add("card-title");
                    charityTitle.appendChild(charityLink);


                    const chairtyCategory = document.createElement("h5");
                    chairtyCategory.classList.add("card-text", "text-center");
                    chairtyCategory.textContent = charity.category;


                    const charityDescription = document.createElement("p");
                    charityDescription.classList.add("card-text");
                    charityDescription.textContent = charity.description;

                    const goalAmount = document.createElement("h6");
                    goalAmount.classList.add("card-text", "text-end", "get-donation");
                    goalAmount.textContent = `Goal: $${charity.goal}`;


                    const progress = document.createElement("h6");
                    progress.classList.add("card-text", "text-end");
                    progress.textContent = `Total Donation: $${charity.totaldonation}`;

                    const donateButton = document.createElement("button");
                    donateButton.classList.add("btn", "btn-primary", "donate-btn", "float-end");
                    donateButton.textContent = "Donate";
                    donateButton.setAttribute('data-post-id', charity.id);
                    donateButton.setAttribute('data-goal-amount', charity.goal);
                    donateButton.setAttribute('data-total-donation', charity.totaldonation);
                    donateButton.id = `donateBtn_${charity.id}`;

                    donateButton.setAttribute("data-bs-toggle", "modal");
                    donateButton.setAttribute("data-bs-target", "#donateModal");


                    // here we're putting all the nodes in the DOM tree of this page

                    cardBody.appendChild(charityTitle);
                    cardBody.appendChild(progress);
                    cardBody.appendChild(progressBar);
                    cardBody.appendChild(chairtyCategory);
                    cardBody.appendChild(charityDescription);
                    cardBody.appendChild(goalAmount);
                    cardBody.appendChild(donateButton);
                    charityDiv.appendChild(cardBody);
                    charityListContainer.appendChild(charityDiv);


                });
            }
            // using this function we're showing the results according to search and filter

            function filterCharities() {
                const selectedCategory = categoryFilter.value;
                const searchTerm = searchInput.value.toLowerCase();

                const filteredCharities = charityList.filter(charity => {
                    const matchesCategory = selectedCategory === "all" || charity.category === selectedCategory;
                    const matchesSearch = charity.name.toLowerCase().includes(searchTerm);
                    return matchesCategory && matchesSearch;
                });

                renderCharityList(filteredCharities);
            }

            categoryFilter.addEventListener("change", filterCharities);
            searchInput.addEventListener("input", filterCharities);

            // Initial render
            renderCharityList(charityList);
        });

        document.addEventListener("DOMContentLoaded", function () {
            // Handle donation submission
            const donateForm = document.getElementById("donateForm");
            // Event listener for donate button click
            document.querySelectorAll('.donate-btn').forEach(button => {
                button.addEventListener('click', function () {
                    updateDonationValues(this);
                });
            });
            function updateDonationValues(donateButton) {
                const postId = donateButton.getAttribute('data-post-id');
                const goal = donateButton.getAttribute('data-goal-amount');
                const totaldonation = donateButton.getAttribute('data-total-donation');

                document.getElementById("donatePostId").value = postId;
                document.getElementById("donateGoal").value = goal;
                document.getElementById("donateTotalDonation").value = totaldonation;

                // console.log(document.getElementById("donateTotalDonation").value)
            }

            donateForm.addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent default form submission

                const donationAmount = document.getElementById("donationAmount").value;

                // Function to update donation values based on the clicked donate button

                fetch('admin/saveDonation.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        amount: donationAmount,
                        postId: document.getElementById("donatePostId").value,
                        goalAmount: document.getElementById("donateGoal").value,
                        totaldonation: document.getElementById("donateTotalDonation").value
                    }),

                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => {
                        if (response.ok) {
                            // If the response indicates success, redirect to charityList.php
                            window.location.href = 'charityList.php';
                        } else {
                            // If the response is not successful, handle it as JSON data
                            return response.json();
                        }
                    })
                    .then(data => {
                        // Check if the response contains an error message
                        if (data && data.error) {
                            // Log the error message
                            console.error('Error:', data.error);
                        } else {
                            // Handle other response data (if needed)
                        }
                    })
                    .catch(error => {
                        // Handle network errors or other exceptions
                        console.error('Error:', error);
                    });


                // Close the modal after submitting the form
                const modal = document.getElementById('donateModal');
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();

                // Reset the form
                donateForm.reset();
            });
        });

    </script>
</body>

</html>