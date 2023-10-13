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
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="borderstyle.css">
    <title>Register Vaccine Dose</title>
</head>

    <style>
        .chart-container {
            width: 60%; /* Adjust the width as needed */
            float: left;
        }
        .content {

            width: 30%; /* Adjust the width as needed */
            float: right;
            background-color: #ffffff;
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

//create drop down menue to choose whichi vaccine to look at. 
echo '<h1>View vaccine side effects statistics</h1>';
echo '<form method="post">';
echo '<label for="viewSelector">Select Vaccie:</label>';
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



if (isset($_POST['selectedType'])) {
  $graph_type = $_POST['selectedType'];
} else {
  $graph_type = 'bar';
}


// code for extracting the data 

$sql_statistics = "SELECT * FROM feedback";
$result_statics = $link->query($sql_statistics);

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
echo '<h1> Additional side effects </h1>';
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
    <canvas id="myChart"></canvas>
  </div>


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
</html>


