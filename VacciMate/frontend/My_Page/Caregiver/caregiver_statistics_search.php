<?php
// Frontend for viewing your vaccine history
// display  vaccine doses and refills when that button is pressed, display schedules when that button is pressed
// have if-statement to check
session_start();
include('../../links.php');

$caregiverID = $_SESSION['user_id'];

// Check if the user is logged in and is a caregiver; if not, redirect to the signIn.php page
if (!isset($_SESSION['user_id']) or $_SESSION['role'] != "caregiver" ) {
    header("Location: ../../SignupandSingnin/signIn.php");
    exit;
  }

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../borderstyle.css">
    <link rel="stylesheet" type="text/css" href="mypages_caregiver.css">
    <title>Register Vaccine Dose</title>
</head>

    <style>
        main{
            margin-bottom: 20%;
        }

        .chart-container {
            width: 60%; /* Adjust the width as needed */
            float: left;
        }
        .content {

            width: 30%; /* Adjust the width as needed */
            float: right;
            /* text-align: center; */
            background-color: #ffffff;
            border-radius: 20px; /* Adjust the radius as per your preference */
        }

        .content h2 {
  padding: 20px; /* Add more padding as needed */
  margin: 0; /* Remove default margin for <h1> */
        }
  .content p {
  padding: 20px; /* Add more padding as needed */
  margin: 0; /* Remove default margin for <h1> */
}
        .stats{
            margin: 2.5%;
            width: 160%;
        }

    </style>


<?php include $header_my_page_caregiver; ?>

<?php
//create an associative list with vaccine names and id 
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "VacciMate";

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbname);

// Check if connection is established
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT VaccineID, VaccineName FROM Vaccine";
$result = $link->query($sql);

//creates an associative array with Name as key and id as value
$Vaccine_list = array();

while ($row = $result -> fetch_assoc()){
  $VaccineName = $row['VaccineName'];
  $VaccineID = $row['VaccineID'];
  $Vaccine_list[$VaccineName] = $VaccineID;
}

//sorts the list alpabetically
ksort($Vaccine_list);

//creates a list for the different types of chart
$chartTypeOptions = [
  'bar' => 'Bar Chart',
  'pie' => 'Pie Chart',
];

//creates a selected variable and sets default
$selectedType = isset($_POST['selectedType']) ? $_POST['selectedType'] : 'bar'; // Default to 'bar'
?>
<div class="bottomheader">
    <?php
    echo '<h1>Statistics</h1>
        <br>
        <p>See the reported side effects by the patient</p>';
    // echo '<a id="GFG"  href="' . $homepage_link . '"> <img src="' . $logo_img3 . '" alt="test_pic"> </a>';
    ?>
</div>
<main>
<div class="stats">
<?php
//create drop down menue to choose whichi vaccine to look at. 
echo '<h1>View vaccine side effects statistics</h1>';
echo '<form method="post">';
echo '<label for="viewSelector">Select Vaccine:</label>';
echo '<select name="selectedView" id="viewSelector" onchange="this.form.submit()">';
foreach ($Vaccine_list as $Vaccine_name => $Vaccine_ID){ 
  $selected = (isset($_POST['selectedView']) && $_POST['selectedView'] == $Vaccine_ID) ? 'selected' : '';
  echo '<option value="' . $Vaccine_ID . '" ' . $selected . '>' . $Vaccine_name . '</option>';
}

//drop down menue for which type of graph
echo '</select>';
echo '<label for="typeSelector">Choose graph type:</label>';
echo '<select name="selectedType" id="typeSelector" onchange="this.form.submit()">';
foreach ($chartTypeOptions as $type => $label) {
  $selected = ($selectedType === $type) ? 'selected' : '';
  echo "<option value=\"$type\" $selected>$label</option>";
}
echo '</select>';
echo '</form>';

if (isset($_POST['selectedView'])) {
  $selected_vaccine = $_POST['selectedView'];
} else {
  $selected_vaccine = '1';
}

if (isset($_POST['selectedType'])) {
  $graph_type = $_POST['selectedType'];
} else {
  $graph_type = 'bar';
}


// code for extracting the data 

$sql_statistics = "SELECT * FROM feedback";
$result_statics = $link->query($sql_statistics);

$sql_doses = "SELECT VaccineID FROM VaccineDose";
$result_doses = $link->query($sql_doses);

