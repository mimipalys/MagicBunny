<!DOCTYPE html>
<html>
<?php
  include('../frontend/links.php');
?>


<head>
    <link rel="stylesheet" type="text/css" href="http://localhost:8888/frontend/borderstyle.css">
    <link rel="stylesheet" type="text/css" href="http://localhost:8888/processing/country_page.css">
    <title>
          Using display: flex and 
          justify-content: space-between
    </title>
</head>

<body>
<header>
  <div class= "topheader">
    <?php
     echo '<a id="GFG" class="vaccimateLogo" href="' . $homepage_link . '">&#128137 VacciMate</a>';
    ?>
    
    <div class= "rightpart_topheader">
    <?php
     echo '<a id="GFG" href="' . $login_link . '" class="costumbutton1">Login</a>';
     echo '<a id="GFG" href="' . $register_link . '"  class="costumbutton1">Register</a>';
     echo '<a id="GFG" href="' . $setting_link . '" class="costumbutton1">&#9881</a>';
    ?>
    </div>
  </div>
  
  <div class= "bottomheader">
  <?php
    echo '<a id="GFG" href="' . $travel_link . '" class="costumbutton2">Travel information</a>';
    echo '<a id="GFG" href="' . $search_link . '"  class="costumbutton2">Search Vaccine</a>';
    echo '<a id="GFG" href="' . $aboutUs_link . '"  class="costumbutton2">About Us</a>';
  ?>
  </div>

 </header>

    
    
    <!-- Countries Section -->
    <section>
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

        // SQL query to fetch countries and descriptions for the selected continent
        $sql = "SELECT Name, description FROM Country WHERE Name = '$selectedCountry'";

        // Execute the query
        $result = $link->query($sql);

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
                    $vaccineLink = "http://localhost:8888/processing/search_vaccine.php?search_query=" . urlencode($word);
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
        $link->close();
        ?>
    </section>
</body>
</html>
