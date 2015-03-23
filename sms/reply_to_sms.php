<?php
    require_once 'plivo.php';

    use GuzzleHttp\Client;
    require 'vendor/autoload.php';
    $app = new \Slim\Slim();
    
    $app->map('/reply_to_sms', function () use ($app) {
        // Sender's phone numer
        $from_number = $_REQUEST["From"];

        // Receiver's phone number - Plivo number
        $to_number = $_REQUEST["To"];

        // The SMS text message which was received
        $text = $_REQUEST["Text"];

        // Output the text which was received, you could
        // also store the text in a database.
        echo("Message received from $from_number : $text");

        $params = array(
                'src' => $to_number, 
                'dst' => $from_number,
            );

        $body = "Thank you for your message.";

        // Generate a Message XML with the details of
        // the reply to be sent.
        $r = new Response();
        $r->addMessage($body, $params);

        echo($r->toXML());
    })->name('reply_to_sms')->via('GET','POST');

    $app->run();
?>

<!--
Sample Output
Message received from 3333333333 : Hello, from Plivo
<Response>
   <Message dst="2222222222" src="1111111111">Thank you for your message</Message>
</Response>
-->