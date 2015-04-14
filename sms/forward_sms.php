<?php
    require_once 'plivo.php';
    
    // Sender's phone numer
    $from_number = $_REQUEST["From"];

    // Receiver's phone number - Plivo number
    $to_number = $_REQUEST["To"];

    // The SMS text message which was received
    $text = $_REQUEST["Text"];

    // Output the text which was received, you could
    // also store the text in a database.
    echo("Message received from $from_number : $text");

    // The phone number to which the SMS has to be forwarded
    $to_forward = '3333333333'   

    $params = array(
            'src' => $to_number, 
            'dst' => $to_forward,
        );

    $body = $text;

    // Generate a Message XML with the details of
    // the reply to be sent.
    $r = new Response();
    $r->addMessage($body, $params);

    Header('Content-type: text/xml');
    echo($r->toXML());
    
?>

<!--
Sample Output
Message received from 3333333333 : Hello, from Plivo
<Response>
    <Message dst="1111111111" src="2222222222" type="sms">Hello, from Plivo</Message>
</Response>

-->