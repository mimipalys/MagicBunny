<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="http://localhost/frontend/borderstyle.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/processing/country_page.css">
    <title>
          Using display: flex and 
          justify-content: space-between
    </title>
</head>

<body>
 <header>
  <div class= "topheader">
    <a id = "GFG" class="vaccimateLogo" href = "http://localhost:8888/frontend/homepage/frontpage.php"> &#128137 VacciMate </a> 
    <div class= "rightpart_topheader">
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Login </a> 
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Register </a> 
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> &#9881 </a> 
    </div>
  </div>

  <div class= "bottomheader">
  <a id = "GFG" href = "http://localhost:8888/processing/continents.php" class="costumbutton2"> Travel information </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="costumbutton2"> Search Vaccine </a> 
    <a id = "GFG" href = "http://localhost:8888/frontend/About_Us/About_Us.php" class="costumbutton2"> About Us </a>
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
                    // Perform a case-insensitive search and replace
                    $description = preg_replace(
                        "/\b" . preg_quote($word, '/') . "\b/i",
                        "<a href='http://localhost/processing/search_vaccine.php'class='highlight-link'>$0</a>",
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
