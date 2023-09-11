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

// REGISTER

if (isset($_POST['register'])) {
    $username = $_POST['ID'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dateOfBirth = $_POST['bday'];
    $mailAddress = $_POST['mail'];
    $phoneNumber = $_POST['phone'];
    $address = $_POST['address'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT, ["cost"=>12]);

    $sql = "INSERT INTO Patient (PatientID, Fname, Lname, DateOfBirth, Password, MailAddress, PhoneNumber, Address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("isssssss", $username, $fname, $lname, $dateOfBirth, $hashed_password, $mailAddress, $phoneNumber, $address);
    
    if ($stmt->execute()) {
        echo "Registration successful. <a href='index.php'>Login here</a>";
    } else {
        echo "Registration failed. Error: " . $db->error;
    }    

    $stmt->close();
}

// LOGIN

if (isset($_POST['login'])) {
    $username = $_POST['ID'];
    $password = $_POST['password'];

    $sql = "SELECT PatientID, Fname, Lname, Password FROM Patient WHERE PatientID=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['user_id'] = $user['PatientID'];
        $_SESSION['username'] = $user['Fname'];
        header("Location: dashboard.php");
        echo "succesful login";
    } else {
        echo "Login failed. Please check your credentials.";
    }

    $stmt->close();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
}
?>
