<!DOCTYPE html>
<html>
<?php
  include('../links.php');
?>
<head>
    <link rel="stylesheet" type="text/css" href="login.css">
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

    function resetPassword() {
        var email = document.getElementById('email_to_send').value;

        if (!email) {
            console.error('Email address is required.');
            return;
        }

        // Call your AJAX function to reset the password here
        // ...

        // Close the popup after processing the password reset
        closePopup();
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


    <div class="loginbox">

      <!-- only if a GET value changed is passed with the URL-->
      <?php
        if (isset($_GET['changed'])) {
        echo "<br> Please login before viewing your account settings";
        }
      ?>
        <h1>Login</h1>
        <div id="administratorForm" style="display:none;">
            <h2>Administrator</h2>
        <form action="../../processing/login_caregiver.php" method="POST">
            <div id="k">
            <label for="loginUsername">Employee ID:</label>
            <input type="text" id="loginUsername" name="ID" required>
            </div>
            <div id="k">
            <label for="loginPassword">Password:</label>
            <input type="password" id="loginPassword" name="password" required>
            </div>
                <label for="clinicID">Clinic:</label>
                <select id="clinicID" name="clinicID">
                    <option value="1">Stadsvårdkliniken</option>
                    <option value="2">Hälsocentralen</option>
                    <option value="3">Eklundskliniken</option>
                    <option value="4">Björnskliniken</option>
                    <option value="5">Cedar Vårdcentral</option>
                </select>
            <br>
            <br>
            <div id="submit" >
            <input type="submit" name="login" value="Login">
            <button onclick="showPopup()">Forgot password</button>
            </div>
        </form>

        </div>

        <div id="clientForm">
            <h2>Client</h2>
            <form action="../../processing/login.php" method="POST">
                <div id="k">
                    <label for="loginUsername">Social Security Number:</label>
                    <input type="text" id="loginUsername" name="ID" required>
                </div>
                <div id="k">
                    <label for="loginPassword">Password:</label>
                    <input type="password" id="loginPassword" name="password" required>
                </div>
                <div id="formbtn" >
                    <input type="submit" name="login" value="Login">
                    <button onclick="showPopup()">Forgot password</button>
                </div>
            </form>

            <div id="popup" class="popup">
                <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <h2>Forgot Password</h2>
                <p>Enter your email address to reset your password:</p>
                <input id="email_to_send" type="email" placeholder="Email">
                <button onclick="resetPassword()">Reset Password</button>
                </div>
            </div>
            <div class="formbtn">
            <button onclick="showAdministratorForm()">Administrator</button>
            <button onclick="showClientForm()">Client</button>
            </div>
        </div>

        

    </div>

</main>

</body>
<?php 
 include $footer;
 ?>

<style>
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