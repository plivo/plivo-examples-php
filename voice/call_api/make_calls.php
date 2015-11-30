<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    $params = array(
        'to' => '2222222222', # The phone numer to which the all has to be placed
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
            [api_id] => 32cba792-ae01-11e4-b153-22000abcaa64 
            [message] => call fired 
            [request_uuid] => 5b2db3d3-f478-4b63-992c-e47c527572e8 
        }
    )
    */

