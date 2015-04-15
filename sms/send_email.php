<?php
    // Pear Mail Library
    require_once "Mail.php";
    
    // Sender's phone numer
    $from_number = $_REQUEST["From"];

    // Receiver's phone number - Plivo number
    $to_number = $_REQUEST["To"];

    // The SMS text message which was received
    $text = $_REQUEST["Text"];

    // Output the text which was received, you could
    // also store the text in a database.
    echo("Message received from $from_number : $text");
    to_email($text);

function to_email($text){

    $from = 'From mail address';
    $to = 'To mail address';
    $subject = 'Mail Subject';
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
            'username' => 'Your mail address',
            'password' => 'Your Password'
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

<!--
Sample Output

Message received from 3333333333 : Hello, from Plivo
Message successfully sent
-->
