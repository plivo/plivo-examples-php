<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app->map('/speak', function() use ($app) {
        $res = new \Slim\Http\Response();

        $r = new Response(); 

        $params = array(
            'confirmSound' => 'https://glacial-harbor-8656.herokuapp.com/testing.php/confirm_sound', 
            # A remote URL fetched with POST HTTP request which must return an XML response with Play, Wait and/or Speak elements only
            'confirmKey' => '5' # The digit to be pressed by the called party to accept the call.
        );

        // Add Dial tag
        $d = $r->addDial($params);
        $number1 = "919663489033";
        $d->addNumber($number1);
        $number2 = "919663489033";
        $d->addNumber($number1);
        $number3 = "919663489033";
        $d->addNumber($number3);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

        })->name('speak')->via('GET', 'POST');

    $app->map('/confirm_sound', function() use ($app) {
        $res = new \Slim\Http\Response();

        $r = new Response(); 

        $body = "Press 5 to answer the call";

        //Add Speak tag
        $r->addSpeak($body);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('speak')->via('GET', 'POST');

    $app->run();

/*
Sample Output
<Response>
    <Dial confirmSound=https://glacial-harbor-8656.herokuapp.com/testing.php/confirm_sound confirmKey=5>
        <Number>1111111111</Number>
        <Number>2222222222</Number>
        <User>sip:abcd1234@phone.plivo.com</User>
    </Dial>
</Response>

<Response>
    <Speak>Press 5 to answer the call</Speak>
</Response>
*/