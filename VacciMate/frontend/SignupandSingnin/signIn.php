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
            </div>
            <a href="#">forgot password</a>
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
                <a href="#">Forget password</a>
            </form>
        </div>

        <div class="formbtn">
            <button onclick="showAdministratorForm()">Administrator</button>
            <button onclick="showClientForm()">Client</button>
        </div>

    </div>

</main>

</body>
<?php 
 include $footer;
 ?>
</html>