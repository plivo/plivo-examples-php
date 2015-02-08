<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app->map('/speak', function() use ($app) {
        $res = new \Slim\Http\Response();

        $r = new Response(); 

        // Add Speak tag
        $body = "Sending Digits";
        $r->addSpeak($body);

        // Add DTMF tag
        $dtmf = "12345";
        $r->addDTMF($dtmf);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('speak')->via('GET', 'POST');

/*
Sample Output
<Response>
    <Speak>Sending Digits</Speak>
    <DTMF>12345</DTMF>
</Response>
*/