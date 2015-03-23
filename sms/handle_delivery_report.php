<?php
    use GuzzleHttp\Client;
    require 'vendor/autoload.php';
    $app = new \Slim\Slim();
    
    $app->map('/delivery_report', function () use ($app) {
        // Sender's phone numer
        $from_number = $_REQUEST["From"];

        // Receiver's phone number - Plivo number
        $to_number = $_REQUEST["To"];

        // The SMS text message which was received
        $status = $_REQUEST["Status"];

        // Message UUID
        $uuid = $_REQUEST["MessageUUID"];

        // Output the text which was received, you could
        // also store the text in a database.
        echo("From : $from_number, To : $to_number, Status : $status, Message UUID : $uuid");
    }

    $app->run();
?>

<!--
Sample Output
From : 2222222222 To : 1111111111 Status : delivered MessageUUID : 53e6526a-8a7a-11e4-a77d-22000ae383ea

Possible values for message status - "queued", "sent", "failed", "delivered", "undelivered" or "rejected"
-->