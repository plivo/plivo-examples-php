<?php

/**
 * Example for Call delete
 */
require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

try {
    $response = $client->calls->delete(
        'eba53b9e-8fbd-45c1-9444-696d2172fbc8' # UUID of the call to be hung up
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
Sample Output
( 
    [response] =>
)

Unsuccessful Output
(
    [message:protected] => 404
)
*/