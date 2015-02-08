<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    # Set te caller ID using Dial XML

    $app->map('/hangup', function() use ($app) {
        $res = new \Slim\Http\Response();

        $r = new Response();

        // Generate a Dial XML ans set the caller ID
        $params = array(
                'callerId' => '1111111111' # Caller ID
            );

        $d = $r->addDial($params);
        $number = '2222222222';
        $r->addNumber($number);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('speak')->via('GET', 'POST');

    $app->run();

/*
Sample successful output
<Response>
    <Dial callerId="1111111111">
        <Number>2222222222</Number>
    </Dial>
</Response>
*/

    # Set the caller ID using Call API

    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    $params = array(
        'to' => '14155069431', # The phone numer to which the all has to be placed
        'from' => '18583650866', # The phone number to be used as the caller id
        'answer_url' => "https://glacial-harbor-8656.herokuapp.com/testing.php/detect", # The URL invoked by Plivo when the outbound call is answered
        'answer_method' => "GET", # The method used to call the answer_url
    );

    $response = $p->make_call($params);
    print_r ($response);

/* Sample Output
( 
    [status] => 201 
    [response] => Array ( 
        [api_id] => 32cba792-ae01-11e4-b153-22000abcaa64 
        [message] => call fired 
        [request_uuid] => 5b2db3d3-f478-4b63-992c-e47c527572e8 
)
*/        