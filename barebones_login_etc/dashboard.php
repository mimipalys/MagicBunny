<?php
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// You can retrieve user-specific data here or perform any other actions you need for the dashboard.

// Include a header for the dashboard
include("header.php"); // You can create a separate header.php file for the header content.

// Display user-specific content here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to Your Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>This is a simple example of a dashboard page.</p>
    
    <!-- You can include various dashboard content here based on your application's requirements. -->
    
    <a href="logout.php">Logout</a> <!-- Add a logout link to log the user out. -->
</body>
</html>

<?php
// Include a footer for the dashboard
include("footer.php"); // You can create a separate footer.php file for the footer content.
?>
