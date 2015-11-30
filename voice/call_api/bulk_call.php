<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    $params = array(
        'to' => '2222222222<3333333333', # The phone numer to which the all has to be placed
        'from' => '1111111111', # The phone number to be used as the caller id
        'answer_url' => "https://s3.amazonaws.com/static.plivo.com/answer.xml", # The URL invoked by Plivo when the outbound call is answered
        'answer_method' => "GET", # The method used to call the answer_url
    );
    
    $response = $p->make_call($params);

    print_r ($response);

    /* Sample Output
    ( 
        [status] => 201 
        [response] => Array ( 
            [api_id] => ed5108f0-ae01-11e4-a2d1-22000ac5040c 
            [message] => calls fired 
            [request_uuid] => Array ( 
                [0] => 23cb5e06-9f5d-44c7-b880-1bd32c970d52 
                [1] => ebb63b3e-69d2-450a-91ee-f0cb3b28a3dc 
            )
        ) 
    )
    */