$sql_vaccines = "SELECT VaccineID FROM Vaccine";
$result_vaccines = $link->query($sql_vaccines);

$vaccines_ids = array();
$sideeffect_nr = array();
while ($row1 = $result_vaccines -> fetch_assoc()){
  $vaccines_ids[$row1['VaccineID']] = 0;
  $sideeffect_nr[$row1['VaccineID']] = 0;
}

while ($row2 = $result_doses -> fetch_assoc()){
  $VacID = $row2['VaccineID'];
  $vaccines_ids[$VacID] += 1;
}


$statistics = array();

//creates an asspociative array with the name of the attribute in the database as key and the actual name as calue
$questions = array(
  'question1'=> 'Any sideeffects', 
  'question2'=> 'Severe sideeffects', 
  'question3' => 'Pain, swelling, or redness at the injection site', 
  'question4'=> 'Fever after receiving the vaccine', 
  'question5' => 'Chills or shivering',
  'question6' => 'Muscle or joint pain after vaccination',
  'question7' => 'Headache', 
  'question8'=> 'Fatigued or unusually tired?', 
  'question9'=> 'Nausea or vomiting',
  'question10' => 'Diarrhea', 
  'question11' => 'Rash or itching',
  'question12' => 'Difficulty breathing or chest pain',
  'question13' => 'Dizzy or lightheaded', 
  'question14' => 'Persistent cough',
  'question15' => 'Changes in your taste or smell'
);

//creates an statistics array and sets the number of each sideeffect to zerp
foreach ($questions as $questionnr => $question){
  $statistics[$question] = 0 ;
}

//an array for teh written text of the additional siedeffect
$written_stat = array();

//creates statistics
while ($row_statistics = $result_statics -> fetch_assoc()){
  if (isset($_POST['selectedView']) && $_POST['selectedView'] == $row_statistics['VaccineID']) {
    $sideeffect_nr[$row_statistics['VaccineID']] += 1;
    $text = $row_statistics['additional_effects'];
    array_push($written_stat, $text);
    foreach ($questions as $questionnr => $question){
      if (isset($row_statistics[$questionnr])){
        $number = (int)$row_statistics[$questionnr];
        $statistics[$question] += $number;
      }
    }

  }
}



//shows the additional statistics
echo '<div class = content>';
echo '<h2> Additional side effects </h2>';
foreach ($written_stat as $texts){
  echo '<p>' .$texts. '<br><br> </p>';
}
echo '</div>';
?>
<head>
    <title>Bar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
  <div class = chart-container>
    <?php 
    echo '<p> Out of the ' .$vaccines_ids[$selected_vaccine]. ' people that took the vaccine ' .$sideeffect_nr[$selected_vaccine].' people reported sideeffects <br><br> </p>';
    ?>
    <canvas id="myChart"></canvas>
  </div>
</div>
</main>
<script>
    // JavaScript code for creating the chart
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart;

    // Function to update the chart
    function updateChart() {
        var selectedVaccineID = document.getElementById('viewSelector').value;

        // AJAX request to fetch data from your PHP script
        // You should modify this part to fetch the data you need
        // For now, we'll use sample data
        var sampleData = {
            labels: <?php echo json_encode(array_keys($statistics)); ?>,
            values: <?php echo json_encode(array_values($statistics)); ?>
        };

        if (myChart) {
            myChart.destroy(); // Destroy the previous chart if it exists
        }

        myChart = new Chart(ctx, {
            type: '<?php echo $graph_type; ?>',
            data: {
                labels: sampleData.labels,
                datasets: [{
                    label: 'Side Effects',
                    data: sampleData.values,
                    backgroundColor: [
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)',
                      'rgba(51, 153, 51, 0.2)',
                      'rgba(102, 102, 255, 0.2)',
                      'rgba(255, 0, 0, 0.2)',
                      'rgba(0, 255, 0, 0.2)',
                      'rgba(0, 0, 255, 0.2)',
                      'rgba(128, 0, 128, 0.2)',
                      'rgba(128, 128, 0, 0.2)',
                      'rgba(0, 128, 128, 0.2)',
                      'rgba(0, 128, 0, 0.2)',
                    ],
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 1
                }]
            }
        });
    }

    // Initially, call the updateChart function to display the chart
    updateChart();
</script>

<?php
include $footer;
?>
</html>


