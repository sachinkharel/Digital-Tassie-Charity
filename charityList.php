<?php
include ("partials/navbar.php");
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
                    <button class="btn btn-outline-secondary" type="button">Search</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
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

    <!-- We're using an array to store the data for the charity and dynamically list,
    in assignment 2 we'll pull the data from the database charity table and store it in the array 
    to then list it in this page. -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // storing the data in "charityList" array, in key-value format where "name" is the key and "Charity for Disable" is the value

            const charityList = [
                { name: "Charity For Health and Safety Awareness", category: "Health", description: "Committed to promoting health and safety awareness, our charity educates and empowers communities to prioritize well-being. Through workshops, campaigns, and outreach programs, we strive to create a culture of prevention and preparedness. Your support enables us to advocate for safer environments and healthier lifestyles, ensuring a brighter future for all", goal: 1000, progress: 50 },
                { name: "Charity For Disable", category: "Education", description: "Supporting individuals with disabilities, our charity strives to create an inclusive society where everyone has equal opportunities. Through advocacy, education, and empowerment programs, we aim to enhance the quality of life for people with disabilities. Your contribution helps us provide essential services and promote disability rights, fostering a more accessible and supportive community.", goal: 1500, progress: 30 },
                { name: "Charity For Environment", category: "Environment", description: "Green Earth Initiative is a charity dedicated to preserving and protecting our planet's natural resources. Our mission is to promote sustainability, biodiversity, and environmental conservation. Through tree-planting drives, waste reduction campaigns, and educational programs, we empower communities to adopt eco-friendly practices and mitigate the impact of climate change", goal: 2000, progress: 60 },

            ];

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

                    const charityTitle = document.createElement("h5");
                    charityTitle.classList.add("card-title");
                    charityTitle.textContent = charity.name;

                    const chairtyCategory = document.createElement("p");
                    chairtyCategory.classList.add("card-text");
                    chairtyCategory.textContent = charity.category;


                    const charityDescription = document.createElement("p");
                    charityDescription.classList.add("card-text");
                    charityDescription.textContent = charity.description;

                    const goalAmount = document.createElement("p");
                    goalAmount.classList.add("card-text", "text-end", "font-weight-bold");
                    goalAmount.textContent = `Goal: $${charity.goal}`;

                    // here we're putting all the nodes in the DOM tree of this page

                    cardBody.appendChild(charityTitle);
                    cardBody.appendChild(progressBar);
                    cardBody.appendChild(chairtyCategory);
                    cardBody.appendChild(charityDescription);
                    cardBody.appendChild(goalAmount);
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
    </script>
</body>

</html>