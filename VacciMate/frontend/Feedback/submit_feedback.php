<?php
session_start();
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
    // Get form input values
    $questions = array(); // Create an array to store question values
    $bindTypes = 'iss'; // Initialize bind parameter types
    $bindValues = array(); // Initialize bind parameter values

    for ($i = 1; $i <= 15; $i++) {
        $questionName = 'question' . $i;
        // Check if the question is set, if not, set it to NULL
        $questions[$i - 1] = isset($_POST[$questionName]) ? $_POST[$questionName] : null;

        // Update bind parameter types and values
        $bindTypes .= 's'; // Append 's' for string
        $bindValues[] = &$questions[$i - 1];
    }
    $additional_effects = $_POST['additional_effects'];

    // After the user is identified or logs in:
    if (isset($_SESSION['PatientID']) && isset($_SESSION['VaccineID'])) {
        $PatientID = $_SESSION['PatientID'];
        $VaccineID = $_SESSION['VaccineID'];
    } else {
        // You should handle the case when these values are not set properly.
        // You can redirect the user or display an error message.
        // For now, I'm setting them to null.
        $PatientID = null;
        $VaccineID = null;
    }   

    // Prepare and execute the SQL query to insert feedback data into the table
    $sql = "INSERT INTO feedback(PatientID, VaccineID, question1, question2, question3, question4, question5, question6, question7, question8, question9, question10, question11, question12, question13, question14, question15, additional_effects) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters without argument unpacking
        array_unshift($bindValues, $bindTypes);
        call_user_func_array(array($stmt, 'bind_param'), $bindValues);
    
        if ($stmt->execute()) {
            // Feedback data has been successfully inserted into the database
            header("Location: thank_you.php"); // Redirect to a thank you page
        } else {
            // Handle the error if the data insertion fails
            echo "Error executing the SQL statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Handle the case when the statement couldn't be prepared
        echo "Error preparing the SQL statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
