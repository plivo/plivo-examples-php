<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    $app->map('/greet_caller', function() use ($app) {
        $from_number = $_REQUEST['From'];
        $callers = array(
            '1111111111' => 'ABCDEF',
            '2222222222' => 'VWXYZ',
            '3333333333' => 'QWERTY'
        );
        $res = new \Slim\Http\Response();
        $r = new Response();
        error_log($callers[$from_number]);
        if (array_key_exists($from_number, $caller))
        {
            $body = "Hello {$caller[$from_number]}" ;
            $r->addSpeak($body);
        }
        else
        {
            $body = "Hello Stranger!";
            $r->addSpeak($body);
        }
        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        error_log($r->toXML());
        $app->response = $res;

    })->name('greet_caller')->via('GET','POST');

    $app->run();

/*
Sample Output
<Response>
    <Speak>Hello,ABCDEF</Speak>
</Response>
*/