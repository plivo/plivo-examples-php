<?php
require 'vendor/autoload.php';

use Plivo\Response;

# Set te caller ID using Dial XML

$r = new Response();

// Generate a Dial XML ans set the caller ID
$params = array(
    'callerId' => '1111111111' # Caller ID
);

$d = $r->addDial($params);
$number = '2222222222';
$d->addNumber($number);

Header('Content-type: text/xml');
echo ($r->toXML());

/*
Sample successful output
<Response>
   <Dial callerId="1111111111">
      <Number>2222222222</Number>
   </Dial>
</Response>
*/
?>

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
            'ring_url' => 'http://WWW.RING.URL',
        ]
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

/* Sample Output
(
    [requestUuid:protected] => 2d7fb6f1-76ec-42f8-a935-bde99c5fc3b0
    [_message] => call fired
    [apiId] => 75fb7714-7046-11eb-9c7a-0242ac110006
    [statusCode] => 201
)
*/
?>       