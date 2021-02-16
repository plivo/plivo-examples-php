<?php

require 'vendor/autoload.php';
use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;
$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

# Link an application to a number
try {
    $response = $client->numbers->update(
        '17609915566', # Number that has to be linked to an application
        ['alias' => 'Updated Alias', 'appId' => '95061338981454152']
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

    

/*
Sample Output
(
    [_message] => changed
    [apiId] => a0dbebfa-7021-11eb-94d7-0242ac110004
    [statusCode] => 202
)
*/

# Unlink an application from an number

try {
    $response = $client->numbers->update(
        '18664972085', # Number that has to be unlikned to an application
        ['api_id'=>' ']
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
Sample Output
(
    [_message] => changed
    [apiId] => a0dbebfa-7021-11eb-94d7-0242ac110004
    [statusCode] => 202
)
*/