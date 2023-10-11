<!DOCTYPE html>
<html>
<?php
    session_start();
    include('../frontend/links.php');
?>


<head>

  <link rel="stylesheet" type="text/css" href="../frontend/borderstyle.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:8888/processing/search_vaccine_page.css">
  <title>
          Using display: flex and 
          justify-content: space-between
  </title>
</head>

<?php 

//include correct header
if (isset($_SESSION['user_id']) and $_SESSION['role'] == "patient") {
  include $header_logged_in_patient;
} elseif (isset($_SESSION['user_id']) and $_SESSION['role'] == "caregiver") {
  include $header_logged_in_caregiver;
} else {
  include $header;
}



?>
</html>


<!DOCTYPE html>
<html>
<style>
        .Vaccine_title {
            text-align: center;
            font-size: 30px;
            color: #333;
            margin-top: 50px;
        }
        
        /* Styles for the destination description */
        .vaccine_text {
            text-align: center;
            font-size: 30px;
            color: #666;
            margin-top: 10px;
            word-wrap: break-word; /* Allow automatic line wrapping */
        }

        .search-form {
        text-align: center;
        margin-top: 20px;
        }

        .search-form input[type="text"] {
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        }

        .search-form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        }

        /* Style for the description initially hidden */
        .search_vaccine {
            text-align: center;
            font-size: 20px; 
            border-radius:20px;
            border: none;
            padding: auto;
        }
        .vaccinerecord1 {
            background-color: #ffb38a;
            margin: auto;
            padding: 20px;
            text-align: left;
            margin: 20px;
            width: 100%;
            height: auto; /* Adjust height to "auto" to accommodate dynamic content */
            float: left;
        }
        div.parent {
	        text-align: center;
	    }
        ul { 
	        display: inline-block; 
	        text-align: left; 
	    }


        .list_of_vaccine {
            text-align: center;
            font-size: 20px; 
        }
        /* Style for the button */
        .show-description-button1 {
            cursor: pointer;
        }

        /* Style for the checkbox */
        .show-description-checkbox {
            display: none;
        }

        /* When the checkbox is checked, show the hidden description */
        .show-description-checkbox:checked + .vaccine_description1 {
            display: block;
            text-align: left;
            align-items: right;
        }

        .show-all-button {
            text-align: center;
            cursor: pointer;
            border: groove;
            padding: auto;
            align-items: right;
            font-size: 20px;
            cursor: pointer;
            border-radius: 10px;
            margin: auto; /* Add some spacing between buttons */
            display: block
        }
        /* styles of the vaccinename buttons that are clickable to view the description*/
        .show-description-button {
        text-align: left;
        border: none;
        padding: auto;
        align-items: right;
        font-size: 20px;
        cursor: pointer;
        border-radius: 10px;
        margin: auto; /* Add some spacing between buttons */
        display: block
        }
    

        /* styles of the vaccine descriptions in seach vaccine*/

        .vaccine_description1 {
        display: none;
        align-items: center;
        background-color: #ffffff;
        margin: auto;
        padding: 1rem 1rem;
        text-align: right;
        margin: 20px ; 
        width: 700px;
        Height: auto;
        border-radius:20px;
        }

        .save_vaccine_button input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;   

        }
</style>



