<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    
    $errors = array();
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }

     if (empty($subject)) {
        $errors[] = "Subject is required";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    if (empty($errors)) {
        $to = "eacunningham05@gmail.com";
        $subject = "$subject";
        $headers = "From: $email";
        
        if (mail($to, $subject, $message, $headers)) {
            echo "Thank you for contacting us!";
        } else {
            echo "Oops! Something went wrong.";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>