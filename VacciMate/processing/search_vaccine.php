

<!DOCTYPE html>
<html>

<head>

  <link rel="stylesheet" type="text/css" href="../frontend/homepage/borderstyle.css">
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
    <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> Travel information </a> 
    <p id = "GFG" class="costumbutton2_choosen"> Search Vaccine </p>  
    <a id = "GFG" href = "http://localhost:8888/frontend/About_Us/About_Us.php" class="costumbutton2"> About Us </a> 
  </div>

    <form method="POST">
        <input type="text" name="query" placeholder="Vaccine Name or Disease..." >
        <button type="submit">Search</button class="costumbutton1">
    </form>

    <style>
        /* Style for the description initially hidden */

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
        }
    </style>
    
    <?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Vaccine";

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
<head>
    <title>Vaccine List</title>
</head>
<body>
    <h1>List of Vaccines</h1>

    <?php
    // creates buttons and description

    while($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<label for="show-description-' . $row['VaccineName'] . '" class="show-description-button">' . $row['VaccineName'] . '</label>';
        echo '<input type="checkbox" id="show-description-' . $row['VaccineName'] . '" class="show-description-checkbox">';
        echo '<p class="vaccine_description">' . $row['Description'] . '</p>';
        echo '</div>';
    }
    
    ?>
</body>
</html>
