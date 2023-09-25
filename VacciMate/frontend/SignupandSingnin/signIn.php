<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>SignIn</title>
</head>

<body>
<header>
    <div class= "topheader">
        <a id = "GFG" class="vaccimateLogo" href = "http://localhost:8888/frontend/homepage/frontpage.php"> &#128137 VacciMate </a>
        <div class= "rightpart_topheader">
            <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Home </a>
            <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Register </a>
            <a id = "GFG" href = "http://localhost:8888/frontend/Settings/Settings_Page.php" class="costumbutton1"> &#9881 </a>
        </div>
    </div>

    <div class= "bottomheader">
        <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> Travel information </a>
        <a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="costumbutton2"> Search Vaccine </a>
        <a id = "GFG" href = "http://localhost:8888/frontend/About_Us/About_Us.php" class="costumbutton2"> About Us </a>
    </div>
    <nav>

    </nav>
</header>

<main>

    <div class="loginbox">
        <h1>Login</h1>
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
        </form>

    </div>

</main>

<footer>

</footer>

</body>


</html>