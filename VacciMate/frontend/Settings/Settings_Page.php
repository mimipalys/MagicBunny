
<!DOCTYPE html>
<html>

<?php
  include('../links.php');
  //if (!isset($_SESSION['user_id'])) {
  //header("Location: $login_link?changed=1");
  //exit;
  //}
  
?>

<head>
  <link rel="stylesheet" type="text/css" href="../borderstyle.css">
  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>

<body>
<head>

<link rel="stylesheet" type="text/css" href="../borderstyle.css">
<title>
        Using display: flex and 
        justify-content: space-between
</title>
</head>

<body>
<header>
<div class= "topheader">
  <?php
   echo '<a id="GFG" class="vaccimateLogo" href="' . $homepage_link . '">&#128137 VacciMate</a>';
  ?>
  
  <div class= "rightpart_topheader">
  <?php
   echo '<a id="GFG" href="' . $login_link . '" class="costumbutton1">Login</a>';
   echo '<a id="GFG" href="' . $register_link . '"  class="costumbutton1">Register</a>';
   echo '<p id = "GFG" class="costumbutton1_choosen"> &#9881 </p>';
  ?>
  </div>
</div>

<div class= "bottomheader">
<?php
  echo '<a id="GFG" href="' . $travel_link . '" class="costumbutton2">Travel information</a>';
  echo '<a id="GFG" href="' . $search_link . '"  class="costumbutton2">Search Vaccine</a>';
  echo '<a id="GFG" href="' . $aboutUs_link . '"  class="costumbutton2">About Us</a>';
?>
</div>

</header>

 <body>

 <h1> Settings </h1>
 
 <div class = "bodydiv">
   <fieldset>
   <legend>Notifications:</legend>
     

     <form action="../../processing/Notification/notification_change.php" method="POST">

        <input type="hidden" name="refill_note" value="0">
        <input type="checkbox" name="refill_note" value="1">
        <label for="refill_note"> I want to reccive emails on upcoming vaccine doses </label><br> <br>
        <input type="hidden" name="saved_note" value="0">
        <input type="checkbox" name="saved_note" value="1">
        <label for="saved_note"> I want to reccive emails on my saved vaccines once a month </label><br> <br>
        <input type="submit" value="Save">
    </form>

    <!-- DELETE ACCOUNT -->

<body>
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
</body>
  
    <?php

   if (isset($_GET['changed'])) {
    echo "Notification settings changed!";
}
  ?>

  </div>

 </div>

 </body>

</body>
</html>
