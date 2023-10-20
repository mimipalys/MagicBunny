<!DOCTYPE html>
<html>
<?php
  include('../links.php');
?>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" type="text/css" href="../borderstyle.css">
    <title>SignIn</title>

    <script>
        function showAdministratorForm() {
            document.getElementById('clientForm').style.display = 'none';
            document.getElementById('administratorForm').style.display = 'block';
        }

        function showClientForm() {
            document.getElementById('administratorForm').style.display = 'none';
            document.getElementById('clientForm').style.display = 'block';
        }
    </script>

<script>
    function showPopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "block";
    }

    function closePopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "none";
    }

    function closePopup_message() {
        var popup_message = document.getElementById("popup_message");
        popup_message.style.display = "none";
    }
    function showParagraph() {
    var paragraph = document.getElementById("myParagraph");
    paragraph.style.display = "block"; // Set the display property to "block" to make it visible
}

    

    function resetPassword() {
        var email = document.getElementById('email_to_send').value;
        if (!email) {
            var paragraph = document.getElementById("myParagraph");
            paragraph.style.display = "block"; 
        return;
        }

        

        // Call your AJAX function to reset the password here
        $.ajax({
        url: 'http://localhost:8888/processing/Pasword_reset/Send_token.php', // Replace with the correct path to your PHP script
        method: 'POST', // Use POST or GET based on your script's requirements
        data: {
            email: email // Pass the email data to the PHP script
        },
        success: function(response) {
            // Handle the response from the PHP script here
            // This could be a success message or any other data returned by the script
            // var err_message = document.getElementById('message_of_pop');

            // Update the content of the paragraph
            // err_message.textContent = response;

            // alert('Request successful: ' + response);

            
        },

        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX Error: ' + status + ' - ' + error);
        }
    });

    
        var popup_message = document.getElementById("popup_message");
        popup_message.style.display = "Block";

    }
</script>

</head>

<body>
<?php 
session_start();

//include correct header
if (isset($_SESSION['user_id']) and $_SESSION['role'] == "patient") {
  include $header_logged_in_patient;
} elseif (isset($_SESSION['user_id']) and $_SESSION['role'] == "caregiver") {
  include $header_logged_in_caregiver;
} else {
  include $header;
}


?>
<main>
    <div class="bottomheader">
        <?php
        echo '<h1>Sgin-In</h1>
        <br>
        <p>Please fill out the relevant information</p>';
        // echo '<a id="GFG"  href="' . $homepage_link . '"> <img src="' . $logo_img3 . '" alt="test_pic"> </a>';
        ?>
    </div>

    <div class="registervaccinecontainer">

      <!-- only if a GET value changed is passed with the URL-->
      <?php
        if (isset($_GET['changed'])) {
        echo "<br> Please login before viewing your account settings";
        }
      ?>
        <div id="administratorForm" style="display:none;">
            <h1>Administrator</h1>
            <br>
        <form action="../../processing/login_caregiver.php" method="POST">
            <div id="k">
            <label class="register-vaccine-label" for="loginUsername">Employee ID:</label>
            <input class="register-vaccine-input" type="text" id="loginUsername" name="ID" required>
            </div>
            <div id="k">
            <label class="register-vaccine-label" for="loginPassword">Password:</label>
            <input class="register-vaccine-input" type="password" id="loginPassword" name="password" required>
            </div>


                <label class="register-vaccine-label" for="clinicID">Clinic:</label>
                <select class="register-vaccine-input" id="clinicID" name="clinicID">
                    <option value="1">Stadsvårdkliniken</option>
                    <option value="2">Hälsocentralen</option>
                    <option value="3">Eklundskliniken</option>
                    <option value="4">Björnskliniken</option>
                    <option value="5">Cedar Vårdcentral</option>
                </select>
            <br>
            <br>
            <div>
            <input class="register-vaccine-button" type="submit" name="login" value="Login">

            <button class="register-vaccine-button" onclick="showPopup()">Forgot password</button>
            </div>
        </form>

        </div>

        <div id="clientForm">
            <h1>Client</h1>
            <br>
            <form action="../../processing/login.php" method="POST">
                <div id="k">
                    <label class="register-vaccine-label" for="loginUsername">Social Security Number:</label>
                    <input class="register-vaccine-input" type="text" id="loginUsername" name="ID" required>
                </div>
                <div id="k">
                    <label class="register-vaccine-label" for="loginPassword">Password:</label>
                    <input class="register-vaccine-input" type="password" id="loginPassword" name="password" required>
                </div>
                <div id="formbtn" >
                    <input class="register-vaccine-button" type="submit" name="login" value="Login">
                    <button class="register-vaccine-button" onclick="showPopup()">Forgot password</button>
                </div>
            </form>

            <div id="popup" class="popup">
                <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <h2>Forgot Password</h2>
                <p>Enter your email address to reset your password:</p>
                <input id="email_to_send" type="email" placeholder="Email" name="email">
                <p id="myParagraph" style="display: none; color: red;">Please enter the email adress connected to your account</p>
                <button class= "linkLogin" id="resetButton" onclick="resetPassword()">Reset Password</button>
                </div>
            </div>
        </div>

        <div class="formbtn">

            <div id="popup_message" class="popup">
                <div class="popup-content">
                <span class="close" onclick="closePopup_message();closePopup();">&times;</span>
                <h2>Forgot Password?</h2>
                <p id = "message_of_pop"> If an existing email was provided, a link to reset you password will have been end to your email</p>
                </div>
            </div>

        <div class="formbtn">

            <button class="register-vaccine-button2" onclick="showAdministratorForm()">Administrator</button>
            <button class="register-vaccine-button2" onclick="showClientForm()">Client</button>
        </div>

        

    </div>

</main>

</body>
<?php 
 include $footer;
 ?>

<style>


.linkLogin{
    background-color: rgb(198, 25, 51);
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 25px;
    text-decoration: none;
    margin-bottom: 20px; /* Adjust the margin-bottom value as needed */
}

.linkLogin:hover {
  /*background-color: rgb(198, 25, 51);  Button background color on hover */
  border: 2px solid #0056b3; /* Border color on hover 
  /*color: white; Text color on hover */
  background-color: rgb(198, 25, 51);
}
/* Style the popup container */
.popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
}

.error-paragraph{
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
}

/* Style the popup content */
.popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

/* Style the close button (x) */
.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}

/* Center the popup content vertically and horizontally */
.popup-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

</style>

</html>