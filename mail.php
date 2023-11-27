<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'plugin/PHPMailer/src/Exception.php';
require 'plugin/PHPMailer/src/PHPMailer.php';

$mail = new PHPMailer(true);

try {
    //Recipients
    $mail->setFrom('responses@faux-horne-wedding.co.uk', 'NOREPLY');
    // $mail->addAddress('d.horne92@live.co.uk');
    $mail->addAddress('responses@faux-horne-wedding.co.uk');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New online RSVP';
    $mail->Body    = 'Name:'.$_POST['name'].'<br /> Phone:'.$_POST['phone'].'<br /> Message:'.$_POST['attending'].'<br />';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<script> window.location="../response.html"; </script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>