<link rel="stylesheet" type="text/css" href="http://localhost:8888/processing/search_vaccine_page.css">
<header>
    <section class="search_vaccine_page">   
        <div  class = "search-form">
            <form action="search_vaccine.php" method="GET">
            <input class="search_vaccine" type="text" name="search_query" placeholder="Vaccine Name or Disease..." >
            <input class = "search-form" type="submit" value="Search">
            </form>
        </div>
        <h1 class = "Vaccine_title">Vaccine Information</h1>   
        <p class = "vaccine_text"> Search for Vaccine or disease to find information or click vaccine name to read description</p>    


        <?php
        // Database connection parameters
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

        //check if there is a search query 

        if (isset($_GET['search_query'])) {

            // get the search query from the form
            $searchQuery = "%" . $_GET['search_query'] . "%"; 

            // Build the SQL query for search query
            $sql = "SELECT VaccineID, VaccineName, Description, RelatedDisease FROM Vaccine WHERE VaccineName LIKE ?";

            $stmt = $link->prepare($sql);
            $stmt->bind_param("s", $searchQuery);
            $result = $stmt->execute();
            $result = $stmt->get_result();            
            $stmt->close();
            // Create button that takes you back
            echo '<div  class = "show-all-button">';
            echo '<a id = "GFG" href = "http://localhost:8888/processing/search_vaccine.php" class="show-all-button"> Show all vaccines</a>';
            echo '</div>';

        }   else {
            // Build the SQL query for all vaccines in DB
            $sql = "SELECT VaccineID, VaccineName, Description, RelatedDisease FROM Vaccine";
            $result = $link->query($sql);
        }
    

      
        // check if session
        if (isset($_SESSION['user_id'])) {
            // If session: extract vaccine information about patient
            //Build sql query
            $patientID = $_SESSION['user_id'];
            $sql2 = "SELECT DISTINCT
            V.VaccineName
            FROM
            Vaccine V
            JOIN 
            VaccineDose AS VD ON V.VaccineID = VD.VaccineID
            WHERE VD.PatientID = ?";
            $stmt = $link->prepare($sql2);
            $stmt->bind_param("s", $patientID);
            $result2 = $stmt->execute();
            $result2 = $stmt->get_result();            
        
            // create list of all the users vaccines, used to check if they are vaccinated of not
            $Vaccine_list_patient = array();
            while($row2 = $result2 ->fetch_assoc()){
                array_push($Vaccine_list_patient, $row2['VaccineName']);   
            }
            $stmt->close();

            //create a list of all the patients saved vaccines
            $Saved_vaccine_list = array();

            //Build sql query
            $sql_find_saved = "SELECT VaccineID FROM SavedVaccine WHERE PatientID = ?";
            $stmt = $link->prepare($sql_find_saved);
            $stmt->bind_param("s", $patientID);
            $result_saved = $stmt->execute();
            $result_saved = $stmt->get_result();  
            $stmt->close();  
            while($row_saved = $result_saved ->fetch_assoc()){
                array_push($Saved_vaccine_list, $row_saved['VaccineID']);   
            }

            echo '<div class=parent>';
                echo '<ul>';
                echo '<section class = vaccinerecord1>';
                    // create everything that is shown on the page for each vaccine
                    while($row = $result->fetch_assoc()) {
                        //Check if the vaccine is saved
                        // check if the vaccine is in the list of the users vaccine
                        if(in_array($row['VaccineName'], $Vaccine_list_patient)){
                            $already_vaccinated = "You have this vaccine";
                        } elseif (in_array($row['VaccineID'], $Saved_vaccine_list)) { 
                            $already_vaccinated = "You have saved this vaccine";    
                        } else{
                            $already_vaccinated = "You dont have this vaccine click here to add to saved vaccines";
                        }

                        echo '<div>';
                        //create the label for the vaccine name that is also a cliclable button
                        echo '<label for="show-description-' . $row['VaccineName'] . '" class="show-description-button">' . $row['VaccineName'] . '</label>';
                        echo '<input type="checkbox" id="show-description-' . $row['VaccineName'] . '" class="show-description-checkbox">';

                        //Create the collapseble information box
                        echo '<section class ="vaccine_description1">';
                        echo '<p>' . "Vaccine Name: " .  $row['VaccineName']  . "<br><br>". "Related Disease: " . $row['RelatedDisease']."<br><br>". "Description: " .$row['Description'] ."<br><br>". $already_vaccinated .'</p>';
                        
                        // echo '<p class="vaccine_description1">'. "Vaccine Name: ".  $row['VaccineName']  ."<br><br>". "Related Disease: " . $row['RelatedDisease']."<br><br>". "Description: " .$row['Description'] ."<br><br>". $already_vaccinated. '</p>';
                        

                        //Create a button to save vaccine
                        if ($already_vaccinated == "You dont have this vaccine click here to add to saved vaccines"){
                            echo '<form action="search_vaccine.php" method="post">';
                            echo '<input type="submit" name='.$row['VaccineID'].' class="button" value="Save this vaccine" />';
                            echo '</form>';
                        }

                        echo '</section>';
                        echo '</div>';

                        //If the button is clicked add the infomration in the database 

                        if(isset($_POST[$row['VaccineID']])) { 
                            $VacID = $row['VaccineID'];
                            $sql_save = "INSERT INTO SavedVaccine (PatientID, VaccineID) VALUES (?, ?)";
                            $stmt = $link->prepare($sql_save);
                            $stmt->bind_param("si", $patientID, $VacID);
                            $result_save = $stmt->execute();
                            $result_save = $stmt->get_result();
                            $stmt->close();   
                        }


                        //check if patient is vaccinated or already saved this vaccin

                    }    
                } else {
                    while($row = $result->fetch_assoc()) {

                        // same thing as before but wihtout information about the person
                        echo '<div>';
                        echo '<label for="show-description-' . $row['VaccineName'] . '" class="show-description-button">' . $row['VaccineName'] . '</label>';
                        echo '<input type="checkbox" id="show-description-' . $row['VaccineName'] . '" class="show-description-checkbox">';
                        echo '<p class="vaccine_description1">'. "Vaccine Name: ".  $row['VaccineName']  ."<br><br>". "Related Disease: " . $row['RelatedDisease']."<br><br>". "Description: " .$row['Description'] . '</p>';
                        
                        echo '</div>';
                    }
                }
            echo '</section>';
            echo '</ul>';
        echo '</div>';

        // Close the database connection
        $link->close();
        
        ?>
    </section>
</body>

<?php 
 include $footer;
 ?>
</html>





