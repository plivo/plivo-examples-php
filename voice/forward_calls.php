<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app->map('/speak', function() use ($app) {
        $res = new \Slim\Http\Response();

        // Feth the from_number from the URL
        $from_numbr = $_REQUEST['From'];
        $r = new Response(); 

        // Add Dial tag
        $params = array(
            'callerId' => $from_numbr # Caller ID
        );

        $d = $r->addDial($params);
        $number = "919663489033";
        $d->addNumber($number);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('speak')->via('GET', 'POST');

    $app->run();

/*
Sample Output
<Response>
    <Dial callerId="1111111111">
        <Number>2222222222</Number>
    </Dial>
</Response>
*/