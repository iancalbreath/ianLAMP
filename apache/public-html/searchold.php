<?php
// Database connection
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password
$dbname = "world_build";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch search query from the form
$search = isset($_POST['search']) ? $_POST['search'] : '';

// SQL query to search the characters table
$sql = "SELECT * FROM characters WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR species LIKE '%$search%' OR hometown LIKE '%$search%'";

$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Character Search</title>
</head>
<body>
    <h1>Search Characters</h1>
    <form method="post" action="search.php">
        <input type="text" name="search" placeholder="Search for characters">
        <input type="submit" value="Search">
    </form>

    <?php
    if ($search) {
        if ($result->num_rows > 0) {
            echo "<h2>Search Results:</h2>";
            echo "<table border='1'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Species</th><th>Hometown</th><th>Occupation</th></tr>";
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstname"]. "</td><td>" . $row["lastname"]. "</td><td>" . $row["species"]. "</td><td>" . $row["hometown"]. "</td><td>" . $row["occupation"]. "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }
    ?>

    <?php $conn->close(); ?>
</body>
</html>
