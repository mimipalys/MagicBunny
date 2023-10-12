 <header>
        <div class= "topheader">
            <div class="vaccimateLogo">
                <?php
                echo ' <a id="GFG"  href="' . $homepage_link . '"> <img src="' . $logo_img . '" alt="test_pic"> </a>';
                ?>
            </div>
            <nav class="navy">

                <?php
                echo '<a  href="' . $homepage_link . '"  class="costumbutton1">Home</a>';
                echo '<a href="' . $my_page_caregiver . '" class="costumbutton1">Register Vaccine Dose</a>';
                echo '<a  href="' . $view_administered_vaccines . '"  class="costumbutton1">Administration</a>';
                echo '<a  href="' . $logout . '"  class="costumbutton1">Logout</a>';
                ?>
            </nav>
        </div>

        <div class="bottomheader">
            <?php
            echo '<h1>VacciMate</h1>
        <br>
        <p>A new, and improved Way of tracking vaccines </p>';
            echo ' <a id="GFG"  href="' . $homepage_link . '"> <img src="' . $logo_img1177 . '" alt="test_pic"> </a>';
            ?>
        </div>



    </header>