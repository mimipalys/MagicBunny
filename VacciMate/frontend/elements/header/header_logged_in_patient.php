<header>
     <div class= "topheader">
         <div class="vaccimateLogo">
             <?php
             echo ' <a id="GFG"  href="' . $homepage_link . '"> <img src="' . $logo_img . '" alt="test_pic"> </a>';
             ?>
         </div>
         <nav class="navy">

             <?php
            // echo '<a  href="' . $my_page . '" class="costumbutton1">My Pages</a>';

             echo'<div class="dropdown" >
                 <a class="costumbutton1" href="#">My Pages <span class="triangle"> &#x25BC; </span> </a>
                 <div class="dropdown-content" >
                     <a href="' . $my_page . '" >My Doses and Refills</a>
                     <a  href="' . $savedvaccine_link . '"  class="costumbutton1">Saved Vaccines</a>
                 </div>
             </div>'
             ?>
             <?php
             echo '<a  href="' . $aboutUs_link . '"  class="costumbutton1">About Us</a>';
             echo '<a href="' . $travel_link . '" class="costumbutton1">Travel Information</a>';
             echo '<a  href="' . $search_link . '"  class="costumbutton1">Vaccine Information</a>';
             echo '<a  href="' . $logout . '"  class="costumbutton1">Logout</a>';
             ?>
         </nav>
     </div>

 </header>

