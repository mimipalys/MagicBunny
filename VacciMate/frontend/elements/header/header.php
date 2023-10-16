<body>

 <header>
  <div class= "topheader">
      <div class="vaccimateLogo">
      <?php
      echo ' <a id="GFG"  href="' . $homepage_link . '"> <img src="' . $logo_img . '" alt="test_pic"> </a>';
      ?>
      </div>
      <nav class="navy">

    <?php
     echo '<a  href="' . $login_link . '" class="costumbutton1">Login</a>';
     echo '<a  href="' . $register_link . '"  class="costumbutton1">Register</a>';
     echo '<a  href="' . $aboutUs_link . '"  class="costumbutton1">About Us</a>';
    echo '<a href="' . $travel_link . '" class="costumbutton1">Travel Information</a>';
    echo '<a  href="' . $search_link . '"  class="costumbutton1">Vaccine Information</a>';
    ?>
      </nav>
  </div>

<div class="bottomheader">
    <?php
    echo '<h1>VacciMate</h1>
        <br>
        <p>A new, and improved Way of tracking vaccines </p>';
    // echo ' <a id="GFG"  href="' . $homepage_link . '"> <img src="' . $logo_img1177 . '" alt="test_pic"> </a>';
    ?>
</div>



 </header>