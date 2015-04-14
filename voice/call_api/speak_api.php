<?php
    require_once "./plivo.php";

    $r = new Response(); 
    $getdigits_action_url = "https://example.com/speak_action.php";
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

    Header('Content-type: text/xml');
    echo($r->toXML());

?>

<!--speak_action.php-->

<?php
    require_once "./plivo.php";

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