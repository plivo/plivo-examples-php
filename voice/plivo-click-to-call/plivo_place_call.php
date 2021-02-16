<?php
require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
try {
    $response = $client->calls->create(
        '+14151234567',
        ['+15671234567'],
        'http://s3.amazonaws.com/static.plivo.com/answer.xml',
        'GET',
        [
            'ring_url' => 'http://WWW.RING.URL',
        ]
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}
