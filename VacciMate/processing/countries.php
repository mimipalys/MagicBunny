<!DOCTYPE html>
<html>
<?php
include('../frontend/links.php');
?>

<head>
    <link rel="stylesheet" type="text/css" href="../frontend/borderstyle.css">
    <link rel="stylesheet" type="text/css" href="country_page.css">
    <title>
        Using display: flex and
        justify-content: space-between
    </title>
</head>

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
<div class="bottomheader">
    <?php
    echo '<h1>countries</h1>
        <br>
        <p>Travel info</p>';
    // echo '<a id="GFG"  href="' . $homepage_link . '"> <img src="' . $logo_img3 . '" alt="test_pic"> </a>';
    ?>
</div>
<!-- Countries Section -->
<section>
    <a href="continents.php" style='font-size:50px; font-family: Zapf Dingbats;'>&#8592;</a>
    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "vaccimate";

    // Get the selected continent from the URL parameter
    $selectedContinent = $_GET['continent'];

    // Create connection
    $link = mysqli_connect($servername, $username, $password, $dbname);

    // Check if connection is established
    if (mysqli_connect_error()) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $sql = "SELECT Name, description FROM Country WHERE continent = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $selectedContinent);
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
        echo "No countries found for $selectedContinent.";
    }

    // Close the database connection
    $stmt->close();
    $link->close();
    ?>
</section>
</body>
<?php
include $footer;
?>
</html>
