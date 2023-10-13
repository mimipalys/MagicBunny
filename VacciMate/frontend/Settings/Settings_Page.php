<!DOCTYPE html>
<html>
<<<<<<< Updated upstream
=======

<?php
  include('../links.php');
?>

>>>>>>> Stashed changes
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" type="text/css" href="../borderstyle.css">
    <?php
    include('../links.php');
    session_start();

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

    // Check if the user is logged in; if not, redirect to the signIn.php page
    if (!isset($_SESSION['user_id']) or $_SESSION['role'] != "patient") {
        header("Location: $login_link");
        exit;
    }

    $patientID = $_SESSION['user_id'];

    // Prepare SQL statement
    $sql = "SELECT NotificationsSaved, NotificationsRefill FROM Patient WHERE PatientID = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $patientID);
    $stmt->execute();
    $stmt->bind_result($saved_check, $refill_check);
    $stmt->fetch();
    $stmt->close();
    ?>
</head>
<body>
    <?php
    // Include correct header based on user role
    if (isset($_SESSION['user_id']) && $_SESSION['role'] == "patient") {
        include $header_my_page_patient;
    } elseif (isset($_SESSION['user_id']) && $_SESSION['role'] == "caregiver") {
        include $header_my_page_caregiver;
    } else {
        include $header;
    }
    ?>

    <h1>Settings</h1>

    <main>
        <div class="vaccinerecord">
            <div id="GFG">
                <h3>Notification Settings</h3>
                <form id="update" action="../../processing/Notification/notification_change.php" method="POST">
                    <input type="hidden" name="refill_note" value="0">
                    <input type="checkbox" name="refill_note" value="1" <?= $refill_check == 1 ? 'checked' : '' ?>>
                    <label for="refill_note">I want to receive emails on upcoming vaccine doses</label><br><br>
                    <input type="hidden" name="saved_note" value="0">
                    <input type="checkbox" name="saved_note" value="1" <?= $saved_check == 1 ? 'checked' : '' ?>>
                    <label for="saved_note">I want to receive emails on my saved vaccines once a month</label><br><br>
                    <input type="submit" class="register-vaccine-button" value="Save">
                </form>

                <?php
                if (isset($_GET['changed'])) {
                    echo "Your notification settings have been changed!";
                }
                ?>
               
            </div>

            <!-- DELETE ACCOUNT -->
            <div class="delete-account-container">
                <h3></h3>
                <?php 
                if (isset($_SESSION['user_id']) && $_SESSION['role'] == "patient") {
                ?>
                <button id="deleteBtn" class="register-vaccine-button">Delete Account</button>
                <div id="confirmationMessage" style="display: none;">
                    <p>Are you sure you want to delete your account?</p>
                    <button id="confirmYes">Yes</button>
                    <button id="confirmNo">No</button>
                </div>
                <div id="resultMessage"></div>

                <script>
                    var confirmationMessage = document.getElementById("confirmationMessage");
                    var resultMessage = document.getElementById("resultMessage");

                    document.getElementById("deleteBtn").addEventListener("click", function() {
                        confirmationMessage.style.display = "block";
                    });

                    document.getElementById("confirmYes").addEventListener("click", function() {
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "<?php echo $delete_account ?>", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4) {
                                if (xhr.status === 200) {
                                    resultMessage.innerHTML = xhr.responseText;
                                } else {
                                    resultMessage.innerHTML = "Error deleting account: " + xhr.responseText;
                                }
                            }
                        };
                        xhr.send();
                        confirmationMessage.style.display = "none";
                    });

                    document.getElementById("confirmNo").addEventListener("click", function() {
                        confirmationMessage.style.display = "none";
                    });
                </script>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <?php include $footer; ?>
</body>
</html>
