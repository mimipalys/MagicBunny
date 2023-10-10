<?php 
include('../links.php');
session_start();

//include correct header
include $header_logged_in_patient;

?>

<main>
 <div class="bodydiv">
    <?php
    echo '<a id="GFG" href="' . $TBE_link . '" class="newscolumns">
   
    <h2>Did you remember to take your refill dose of the TBE vaccine?</h2>
    <p>Read everything about the TBE vaccine here and stay safe during the hot summer months</p>
    <img src="' . $TBE_image . '" alt="test_pic"> </a>';
    ?>
    <?php
    echo '<a id="GFG" href="' . $influenza_link . '" class="newscolumns">
   
    <h2>Revolutionizing Healthcare: A Breakthrough Journey in Influenza Vaccine Development</h2>
    <p>Explore the future of immunity: Unraveling groundbreaking advancements in our latest influenza vaccine research..</p>
    <img src="' . $influenza_image . '" alt="test_pic"> </a>';
    ?>
   
  
   <?php
    echo '<a id="GFG" href="' . $kenya_link . '" class="newscolumns">
    <h2>Traveling to Kenya? Stay Informed!</h2>
    <p>Get all the information you need about vaccines needed in the area!</p>
    <img src="' . $kenya_image . '" alt="test_pic"> </a>';
    ?>
  </div>

 </main>

 </body>
</html>