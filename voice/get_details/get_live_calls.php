<?php

/**
 * Example for Call get
 */

require 'vendor/autoload.php';
use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;
$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
try {
    $response = $client->calls->getLive(
        'eba53b9e-8fbd-45c1-9444-696d2172fbc8' # UUID of call to fetch live status
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Get all Live Calls
try {
    $response = $client->calls->listLive();
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

    /*
    Sample Output
    ( 
        [status] => 200 
        [response] => Array ( 
            [calls] => Array (
                [0] => a60f44dc-926f-11e4-82f5-b559cbfe39b9
                [1] => af399206-926f-11e4-8b6f-fd067af138be
            )
            [api_id] => 44abd2a4-aec7-11e4-ac1f-22000ac51de6  
        ) 
    )
    */