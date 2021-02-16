<?php
    require 'vendor/autoload.php';
    // Sender's phone numer
    $from_number = $_REQUEST["From"];
    // Receiver's phone number - Plivo number
    $to_number = $_REQUEST["To"];
    // The SMS text message which was received
    $text = $_REQUEST["Text"];
    // Message UUID
    $uuid = $_REQUEST["MessageUUID"];
    // Prints the message
    echo("Message received - From: $from_number, To: $to_number, Text: $text, MessageUUID: $uuid");
    
    echo("Delivery status reported");
?>

<!--
Sample Output
Message received - From : 2222222222 To : 1111111111 Text : Hello, from Plivo MessageUUID : 53e6526a-8a7a-11e4-a77d-22000ae383ea

Note: Possible values for message status - "queued", "sent", "failed", "delivered", "undelivered" or "rejected"

Delivery status reported
-->