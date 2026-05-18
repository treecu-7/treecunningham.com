<?php

session_start();

function check_honeypot(){
    // check the honeypot
    if(filter_has_var(INPUT_POST, 'honeypot')){
        $honeypot = trim($_POST['honeypot']);
        if ($honeypot) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
    }
}

function send_email($from_email, $message, $subject, $recipient_email) {
    // Email header
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=utf-8';
    $headers[] = "To: $recipient_email";
    $headers[] = "From: $from_email";
    $header = implode('\r\n', $headers);

    // send email
    mail($recipient_email, $subject, $message, $header);
}


$request_method = $_SERVER['REQUEST_METHOD'];


if($request_method === 'POST') {
   
    $config = [
        'mail' => [
            'to_email' => 'eacunningham05@gmail.com'
        ]
    ];

    // check honeypot
    check_honeypot();

    // validate inputs
    [$inputs, $errors] = validate();

    if(empty($errors)) {
        // send email
        $from_email = $inputs['email'];
        $subject = $inputs['subject'];
        $message = nl2br(htmlspecialchars($inputs['message']));
        
        send_email($from_email, $message, $subject, $config['mail']['to_email']);

        // success message
        $_SESSION['success_message'] =  'Thanks for contacting us! We will be in touch with you shortly.';

    } else {

        $_SESSION['error_message'] =  'Please fix the following errors';
        $_SESSION['errors'] =   $errors;
        $_SESSION['inputs'] =   $inputs;
        
    }

    header('Location: ' . $_SERVER['PHP_SELF'], true, 303);
    exit;   
    

} 
