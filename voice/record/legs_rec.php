<?php
require 'vendor/autoload.php';

use Plivo\Response;

# A call is made to the plivo number. 
# The answer_url returns and XML that starts recording the session and then dials to another number.
# When the user pick up, the B Leg record starts and a music is played.

# The action URL of the Record tag will return the Session recording details

$r = new Response();

$record_params = array(
    'action' => 'https://example.com/record_action.php', # Submit the result of the record to this URL. 
    'method' => 'GET', # Submit to action url using GET or POST
    'redirect' => 'false', # If false, don't redirect to action url, only request the url and continue to next element.
    'recordSession' => 'true' # Record current call session in background 
);

$r->addRecord($record_params);

$wait_params = array(
    'length' => '5' # Time to wait in seconds
);

$r->addWait($wait_params);
$r->addSpeak("Connecting your call!");

$dial_params = array(
    'callbackUrl' => 'https://example.com/dial_outbound.php', # URL that is notified by Plivo when one of the following events occur :    called party is bridged with caller, called party hangs up, caller has pressed any digit
    'callbackMethod' => 'GET' # Method used to notify callbackUrl.
);

$number = "1111111111";
$d = $r->addDial($dial_params);
$d->addNumber($number);

Header('Content-type: text/xml');
echo ($r->toXML());
?>

<!--dial_outbound.php-->

<?php
require 'vendor/autoload.php';

use Plivo\RestAPI;

# The Callback URL of Dial will make a request to the Record API which will record only the B Leg
# Play API is invoked which will play a music only on the B Leg.

$event = $_REQUEST['Event'];
$call_uuid = $_REQUEST['DialBLegUUID'];

print("Event : $event");
print("Call UUID : $call_uuid");

if ($event == "DialAnswer") {


    $client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

    try {
        $response = $client->calls->startRecording(
            'eba53b9e-8fbd-45c1-9444-696d2172fbc8', # ID of the call 
            [
                'callback_url' => 'https://example.com/recording_callback.php', # The URL invoked by the API when the recording ends.
                'callback_method' => 'GET' # The method which is used to invoke the callback_url URL. Defaults to POST.
            ]
        );
        print_r($response);
    } catch (PlivoRestException $ex) {
        print_r($ex);
    }
    $record_params = array(
        'call_uuid' => $call_uuid,

    );

    $resp = $p->record($record_params);
    print_r("API ID : {$response->apiId}");
    print_r("Message : {$response->message}");

    try {
        $response = $client->calls->startPlaying(
            'eba53b9e-8fbd-45c1-9444-696d2172fbc8', # ID of the call
            [
                'https://s3.amazonaws.com/plivocloud/Trumpet.mp3', # A single URL or a list of comma separated URLs pointing to an mp3 or wav file.     
                'http://www.ANOTHER.ONE/SOUND.MP3'
            ]
        );
        print_r("API ID : {$response->apiId}");
        print_r("Message : {$response->message}");
    } catch (PlivoRestException $ex) {
        print_r($ex);
    }
} else {
    print("Invalid");
}
?>

<!--recording_callback.php-->

<?php
# The Callback URL of record api will return the B Leg record details.
$record_url = $_REQUEST['record_url'];
$record_duration = $_REQUEST['recording_duration'];
$record_id = $_REQUEST['recording_id'];
print("Record URL : $record_url");
print("Recording Duration : $record_duration");
print("Recording ID : $record_id");


/*
Sample Output
<Response>
   <Record action="https://glacial-harbor-8656.herokuapp.com/testing.php/record_action" method="GET" redirect="false" recordSession="true" />
   <Wait length="5" />
   <Speak>Connecting your call!</Speak>
   <Dial callbackUrl="https://glacial-harbor-8656.herokuapp.com/testing.php/dial_outbound" callbackMethod="GET">
      <Number>1111111111</Number>
   </Dial>
</Response>

Call UUID : fead401c-bc13-11e4-be69-b7d6ae170e26
Event : DialAnswer

Output of the Record API request
API ID : 050d62c0-bc14-11e4-b423-22000ac8a2f8
Message : async api spawned

Output of the Play API request
API ID : 05436366-bc14-11e4-8ccf-22000afb14f7
Message : play started

Output of Record API Callback URL
Record URL : http://s3.amazonaws.com/recordings_2013/11112222-4444-11e4-a4c8-782bcb5bb8af.mp3
Recording Duration : 22 
Recording ID : 693e61fd-8150-4091-a0f8-561d4a434288 

Output of Record XML Action URL
Record URL : http://s3.amazonaws.com/recordings_2013/55556666-7777-11e4-a4c8-782bcb5bb8af.mp3 
Recording Duration : 27 
Recording ID : daddbf04-9585-11e4-a4c8-782bcb5bb8af 

*/
