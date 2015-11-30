<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    $params = array(
            'call_uuid' => 'defb0706-86a6-11e4-b303-498d468c930b' # UUID of the call to be hung up
        );

    $response = $p->hangup_call($params);
    print_r ($response)

    /* 
    Sample Output
    ( 
        [status] => 204 
        [response] => 
    )
    Unsuccessful Output
    ( 
        [status] => 404 
        [response] => Array ( 
            [api_id] => c0cf0530-ac39-11e4-96e3-22000abcb9af 
            [error] => not found 
        ) 
    )
    */