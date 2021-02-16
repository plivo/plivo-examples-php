<?php
require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

try {
    $response = $client->numbers->list(
        [
            'limit' => 4, # Used to display the number of results per page.
            'offset' => 0 # Denotes the number of value items by which the results should be offset. 
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
        [response] => Array
        (
            [api_id] => b5b9e238-b688-11e4-ac1f-22000ac51de6
            [meta] => Array
            (
                [limit] => 10
                [next] => 
                [offset] => 0
                [previous] => 
                [total_count] => 2
            )

            [objects] => Array
            (
                [0] => Array
                (
                    [active] => 1
                    [added_on] => 2014-12-04
                    [alias] => 
                    [application] => 
                    [carrier] => Plivo
                    [monthly_rental_rate] => 0.80000
                    [number] => 1111111111
                    [number_type] => local
                    [region] => UNITED KINGDOM
                    [resource_uri] => /v1/Account/XXXXXXXXXXXX/Number/1111111111/
                    [sms_enabled] => 1
                    [sms_rate] => 0.00000
                    [sub_account] => 
                    [type] => local
                    [voice_enabled] => 1
                    [voice_rate] => 0.00500
                )

                [1] => Array
                (
                    [active] => 1
                    [added_on] => 2014-10-28
                    [alias] => 
                    [application] => /v1/Account/XXXXXXXXXXXX/Application/26469261154421101/
                    [carrier] => Plivo
                    [monthly_rental_rate] => 0.80000
                    [number] => 2222222222
                    [number_type] => local
                    [region] => California, UNITED STATES
                    [resource_uri] => /v1/Account/XXXXXXXXXXXX/Number/2222222222/
                    [sms_enabled] => 1
                    [sms_rate] => 0.00000
                    [sub_account] => 
                    [type] => local
                    [voice_enabled] => 1
                    [voice_rate] => 0.00850
                )
            )
        )
    )
    */

# Get a particular number
try {
    $response = $client->numbers->get(
        '17609915566' # PHone number for which the details have to be retrieved
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}


$response = $p->get_number($params);
print_r($response);
/*
Sample Output
    (
        [status] => 200
        [response] => Array
        (
            [active] => 1
            [added_on] => 2014-12-04
            [alias] => 
            [api_id] => 225d65e0-b689-11e4-9107-22000afaaa90
            [application] => 
            [carrier] => Plivo
            [monthly_rental_rate] => 0.80000
            [number] => 17609915566
            [number_type] => local
            [region] => UNITED KINGDOM
            [resource_uri] => /v1/Account/XXXXXXXXXXXX/Number/17609915566/
            [sms_enabled] => 1
            [sms_rate] => 0.00000
            [sub_account] => 
            [type] => local
            [voice_enabled] => 1
            [voice_rate] => 0.00500
        )
    )
    */