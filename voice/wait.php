<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    $app->map('/basic_wait', function() use ($app) {

        $res = new \Slim\Http\Response();

        $r = new Response();

        // Add Speak tag
        $body = "I will wait for 10 seconds";
        $r->addSpeak($body);

        // Add Wait tag
        $params = array(
            'length' => '10' # Time to wait in seconds
          );  

        $r->addWait($params);

        // Add Speak tag
        $body1 = "I just waited 10 seconds";
        $r->addSpeak($body1);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('basic_wait')->via('GET', 'POST');

/*
Sample Wait XML
 <Response>
    <Speak>I will wait for 10 seconds</Speak>
    <Wait length="10" />
    <Speak>I just waited 10 seconds</Speak>
</Response>
*/

    $app->map('/delayed_wait', function() use ($app) {

        $res = new \Slim\Http\Response();

        $r = new Response();

        // Add Wait tag
        $params = array(
            'length' => '10' # Time to wait in seconds
          );  

        $r->addWait($params);

        // Add Speak tag
        $body = "Hello";
        $r->addSpeak($body);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('delayed_wait')->via('GET', 'POST');

/* 
Sample Wait XML
<Response>
    <Wait length="10" />
    <Speak>Hello</Speak>
</Response>
*/

    $app->map('/beep_det', function() use ($app) {

        $res = new \Slim\Http\Response();

        $r = new Response();

        // Add Wait tag
        $params = array(
            'length' => '10', # Time to wait in seconds
            'beep' =>'true' # Used to detect a voice mail machine.
          );  

        $r->addWait($params);

        // Add Speak tag
        $body = "Hello";
        $r->addSpeak($body);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('beep_det')->via('GET', 'POST');

    $app->run();
/*
Sample Wait XML
<Response>
    <Wait length="10" beep="true" />
    <Speak>Hello</Speak>
</Response>
*/