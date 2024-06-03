<?php
// Database connection
$servername = "mariadb";
$username = "user"; 
$password = "password"; 
$dbname = "world_build";
$socket = "/var/run/mysql/mysqld.sock";
// Create connection
$conn = new MySQLi($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch search query from the form
$search = isset($_POST['search']) ? $_POST['search'] : '';

// SQL query to search the characters table
$sql = "SELECT * FROM characters WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR species LIKE '%$search%' OR hometown LIKE '%$search%' OR height LIKE '%$search%' OR weight LIKE '%$search%' OR eye_color LIKE '%$search%' OR hair_color LIKE '%$search%' OR build LIKE '%$search%' OR positive_traits LIKE '%$search%' OR negative_traits LIKE '%$search%' OR motivations LIKE '%$search%' OR fears LIKE '%$search%' OR family_members LIKE '%$search%' OR education LIKE '%$search%' OR physical_perks LIKE '%$search%' OR magical_perks LIKE '%$search%' OR social_perks LIKE '%$search%' OR languages LIKE '%$search%' OR primary_weapon LIKE '%$search%' OR primary_armor LIKE '%$search%' OR unique_items LIKE '%$search%' OR social_status LIKE '%$search%' OR affiliations LIKE '%$search%' OR enemies LIKE '%$search%' OR backstory LIKE '%$search%'";

$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ian Calbreath</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Icon -->
    <link rel="icon" href="./assets/iant32.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <!-- Style sheet -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a id="portfolio-link" class="nav-link" href="./index.html">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a id="contact-link" class="nav-link" href="./contact.html">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a id="projects-link" class="nav-link" href="./search.php">Projects</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        // Get the current page URL
        const currentUrl = window.location.pathname;

        // Get the navigation links by their IDs
        const portfolioLink = document.getElementById('portfolio-link');
        const contactLink = document.getElementById('contact-link');
        const projectsLink = document.getElementById('projects-link');

        // Check if each link's href matches the current URL and set the active class accordingly
        if (currentUrl.endsWith('index.html')) {
            portfolioLink.classList.add('active');
        } else if (currentUrl.endsWith('contact.html')) {
            contactLink.classList.add('active');
        } else if (currentUrl.endsWith('search.php')) {
            projectsLink.classList.add('active');
        }
    </script>

	<div class="container">
		<div class="sidebar">
        <img src="./assets/iant.png" alt="Ian's Photo" class="ianphoto">
			<p>
				I’m a quick learner who loves solving puzzles and being of service.
				<br>
				<br>
				My foundation in IT began as a Field Technician during the pandemic.  This has been a trying time for our community, and it was a challenge and an honor to serve as an essential worker.
				<br>
				<br>
				I’m proud to continue serving my community in my current position at Contra Costa Health, where I collaborate with several IT departments in providing support to our hospitals and clinics.
				<br>
				<br>
				I’m also attending school full-time on my way to my degree in Computer Science and have a special interest in SQL and Python programming, disaster recovery, and security.
			</p>
			<img src="./assets/greybar.png" alt="grey bar" class="greybar">
		</div>
    </div>


    <div class="sqlsearch">
        <h2>Ian's SQL Database of Original Fantasy Characters</h2>
        <p>(HINT: Try "bear" ... or try "%" to see all records.)</p>
        <form method="post" action="search.php">
            <input type="text" name="search" placeholder="Search for characters">
            <input type="submit" value="Search">
        </form>

        <?php

        if ($search) {
            if ($result->num_rows > 0) {
                echo "<h4>Search Results:</h4>";
                echo "<div class='table-container'><table border='1'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Species</th><th>Hometown</th><th>Height</th><th>Weight</th><th>Eye Color</th><th>Hair Color</th><th>Build</th><th>Positive Traits</th><th>Negative Traits</th><th>Motivations</th><th>Fears</th><th>Family Members</th><th>Education</th><th>Physical Perks</th><th>Magical Perks</th><th>Social Perks</th><th>Languages</th><th>Primary Weapon</th><th>Primary Armor</th><th>Unique Items</th><th>Social Status</th><th>Affiliations</th><th>Enemies</th></tr></div>";
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstname"]. "</td><td>" . $row["lastname"]. "</td><td>" . $row["species"]. "</td><td>" . $row["hometown"]. "</td><td>" . $row["height"]. "</td><td>" . $row["weight"]. "</td><td>" . $row["eye_color"]. "</td><td>" . $row["hair_color"]. "</td><td>" . $row["build"]. "</td><td>" . $row["positive_traits"]. "</td><td>" . $row["negative_traits"]. "</td><td>" . $row["motivations"]. "</td><td>" . $row["fears"]. "</td><td>" . $row["family_members"]. "</td><td>" . $row["education"]. "</td><td>" . $row["physical_perks"]. "</td><td>" . $row["magical_perks"]. "</td><td>" . $row["social_perks"]. "</td><td>" . $row["languages"]. "</td><td>" . $row["primary_weapon"]. "</td><td>" . $row["primary_armor"]. "</td><td>" . $row["unique_items"]. "</td><td>" . $row["social_status"]. "</td><td>" . $row["affiliations"]. "</td><td>" . $row["enemies"]. "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
        }
        ?>

        <?php $conn->close(); ?>
    </div>

</body>
</html>
