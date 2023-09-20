
<!DOCTYPE html>
<html>

    <body>
    <form method="POST">
        <input type="text" name="query" placeholder="Vaccine Name or Disease...">
        <button type="submit">Search</button>
    </form>


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
        #$Vaccine_list[] = $row['VaccineName'];
        echo '<details>';
        echo '<summary>' . $row['VaccineName'] . '</summary>';
        echo '<p>' . $row['Description'] . '</p>';
        echo '</details>';
    }
    
    ?>
</body>
</html>