
<!DOCTYPE html>
<html>

<?php
  include('../links.php');
  
?>

<head>
  <link rel="stylesheet" type="text/css" href="../borderstyle.css">
  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>

<body>

<!-- NOTIFICATIONS -->

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
 
 // Check if the user is logged in; if not, redirect to the signIn.php page
 if (!isset($_SESSION['user_id'])or $_SESSION['role'] != "patient") {
     header("Location: $login_link");
     exit;
 }
 
//include correct header
if (isset($_SESSION['user_id']) and $_SESSION['role'] == "patient") {
  include $header_my_page_patient;
} elseif (isset($_SESSION['user_id']) and $_SESSION['role'] == "caregiver") {
  include $header_my_page_caregiver;
} else {
  include $header;
}

$patientID = $_SESSION['user_id'];

// Variables for notifications
$refill_check;
$saved_check;

// Prepare SQL statement
$sql = "SELECT
    NotificationsSaved, 
    NotificationsRefill
FROM
    Patient
WHERE
    PatientID = ?"; 

$stmt = $db->prepare($sql);
$stmt->bind_param("s", $patientID);
$stmt->execute();

$stmt->bind_result($saved_check, $refill_check );

// Fetch the data
$stmt->fetch();

// Close the statement
$stmt->close();
?>

 <body>

 <h1> Settings </h1>
 
 <div class = "bodydiv">
   <fieldset id="GFG">
   <legend> Notifications: </legend>

    <form id = "update" action="../../processing/Notification/notification_change.php" method="POST">
        <input type="hidden" name="refill_note" value="0">
        <input type="checkbox" name="refill_note" value="1" <?php if ($refill_check == 1) echo 'checked'; ?>>
        <label for="refill_note"> I want to receive emails on upcoming vaccine doses </label><br><br>
        <input type="hidden" name="saved_note" value="0" >
        <input type="checkbox" name="saved_note" value="1" <?php if($saved_check == 1) echo 'checked'; ?>>
        <label for="saved_note"> I want to receive emails on my saved vaccines once a month </label><br><br>

        <input type="submit" value="Save">
    </form>
    
    <?php
    if (isset($_GET['changed'])) {
    echo "Your notification settings has been changed!";
    }
    ?>

</fieldset>

<!-- DELETE ACCOUNT -->

<fieldset >
<legend>Delete account: </legend>
<?php 
if (isset($_SESSION['user_id']) and $_SESSION['role'] == "patient") {
  ?>
  <body id="GFG">
  <button id="deleteBtn">Delete Account</button>
  <div id="confirmationMessage" style="display: none;">
      <p>Are you sure you want to delete your account?</p>
      <button id="confirmYes">Yes</button>
      <button id="confirmNo">No</button>
  </div>

  <div id="resultMessage"></div>

  <script>
      var confirmationMessage = document.getElementById("confirmationMessage");
      var resultMessage = document.getElementById("resultMessage");

      // If delete button is pressed it will display the confirmation message
      document.getElementById("deleteBtn").addEventListener("click", function() {
          confirmationMessage.style.display = "block";
      });

      // if the yes button of the confirmation is pressed it will send a request to backend
      document.getElementById("confirmYes").addEventListener("click", function() {
          // Send a request to the backend PHP script to delete the account
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "<?php echo $delete_account ?>", true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function() {
              if (xhr.readyState === 4) {
                  if (xhr.status === 200) {
                      // Account deleted successfully
                      resultMessage.innerHTML = xhr.responseText;
                  } else {
                      // Error deleting account
                      resultMessage.innerHTML = "Error deleting account: " + xhr.responseText;
                  }
              }
          };
          xhr.send();

          // Hide the confirmation message after processing the user's choice
          confirmationMessage.style.display = "none";
      });

      document.getElementById("confirmNo").addEventListener("click", function() {
          // If the user clicks "No," hide the confirmation message
          confirmationMessage.style.display = "none";
      });
  </script>
  </div>
</body>

<?php } ?>

</fieldset>
</div>

</div>

</body>

</body>



<?php 
 include $footer;
 ?>
</html>
