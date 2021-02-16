<?php

require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

try {
    $response = $client->calls->list();
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

/* 
    Sample Output
    ( 
        [status] => 200 
        [response] => Array ( 
            [api_id] => 22852b7c-ae03-11e4-a2d1-22000ac5040c 
            [meta] => Array ( 
                [limit] => 20 
                [next] => /v1/Account/XXXXXXXXXXXXXXX/Call/?limit=20&offset=20 
                [offset] => 0 
                [previous] => 
                [total_count] => 124 
            ) [objects] => Array ( 
                [0] => Array ( 
                    [bill_duration] => 8 
                    [billed_duration] => 60 
                    [call_direction] => outbound 
                    [call_duration] => 8 
                    [call_uuid] => dd9b3414-adc8-11e4-aed8-377ffe01233f 
                    [end_time] => 2015-02-06 10:25:20+04:00 
                    [from_number] => 
                    [parent_call_uuid] => d66cc0a4-adc8-11e4-ac44-377ffe01233f 
                    [resource_uri] => /v1/Account/XXXXXXXXXXXXXXX/Call/dd9b3414-adc8-11e4-aed8-377ffe01233f/ 
                    [to_number] => 2222222222 
                    [total_amount] => 0.03570 
                    [total_rate] => 0.03570 
                ) [1] => Array ( 
                    [bill_duration] => 29 
                    [billed_duration] => 60 
                    [call_direction] => outbound 
                    [call_duration] => 29 
                    [call_uuid] => d66cc0a4-adc8-11e4-ac44-377ffe01233f 
                    [end_time] => 2015-02-06 10:25:20+04:00 
                    [from_number] => +1111111111 
                    [parent_call_uuid] => 
                    [resource_uri] => /v1/Account/XXXXXXXXXXXXXXX/Call/d66cc0a4-adc8-11e4-ac44-377ffe01233f/ 
                    [to_number] => 2222222222 
                    [total_amount] => 0.03570 
                    [total_rate] => 0.03570 
                )
            )
        )
    ) 
    */

// FIltering the records

try {
    $response = $client->calls->list(
        [
            'end_time__gt' => '2015-01-28 11:47', # Filter out calls according to the time of completion. gte stands for greater than or equal.
            'call_direction' => 'outbound', # Filter the results by call direction. The valid inputs are inbound and outbound
            'from_number' => '1111111111', # Filter the results by the number from where the call originated
            'to_number' => '11111111111', # Filter the results by the number to which the call was made
            'limit' => 5, # The number of results per page
            'offset' => 2 # The number of value items by which the results should be offset
        ]
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
            [api_id] => b37841c4-aec5-11e4-ac1f-22000ac51de6 
            [meta] => Array ( 
                [limit] => 2 
                [next] => /v1/Account/XXXXXXXXXXXXXXX/Call/?call_direction=outbound&to_number=2222222222&end_time__gt=2015-01-28+11%3A47&from_number=1111111111&limit=2&offset=2 
                [offset] => 0 
                [previous] => 
                [total_count] => 4 
            ) [objects] => Array ( 
                [0] => Array ( 
                    [bill_duration] => 40 
                    [billed_duration] => 60 
                    [call_direction] => outbound 
                    [call_duration] => 40 
                    [call_uuid] => db707c6c-adff-11e4-a23e-377ffe01233f 
                    [end_time] => 2015-02-06 16:59:23+04:00 
                    [from_number] => +1111111111 
                    [parent_call_uuid] => 
                    [resource_uri] => /v1/Account/XXXXXXXXXXXXXXX/Call/db707c6c-adff-11e4-a23e-377ffe01233f/ 
                    [to_number] => 2222222222 
                    [total_amount] => 0.03570 
                    [total_rate] => 0.03570 
                ) [1] => Array ( 
                    [bill_duration] => 0 
                    [billed_duration] => 0 
                    [call_direction] => outbound 
                    [call_duration] => 0 
                    [call_uuid] => 8ce9b87e-adff-11e4-ace6-377ffe01233f 
                    [end_time] => 2015-02-06 16:57:14+04:00 
                    [from_number] => +1111111111 
                    [parent_call_uuid] => 
                    [resource_uri] => /v1/Account/XXXXXXXXXXXXXXX/Call/8ce9b87e-adff-11e4-ace6-377ffe01233f/ 
                    [to_number] => 2222222222 
                    [total_amount] => 0.00000 
                    [total_rate] => 0.03570 
                ) 
            ) 
        ) 
    )
    */
