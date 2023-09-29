<?php session_start();
?>

<!DOCTYPE html>
<html>

<head>

  <link rel="stylesheet" type="text/css" href="borderstyle.css">
  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>

<body>
<header>
  <div class= "topheader">
    <a id = "GFG" class="vaccimateLogo" href = "http://localhost/Page_layout_Patient.php"> &#128137 VacciMate </a> 
    <div class= "rightpart_topheader">
     <a id = "GFG" href = "http://localhost/frontend/My_Page/Patient/view_vaccine_history.php" class="costumbutton1"> My Pages </a>
     <a id = "GFG" href = "../SignupandSingnin/signUp.php" class="costumbutton1"> Logout </a>
     <a id = "GFG" href = "http://localhost:8888/frontend/Settings/Settings_Page.php" class="costumbutton1"> &#9881 </a> 
    </div>
  </div>


  <div class= "bottomheader">
    <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> Travel information </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="costumbutton2"> Search Vaccine </a> 
    <a id = "GFG" href = "http://localhost:8888/frontend/Non_connected_pages/About_Us/About_Us.php" class="costumbutton2"> About Us </a> 
  </div>

 </header>

 <body>
  <div class = "bodydiv">
   <a id = "GFG" href = "http://localhost:8888/frontend/Non_connected_pages/News/TBE.php" class = "newscolumns">
     <h2> Did you remember to take your refill dose of the TBE vaccine? </h2>
     <p> Read everything about the TBE vaccine here and stay safe during the hot summer months </p>
     <img src=" data:image/jpeg;base64,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
    " alt="test_pic">
   </a>
   <a id = "GFG" href = "http://localhost:8888/frontend/Non_connected_pages/News/influenza.php" class = "newscolumns">
     <h2> Some exiting news on the progress of the new influenza vaccine</h2>
     <p> Some cool text introduction to the subject here </p>
     <img src="https://media.istockphoto.com/id/826699900/vector/womans-hand-preventing-man-from-sneezing.jpg?s=612x612&w=0&k=20&c=KjaIIGfNoLwMZmCMf5AXEgVs3e8DFqefoajRocEwWmA=" alt="test_pic">
     
    </a>
   <a id = "GFG" href = "http://localhost:8888/frontend/Non_connected_pages/News/kenya.php" class = "newscolumns">
     <h2> Traveling to Kenya this winter?</h2>
     <p> Get all the information you need about vacciens needed in the area!</p>
     <img src="https://www.thesafaricollection.com/wp-content/uploads/2022/07/The-Safari-Collection-Hey-You-Giraffe-Manor-1.jpg" alt="test_pic">
   </a>
  </div>

 </body>

</body>
</html>