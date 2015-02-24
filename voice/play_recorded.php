<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    $app->map('/speak', function() use ($app) {
        
        $res = new \Slim\Http\Response();
        
        // Generate a Play XML with the details of the audio file to play on the call.
        $body = "https://s3.amazonaws.com/plivocloud/Trumpet.mp3";

        $r = new Response(); 

        // Add Play element
        $r->addPlay($body);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('speak')->via('GET', 'POST');

    $app->run();

/*
Sample Output
<Response>
    <Play>https://s3.amazonaws.com/plivocloud/Trumpet.mp3</Play>
</Response>
*/