<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="../../borderstyle.css">

  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the answers from the form
    $answer1 = $_POST["question1"];
    $answer2 = $_POST["question2"];

    // Database connection details
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'root';
    $dbName = 'VacciMate';

    // Create a database connection
    $conn = new mysqli($db_host, $db_Username, $db_Password, $db_Name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert feedback data into a table
    $sql = "INSERT INTO feedback (question1, question2) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $answer1, $answer2);

    if ($stmt->execute()) {
        // Feedback data has been successfully inserted into the database
        header("Location: thank_you.php");
    } else {
        // Handle the error if the data insertion fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>


<head>
  <title>Feedback Form</title>
</head>

<body>
  <h1>Feedback Form for Side Effects Post Vaccination</h1>

  <form action="submit_feedback.php" method="POST">
    <label for="question1">1. Did you experience any side effects after vaccination?</label>
    <input type="radio" name="question1" value="Yes"> Yes
    <input type="radio" name="question1" value="No"> No

    <br><br>

    <label for="question2">2. If you experienced side effects, were they severe?</label>
    <input type="radio" name="question2" value="Yes"> Yes
    <input type="radio" name="question2" value="No"> No

    <br><br>

    <input type="submit" value="Submit Feedback">
  </form>
</body>

</html>
