<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/var/www/html/PHPMailer/src/Exception.php';
require '/var/www/html/PHPMailer/src/PHPMailer.php';
require '/var/www/html/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true); //Argument true in constructor enables exceptions

$mail->isSMTP();// Set mailer to use SMTP
#$mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers

$mail->Host = 'localhost';// Specify main and backup SMTP servers
$mail->SMTPDebug = 2; // to see exactly what's the issue
#$mail->Username = 'serverproject8@gmail.com';
#$mail->Password = 'ccvkkxmzjrrgcbhl'; 
# $mail->CharSet = "utf-8";// set charset to utf8
$mail->SMTPAuth = false;// Enable SMTP authentication
#$mail->SMTPSecure = 'ssl';// Enable TLS encryption, `ssl` also accepted
$mail->Port = 1025;// TCP port to connect to

$mail->setFrom('serverproject8@gmail.com');

// $mail->setFrom('info@mailtrap.io', 'Mailtrap');
// $mail->addReplyTo('info@mailtrap.io', 'Mailtrap');
$mail->addAddress('iamzeki40@gmail.com');
// $mail->addCC('cc1@example.com', 'Elena');
// $mail->addBCC('bcc1@example.com', 'Alex');

$mail->Subject = 'Test Email via Mailtrap SMTP using PHPMailer';

$mail->isHTML(true);
$mailContent = "<h1>Send HTML Email using SMTP in PHP</h1>
    <p>This is a test email I’m sending using SMTP mail server with PHPMailer.</p>";
$mail->Body = $mailContent;

if($mail->send()){
    echo 'Message has been sent';
}else{
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}