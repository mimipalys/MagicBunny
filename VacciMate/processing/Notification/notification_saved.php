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
        
        $mailAdressToSendTo = 'VacciMate@gmail.com' ; 
        //$mailAdressToSendTo = 'erika-lindberg97@hotmail.com' ; 
        //$mailAdressToSendTo = $row['MailAddress'] ; //the mail of the person that is supposed to get email (from DB)
        

        $original_string = $row['VaccineArray'];
        $parts = explode(',', $original_string);

        // Check if there are more than one parts
        if (count($parts) > 1) {
        // Get the last part
            $last_part = array_pop($parts);

            // Implode the array with ', ' again and add ' and ' before the last part
            $modified_string = implode(', ', $parts) . ' and ' . $last_part;
            $body_vaccine = 'Hi ' . $row['Fname'] . ' ' .  $row['Lname'] . '! <br> <br> You have saved vaccines on your account. Your saved vaccines are: ' .  $modified_string . '!<br> Please consider to book appointments for theese vaccine.' ;
        } 

        else {
            // If there's only one part, no need for 'and'
            $modified_string = $original_string;
            $body_vaccine = 'Hi ' . $row['Fname'] . ' ' .  $row['Lname'] . '! <br> <br> You have a saved vaccine on your account. Your saved vaccine is: ' .  $modified_string . '!<br> Please consider to book an appointment for this vaccine.' ;
        }

        $mail = new PHPMailer(true); 


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
            $mail->addAddress($mailAdressToSendTo);   // Set receiver of email 
    
            $mail->isHTML(true);  
            $mail->Subject = 'Vaccine Reminder';
            $mail->Body    = $body_vaccine; 
            // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            echo "Mail has been sent successfully according to schedule!";
        } 
        
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>