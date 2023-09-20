<?php
// Frontend for viewing your vaccine history
// display  vaccine doses and refills when that button is pressed, display shcedules when that button is pressed
// have if-statement to check
session_start();
echo "frontend: ";
echo $_SESSION['user_id'];
echo $_SERVER["DOCUMENT_ROOT"]
?>


<!DOCTYPE html>
<html>

<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" type="text/css" href="borderstyle.css">
  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>

<body>
 <header>
  <div class= "topheader">
    <a class="vaccimateLogo"> &#128137 VacciMate </a> 
    <div class= "rightpart_topheader">
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Login </a> 
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> Register </a> 
     <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton1"> &#9881 </a> 
    </div>
  </div>

  <div class= "bottomheader">
    <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> My Doses and Refills </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="costumbutton2"> View Active Dose Schedules </a> 
    <a id = "GFG" href = "http://localhost:8888/processing/index.php" class="costumbutton2"> About Us </a> 
  </div>

  <div class="newscolumns">
        <h1>Vaccine Dose Information</h1>
        <?php // index.php 
        // include $_SERVER["DOCUMENT_ROOT"] . "/processing/get_vaccine_doses.php"; ?>
  </div>

  <!-- Create a div to display the data -->
  <div id="dataDisplay"></div>
  <!-- JavaScript code -->
  <script>
    $(document).ready(function() {
        // Function to fetch data from PHP using AJAX and display it on the web page
        function fetchDataAndDisplay() {
            $.ajax({
                url: "/processing/send_data.php", // PHP file that generates the data
                method: 'GET',       // HTTP method 
                dataType: 'json',    // Expected data type
                success: function(response) {
                    // Display the data on the web page
                    var dataDisplayElement = $('#dataDisplay');
                    dataDisplayElement.empty(); // Clear any previous content
                    dataDisplayElement.append('<p>Name: ' + response.name + '</p>');
                    dataDisplayElement.append('<p>Email: ' + response.email + '</p>');
                    dataDisplayElement.append('<p>Age: ' + response.age + '</p>');
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error('AJAX Error: ' + status + ' - ' + error);
                }
            });
        }

        // Call the fetchDataAndDisplay function when the page loads
        fetchDataAndDisplay();
    });
  </script>
  

  <!-- Create a div to display the data -->
  <div id="vaccinedoses"></div>
  <!-- JavaScript code -->
  <script>
  $(document).ready(function() {
    // Function to fetch data from PHP using AJAX and display it on the web page
    function fetchDataAndDisplay() {
      $.ajax({
        url: "/processing/get_vaccine_doses.php", // PHP file that generates the data
        method: 'GET',                 // HTTP method 
        dataType: 'json',             // Expected data type
        success: function(response) {
          // Display the data on the web page
          var dataDisplayElement = $('#dataDisplay');
          dataDisplayElement.empty(); // Clear any previous content

          if (response.vaccineNames.length === 0) {
    // Display "empty" on the web page
    var dataDisplayElement = $('#dataDisplay');
    dataDisplayElement.html("empty");
}

          // Loop through the vaccine names and display them
          $.each(response.vaccineNames, function(index, vaccineName) {
            dataDisplayElement.append('<p>Vaccine Name: ' + vaccineName + '</p>');
          });
        },
        error: function(xhr, status, error) {
          // Handle errors here
          console.error('AJAX Error: ' + status + ' - ' + error);
        }
      });
    }

    // Call the fetchDataAndDisplay function when the page loads
    fetchDataAndDisplay();
  });
</script>


</body>
</html>
