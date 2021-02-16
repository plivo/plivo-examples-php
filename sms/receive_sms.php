<?php
    require 'vendor/autoload.php';
    // Sender's phone numer
    $from_number = $_REQUEST["From"];
    // Receiver's phone number - Plivo number
    $to_number = $_REQUEST["To"];
    // The SMS text message which was received
    $text = $_REQUEST["Text"];
    // Prints the message
    echo("Message received - From $from_number, To: $to_number, Text: $text");
?>

<!--
Sample Output
Message received - From 3333333333, To: 1111111111,  Text: Hello, from Plivo
-->