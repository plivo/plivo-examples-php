<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    $app->map('/call_transfer', function() use ($app) {
        $res = new \Slim\Http\Response();

        $r = new Response(); 

        //Add Speak tag
        $body = "Please wait while your call is being transferred";

        $r->addSpeak($body);

        // Add Redirect tag
        $redirect = "https://glacial-harbor-8656.herokuapp.com/testing.php/connect";

        $r->addRedirect($redirect);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('call_transfer')->via('GET', 'POST');

    $app->map('/connect', function() use ($app) {
        $res = new \Slim\Http\Response();

        $r = new Response(); 

        // Add Speak tag
        $body = "Connecting your call..";
        $attributes = array(
          'action' => "https://morning-ocean-4669.herokuapp.com/dial_status/", # Redirect to this URL after leaving Dial. 
          'method' => "GET", # Submit to action URL using GET or POST.
          'redirect' => "true" # If set to false, do not redirect to action URL. The call will be controlled based on the XML returned from the action URL.
        );

        $r->addSpeak($body);

        // Add Dial tag
        $d = $r->addDial($attributes);
        $number = "919663489033";
        $d->addNumber($number);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('connect')->via('GET', 'POST');

    $app->run();
/*
Sample Output
<Response>
    <Speak>Please wait while your call is being transferred</Speak>
    <Redirect>
        https://glacial-harbor-8656.herokuapp.com/testing.php/connect
    </Redirect>
</Response>

<Response>
    <Speak>Connecting your call..</Speak>
    <Dial action="https://morning-ocean-4669.herokuapp.com/dial_status/" method="GET" redirect="true">
        <Number>919663489033</Number>
    </Dial>
</Response>
*/