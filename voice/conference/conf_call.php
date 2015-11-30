<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    $plivo_number = "1111111111";

    $params = array(
        'to' => '1111111111<2222222222', # The phon number to be called
        'from' => $plivo_number, # The phone number to be used as the caller id
        'answer_url' => "https://example.com/conference_xml.php", # The URL invoked by Plivo when the outbound call is answered
        'answer_method' => "GET" # The method used to call the answer_url
    );
    
    $response = $p->make_call($params);
    print_r ($response);
    

/* Sample Output
( 
    [status] => 201 
    [response] => Array ( 
        [api_id] => 8b32b934-af6e-11e4-b153-22000abcaa64 
        [message] => calls fired 
        [request_uuid] => Array ( 
            [0] => d1187266-b5e8-4a1d-bd8d-b0a4395f08f6 
            [1] => 0c88ed10-fde4-4e6e-8c7c-08ebeee5e856 
        ) 
    ) 
)
*/

