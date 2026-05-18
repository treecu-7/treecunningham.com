<?php

session_start()

$honeypot = filter_input(INPUT_POST, 'sname', FILTER_SANITIZA_STRING);

if ($honeypot) {
    header($_SERVER['SERVER_PROTOCOL'] . '405 Method Not Allowed');
    exit;
}

$errors = [];

if (!empty($_POST)) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $subject = $_POST['subject'];
   $message = $_POST['message'];
  
   if (empty($name)) {
       $errors[] = 'Name is empty';
   }

   if (empty($email)) {
       $errors[] = 'Email is empty';
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors[] = 'Email is invalid';
   }

   if (empty($subject)) {
       $errors[] = 'Subject is empty';
   }

   if (empty($message)) {
       $errors[] = 'Message is empty';
   }
}

return ['mail' => ['to_email' => 'eacunningham05@gmail.com']];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $mailFrom = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mailTo = "eacunningham05@gmail.com";
    $headers = "From: ".$mailFrom;
    $txt = "You have received an e-mail from ".$.name.".\n\n".$message;

    mail($mailTo, $subject, $txt, $headers);
}