<?php
    require_once "plivo.php";

    $r = new Response(); 

    $getdigits_action_url = "https://example.com/transfer_action.php";
    $params = array(
        'action' => $getdigits_action_url, # The URL to which the digits are sent. 
        'method' => 'GET', # Submit to action URL using GET or POST.
        'timeout' => '7', # Time in seconds to wait to receive the first digit.
        'numDigits' =>  '1', # Maximum number of digits to be processed in the current operation. 
        'retries' => '1', # Indicates the number of retries the user is allowed to input the digits
        'redirect' => 'false' # Redirect to action URL if true. If false,only request the URL and continue to next element.
    );

    $getDigits = $r->addGetDigits($params);

    $getDigits->addSpeak("Press 1 to transfer your call");

    $waitparam = array(
        'length' => '10'
    );
    $r->addWait($waitparam);

    Header('Content-type: text/xml');
    echo($r->toXML());

?>

<!-- transfer_action.php -->

<?php

    $r = new Response(); 
    $digit = $_REQUEST['Digits'];
    $call_uuid = $_REQUEST['CallUUID'];

    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";
    error_log($digit);
    error_log($call_uuid);

    $p = new RestAPI($auth_id, $auth_token);

    if ($digit == "1"){
        $params = array(
            'call_uuid' => $call_uuid, # ID of the call
            'aleg_url' => 'https://glacial-harbor-8656.herokuapp.com/testing.php/connect', # URL to transfer for aleg
            'aleg_method' => 'GET', # Method to invoke the aleg_url
        );

        $resp = $p->transfer_call($params);
        print_r ($resp);
    }else{
        print ("WrongInput");
    }


    /*
    Sample Output
    <Response>
        <GetDigits action="http://morning-ocean-4669.herokuapp.com/transfer_action/" method="GET" numDigits="1" redirect="false" retries="1" timeout="7">
            <Speak>Press 1 to transfer this call</Speak>
        </GetDigits>
        <Wait length="10" />
    </Response>

    Call UUID is : e66aa1a0-9587-11e4-9d37-c15e0b562efe 
    Digit pressed is : 1

    (202, {
            u'call_uuids': [
                u'e66aa1a0-9587-11e4-9d37-c15e0b562efe'
            ], 
            u'message': u'transfer executed', 
            u'api_id': u'eb8c80ae-9587-11e4-b423-22000ac8a2f8'
        }
    )
    <Response>
        <Speak>Connecting your call..</Speak>
        <Dial>
            <Number>1111111111</Number>
        </Dial>
    </Response>
    */