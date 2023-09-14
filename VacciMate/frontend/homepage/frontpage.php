
<!DOCTYPE html>
<html>

<head>
<style>
body {
  background-color: white;
}

#container {
  width: 100%;
  Height: 10px;
  border: none
            /*Making the container a flexbox*/
  display: flex;
            /*Making equal spaced divs*/
  justify-content: space-between;
  background-color: powderblue;
}


.div1 {
  align-items: center;
  background-color: powderblue;
  margin: auto;
  padding: 1rem 1rem;
  text-align: center;
  width: 100%;
  Height: 10px;
  display: flex;
  justify-content: space-between;
}

.div2{
  align-items: center;
  background-color: #89B3C4;
  margin: auto;
  padding: 1rem 1rem;
  text-align: center;
  width: 100%;
  Height: 40px;
  display: flex;
  justify-content: space-between;
}


.divInf {
  align-items: center;
  background-color: #7697B6;
  margin: auto;
  padding: 1rem 1rem;
  text-align: center;
  margin: 18px ; 
  width: 400px;
  Height: 500px;
  float: left;
}

.divBody {
  display: flex;
  justify-content: space-between;
}

.costumbutton1 {
text-align: center;
float: left;
background-color: powderblue;
border: none;
padding: auto;
font-size: 20px;
cursor: pointer;
border-radius: 10px;
margin-right: 80px; 
margin-left: 80px; /* Add some spacing between buttons */
}
.costumbutton2 {
text-align: center;
float: left;
background-color: #89B3C4;
border: none;
padding: auto;
font-size: 40px;
cursor: pointer;
border-radius: 10px;
margin-right: 80px; 
margin-left: 80px; /* Add some spacing between buttons */
}



.vaccimateLogo {
  text-align: center;
  float: left;
  background-color: #powderblue;
  border: none;
  padding: auto;
  font-size: 30px;
  margin-right: 80px; 
  margin-left: 80px; /* Add some spacing between buttons */
  font-size: 40px; 
  color: black; 
  font-family: Copperplate;
}

.container > div {
    display: inline-block;
    display: -moz-inline-box;
    *display: inline; /* For IE7 */
    zoom: 1; /* Trigger hasLayout */
    width: 33%;
    text-align: center;
}

   /* Change button style on hover */
.costumbutton1:hover {
  background-color: blue;
}
.costumbutton2:hover {
  background-color: blue;
}

.divInf:hover {
  background-color: blue;
}

</style>
 <link rel="stylesheet" type="text/css" href="/Users/erikaelisabet/VacciMate/MagicBunny/VacciMate/frontend/homepage/boarderstyle.css">
 <title>
          Using display: flex and 
          justify-content: space-between
 </title>
</head>





<body>
 <header>
  <div class= "div1">
    <a class="vaccimateLogo"> &#128137 VacciMate </a> 
    <a href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Login </a> 
    <a href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Register </a> 
    <a href = "http://localhost:8888/processing/index.php" class="costumbutton1"> &#9881 </a> 
  </div>

  <div class= "div2">
    <a href = "http://localhost:8888/processing/index.php" class="costumbutton2"> Travel information </a> 
    <a href = "http://localhost:8888/processing/index.php" class="costumbutton2"> Search Vaccine </a> 
    <a href = "http://localhost:8888/processing/index.php" class="costumbutton2"> About Us </a> 
  </div>

  <nav>


   </nav>


 </header>

 <body>
  <div class = "divBody">
   <a href = "http://localhost:8888/processing/index.php" class = "divInf">
     <h2> Did you remember to take your refill dose of the TBE vaccine? </h2>
     <p> Read everything about the TBE vaccine here and stay safe during the hot summer months </p>
     <h1> Insert picture here</h1>
    </a>
   <a href = "http://localhost:8888/processing/index.php" class = "divInf">
     <h2> Some exiting news on the progress of the new influensa vaccine</h2>
     <p> Some cool text introduction to the subject here </p>
     <h1> Insert picture here </h1>
    </a>
   <a href = "http://localhost:8888/processing/index.php" class = "divInf">
     <h2> Traveling to Kenya this winter?</h2>
     <p> Get all the information you need about vacciens needed in the area!</p>
     <img src="test_image.jpg" alt="test_pic">
   </a>
  </div>

 </body>

</body>
</html>