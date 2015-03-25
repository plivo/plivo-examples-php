<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    $app->map('/reject_caller', function() use ($app) {

    $from_number = $_REQUEST['From'];
    $caller = array('1111111111', '2222222222', '3333333333');
    $res = new \Slim\Http\Response();
    $r = new Response();
    if (in_array($from_number, $caller))
    {
        $params = array(
            'reason' => 'rejected'
        );
        $r->addHangup($params);
    }
    else
    {
        $body = "Hello, from Plivo!";
        $r->addSpeak($body);
    }

    $res->headers->set('Content-Type', 'text/xml');
    $res->setBody($r->toXML());
    error_log($r->toXML());
    $app->response = $res;

    })->name('reject_caller')->via('GET','POST');

    $app->run();

/*
Sample output when From number is in blacklist
<Response>
    <Hangup reason="rejected"/>
</Response>

Sample Output when From number is not in blacklist
<Response>
    <Speak>Hello from Plivo</Speak>
</Response>
*/