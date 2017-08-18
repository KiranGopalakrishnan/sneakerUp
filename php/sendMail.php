<?php
$to      = 'kirangplkrishnan@gmail.com';
$subject = $_POST["fullname"]." - Contact Form Submission";
$message = $_POST["message"];
$headers = "From: mailer@levels8.com \r\n" .
    'Reply-To: '.$_POST["email"] . "\r\n";

mail($to, $subject, $message, $headers);
?>