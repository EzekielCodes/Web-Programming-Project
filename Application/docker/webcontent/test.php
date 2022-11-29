<?php

$to = 'iamzeki40@gmail.com';
$subject = 'Hello from Neard!';
$message = 'This is a Mailhog test';
$headers = "From: your@email-address.com\r\n";
if (mail($to, $subject, $message, $headers)) {
  echo "SUCCESS";
} else {
  echo "ERROR";
}