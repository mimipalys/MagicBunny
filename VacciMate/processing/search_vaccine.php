
<!DOCTYPE html>
<html>

<head>

  <link rel="stylesheet" type="text/css" href="../frontend/borderstyle.css">
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
     <a id = "GFG" href = "http://localhost:8888/processing/i 
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> &#9881 </a> 
    </div>
  </div>
  

  <div class= "bottomheader">
    <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> Travel information </a> 
    <p id = "GFG" class="costumbutton2_choosen"> Search Vaccine </p>  
    <a id = "GFG" href = "http://localhost:8888/frontend/About_Us/About_Us.php" class="costumbutton2"> About Us </a> 
  </div>

    <style>
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
    
<!DOCTYPE html>
<html>
<body>
    qwerqweqwerweweq
    <div  class = "search_vaccine">
        <form action="search_vaccine.php" method="GET">
        <p class="search_vaccine">Search forccine</p> <input class="search_vaccine" type="text" name="search_query" placeholder="Vaccine Name or Disease..." >
        <text-align: center><input type="submit" value="Search">
        </form>
    </div>

</body>


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


if (isset($_GET['search_query'])) {
    // Build the SQL query
    $searchQuery = $_GET['search_query'];
    $sql = "SELECT VaccineName, Description, RelatedDisease FROM Vaccine WHERE VaccineName LIKE '%$searchQuery%'";

    // Create button that takes you back
    echo '<div  class = "show-all-button">';
    echo '<a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="show-all-button"> Show all vaccines</a>';
    echo '</div>';

}   else {
    // Build the SQL query
    $sql = "SELECT VaccineName, Description, RelatedDisease FROM Vaccine";
    $test = 0;
}

// Create the vaccine buttons
$result = $link->query($sql);
while($row = $result->fetch_assoc()) {
    echo '<div>';
    echo '<label for="show-description-' . $row['VaccineName'] . '" class="show-description-button">' . $row['VaccineName'] . '</label>';
    echo '<input type="checkbox" id="show-description-' . $row['VaccineName'] . '" class="show-description-checkbox">';
    echo '<p class="vaccine_description1">'. "Vaccine Name: ".  $row['VaccineName']  ."<br><br>". "Related Disease: " . $row['RelatedDisease']."<br><br>". "Description: " .$row['Description'] . '</p>';
    echo '</div>';
}



// Close the database connection
$link->close();
?>





