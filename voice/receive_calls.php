<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app->map('/speak', function() use ($app) {
        
        $res = new \Slim\Http\Response();
        
        // Generate a Speak XML with the details of the text to play on the call.
        $body = 'Hi, Calling from Plivo';
        $attributes = array (
        'loop' => 2,
        );

        $r = new Response(); 

        // Add speak element
        $r->addSpeak($body,$attributes);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('speak')->via('GET', 'POST');

    $app->run();

/*
Sample Output
<Response>
    <Speak loop="2">Hi, Calling from Plivo</Speak>
</Response>
*/