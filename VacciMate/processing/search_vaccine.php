
<!DOCTYPE html>
<html>
<?php
    session_start();
    include('../frontend/links.php');
?>


<head>

  <link rel="stylesheet" type="text/css" href="../frontend/borderstyle.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:8888/processing/search_vaccine_page.css">
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
    echo '<p id = "GFG" class="costumbutton2_choosen"> Search Vaccine </p>';
    echo '<a id="GFG" href="' . $aboutUs_link . '"  class="costumbutton2">About Us</a>';
  ?>
  </div>
</html>


<!DOCTYPE html>
<html>
<style>
.Vaccine_title {
            text-align: center;
            font-size: 30px;
            color: #333;
            margin-top: 50px;
        }
        
        /* Styles for the destination description */
        .vaccine_text {
            text-align: center;
            font-size: 30px;
            color: #666;
            margin-top: 10px;
            word-wrap: break-word; /* Allow automatic line wrapping */
        }

        .search-form {
        text-align: center;
        margin-top: 20px;
        }

        .search-form input[type="text"] {
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        }

        .search-form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        }

        /* Style for the description initially hidden */
        .search_vaccine {
            text-align: center;
            font-size: 20px; 
            border-radius:20px;
            border: none;
            padding: auto;
        }

        .list_of_vaccine {
            text-align: center;
            font-size: 20px; 
        }
        /* Style for the button */
        .show-description-button1 {
            cursor: pointer;
        }

        /* Style for the checkbox */
        .show-description-checkbox {
            display: none;
        }

        /* When the checkbox is checked, show the hidden description */
        .show-description-checkbox:checked + .vaccine_description1 {
            display: block;
            text-align: left;
            align-items: right;
        }

        .show-all-button {
            cursor: pointer;
            border: none;
            padding: auto;
            align-items: right;
            font-size: 20px;
            cursor: pointer;
            border-radius: 10px;
            margin: auto; /* Add some spacing between buttons */
            display: block
        }
        /* styles of the vaccinename buttons that are clickable to view the description*/
        .show-description-button {
        text-align: left;
        border: none;
        padding: auto;
        align-items: right;
        font-size: 20px;
        cursor: pointer;
        border-radius: 10px;
        margin: auto; /* Add some spacing between buttons */
        display: block
        }
    

        /* styles of the vaccine descriptions in seach vaccine*/

        .vaccine_description1 {
        display: none;
        align-items: center;
        background-color: #ffffff;
        margin: auto;
        padding: 1rem 1rem;
        text-align: right;
        margin: 20px ; 
        width: 700px;
        Height: auto;
        border-radius:20px;
        }
</style>



<link rel="stylesheet" type="text/css" href="http://localhost:8888/processing/search_vaccine_page.css">
<header>
    <section class="search_vaccine_page">   
        <div  class = "search-form">
            <form action="search_vaccine.php" method="GET">
            <input class="search_vaccine" type="text" name="search_query" placeholder="Vaccine Name or Disease..." >
            <input class = "search-form" type="submit" value="Search">
            </form>
        </div>
        <h1 class = "Vaccine_title">Vaccine Information</h1>   
        <p class = "vaccine_text"> Search for Vaccine or disease to find information or click vaccine name to read description</p>    


        <?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "VacciMate";

        // Create connection
        $link = mysqli_connect($servername, $username, $password, $dbname);

        // Check if connection is established
        if (mysqli_connect_error()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        //check if there is a search query 

        if (isset($_GET['search_query'])) {

            // Build the SQL query for search query
            $searchQuery = $_GET['search_query'];
            $sql = "SELECT VaccineName, Description, RelatedDisease FROM Vaccine WHERE VaccineName LIKE '%$searchQuery%'";

            // Create button that takes you back
            echo '<div  class = "show-all-button">';
            echo '<a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="show-all-button"> Show all vaccines</a>';
            echo '</div>';

        }   else {
            // Build the SQL query for all vaccines in DB
            $sql = "SELECT VaccineName, Description, RelatedDisease FROM Vaccine";
            $test = 0;
        }
        $result = $link->query($sql);


        
        while($row = $result->fetch_assoc()) {
            echo '<div>';
            echo '<label for="show-description-' . $row['VaccineName'] . '" class="show-description-button">' . $row['VaccineName'] . '</label>';
            echo '<input type="checkbox" id="show-description-' . $row['VaccineName'] . '" class="show-description-checkbox">';
            echo '<p class="vaccine_description1">'. "Vaccine Name: ".  $row['VaccineName']  ."<br><br>". "Related Disease: " . $row['RelatedDisease']."<br><br>". "Description: " .$row['Description'] . '</p>';
            echo '</div>';
        }
        // check if session
        if (isset($_SESSION['user_id'])) {
            $patientID = $_SESSION['user_id'];
            $sql2 = "SELECT VaccineName FROM VaccineDose VD JOIN Vaccine AS V ON V.VaccineID = VD.VaccineID WHERE VD.PatientID = $patientID";
            $result2 = $link->query($sql2);
        }

        while($row2 = $result2 ->fetch_assoc()) {
            echo '<div>';
            echo $row2['VaccineName'] ;
            echo '</div>';
        }


        // Close the database connection
        $link->close();
        ?>
    </section>
</body>
</html>





