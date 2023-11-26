<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Recipients
    $mail->setFrom('d.horne92@live.co.uk', 'NOREPLY');
    // $mail->addAddress('d.horne92@live.co.uk');
    $mail->addAddress('d.horne92@live.co.uk');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New RSVP';
    $mail->Body    = 'Name:'.$_POST['name'].'<br /> Phone:'.$_POST['phone'].'<br /> RSVP:'.$_POST['attending'].'<br />';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<script> window.location="../index.html"; </script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


// if(isset($_POST['submit'])) {
//  $emailAddress = 'ex@ex.com';
//  require "class.phpmailer.php";
// $msg = 'First Name:'.$_POST['firstName'].'<br /> Last name:'.$_POST['lastName'].'<br /> Email:'.$_POST['email'].'<br />';
// move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $_FILES["uploaded_file"]["name"]);
//   $mail = new PHPMailer();
//   $mail->IsMail();

//   $mail->AddReplyTo($_POST['email'], $_POST['name']);
//   $mail->AddAddress($emailAddress);
//   $mail->SetFrom($_POST['email'], $_POST['name']);
//   $mail->Subject = "Subject";
//   $mail->MsgHTML($msg);
//   $mail->AddAttachment( $_FILES["uploaded_file"]["name"]);
//   $mail->Send();

//   echo'<script> window.location="../index.html"; </script> ';
// }
?>