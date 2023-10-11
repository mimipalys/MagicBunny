<?php
// Database connection details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'VacciMate';

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values (replace 'fieldname' with actual field names)
    $question1 = $_POST['question1'];
    $question2 = $_POST['question2'];
    $question3 = $_POST['question3'];
    $question4 = $_POST['question4'];
    $question5 = $_POST['question5'];
    $question6 = $_POST['question6'];
    $question7 = $_POST['question7'];
    $question8 = $_POST['question8'];
    $question9 = $_POST['question9'];
    $question10 = $_POST['question10'];
    $question11 = $_POST['question11'];
    $question12 = $_POST['question12'];
    $question13 = $_POST['question13'];
    $question14 = $_POST['question14'];
    $question15 = $_POST['question15'];
    $additional_effects = $_POST['additional_effects'];

    // Prepare and execute the SQL query to insert feedback data into the table
    $sql = "INSERT INTO feedback (question1, question2, question3, question4, question5, question6, question7, question8, question9, question10, question11, question12, question13, question14, question15, additional_effects) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssss", $question1, $question2, $question3, $question4, $question5, $question6, $question7, $question8, $question9, $question10, $question11, $question12, $question13, $question14, $question15, $additional_effects);

    if ($stmt->execute()) {
        // Feedback data has been successfully inserted into the database
        header("Location: thank_you.php"); // Redirect to a thank you page
    } else {
        // Handle the error if the data insertion fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>


