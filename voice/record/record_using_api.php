<?php
require 'vendor/autoload.php';

use Plivo\Response;

$r = new Response();

$getdigits_action_url = "https://example.com/recording_action.php";
$params = array(
    'action' => $getdigits_action_url, # The URL to which the digits are sent.
    'method' => 'GET', # Submit to action URL using GET or POST.
    'timeout' => '7', # Time in seconds to wait to receive the first digit.
    'numDigits' =>  '1', # Maximum number of digits to be processed in the current operation. 
    'retries' => '1', # Indicates the number of retries the user is allowed to input the digits
    'redirect' => 'false' # Redirect to action URL if true. If false,only request the URL and continue to next element.
);

$getDigits = $r->addGetDigits($params);

$getDigits->addSpeak("Press 1 to record this call");

$waitparam = array(
    'length' => '10'
);

$r->addWait($waitparam);

Header('Content-type: text/xml');
echo ($r->toXML());
?>

<!--recording_action.php-->

<?php

require 'vendor/autoload.php';
use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;


$digit = $_REQUEST['Digits'];
$uuid = $_REQUEST['CallUUID'];
print("Digit : $digit");
print("Call UUID : $uuid");


if ($digit == "1") {
    $client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

    try {
        $response = $client->calls->startRecording(
            $uuid # ID of the call
        );
        print_r("URL : {$response->url}");
        print_r("Recording ID : {$response->recordingId}");
        print_r("API ID : {$response->apiId}");
        print_r("Message : {$response->message}");
    } catch (PlivoRestException $ex) {
        print_r($ex);
    }
} else {
    print("invalid");
}

/*
Sample Output
<Response>
    <GetDigits action="https://glacial-harbor-8656.herokuapp.com/testing.php/recording_action" method="GET" timeout="7" numDigits="1" retries="1" redirect="false">
        <Speak>Press 1 to record this call</Speak>
    </GetDigits>
    <Wait length="10"/>
</Response>

Digit : 1
Call UUID : fa69df24-bc0e-11e4-abe7-1da51d64770b

Recording ID : 0039c1c6-bc0f-11e4-a1f8-0026b958a9e2
API ID : 0027f360-bc0f-11e4-9107-22000afaaa90
Message : call recording started
URL : https://s3.amazonaws.com/recordings_2013/0039c1c6-bc12f-11e4-a1f8-0026b958a9e2.mp3
*/
