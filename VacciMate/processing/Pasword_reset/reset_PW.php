<!DOCTYPE html>
<html>

<?php
  include('../../frontend/links.php');
  if (isset($_SESSION['user_id']) and $_SESSION['role'] == "patient") {
    include $header_logged_in_patient;
  } elseif (isset($_SESSION['user_id']) and $_SESSION['role'] == "caregiver") {
    include $header_logged_in_caregiver;
  } else {
    include $header;
  }
?>

<head>
    <link rel="stylesheet" type="text/css" href="../../frontend/borderstyle.css">
    <link rel="stylesheet" type="text/css" href="../../frontend/SignupandSingnin/login.css">
    <title>Change Password</title>
    <script>
        function closepop() {
            var popup = document.getElementById("div_message");
            popup.style.display = "none";
        }
    </script>
</head>

<body>

<main>

<?php
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

if (isset($_GET['token']) && isset($_GET['mail']) && isset($_POST['NewPassword'])) {
    // Token and email received from GET
    $token = $_GET['token'];
    $email = $_GET['mail'];
    
    // New password received from POST
    $newPassword = $_POST['NewPassword'];
    $hashed_password = password_hash($newPassword, PASSWORD_BCRYPT, ["cost"=>12]);
    
    // Check if the token is valid and hasn't expired
    $sqlCheckToken = "SELECT Token, TokenTime FROM Patient WHERE MailAddress = ?";
    $stmtCheckToken = $db->prepare($sqlCheckToken);

    if ($stmtCheckToken) {
        $stmtCheckToken->bind_param("s", $email);

        if ($stmtCheckToken->execute()) {
            $stmtCheckToken->bind_result($dbToken, $dbTokenTime);
            $stmtCheckToken->fetch();

            if ($token === $dbToken && strtotime($dbTokenTime) > time()) {
                // Token is valid and hasn't expired
                $stmtCheckToken->close();

                // Update the password
                $sqlUpdatePassword = "UPDATE Patient SET Password = ? WHERE Token = ? AND MailAddress = ?";
                $stmtUpdatePassword = $db->prepare($sqlUpdatePassword);

                if ($stmtUpdatePassword) {
                    $stmtUpdatePassword->bind_param("sss", $hashed_password, $token, $email);

                    if ($stmtUpdatePassword->execute()) {
                        // Password updated successfully
                        $sqlRemoveToken = "UPDATE Patient
                        SET Token = NULL, TokenTime = NULL
                        WHERE MailAddress = ?";
                        $stmtRemoveToken = $db->prepare($sqlRemoveToken);
                        if ($stmtRemoveToken) {
                            $stmtRemoveToken->bind_param("s", $email);
                            $stmtRemoveToken->execute(); 
                        }
                        echo '<div id="div_message" class="pop">Password was changed succesfully <br><br><a class= "linkLogin" href= ' . $login_link . '>Go to Login Page</a></div>';

                    } else {
                        // Handle the case where the update failed
                        echo "Failed to update password: " . $db->error;
                    }
                    
                    $stmtUpdatePassword->close();
                } else {
                    // Handle the case where the statement preparation failed
                    echo "Error preparing SQL statement: " . $db->error;
                }
            } else {
                // Token is not valid or has expired

                //echo "<script>showPopup('" . $message . "')</script>";
                echo '<div id="div_message" class="pop">Token invalid, go back to login and resend a resett passwors link <br> <br><a class= "linkLogin" href= ' . $login_link . '>Click ME to go to Login Page</a>
                </div>';

                //echo "Token invalid, go back to login and resend a resett passwors link"; 
            }
        } else {
            echo "Error executing the query to check the token.";
        }
    } else {
        echo "Error preparing the SQL statement to check the token.";
    }
} else {
    ?> 
    <div class="loginbox">

    <div id="clientForm">
        <h2>Change Password</h2>
        <?php echo '<form action="reset_PW.php?token=' . $_GET['token'] . '&mail=' . $_GET['mail'] . '" method="POST">'; ?>
                <div id="k">
                    <label for="loginPassword">New Password:</label>
                    <input type="password" id="NewPassword" name="NewPassword" required><br>
                    <input type="submit" value="Save">
                </div>
    </div>
    

</div>
    

                <!-- <div id="formbtn" >
                    <input type="submit" name="newPW" value="Save">
                </div> -->
            </form> <?php
}


?>
</main>

<div id="token_inv" class="popup">
                <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <h2>im innn</h2>
                <p id="pop_message"></p>
                </div>
            </div>
</body>

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


.pop {
    position: fixed; 
    height: 100px; 
    width: 240px; 
    background: white; 
    left: calc(50% - 100px); 
    box-shadow: 0 0 10px black; 
    padding: 40px; 
    border-radius: 20px;
}

.close-button {
    background-color: black;
    color: white;
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 15px;
    cursor: pointer;
    position: absolute;
    left: 10px;
    top: 10px;
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


<?php 
 include $footer;
?>
</html>

