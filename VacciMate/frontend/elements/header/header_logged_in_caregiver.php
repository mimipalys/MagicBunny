<body>
 <header>
  <div class= "topheader">
    <a id = "GFG" class="vaccimateLogo" href = "<?php echo $homepage_link ?>"> &#128137 VacciMate </a> 
    <div class= "rightpart_topheader">
     <a id = "GFG" href = "<?php echo $my_page_caregiver ?>"  class="costumbutton1"> My Pages </a>
     <a id = "GFG" href = "<?php echo $logout ?>" class="costumbutton1"> Logout </a>
    </div>
  </div>

  <div class= "bottomheader">
  <?php
    echo '<a id="GFG" href="' . $travel_link . '" class="costumbutton2">Travel Information</a>';
    echo '<a id="GFG" href="' . $search_link . '"  class="costumbutton2">Vaccine Information</a>';
    echo '<a id="GFG" href="' . $aboutUs_link . '"  class="costumbutton2">About Us</a>';
  ?> 
  </div>

 </header>

