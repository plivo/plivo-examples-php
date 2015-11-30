<?php
    require 'vendor/autoload.php';
    use Plivo\Response;

    $r = new Response(); 

    // Add Speak tag
    $body = "Sending Digits";
    $r->addSpeak($body);

    // Add DTMF tag
    $dtmf = "12345";
    $r->addDTMF($dtmf);

    Header('Content-type: text/xml');
    echo($r->toXML());

/*
Sample Output
<Response>
    <Speak>Sending Digits</Speak>
    <DTMF>12345</DTMF>
</Response>
*/