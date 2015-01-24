<?php

    use GuzzleHttp\Client;
    require 'vendor/autoload.php';
    $app = new \Slim\Slim();
    
    $app->map('/receive_sms', function () use ($app) {
        // Sender's phone numer
        $from_number = $_REQUEST["From"];

        // Receiver's phone number - Plivo number
        $to_number = $_REQUEST["To"];

        // The SMS text message which was received
        $text = $_REQUEST["Text"];

        // Output the text which was received, you could
        // also store the text in a database.
        echo("Message received from $from_number : $text");
    }
?>

<!--
Message received from 3333333333 : Hello, from Plivo
-->