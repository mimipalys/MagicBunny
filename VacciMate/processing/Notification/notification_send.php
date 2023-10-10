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

// test with another date as todays date. 
$sql_specific_rows = "SELECT *
FROM (
    SELECT 
        `Fname`, 
        `Lname`, 
        `AdministrationDate`, 
        `MailAddress`, 
        `PhoneNumber`, 
        `NotificationsRefill`,
        `MinimumGap`,
        `MaximumGap`,
        `VaccineName`
    FROM `Patient`
    JOIN `VaccineDose` ON Patient.PatientID = VaccineDose.PatientID
    JOIN `VaccineSchedule` ON VaccineDose.VaccineID = VaccineSchedule.VaccineID
    JOIN `Vaccine` ON VaccineDose.VaccineID = Vaccine.VaccineID
    WHERE NotificationsRefill = 1
) AS subquery
WHERE DATE_ADD(AdministrationDate, INTERVAL MinimumGap DAY) = DATE_ADD('2022-01-01', INTERVAL 30 DAY)";
// use row below for real implementation!!
// WHERE DATE_ADD(AdministrationDate, INTERVAL MinimumGap DAY) = DATE_ADD(CURDATE(), INTERVAL 30 DAY)";

$result = $db->query($sql_specific_rows);

// For each row in specific query if NotificationsRefill= 1 --> send email to MailAddress if NotificationsRefill = 1 --> send text to phone PhoneNumber
// Assuming you have executed your SQL query and fetched the results into $result.
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['NotificationsRefill'] == 1) {
        $mailAdressToSendTo = 'VacciMate@gmail.com' ; 
        //$mailAdressToSendTo = 'erika-lindberg97@hotmail.com' ; 
        //$mailAdressToSendTo = $row['MailAddress'] ; //the mail of the person that is supposed to get email (from DB)
        
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
            $mail->Body    = 'Hi ' . $row['Fname'] . ' ' .  $row['Lname'] . '! <br> It is time for you to refill your ' .  $row['VaccineName'] . '! Please try to do this within the next ' .  $row['MaximumGap'] . ' days!';
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


