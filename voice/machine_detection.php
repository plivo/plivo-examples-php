<?php

require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

try {
    $response = $client->calls->create(
        '+14151234567', # The phone number to be used as the caller id
        ['+15671234567'], # The phone numer to which the all has to be placed
        'http://s3.amazonaws.com/static.plivo.com/answer.xml', # The URL invoked by Plivo when the outbound call is answered
        'GET', # The method used to call the answer_url
        [
            'machine_detection' => "true", # Used to detect if the call has been answered by a machine. The valid values are true and hangup.
            'machine_detection_time' => "10000", # Time allotted to analyze if the call has been answered by a machine. The default value is 5000 ms.
            'machine_detection_url' => "https://example.com/testing.php/machine_detect.php", # A URL where machine detection parameters will be sent by Plivo.
            'machine_detection_method' => "GET" # Method used to invoke machine_detection_url
        ]
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

?>
<!--Sample Output
(
    [requestUuid:protected] => e4b8fc7b-af3a-4644-ad61-f78f3ebeb050
    [_message] => call fired
    [apiId] => 56e51a7e-7040-11eb-896e-0242ac110005
    [statusCode] => 201
)
-->

<!-- machine_detect.php-->

<?php

$from_number = $_REQUEST['From'];
$to_number = $_REQUEST['To'];
$machine = $_REQUEST['Machine'];
$call_uuid = $_REQUEST['CallUUID'];
$event = $_REQUEST['Event'];
$call_status = $_REQUEST['CallStatus'];
error_log("From = $from_number , To = $to_number , Machine = $machine , Call UUID = $call_uuid , Event = $event , Call Status = $call_status");
echo "From = $from_number , To = $to_number , Machine = $machine , Call UUID = $call_uuid , Event = $event , Call Status = $call_status";

?>


<!-- detect.php-->

<?php
require 'vendor/autoload.php';

use Plivo\XML\Response;

$r = new Response();

// Add Wait tag
$params = array(
    'length' => '1000',
    'silence' => 'true',
    'minSilence' => '3000'
);

$r->addWait($params);

// Add Speak tag
$body = "Hello voicemeail";
$r->addSpeak($body);

Header('Content-type: text/xml');
echo ($r->toXML());

/*
Sample Output
<Response>
    <Wait length="10" silence="true" minSilence="500"/>
    <Speak>Hello Voicemail!</Speak>
</Response>

From = 1111111111 , To = 2222222222 , Machine = true , Call UUID = fee30404-aee9-11e4-a5d9-850813b6efc3 , Event = MachineDetection , Call Status = in-progress
*/
