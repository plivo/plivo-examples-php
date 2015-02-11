<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app->map('/speak', function() use ($app) {
        $res = new \Slim\Http\Response();

        $r = new Response(); 

        $params = array(
            'dialMusic' => 'https://glacial-harbor-8656.herokuapp.com/testing.php/custom_tone' # Music to be played to the caller while the call is being connected. 
        );

        // Add Dial tag
        $d = $r->addDial($params);
        $number = "1111111111";
        $d->addNumber($number);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

        })->name('speak')->via('GET', 'POST');

    $app->map('/custom_tone', function() use ($app) {
        $res = new \Slim\Http\Response();

        $r = new Response(); 

        $body = "https://s3.amazonaws.com/plivocloud/music.mp3";

        // Add Play tag
        $r->addPlay($body);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('custom_tone')->via('GET', 'POST');

    $app->run();
    
/*
Sample Output
<Response>
    <Dial dialMusic="https://glacial-harbor-8656.herokuapp.com/testing.php/custom_tone">
        <Number>1111111111</Number>
    </Dial>
</Response>

<Response>
    <Play>https://s3.amazonaws.com/plivocloud/music.mp3</Play>
</Response>
*/