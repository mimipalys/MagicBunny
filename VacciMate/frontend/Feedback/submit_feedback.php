<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the answers from the form
    $answer1 = $_POST["question1"];
    $answer2 = $_POST["question2"];

    // You can store the feedback data in a database or file, or perform any other actions as needed

    // For example, you can store the feedback in a text file
    $feedback = "Question 1: $answer1\nQuestion 2: $answer2\n";

    // Append the feedback to a text file
    file_put_contents("feedback.txt", $feedback, FILE_APPEND);

    // Redirect the user to a thank you page or another page as needed
    header("Location: thank_you.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Thank You for Your Feedback</title>
</head>

<body>
    <h1>Thank You for Your Feedback</h1>

    <p>We appreciate your feedback regarding your vaccination experience. Your input helps us improve our services.</p>

    <p><a href="feedback_form.php">Go back to the feedback form</a></p>
</body>

</html>
