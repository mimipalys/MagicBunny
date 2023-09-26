<?php
session_start();

// Database connection details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'VacciMate';

// Create a database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// LOGIN

$username = $_POST['ID'];
$password = $_POST['password'];

$sql = "SELECT HealthcareProviderID, Fname, Lname, Password FROM HealthcareProvider WHERE HealthcareProviderID=?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['Password'])) {
    $_SESSION['user_id'] = $user['HealthcareProviderID'];
    $_SESSION['username'] = $user['Fname'];
    header("Location: ../frontend/homepage/frontpage.php");
    echo "succesful signIn.php";
} else {
    echo "Login failed. Please check your credentials.";
}

$stmt->close();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
}
?>
