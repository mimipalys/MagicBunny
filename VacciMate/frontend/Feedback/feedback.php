<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="feedback.css">
  <title>Feedback Form</title>
</head>

<body>
  <h1>Feedback Form- Side Effects Post Vaccination</h1>

 <?php
  session_start(); // Start the session

  // Database connection and query to fetch the vaccine name based on the session VaccineID
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "VacciMate";

  $conn = new mysqli($servername, $username, $password, $dbname);

  $VaccineName = $_POST['Vaccine'];

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  ?>

  <form action="submit_feedback.php" method="POST">
  <input type="hidden" name="VaccineID" value="<?php echo isset($_SESSION['VaccineID']) ? $_SESSION['VaccineID'] : ''; ?>">
  
    <label for="question1">1. Did you experience any side effects after vaccination?</label>
    <input type="radio" name="question1" value="Yes"> Yes
    <input type="radio" name="question1" value="No"> No

    <br><br>

    <label for="question2">2. If you experienced side effects, were they severe?</label>
    <input type="radio" name="question2" value="Yes"> Yes
    <input type="radio" name="question2" value="No"> No

    <br><br>

    <label for="question3">3. Did you experience any pain, swelling, or redness at the injection site?</label>
    <input type="radio" name="question3" value="Yes"> Yes
    <input type="radio" name="question3" value="No"> No

    <br><br>

    <label for="question4">4. Did you have a fever after receiving the vaccine?</label>
    <input type="radio" name="question4" value="Yes"> Yes
    <input type="radio" name="question4" value="No"> No

    <br><br>

    <label for="question5">5. Did you experience chills or shivering?</label>
    <input type="radio" name="question5" value="Yes"> Yes
    <input type="radio" name="question5" value="No"> No

    <br><br>

    <label for="question6">6. Did you have muscle or joint pain after vaccination?</label>
    <input type="radio" name="question6" value="Yes"> Yes
    <input type="radio" name="question6" value="No"> No

    <br><br>

    <label for="question7">7. Did you develop a headache?</label>
    <input type="radio" name="question7" value="Yes"> Yes
    <input type="radio" name="question7" value="No"> No

    <br><br>

    <label for="question8">8. Did you feel fatigued or unusually tired?</label>
    <input type="radio" name="question8" value="Yes"> Yes
    <input type="radio" name="question8" value="No"> No

    <br><br>

    <label for="question9">9. Did you have nausea or vomiting?</label>
    <input type="radio" name="question9" value="Yes"> Yes
    <input type="radio" name="question9" value="No"> No

    <br><br>

    <label for="question10">10. Did you experience diarrhea?</label>
    <input type="radio" name="question10" value="Yes"> Yes
    <input type="radio" name="question10" value="No"> No

    <br><br>

    <label for="question11">11. Did you notice a rash or itching on your skin?</label>
    <input type="radio" name="question11" value="Yes"> Yes
    <input type="radio" name="question11" value="No"> No

    <br><br>

    <label for="question12">12. Did you have difficulty breathing or chest pain?</label>
    <input type="radio" name="question12" value="Yes"> Yes
    <input type="radio" name="question12" value="No"> No

    <br><br>

    <label for="question13">13. Did you feel dizzy or lightheaded?</label>
    <input type="radio" name="question13" value="Yes"> Yes
    <input type="radio" name="question13" value="No"> No

    <br><br>

    <label for="question14">14. Did you develop a persistent cough?</label>
    <input type="radio" name="question14" value="Yes"> Yes
    <input type="radio" name="question14" value="No"> No
    
    <br><br>

    <label for="question15">15. Did you notice changes in your taste or smell?</label>
    <input type="radio" name="question15" value="Yes"> Yes
    <input type="radio" name="question15" value="No"> No

    <br><br>

    <div>
      <label for="additional_effects">Any additional effects observed? (Optional)</label>
      <textarea name="additional_effects" rows="4" cols="50"></textarea>
    </div>

    <input type="submit" value="Submit Feedback">
  </form>
</body>
</html>
