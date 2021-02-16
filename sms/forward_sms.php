<?php
    require 'vendor/autoload.php';
    use Plivo\XML\Response;
    // Sender's phone numer
    $from_number = $_REQUEST["From"];
    // Receiver's phone number - Plivo number
    $to_number = $_REQUEST["To"];
    // The SMS text message which was received
    $text = $_REQUEST["Text"];
    // Prints the message
    echo("Message received - From $from_number, To: $to_number, Text: $text");

    // The phone number to which the SMS has to be forwarded
    $to_forward = '+14152223333';

    // send the details to generate an XML
    $response = new Response();
    $params = array(
        'src' => $to_number, //Sender's phone number
        'dst' => $to_forward, //Receiver's phone Number
        'type' => "sms",
        'callbackUrl' => "https://www.foo.com/sms_status/",
        'callbackMethod' => "POST"
    );
    $message_body = $text; //The text which was received
    $response->addMessage($message_body, $params);

    Header('Content-type: text/xml');
    echo($response->toXML()); // Returns the XML
?>
<!--
Sample Output
Message received - From:14152223333, To:2222222222, Text: Hello, from Plivo
<Response>
    <Message dst="14152223333" src="2222222222" type="sms">Hello, from Plivo</Message>
</Response>
-->