<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Front Page :D </title>
</head>
<body>
    <h1>Front Page :D</h1>

    <!-- User Registration Form -->
    <h2>Create new account</h2>
    <form action="patient_registration.php" method="POST">
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

    <!-- User Registration Form -->
    <h2>Create new caregiver account</h2>
    <form action="healthcareprovider_registration.php" method="POST">
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
        <label for="clinicID">Clinic ID:</label>
        <input type="int" id="clinicID" name="clinicID" required>
        <br>
        <input type="submit" name="register" value="Register">
    </form>

    <!-- User Login Form -->
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label for="loginUsername">Username:</label>
        <input type="text" id="loginUsername" name="ID" required>
        <br>
        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="password" required>
        <br>
        <input type="submit" name="login" value="Login">
    </form>

        <!-- caregiver Login Form -->
        <h2>Login</h2>
    <form action="login_caregiver.php" method="POST">
        <label for="loginUsername">Username:</label>
        <input type="text" id="loginUsername" name="ID" required>
        <br>
        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="password" required>
        <br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
