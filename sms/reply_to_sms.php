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

    // send the details to generate an XML
    $response = new Response();
    $params = array(
        'src' => $to_number, //Sender's phone number
        'dst' => $from_number, //Receiver's phone Number
        'type' => "sms",
        'callbackUrl' => "https://www.foo.com/sms_status/",
        'callbackMethod' => "POST"
    );
    $message_body = "Thank you, we have received your request"; //The text to be sent
    $response->addMessage($message_body, $params);

    Header('Content-type: text/xml');
    echo($response->toXML()); // Returns the XML
?>

<!--
Sample Output
Message received - From: 3333333333, To: 1111111111,  Text: Hello, from Plivo
<Response>
   <Message dst="3333333333" src="1111111111">Thank you for your message</Message>
</Response>
-->