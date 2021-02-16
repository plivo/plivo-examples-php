<?php

require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
try {
    $response = $client->calls->create(
        '+14151234567', # The phone number to be used as the caller id
        ['+15671234567<15671234891'], # The phone numer to which the all has to be placed
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
    [requestUuid:protected] => Array
        (
            [0] => 352da142-80e0-415f-8a7a-449541ea5662
            [1] => 0202521a-e713-4178-9601-e18ba99bdd65
        )

    [_message] => calls fired
    [apiId] => 278f9c47-7046-11eb-98e1-0242ac110007
    [statusCode] => 201
)
*/
