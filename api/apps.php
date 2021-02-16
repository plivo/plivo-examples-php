<?php

require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

// Create an Application
try {
    $response = $client->applications->create(
        'Test Application', # The name of your application.
        [
            'answer_url' => 'http://answer.url', # The name of your application.
            'answer_method' => 'POST' # The method for the URL to be invoked.
        ]
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
Sample Output
( 
    [appId:protected] => 95061338981454152
    [_message] => created
    [apiId] => 88c9deea-701d-11eb-b8c4-0242ac110004
    [statusCode] => 201
) 
*/

// Get Details of all existing Applications
try {
    $response = $client->applications->list();
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
    Sample Output
    ( 
        [api_id] => cff47926-ac45-11e4-b153-22000abcaa64 
        [meta] => Array ( 
            [limit] => 20 
            [next] => 
            [offset] => 0 
            [previous] => 
            [total_count] => 2
        ) [objects] => Array ( 
            [0] => Array ( 
                [answer_method] => POST 
                [answer_url] => http://example.com 
                [app_id] => 23061826722302672 
                [app_name] => Testing 
                [default_app] => 
                [default_endpoint_app] => 
                [enabled] => 1 
                [fallback_answer_url] => 
                [fallback_method] => POST 
                [hangup_method] => POST 
                [hangup_url] => http://example.com 
                [message_method] => POST 
                [message_url] => 
                [public_uri] => 
                [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Application/23061826722302672/ 
                [sip_uri] => sip:23061826722302672@app.plivo.com 
                [sub_account] => 
            ) [1] => Array ( 
                [answer_method] => POST 
                [answer_url] => http://plivodirectdial.herokuapp.com/response/sip/route/?DialMusic=real&CLID=919663489533 
                [app_id] => 16982793927977910 
                [app_name] => Sip default 
                [default_app] => 
                [default_endpoint_app] => 1 
                [enabled] => 1 
                [fallback_answer_url] => http://plivodirectdial.herokuapp.com/response/sip/route/?DialMusic=real&CLID=919663489533 
                [fallback_method] => POST 
                [hangup_method] => POST 
                [hangup_url] => http://plivodirectdial.herokuapp.com/response/sip/route/?DialMusic=real&CLID=919663489533 
                [message_method] => POST 
                [message_url] => http://plivodirectdial.herokuapp.com/response/sip/route/?DialMusic=real&CLID=919663489533 
                [public_uri] => 
                [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Application/16982793927977910/ 
                [sip_uri] => sip:16982793927977910@app.plivo.com 
                [sub_account] => 
            )
        }
    )
    */


// Get details of Single Application
try {
    $response = $client->applications->get(
        '95061338981454152' # ID of the application for which the details have to be retrieved
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
    Sample Output
    ( 
        [answer_method] => POST 
        [answer_url] => http://example.com 
        [api_id] => abe963d8-ac4b-11e4-b423-22000ac8a2f8 
        [app_id] => 23061826722302672 
        [app_name] => Testing 
        [default_app] => 
        [default_endpoint_app] => 
        [enabled] => 1 
        [fallback_answer_url] => 
        [fallback_method] => POST 
        [hangup_method] => POST 
        [hangup_url] => http://example.com 
        [message_method] => POST 
        [message_url] => 
        [public_uri] => 
        [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Application/23061826722302672/ 
        [sip_uri] => sip:23061826722302672@app.plivo.com 
        [sub_account] => 
    ) 
    */

// Modify an Application
try {
    $response = $client->applications->update(
        '1101234567899201', # ID of the applictiob for which has to be modified
        [
            'answer_url' => 'http://updated.answer.url' # Values that have to be updated
        ]
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
    Sample Output
    ( 
        [api_id] => 16bf2cf6-ac4c-11e4-b932-22000ac50fac 
        [message] => changed 
    ) 
    */

// Delete an Application
try {
    $response = $client->applications->delete(
        '15784735442685051' # Auth ID of the sub acccount for which the details has to be deleted
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
