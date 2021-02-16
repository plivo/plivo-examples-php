<?php

require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

try {
    $response = $client->calls->get(
        'eba53b9e-8fbd-45c1-9444-696d2172fbc8' # Call UUID
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
} 
/* 
    Sample Output
    ( 
        [status] => 200 
        [response] => Array ( 
            [api_id] => 06b1b1cc-af5c-11e4-b153-22000abcaa64 
            [bill_duration] => 6 
            [billed_duration] => 60 
            [call_direction] => outbound 
            [call_duration] => 6 
            [call_uuid] => 6e699c0a-af55-11e4-91ce-377ffe01233f 
            [end_time] => 2015-02-08 09:43:52+04:00 
            [from_number] => +18583650866 
            [parent_call_uuid] => 
            [resource_uri] => /v1/Account/XXXXXXXXXXXXXXX/Call/6e699c0a-af55-11e4-91ce-377ffe01233f/ 
            [to_number] => 11111111111 
            [total_amount] => 0.03570 
            [total_rate] => 0.03570 
        ) 
    )
    */
