<?php
require 'vendor/autoload.php';

use Plivo\Response;

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
echo ($r->toXML());

?>

<!--speak_action.php-->

<?php
require 'vendor/autoload.php';

use Plivo\RestAPI;

$r = new Response();
$digit = $_REQUEST['Digits'];
$call_uuid = $_REQUEST['CallUUID'];

$auth_id = "Your AUTH_ID";
$auth_token = "Your AUTH_TOKEN";

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");


if ($digit == "1") {
    try {
        $response = $client->calls->startSpeaking(
            'eba53b9e-8fbd-45c1-9444-696d2172fbc8', # call_uuid
            'Hello World' # text to speak
        );
        print_r($response);
    } catch (PlivoRestException $ex) {
        print_r($ex);
    }
} else {
    print("WrongInput");
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