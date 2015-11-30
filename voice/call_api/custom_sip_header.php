<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    $params = array(
        'to' => '1111111111', # The phone numer to which the all has to be placed
        'from' => '2222222222', # The phone number to be used as the caller id
        'answer_url' => "https://s3.amazonaws.com/static.plivo.com/answer.xml", # The URL invoked by Plivo when the outbound call is answered
        'answer_method' => "GET", # The method used to call the answer_url
        'sip_headers' => "Test=Sample", # List of SIP headers in the form of 'key=value' pairs, separated by commas.
    );
    
    $response = $p->make_call($params);

    print_r ($response);

    /* Sample Output
    ( 
        [status] => 201 
        [response] => Array ( 
            [api_id] => 6e16b33c-af55-11e4-a2d1-22000ac5040c 
            [message] => call fired 
            [request_uuid] => b1c64cdd-cecc-43a7-bc5b-cbcbb8988c8d 
        ) 
    )

    The SIP header can be seen as a query parameter in the answer_url
    path="/answer.xml?Direction=outbound&From=18583650866&ALegUUID=6e699c0a-af55-11e4-91ce-377ffe01233f&BillRate=0.03570&
    To=11111111111&X-PH-Test=Sample&CallUUID=6e699c0a-af55-11e4-91ce-377ffe01233f&ALegRequestUUID=b1c64cdd-cecc-43a7-bc5b-cbcbb8988c8d&
    RequestUUID=b1c64cdd-cecc-43a7-bc5b-cbcbb8988c8d&CallStatus=in-progress&Event=StartApp" 
    host=glacial-harbor-8656.herokuapp.com request_id=213e871a-50cb-4d46-a95f-0c5e8113504e fwd="184.169.163.156" 
    dyno=web.1 connect=0ms service=14ms status=200 bytes=314

    */

    