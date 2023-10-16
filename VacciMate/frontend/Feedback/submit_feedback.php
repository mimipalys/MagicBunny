<?php
session_start(); // Add this line to start the session

// Database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "VacciMate"; // Replace 'your_database_name' with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['VaccineID'])) {
        $vaccineID = $_SESSION['VaccineID'];

        // Retrieve form input values
        $questions = array();
        for ($i = 1; $i <= 15; $i++) {
            $questionName = 'question' . $i;
            $questions[$i] = isset($_POST[$questionName]) ? ($_POST[$questionName] === 'Yes' ? 1 : 0) : 0;
        }
        $additional_effects = $_POST['additional_effects'];

        // Prepare and bind the SQL query
        $stmt = $conn->prepare("INSERT INTO feedback (VaccineID, question1, question2, question3, question4, question5, question6, question7, question8, question9, question10, question11, question12, question13, question14, question15, additional_effects) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            echo "Error during prepare: " . $conn->error;
        } else {
            $success = $stmt->bind_param("iiiiiiiiiiiiiiis", $vaccineID, $questions[1], $questions[2], $questions[3], $questions[4], $questions[5], $questions[6], $questions[7], $questions[8], $questions[9], $questions[10], $questions[11], $questions[12], $questions[13], $questions[14], $questions[15], $additional_effects);

            if (!$success) {
                echo "Error during binding: " . $stmt->error;
            } else {
                if ($stmt->execute()) {
                    echo "New record created successfully";
                } else {
                    echo "Error during execution: " . $stmt->error;
                }
            }

            $stmt->close();
        }
    } else {
        echo "Vaccine ID not set in the session.";
    }
}
?>
