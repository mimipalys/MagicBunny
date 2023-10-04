<?php
// Start the session (if not already started)
session_start();

unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['role']);
// Destroy the session
session_destroy();

// Redirect to the index page or any other desired location
header("Location: ../frontend/homepage/frontpage.php"); // Replace "index.php" with your actual index page URL
exit; // Ensure that no code is executed after the redirect
?>
