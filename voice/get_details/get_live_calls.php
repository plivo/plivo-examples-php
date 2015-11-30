<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    $params =array(
        'call_uuid' => 'fcef9018-aec6-11e4-8449-c73b3246dc2a' # The status of the call
    );

    // Get all Live Calls
    $response = $p->get_live_call($params);

    print_r ($response);    

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
    
    $uuids = $response['response']['calls'];
    
    // Looping through the call uuids
    foreach($uuids as $value){
        print_r ("Calls : {$value} <br>");
    }

    /* 
    Sample Output
    Calls : a60f44dc-926f-11e4-82f5-b559cbfe39b9
    Calls : af399206-926f-11e4-8b6f-fd067af138be
    */