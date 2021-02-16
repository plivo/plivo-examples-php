<?php
require 'vendor/autoload.php';

use Plivo\Response;

# Generates a Conference XML
$r = new Response();

$params = array(
    'enterSound' => "beep:1", # Used to play a sound when a member enters the conference
    'callbackUrl' => "https://example.com/conf_callback.php", # If specified, information is sent back to this URL
    'callbackMethod' => "GET" # Method used to notify callbackUrl
);

$name = "demo";
$r->addSpeak("You will now be placed into a demo conference. This is brought to you by Plivo. To know more visit us at plivo.com");
$r->addConference($name, $params);

Header('Content-type: text/xml');
echo ($r->toXML());
?>

<!--conf_callback.php-->

<?php
require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

# Record API is called in the callback URL to record the conference

$conf_name = $_REQUEST['ConferenceName'];
$event = $_REQUEST['Event'];
print("Conference Name : $conf_name");
print("Event : $event");

# The recording starts when the user enters the conference room
if ($event == "ConferenceEnter") {
    try {
        $response = $client->conferences->startRecording(
            $conf_name # Name of the conference
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
   <Speak>You will now be placed into a demo conference. This is brought to you by Plivo. To know more visit us at plivo.com</Speak>
   <Conference enterSound="beep:1" callbackUrl="https://glacial-harbor-8656.herokuapp.com/testing.php/conf_callback" callbackMethod="GET">demo</Conference>
</Response>

Recording ID : c37e5efc-bc10-11e4-81a4-0026b93d8e7c
Message : conference recording started
URL : https://s3.amazonaws.com/recordings_2013/c37e5efc-bc12-11e4-81a4-0026b93d8e7c.mp3
API ID : c37155fe-bc10-11e4-ac1f-22000ac51de6

*/