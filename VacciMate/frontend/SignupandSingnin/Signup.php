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
<header>
  <div class= "topheader">
    <?php
     echo '<a id="GFG" class="vaccimateLogo" href="' . $homepage_link . '">&#128137 VacciMate</a>';
    ?>
    
    <div class= "rightpart_topheader">
    <?php
     echo '<a id="GFG" href="' . $login_link . '" class="costumbutton1">Login</a>';
     echo '<a id="GFG" href="' . $register_link . '"  class="costumbutton1">Register</a>';
     echo '<a id="GFG" href="' . $setting_link . '" class="costumbutton1">&#9881</a>';
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

<main>

    <div class="loginbox">
        <h1>SignUp</h1>

        <!-- User Registration Form -->


        <div id="administratorForm" style="display:none;">
            <!-- Administrator Form Elements -->
            <h2>Administrator</h2>
            <form action="http://localhost/MagicBunny/VacciMate/processing/healthcareprovider_registration.php" method="POST">
                <label for="ID">ID:</label>
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
                <select id="options" name="options">
                    <option value="option1">akademiska sjukhuset</option>
                    <option value="option2">Ersta sjukhus</option>
                    <option value="option3">Skånes universitetssjukhus Malmö</option>
                    <option value="option4">Gothenburg Health</option>
                </select>
                <br>
                <input type="submit" name="register" value="Register">
            </form>
        </div>

        <div id="clientForm">
            <!-- Client Form Elements -->
            <h2>Client</h2>
            <form action="http://localhost/MagicBunny/VacciMate/processing/patient_registration.php" method="POST">
                <label for="ID">ID:</label>
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
                <input type="submit" name="register" value="Register">
            </form>
        </div>

        <div class="formbtn">
        <button onclick="showAdministratorForm()">Administrator</button>
        <button onclick="showClientForm()">Client</button>
        </div>

    </div>

</main>

<footer>

</footer>

</body>


</html>