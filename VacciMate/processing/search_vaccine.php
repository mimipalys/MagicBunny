

<!DOCTYPE html>
<html>
<?php
  include('../frontend/links.php');
?>
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

// Build the SQL query
$sql = "SELECT VaccineName, Description FROM Vaccine";
$result = $link->query($sql);


// Close the database connection
$link->close();
?>

<!DOCTYPE html>
<html>
<body>
    <div class = "search_vaccine">
    <form action="">
        <input type="text" name="query" placeholder="Vaccine Name or Disease..." class = "search_vaccine" >
        <button type="submit">Search</button class = "search_vaccine">
    </form>
    </div>
</body>


   
<body>
    <div class = "list_of_vaccine">
        <h2> List of Vaccines </h2>;
    </div>
    
    <?php
    // creates buttons and description
    
    while($row = $result->fetch_assoc()) {
        echo '<div class>';
        echo '<label for="show-description-' . $row['VaccineName'] . '" class="show-description-button">' . $row['VaccineName'] . '</label>';
        echo '<input type="checkbox" id="show-description-' . $row['VaccineName'] . '" class="show-description-checkbox">';
        echo '<p class="vaccine_description">' . $row['Description'] . '</p>';
        echo '</div>';
    }
    
    function showvaccine() {
        while($row = $result->fetch_assoc()) {
            if ($row['VaccineName']="query"){
                echo "hej";
            }
        }
    }

    ?>
</body>

<body>
    <form action="">
        <input type="text" name="query" placeholder="Vaccine Name or Disease..." class = "search_vaccine">
        <button type="submit">Search</button class = "search_vaccine" onkeyup="showvaccine()">
    </form>

    
</body>

</html>
