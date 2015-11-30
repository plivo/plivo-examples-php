<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    # API ID is returned for every API request.
    # Request UUID is request id of the call. This ID is returned as soon as the call is fired irrespective of whether the call is answered or not

    $params = array(
        'to' => '2222222222', # The phone numer to which the all has to be placed
        'from' => '1111111111', # The phone number to be used as the caller id
        'answer_url' => "https://example.com/speak", # The URL invoked by Plivo when the outbound call is answered
        'answer_method' => "GET", # The method used to call the answer_url
    );

    # Make an outbound call
    $response = $p->make_call($params);
    puts ("API ID : #{$response['api_id']}");
    puts ("Request UUID : #{$response['request_uuid']}");

    /* 
    Sample Output
    API ID : 32cba792-ae01-11e4-b153-22000abcaa64 
    Request UUID : 5b2db3d3-f478-4b63-992c-e47c527572e8 
    */

    # Call UUID is th id of a live call. This ID is returned only after the call is answered.

    $params1 = array(
            'status' => 'live' # The status of the call
        );

    # Get the details of all live calls
    $response = $p->get_live_calls($params1);
    
    $uuids = $response['response']['calls'];
    
    // Looping through the call uuids
    foreach($uuids as $value){
        print_r ("Call UUID : {$value} <br>");
    }

    /*
    Sample Output
    Call UUID : a60f44dc-926f-11e4-82f5-b559cbfe39b9
    Call UUID : af399206-926f-11e4-8b6f-fd067af138be
    */