<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app->map('/speak', function() use ($app) {
        $res = new \Slim\Http\Response();
              
        // Add Speak tag
        $body = 'Connecting your call..';

        $r = new Response(); 

        // Add speak element
        $r->addSpeak($body);

        // Add Dial tag
        $number = "2222222222";
        $d = $r->addDial();
        $d->addNumber($number);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('speak')->via('GET', 'POST');

    $app->run();

/*
Sample Output
<Response>
    <Speak>Connecting your call..</Speak>
    <Dial>
        <Number>2222222222</Number>
    </Dial>
</Response>
*/