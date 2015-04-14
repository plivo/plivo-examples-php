<?php
    require_once "./plivo.php";
        
    // Generate a Speak XML with the details of the text to play on the call.
    $body = 'Hi, Calling from Plivo';
    $attributes = array (
    'loop' => 2,
    );

    $r = new Response(); 

    // Add speak element
    $r->addSpeak($body,$attributes);

    Header('Content-type: text/xml');
    echo($r->toXML());

/*
Sample Output
<Response>
    <Speak loop="2">Hi, Calling from Plivo</Speak>
</Response>
*/