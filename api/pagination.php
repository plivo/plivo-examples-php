<?php

require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

try {
    $response = $client->applications->list(
        [
            'limit' => 0, # The number of results per page
            'offset' => 3 # The number of value items by which the results should be offset
        ]
    );
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
