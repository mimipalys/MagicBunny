<?php

require 'SMTP.php';
require 'PHPMailer.php';
require 'Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Database connection details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'VacciMate';

// Create a database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// $todays_date = date('Y-m-d');

// 
$all_saved_for_all = "SELECT  Subquery.PatientID,
VaccineArray, 
`Fname`, 
`Lname`, 
`MailAddress`, 
`PhoneNumber`, 
`NotificationsEmail`,
`NotificationsPhone`
FROM (
SELECT PatientID, GROUP_CONCAT(VaccineName) AS VaccineArray
FROM SavedVaccine
INNER JOIN Vaccine ON SavedVaccine.VaccineID = Vaccine.VaccineID
GROUP BY PatientID
) AS Subquery
INNER JOIN Patient ON Patient.PatientID = Subquery.PatientID";

// use row below for real implementation!!
// WHERE DATE_ADD(AdministrationDate, INTERVAL MinimumGap DAY) = DATE_ADD(CURDATE(), INTERVAL 30 DAY)";

$result = $db->query($all_saved_for_all);

// for ever row (id with saved): 
while ($row = mysqli_fetch_assoc($result)) {
    // all that has same name add to list. 
    if ($row['NotificationsEmail'] == 1) {
        
        
        $mail = new PHPMailer(true); 

        $original_string = $row['VaccineArray'];
        $search = "";
        $replace = ", ";

        $new_string_vaccines = str_replace($search, $replace, $original_string);


        try {
            $mail->SMTPDebug = 2;                                      
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com;';                   
            $mail->SMTPAuth   = true;                            
            $mail->Username   = 'vaccimate0@gmail.com';                
            $mail->Password   = 'qeptlkkgqfcjablf';                       
            $mail->SMTPSecure = 'tls';                             
            $mail->Port       = 587; 
         
            $mail->setFrom('VacciMate@gmail.com', 'VacciMate');   // Set sender of the mail
            $mail->addAddress('VacciMate@gmail.com');   // Set receiver of email 
    
            $mail->isHTML(true);  
            $mail->Subject = 'Vaccine Reminder';
            $mail->Body    = 'Hi ' . $row['Fname'] . ' ' .  $row['Lname'] . '! <br> <br> You have saved vaccines on your account. Your saved vaccines are: ' .  $new_string_vaccines . '!<br> Maybe you would like to book a time fore theese vaccines.' ;
            // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            echo "Mail has been sent successfully according to schedule!";
        } 
        
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    if ($row['NotificationsPhone'] == 1) {
        // echo "HI Phone"; 
        // Send a text message to $row['PhoneNumber']
        // You would need to use a text messaging service or API for this
    }
}

?>


