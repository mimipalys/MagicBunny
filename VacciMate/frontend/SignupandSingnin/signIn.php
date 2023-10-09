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
$pageTitle = 'SignIn Page';
include('/Applications/XAMPP/xamppfiles/htdocs/MagicBunny/VacciMate/frontend/elements/header/header.php'); ?>

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
        <form action="../../processing/login.php" method="POST">
            <div id="k">
            <label for="loginUsername">Username:</label>
            <input type="text" id="loginUsername" name="ID" required>
            </div>
            <div id="k">
            <label for="loginPassword">Password:</label>
            <input type="password" id="loginPassword" name="password" required>
            </div>
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
                    <label for="loginUsername">Personnumer:</label>
                    <input type="text" id="loginUsername" name="ID" required>
                </div>
                <div id="k">
                    <label for="loginPassword">Password:</label>
                    <input type="password" id="loginPassword" name="password" required>
                </div>
                <div id="submit" >
                    <input type="submit" name="login" value="Login">
                </div>
                <a href="#">forgot password</a>
            </form>
        </div>

        <div class="formbtn">
            <button onclick="showAdministratorForm()">Administrator</button>
            <button onclick="showClientForm()">Client</button>
        </div>

    </div>

</main>

<?php
$pageTitle = 'SignIn Page';
include('/Applications/XAMPP/xamppfiles/htdocs/MagicBunny/VacciMate/frontend/elements/footer/footer.php'); ?>

</body>


</html>