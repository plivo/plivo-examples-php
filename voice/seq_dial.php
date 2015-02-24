<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    $app->map('/speak', function() use ($app) {

        $res = new \Slim\Http\Response();

        $r = new Response();

        $params = array(
        'timeout' => "20", # The duration (in seconds) for which the called party has to be given a ring.
        'action'=> "https://glacial-harbor-8656.herokuapp.com/testing.php/dial_status/" # Redirect to this URL after leaving Dial.
        );

        // Add Dial tag
        $d = $r->addDial($params);
        $number1 = "1111111111";
        $d->addNumber($number1);

        $d = $r->addDial();
        $number2 = "1111111111";
        $d->addNumber($number2);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

        })->name('seq_dial')->via('GET', 'POST');

        $app->run();

/*
Sample Output
<Response>
    <Dial timeout="20" action="https://glacial-harbor-8656.herokuapp.com/testing.php/dial_status/">
        <Number>1111111111</Number>
    </Dial>
    <Dial>
        <Number>2222222222</Number>
    </Dial>
</Response>
*/

