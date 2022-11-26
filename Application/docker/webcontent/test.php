<?php

   $to = 'recipients@email-address.com';
   $subject = 'Hello from XAMPP!';
   $message = 'This is a Mailhog test';
   $headers = "From: your@email-address.com\r\n";

   if (mail($to, $subject, $message, $headers)) {
      echo "SUCCESS";
   } else {
      echo "ERROR";
}