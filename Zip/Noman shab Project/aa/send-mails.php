<?php
// Requires the "PHPMailer" library
require_once 'PHPMailer-master/src/PHPMailer.php';
require_once 'PHPMailer-master/src/SMTP.php';
require_once 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.titan.email';
        $mail->Port = 587;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
         $mail->Username = 'sales@clique360.net';
         $mail->Password = 'Opened@000';
         $mail->SMTPSecure = 'tls';
        // Define the email address separately
        // $senderEmail = 'nomanpk@gmail.com';
        // $senderEmail = 'tax@ask-management-consultants.com';
        // Recipients
        $mail->setFrom('sales@clique360.net', 'Farhad Ahamd');
        // $mail->setFrom('sales@clique360.net', 'Aamer Sikandar');
        // $mail->addReplyTo('sales@clique360.net', 'Farhad Ahmad');
        // $mail->setFrom($senderEmail, 'Aamer Sikandar');
        // $mail->setFrom('nomanpk@gmail.com', 'Noman Ahmad');
        // $mail->setFrom('tax@ask-management-consultants.com', 'Aamer Sikandar');
        $mail->addAddress($to);
        // Add a recipient
    // $mail->addAddress('sales@clique360.net');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ownerEmail = 'hilmandshah636@gmail.com'; // Replace with the owner's email address
    // $ownerEmail = 'nomanpk@gmail.com'; // Replace with the owner's email address
    // $ownerEmail = 'tax@ask-management-consultants.com'; // Replace with the owner's email address
    $visitorEmail = $_POST['visitorEmail'];
    $subject = 'Tax Computation Result';

    // Extract values from the JSON string (assuming JSON is sent in the 'message' field)
    $postData = json_decode($_POST['message'], true);

    // Assign values to variables
    $calType = $postData['calType'];
    $aYear = $postData['aYear'];
    $cName = $postData['cName'];
    $cEmail = $postData['cEmail'];
    $cMobile = $postData['cMobile'];
    $cCompany = $postData['cCompany'];

    // Add more variables as needed

    // HTML-formatted message with placeholders
   
    // Send email to owner
    sendEmail($ownerEmail, $subject, $message);

    // Send email to visitor
    $sendResult = sendEmail($visitorEmail, $subject, $message);

    if ($sendResult === true) {
        echo 'Emails sent successfully.';
    } else {
        http_response_code(500); // Internal Server Error
        echo 'Error sending email: ' . $sendResult;
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo 'Invalid request method.';
}
?>
