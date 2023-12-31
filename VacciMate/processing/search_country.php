<!DOCTYPE html>
<html>
<?php
include('../frontend/links.php');
?>

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $continents_style ?>">
    <link rel="stylesheet" type="text/css" href="http://localhost/processing/country_page.css">
    <title>
        Using display: flex and 
        justify-content: space-between
    </title>
</head>

<body>
<?php 
session_start();

if (isset($_SESSION['user_id']) and $_SESSION['role'] == "patient") {
    include $header_logged_in_patient;
} elseif (isset($_SESSION['user_id']) and $_SESSION['role'] == "caregiver") {
    include $header_logged_in_caregiver;
} else {
    include $header;
}

?>
<!-- Countries Section -->
<section class="vaccine_description1">
    <h1>Countries</h1>
    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "vaccimate"; // Update with your actual database name

    // Get the selected continent from the URL parameter
    $selectedCountry = $_GET['country'];

    // Create connection
    $link = mysqli_connect($servername, $username, $password, $dbname);

    // Check if connection is established
    if (mysqli_connect_error()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT Name, description FROM Country WHERE Name LIKE ?";
    $stmt = $link->prepare($sql);
    $searchQuery = '%' . $selectedCountry . '%';
    $stmt->bind_param("s", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any countries were found
    if ($result->num_rows > 0) {
        echo "<ul>";
        // Loop through the results and display countries and descriptions
        while ($row = $result->fetch_assoc()) {
            $country = $row['Name'];
            $description = $row['description'];

            // Fetch the target words from the "vaccine" table 
            $query = "SELECT RelatedDisease FROM vaccine";
            $targetWordsResult = $link->query($query);

            $targetWords = array();
            if ($targetWordsResult->num_rows > 0) {
                while ($targetRow = $targetWordsResult->fetch_assoc()) {
                    $vaccineName = $targetRow['RelatedDisease'];
                    // Split the vaccine name into individual words
                    $vaccineWords = explode(', ', $vaccineName);
                    // Add each word to the targetWords array
                    $targetWords = array_merge($targetWords, $vaccineWords);
                }
            }

            // Loop through the target words and highlight them in the description
            foreach ($targetWords as $word) {
                // Create a link to the search_vaccine page with the search_query parameter
                $vaccineLink = "http://localhost:8888/processing/search_vaccine/search_vaccine.php?search_query=" . urlencode($word);
                // Perform a case-insensitive search and replace with the link
                $description = preg_replace(
                    "/\b" . preg_quote($word, '/') . "\b/i",
                    "<a href='$vaccineLink' class='highlight-link'>$word</a>",
                    $description
                );
            }

            echo "<li><strong>$country</strong></li>";
            echo "<li>$description</li>";
        }
        echo "</ul>";
    } else {
        echo "No countries found for $selectedCountry.";
    }

    // Close the statement and database connection
    $stmt->close();
    $link->close();
    ?>
</section>
</body>
<?php 
include $footer;
?>
</html>
