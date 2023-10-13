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

header('Content-Type: text/plain');


$Mail = $_POST['email'];

// Generate a token.
$token = bin2hex(random_bytes(32)); // Use bin2hex to convert binary data to a hex string.

// Prepare the SQL statement using a parameterized query to prevent SQL injection.
$inserting_token = "UPDATE Patient
SET Token = ?, TokenTime = NOW() + INTERVAL 1 HOUR
WHERE MailAddress = ?";

$stmt = $db->prepare($inserting_token);

if ($stmt) {
    // Bind the parameters to the placeholders.
    $stmt->bind_param("ss", $token, $Mail);

    // Execute the query.
    $stmt->execute(); 

    if ($stmt->affected_rows > 0) {
        // Rows were affected, indicating a successful update.
        echo "Token updated successfully.";
    } else {
        // No rows were affected, indicating that there was no matching MailAddress in the database.
        echo "No matching Mail Address found.";
    }

    // Close the statement.
    $stmt->close();

} else {
    echo "Error preparing the statement: " . $db->error;
}


//get the email corresponding to the current session ID 

$emailQuery = "SELECT Fname, Lname, MailAddress, Token FROM Patient WHERE MailAddress = ?";
$stmt = $db->prepare($emailQuery);

if ($stmt) {
    // Bind the parameter to the placeholder.
    $stmt->bind_param("s", $Mail);

    // Execute the prepared statement.
    $stmt->execute();

    // Bind the results to variables.
    $stmt->bind_result($Fname, $Lname, $MailAddress, $Token);

    // Fetch and process the results.
    while ($stmt->fetch()) {
        // all that has same name add to list. 
        //$mailAdressToSendTo = 'VacciMate@gmail.com' ; 
        //$mailAdressToSendTo = 'erika-lindberg97@hotmail.com' ; 
        $mailAdressToSendTo = $Mail ; //the mail of the person that is supposed to get email (from DB)
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
            $mail->Body = 'Follow this link to reset you password, it will be valid for 1h. http://localhost:8888/processing/Pasword_reset/reset_PW.php?token=' . $Token . '&mail=' . $Mail . ' '; 
            // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            echo "Mail has been sent successfully according to schedule!";
        } 
        
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    $stmt->close();
}


?>