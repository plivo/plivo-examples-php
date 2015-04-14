<?php
    require_once "./plivo.php";
              
    // Add Speak tag
    $body = 'Connecting your call..';

    $r = new Response(); 

    // Add speak element
    $r->addSpeak($body);

    // Add Dial tag
    $number = "2222222222";
    $d = $r->addDial();
    $d->addNumber($number);

    Header('Content-type: text/xml');
    echo($r->toXML());


/*
Sample Output
<Response>
    <Speak>Connecting your call..</Speak>
    <Dial>
        <Number>2222222222</Number>
    </Dial>
</Response>
*/