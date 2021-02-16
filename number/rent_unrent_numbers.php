<?php
require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

# Search for new number
try {
    $response = $client->phonenumbers->list(
        'US' # The ISO code A2 of the country
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
            [api_id] => 059936ae-b68a-11e4-af95-22000ac54c79
            [meta] => Array
            (
                [limit] => 20
                [next] => /v1/Account/XXXXXXXXXXXX/PhoneNumber/?limit=20&country_iso=US&pattern=210&region=Texas&offset=20&type=local
                [offset] => 0
                [previous] => 
                [total_count] => 98
            )

            [objects] => Array
            (
                [0] => Array
                (
                    [country] => UNITED STATES
                    [lata] => 566
                    [monthly_rental_rate] => 0.80000
                    [number] => 12109206500
                    [prefix] => 210
                    [rate_center] => SANANTONIO
                    [region] => Texas, UNITED STATES
                    [resource_uri] => /v1/Account/XXXXXXXXXXXX/PhoneNumber/12109206500/
                    [restriction] => 
                    [restriction_text] => 
                    [setup_rate] => 0.00000
                    [sms_enabled] => 1
                    [sms_rate] => 0.00000
                    [type] => fixed
                    [voice_enabled] => 1
                    [voice_rate] => 0.00850
                )

                [1] => Array
                (
                    [country] => UNITED STATES
                    [lata] => 566
                    [monthly_rental_rate] => 0.80000
                    [number] => 12109206501
                    [prefix] => 210
                    [rate_center] => SANANTONIO
                    [region] => Texas, UNITED STATES
                    [resource_uri] => /v1/Account/XXXXXXXXXXXX/PhoneNumber/12109206501/
                    [restriction] => 
                    [restriction_text] => 
                    [setup_rate] => 0.00000
                    [sms_enabled] => 1
                    [sms_rate] => 0.00000
                    [type] => fixed
                    [voice_enabled] => 1
                    [voice_rate] => 0.00850
                )
            )
        )
    )    
    */

# Buy a phone number
try {
    $response = $client->phonenumbers->buy(
        '10123456789' # The phone number
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
    Sample Output
(
    [number:protected] => 18336312168
    [numberStatus:protected] => Success
    [status:protected] => fulfilled
    [_message] => created
    [apiId] => c2444610-7027-11eb-9dde-0242ac110004
    [statusCode] => 201
)
*/

# Unrent a number
try {
    $response = $client->numbers->delete(
        '17609915566' # Number that has to be unrented
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
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