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
        `NotificationsEmail`,
        `NotificationsPhone`,
        `MinimumGap`,
        `MaximumGap`,
        `VaccineName`
    FROM `Patient`
    JOIN `VaccineDose` ON Patient.PatientID = VaccineDose.PatientID
    JOIN `VaccineSchedule` ON VaccineDose.VaccineID = VaccineSchedule.VaccineID
    JOIN `Vaccine` ON VaccineDose.VaccineID = Vaccine.VaccineID
    WHERE NotificationsEmail = 1 OR NotificationsPhone = 1
) AS subquery
WHERE DATE_ADD(AdministrationDate, INTERVAL MinimumGap DAY) = DATE_ADD('2022-01-01', INTERVAL 30 DAY)";
// use row below for real implementation!!
// WHERE DATE_ADD(AdministrationDate, INTERVAL MinimumGap DAY) = DATE_ADD(CURDATE(), INTERVAL 30 DAY)";

$result = $db->query($sql_specific_rows);

// For each row in specific query if NotificationsEmail= 1 --> send email to MailAddress if NotificationsPhone = 1 --> send text to phone PhoneNumber
// Assuming you have executed your SQL query and fetched the results into $result.
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['NotificationsEmail'] == 1) {
        echo "To implement, sennding a notification to: " . str_replace(['"',"'"], "", $row['MailAddress']). " ";
        
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
            $mail->addAddress('VacciMate@gmail.com');   // Set receiver of email 
    
            $mail->isHTML(true);  
            $mail->Subject = 'Vaccine Reminder';
            $mail->Body    = 'Hi "' .  str_replace(['"',"'"], "", $row['Fname'] ) . '" "' .  $row['Lname'] . '" it is time for you to book take your "' .  $row['VaccineName'] . '" vaccine! Please try to do this within the next "' .  $row['MaximumGap'] . '" days!';
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








// The real deal
// $sql_specific_rows = "SELECT *
// FROM (
//     SELECT 
//         `Fname`, 
//         `Lname`, 
//         `AdministrationDate`, 
//         `MailAddress`, 
//         `PhoneNumber`, 
//         `NotificationsEmail`,
//         `NotificationsPhone`,
//         `MinimumGap`,
//         `MaximumGap`,
//         `VaccineName`
//     FROM `Patient`
//     JOIN `VaccineDose` ON Patient.PatientID = VaccineDose.PatientID
//     JOIN `VaccineSchedule` ON VaccineDose.VaccineID = VaccineSchedule.VaccineID
//     JOIN `Vaccine` ON VaccineDose.VaccineID = Vaccine.VaccineID
//     WHERE NotificationsEmail = 1 OR NotificationsPhone = 1
// ) AS subquery
// WHERE DATE_ADD(AdministrationDate, INTERVAL MinimumGap DAY) = DATE_ADD(CURDATE(), INTERVAL 30 DAY)";


?>


