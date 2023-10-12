<!DOCTYPE html>
<html>
<?php
  include('../../frontend/links.php');

?>
<head>
    <link rel="stylesheet" type="text/css" href="../../frontend/SignupandSingnin/login.css">
    <title>Change Password</title>
</head>

<body>

<main>

    

</main>

</body>

<?php 
 include $footer;
?>


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
                    $stmtUpdatePassword->bind_param("sss", $newPassword, $token, $email);

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
                        echo "Password updated successfully.";
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
                echo "Token is invalid or has expired.";
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

</html>

