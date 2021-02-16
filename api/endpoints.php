<?php

require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

// Create an Endpoint

try {
    $response = $client->endpoints->create(
        'testusername', # The username for the endpoint to be created
        'testpassword', # The password for your endpoint username
        'Test Account' # Alias for this endpoint
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
Sample Output
( 
    [alias] => Sample address 
    [api_id] => f800f950-ac43-11e4-ac1f-22000ac51de6 
    [endpoint_id] => 32969375408354 
    [message] => created 
    [username] => Testing150204080105 
)
*/
    
// Get Details of all existing Endpoints
try {
    $response = $client->endpoints->list();
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
Sample Output
    ( 
        [api_id] => 13632e02-ac44-11e4-b423-22000ac8a2f8 
        [meta] => Array ( 
            [limit] => 20 
            [next] => 
            [offset] => 0 
            [previous] => 
            [total_count] => 2 
        ) 
        [objects] => Array ( 
            [0] => Array ( 
                [alias] => Sample address 
                [application] => /v1/Account/xxxxxxxxxxxxxxxx/Application/16982793927977910/ 
                [endpoint_id] => 32969375408354 
                [password] => 7681fb638a6edc7c70a522f58659af10 
                [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Endpoint/32969375408354/ 
                [sip_registered] => false 
                [sip_uri] => sip:Testing150204080105@phone.plivo.com 
                [sub_account] => 
                [username] => Testing150204080105 
            ) [1] => Array ( 
                [alias] => pkyjzb 
                [application] => /v1/Account/xxxxxxxxxxxxxxxx/Application/16982793927977910/ 
                [endpoint_id] => 23652884295839 
                [password] => d592b36b4855eeb3b1c53cd53e031438 
                [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Endpoint/23652884295839/ 
                [sip_registered] => false 
                [sip_uri] => sip:pkyjzb150204052138@phone.plivo.com 
                [sub_account] => 
                [username] => pkyjzb150204052138 
            ) 
        ) 
    )
    */


// Get details of Single Endpoint
try {
    $response = $client->endpoints->get(
        '39452475478853' # ID of the endpoint for which the details have to be retrieved
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
Sample Output
( 
    [alias] => pkyjzb 
    [api_id] => cd8011ec-ac44-11e4-b932-22000ac50fac 
    [application] => /v1/Account/xxxxxxxxxxxxxxxx/Application/16982793927977910/ 
    [endpoint_id] => 23652884295839 
    [password] => d592b36b4855eeb3b1c53cd53e031438 
    [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Endpoint/23652884295839/ 
    [sip_registered] => false 
    [sip_uri] => sip:pkyjzb150204052138@phone.plivo.com 
    [sub_account] => 
    [username] => pkyjzb150204052138 
)
*/

// Modify an Endpoint
try {
    $response = $client->endpoints->update(
        '39452475478853', # ID of the endpoint for which has to be modified
        ['alias' => 'Updated Endpoint Alias'] # Values that have to be updated
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}


/*
Sample Output
( 
    [api_id] => 067341d6-ac45-11e4-b932-22000ac50fac 
    [message] => changed 
)
*/

// Delete an Endpoint
try {
    $response = $client->endpoints->delete(
        '39452475478853' # Auth ID of the sub acccount for which the details has to be deleted
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
