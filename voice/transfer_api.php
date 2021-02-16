<?php
require 'vendor/autoload.php';

use Plivo\Response;
use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

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
echo ($r->toXML());
?>

<!-- transfer_action.php -->

<?php
require 'vendor/autoload.php';

$digit = $_REQUEST['Digits'];
$call_uuid = $_REQUEST['CallUUID'];

error_log($digit);
error_log($call_uuid);
if ($digit == "1") {
    try {
        $response = $client->calls->transfer(
            'eba53b9e-8fbd-45c1-9444-696d2172fbc8', # ID of the call
            [
                'legs' => 'aleg', # Specify leg of the call.
                'aleg_url' => 'http://ALEG.URL' # URL to transfer for aleg.
            ]
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
<?xml version="1.0" encoding="UTF-8"?>
<Response>
   <GetDigits action="https://example.com/transfer_action.php" method="GET" numDigits="1" redirect="false" retries="1" timeout="7">
      <Speak>Press 1 to transfer this call</Speak>
   </GetDigits>
   <Wait length="10" />
</Response>

Call UUID is : e66aa1a0-9587-11e4-9d37-c15e0b562efe 
Digit pressed is : 1

(
    [_message] => transfer executed
    [apiId] => b30d1359-7040-11eb-9c7a-0242ac110006
    [statusCode] => 202
)

<?xml version="1.0" encoding="UTF-8"?>
<Response>
   <Speak>Connecting your call..</Speak>
   <Dial>
      <Number>1111111111</Number>
   </Dial>
</Response>
    */