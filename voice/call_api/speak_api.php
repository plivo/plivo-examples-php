<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app->map('/speak_api', function() use ($app) {
        $res = new \Slim\Http\Response();
        $r = new Response(); 
        $getdigits_action_url = "https://glacial-harbor-8656.herokuapp.com/testing.php/speak_action";
        $params = array(
            'action' => $getdigits_action_url,
            'method' => 'GET',
            'timeout' => '7',
            'numDigits' =>  '1',
            'retries' => '1',
            'redirect' => 'false'
        );

        $getDigits = $r->addGetDigits($params);

        $getDigits->addSpeak("Press 1 to listen to a message");

        $waitparam = array(
            'length' => '10'
        );
        $r->addWait($waitparam);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('speak_api')->via('GET','POST');

    $app->map('/speak_action', function() use ($app) {
        $res = new \Slim\Http\Response();
        $r = new Response(); 
        $digit = $_REQUEST['Digits'];
        $call_uuid = $_REQUEST['CallUUID'];

        $auth_id = "Your AUTH_ID";
        $auth_token = "Your AUTH_TOKEN";

        $p = new RestAPI($auth_id, $auth_token);

        if ($digit == "1"){
            $params = array(
                'call_uuid' => $call_uuid, # ID of the call
                'text' => 'Hello from Speak API', # Text to be played.
                'voice' => 'WOMAN', # The voice to be used, can be MAN,WOMAN. Defaults to WOMAN.
                'language' => 'en-GB' # The language to be used
            );

            $resp = $p->speak($params);
            print_r ($resp);
        }else{
            print ("WrongInput");
        }
    })->name('speak_action')->via('GET','POST');

    $app->run();

/*
Sample Output
<Response>
    <GetDigits action="http://morning-ocean-4669.herokuapp.com/speak_action/" method="GET" numDigits="1" redirect="false" retries="1" timeout="7">
        <Speak>Press 1 to listen to a message</Speak>
    </GetDigits>
    <Wait length="10" />
</Response>

( 
    [status] => 202
    [response] => Array ( 
        [api_id] => 0753c6a6-958f-11e4-ac1f-22000ac51de6    
        [message] => speak started
    )
)
*/