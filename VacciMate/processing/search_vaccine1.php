
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
        .show-description-checkbox:checked + .vaccine_description {
            display: block;
            text-align: center;
            align-items: center;
        }
    </style>
    
<!DOCTYPE html>
<html>
<body>
    <form action="search_vaccine1.php" method="POST">
    <p class="search_vaccine">Search HEJ Vaccine</p> <input type="text" name="search_query">
    <text-align: center><input type="submit" value="Search">
    </form>

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


if (isset($_POST['search_query'])) {
    $searchQuery = $_POST['search_query'];
    $sql = "SELECT VaccineName, Description FROM Vaccine WHERE VaccineName LIKE '%$searchQuery%'";
    $test = 1;
}   else {
    // Build the SQL query
    $sql = "SELECT VaccineName, Description FROM Vaccine";
    $test = 0;
}

$result = $link->query($sql);

while($row = $result->fetch_assoc()) {
    echo '<div>';
    echo '<label for="show-description-' . $row['VaccineName'] . '" class="show-description-button">' . $row['VaccineName'] . '</label>';
    echo '<input type="checkbox" id="show-description-' . $row['VaccineName'] . '" class="show-description-checkbox">';
    echo '<p class="vaccine_description">' . $row['Description'] . '</p>';
    echo '</div>';
}



// Close the database connection
$link->close();
?>









    
