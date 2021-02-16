<?php
    // Pear Mail Library
    require_once "Mail.php";

    // Sender's phone numer
    $from_number = $_REQUEST["From"];
    // Receiver's phone number - Plivo number
    $to_number = $_REQUEST["To"];
    // The text which was received on your Plivo number
    $text = $_REQUEST["Text"];
    // Print the message
    echo("Message received from $from_number: $text");
    to_email($text, $from_number);

    function to_email($text, $from_number){
        $from = 'From email address';
        $to = 'To email address';
        $subject = 'SMS from $from_number';
        $body = $text;
        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );
        $smtp = Mail::factory('smtp', array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 'Your email address',
            'password' => 'Your password'
        ));
        // Send mail
        $mail = $smtp->send($to, $headers, $body);
        if (PEAR::isError($mail)) {
            echo('<p>' . $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent!</p>');
        }
    }
?>