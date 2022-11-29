<?php

$to = $_POST["email"];
$subject = 'Hello from Neard!';
$message = 'This is a Mailhog test';
$headers = "From: your@email-address.com\r\n";
if (mail($to, $subject, $message, $headers)) {
  echo "SUCCESS";
} else {
  echo "ERROR";
}