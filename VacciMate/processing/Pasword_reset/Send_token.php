<?php
chdir(dirname(__FILE__));

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


$Mail = $_POST['email'];

// generate a token. 
$token = random_bytes(32); 

// put token in database. 
$inserting_token = "UPDATE Patient
SET Token = $token, TokenTime = NOW() + INTERVAL 1 HOUR
WHERE `MailAddress` = $Mail";

$resultinsert = $db->query($inserting_token);


// get the email corresponding to the current session ID 
$emailadress = "SELECT 
`Fname`, 
`Lname`, 
`MailAddress`, 
`Token`
FROM Patient
WHERE `MailAddress` = $Mail";

$result = $db->query($emailadress);

// for ever row (id with saved): 
while ($row = mysqli_fetch_assoc($result)) {
    // all that has same name add to list. 
        //$mailAdressToSendTo = 'VacciMate@gmail.com' ; 
        //$mailAdressToSendTo = 'erika-lindberg97@hotmail.com' ; 
        $mailAdressToSendTo = $row['MailAddress'] ; //the mail of the person that is supposed to get email (from DB)
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
            $mail->Subject = 'VacciMate: Reset of password';
            $mail->Body    = 'Follow this link to reset you password, it will be valid for 1h. http://localhost:8888/processing/Pasword_reset/reset_PW.php?changed=' . $row['Token'] . '!'; 
            // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            echo "Mail has been sent successfully according to schedule!";
        } 
        
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


?>