<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="header.css">
    <title><?php echo $pageTitle; ?></title>
</head>

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

</html>