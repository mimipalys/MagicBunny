
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
$sql = "SELECT VaccineName FROM Vaccine";
$result = $link->query($sql);

$Vaccine_list = array();

while($row = $result->fetch_assoc()) {
    $Vaccine_list[] = $row['VaccineName'];
}


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
    // Your existing code for database connection and fetching vaccine names

    // Check if there are vaccines in the list
    if (!empty($Vaccine_list)) {
        echo '<ul>';
        foreach ($Vaccine_list as $vaccineName) {
            // Create a button for each vaccine name
            echo '<li><button type="button">' . $vaccineName . '</button></li>';
        }
        echo '</ul>';
    } else {
        echo 'No vaccines found in the list.';
    }
    ?>
</body>
</html>