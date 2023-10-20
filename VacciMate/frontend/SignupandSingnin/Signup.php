<!DOCTYPE html>
<html>
<?php
  include('../links.php');
?>
<head>
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
        echo '<h1>Sign-Up</h1>
        <br>
        <p>Please fill out the relevant information</p>';
        // echo '<a id="GFG"  href="' . $homepage_link . '"> <img src="' . $logo_img3 . '" alt="test_pic"> </a>';
        ?>
    </div>

    <div class="registervaccinecontainer">


        <!-- User Registration Form -->


        <div id="administratorForm" style="display:none;">
            <!-- Administrator Form Elements -->
            <h1>Administrator</h1>
            <br>
            <form action= "<?php echo $register_caregiver; ?>" method="POST">
                <label class="register-vaccine-label" for="Employee ID">ID:</label>
                <input class="register-vaccine-input" type="int" id="ID" name="ID" required>
                <br>
                <label class="register-vaccine-label" for="password">Password:</label>
                <input class="register-vaccine-input" type="password" id="password" name="password" required>
                <br>
                <label class="register-vaccine-label" for="fname">First Name:</label>
                <input class="register-vaccine-input" type="text" id="fname" name="fname" required>
                <br>
                <label class="register-vaccine-label" for="lname">Last Name:</label>
                <input class="register-vaccine-input" type="text" id="lname" name="lname" required>
                <br>
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
                <input type="checkbox" id="privacy" name="privacy" value="gdpr">
                <label for="privacy"> I accept the privacy and policy <a style="color: rgb(198, 25, 51);" href="http://localhost:8888/frontend/Non_connected_pages/About_Us/privacy_policy.php"style="color: black; font-weight: bold; text-decoration: none;"> Click here to view Privacy Policy</a> </label><br>
                <br>
                <input class="register-vaccine-button" type="submit" name="register" value="Register">
            </form>
        </div>

        <div id="clientForm">
            <!-- Client Form Elements -->
            <h1>Client</h1>
            <br>
            <form action="<?php echo $register_patient; ?>" method="POST">
                <label class="register-vaccine-label" for="ID">Social Security Number:</label>
                <input class="register-vaccine-input" type="int" id="ID" name="ID" required>
                <br>
                <label class="register-vaccine-label" for="password">Password:</label>
                <input class="register-vaccine-input" type="password" id="password" name="password" required>
                <br>
                <label class="register-vaccine-label" for="fname">First Name:</label>
                <input class="register-vaccine-input" type="text" id="fname" name="fname" required>
                <br>
                <label class="register-vaccine-label" for="lname">Last Name:</label>
                <input class="register-vaccine-input" type="text" id="lname" name="lname" required>
                <br>
                <label class="register-vaccine-label" for="bday">Date of Birth:</label>
                <input class="register-vaccine-input" type="date" id="bday" name="bday">
                <br>
                <label class="register-vaccine-label" for="mail">Email Address:</label>
                <input class="register-vaccine-input" type="email" id="mail" name="mail">
                <br>
                <label class="register-vaccine-label" for="phone">Phone Number:</label>
                <input class="register-vaccine-input" type="text" id="phone" name="phone">
                <br>
                <label class="register-vaccine-label" for="address">Address:</label>
                <input class="register-vaccine-input" type="text" id="address" name="address">
                <br>
                <input type="checkbox" id="privacy" name="privacy" value="gdpr">
                <label for="privacy"> I accept the privacy and policy <a style="color: rgb(198, 25, 51);" href="http://localhost:8888/frontend/Non_connected_pages/About_Us/privacy_policy.php"style="color: black; font-weight: bold; text-decoration: none;"> Click here to view Privacy Policy</a> </label><br>
                <br>
                <input class="register-vaccine-button" type="submit" name="register" value="Register">
            </form>
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
</html>