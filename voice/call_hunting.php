<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app->map('/call_hunting', function() use ($app) {
        $res = new \Slim\Http\Response();

        // Simultaneous dialing is useful when there are SIP users and numbers that you want to dial. 
        // The first call that connects will cancel all other tries.

        $r = new Response(); 

        // Add Dial tag
        $d = $r->addDial();

        // Add Number tag
        $number1 = "1111111111";
        $d->addNumber($number1);
        $number2 = "2222222222";
        $d->addNumber($number1);
        $user1 = "sip:abcd1234@phone.plivo.com";
        $d->addUser($user1);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('speak')->via('GET', 'POST');

    $app->run();

/*
Sample Output
<Response>
    <Dial>
        <Number>1111111111</Number>
        <Number>2222222222</Number>
        <User>sip:abcd1234@phone.plivo.com</User>
    </Dial>
</Response>
*/