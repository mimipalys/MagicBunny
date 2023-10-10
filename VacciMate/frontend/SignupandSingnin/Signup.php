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
        <h1>SignUp</h1>

        <!-- User Registration Form -->


        <div id="administratorForm" style="display:none;">
            <!-- Administrator Form Elements -->
            <h2>Administrator</h2>
            <form action= "<?php echo $register_caregiver; ?>" method="POST">
                <label for="Employee ID">ID:</label>
                <input type="int" id="ID" name="ID" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" required>
                <br>
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" required>
                <br>
                <label for="clinicID">Clinic:</label>
                <select id="clinicID" name="clinicID">
                    <option value="1">Stadsvårdkliniken</option>
                    <option value="2">Hälsocentralen</option>
                    <option value="3">Eklundskliniken</option>
                    <option value="4">Björnskliniken</option>
                    <option value="5">Cedar Vårdcentral</option>
                </select>

                <br>
                <input type="checkbox" id="privacy" name="privacy" value="gdpr">
                <label for="privacy"> I accept the privacy and policy<a href="#"> Click here to veiw GDPR</a></label><br>
                <br>
                <input type="submit" name="register" value="Register">
            </form>
        </div>

        <div id="clientForm">
            <!-- Client Form Elements -->
            <h2>Client</h2>
            <form action="<?php echo $register_patient; ?>" method="POST">
                <label for="ID">Social Security Number:</label>
                <input type="int" id="ID" name="ID" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" required>
                <br>
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" required>
                <br>
                <label for="bday">Date of Birth:</label>
                <input type="date" id="bday" name="bday">
                <br>
                <label for="mail">Email Address:</label>
                <input type="email" id="mail" name="mail">
                <br>
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone">
                <br>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address">
                <br>
                <input type="checkbox" id="privacy" name="privacy" value="gdpr">
                <label for="privacy"> I accept the privacy and policy <a href="http://localhost:8888/frontend/Non_connected_pages/About_Us/privacy_policy.php"style="color: black; font-weight: bold; text-decoration: none;"> Click here to view Privacy Policy</a> </label><br>
                <br>
                <input type="submit" name="register" value="Register">
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