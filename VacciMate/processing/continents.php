<!DOCTYPE html>
<html>
<?php
  include('../frontend/links.php');
?>

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $styles_doc ?>">
    <link rel="stylesheet" type="text/css" href="http://localhost/processing/continent_page.css">
    <title>
          Using display: flex and 
          justify-content: space-between
    </title>
</head>

<?php 
session_start();

//include correct header
if (isset($_SESSION['user_id']) and $_SESSION['role'] == "patient") {
  include $header_logged_in_patient;
} elseif (isset($_SESSION['user_id']) and $_SESSION['role'] == "caregiver") {
  include $header_logged_in_caregiver;
} else {
  include $header;
}


?>
    
    <!-- Travel Destinations Section -->
    <section class="continent_page">
        <!-- Search Form -->
        <form action="search_country.php" method="get" class="search-form">
            <input type="text" name="country" id="country" placeholder="Search for your destination here">
            <input type="submit" value="Search">
        </form>
        <h1 class="continent_title">Travel Destinations</h1>
        <p class="continent_description">Travelling abroad but unsure about possible vaccinations you may need? Simply type in the country or continent you are visiting to find out all you need to know and recommended vaccines.</p>
        <ul class="continent_list">
        <?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "vaccimate";

        // Create connection
        $link = mysqli_connect($servername, $username, $password, $dbname);

        // Check if connection is established
        if (mysqli_connect_error()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // SQL query to fetch distinct continents from the "Country" table
        $sql = "SELECT DISTINCT continent FROM Country";

        // Execute the query
        $result = $link->query($sql);

        $continentImageURLs = [
            "https://cw-image-resizer.cwg.tw/resize/uri/https%3A%2F%2Fstorage.googleapis.com%2Fopinion-cms-cwg-tw%2Fckeditor%2F201912%2Fckeditor-5e007ff109b1e.jpg/?w=900&format=webp", // Replace with the actual image URL
            "https://www.travelanddestinations.com/wp-content/uploads/2019/05/Mu-Koh-Angthong-National-Marine-Park-via-Adobe-Stock.jpg",  
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6RLvGlBdRW8u1T40Xd8-LVxdzYprkx1zgqNRBIGEoOfzSfNpNRZZiJyMR8F2W1_M--Dk&usqp=CAU",
            "https://media.cntraveller.com/photos/611becca628f4910ed10222d/16:9/w_2560%2Cc_limit/gettyimages-1044285108.jpg",
            "https://d19lgisewk9l6l.cloudfront.net/assetbank/Twelve_Apostles_Great_Ocean_Road_Victoria_Australia_29943.jpg",
        ];
        

        // Loop through the results and display continents as clickable links
        if ($result->num_rows > 0) {
            $index = 0;
            while ($row = $result->fetch_assoc()) {
                $continent = $row['continent'];
                $imageURL = $continentImageURLs[$index];
                $index++; // Move to the next image URL
                // Link to the page that will display countries for the selected continent
                echo "<li><a href='countries.php?continent=$continent'><img src='$imageURL' alt='$continent'><br>$continent</a></li>";
            }
        } else {
            echo "No continents found.";
        }

        // Close the database connection
        $link->close();
        ?>
        </ul>
    </section>
</body>
<?php 
 include $footer;
 ?>
</html>
