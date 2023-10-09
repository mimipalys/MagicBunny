<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="<?php echo $styles_doc ?>">

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
     <a id = "GFG" href = "http://localhost:8888/frontend/My_Page/Patient/view_vaccine_history.php" class="costumbutton1"> My Pages </a>
     <a id = "GFG" href = "<?php echo $logout ?>" class="costumbutton1"> Logout </a>
     <a id = "GFG" href = "http://localhost:8888/frontend/Settings/Settings_Page.php" class="costumbutton1"> &#9881 </a> 
    </div>
  </div>

  <div class= "bottomheader">
    <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> Travel information </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="costumbutton2"> Search Vaccine </a> 
    <a id = "GFG" href = "http://localhost:8888/frontend/Non_connected_pages/About_Us/About_Us.php" class="costumbutton2"> About Us </a> 
  </div>

 </header>

