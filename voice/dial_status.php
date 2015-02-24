<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    $app->map('/speak', function() use ($app) {
        $res = new \Slim\Http\Response();

        $r = new Response(); 

        // Add Speak tag
        $body = "Connecting your call..";
        $r->addSpeak($body);

        $params = array(
            'action' => 'https://glacial-harbor-8656.herokuapp.com/testing.php/dial_status', # Redirect to this URL after leaving Dial. 
            'method' => 'GET' # Submit to action URL using GET or POST.
        );

        // Add Dial tag
        $d = $r->addDial($params);
        $number = "1111111111";
        $d->addNumber($number);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('speak')->via('GET', 'POST');

    $app->map('/dial_status', function() use ($app) {

        // Print the Dial Details
        $status = $_REQUEST['DialStatus'];
        $aleg = $_REQUEST['DialALegUUID'];
        $bleg = $_REQUEST['DialBLegUUID'];
        echo "Status = $status , Aleg UUID = $aleg , Bleg UUID = $bleg";

    })->name('dial_status')->via('GET', 'POST');

    $app->run();

/*
Sample Output
<Response>
    <Speak>Connecting your call..</Speak>
    <Dial action="https://glacial-harbor-8656.herokuapp.com/testing.php/dial_status" method="GET">
        <Number>1111111111</Number>
    </Dial>
</Response>

Status = completed , Aleg UUID = 36100ddc-aed6-11e4-98c9-075c56ad58a0 , Bleg UUID = 38098730-aed6-11e4-9915-075c56ad58a0
*/