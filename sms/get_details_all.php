<?php
    require_once 'plivo.php';
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";
    $p = new RestAPI($auth_id, $auth_token);

    // Fetch the details
    $response = $p->get_messages();

    // Print the response
    print_r ($response['response']);

    // Filter the response
    $params = array(
            'limit' => '2',
            'offset' => '0',
            'message_direction ' => 'outbound',
            'message_state' => 'sent'
        );

    // Fetch the details
    $response = $p->get_messages($params);    

    // Print the response
    print_r ($response['response']);
?>

<!--
Sample Output without Filters
(
    [api_id] => f9adfd4a-a264-11e4-a2d1-22000ac5040c 
    [meta] => Array ( 
        [limit] => 2 
        [next] => /v1/Account/XXXXXXXXXXXXXXX/Message/?message_state=sent&limit=2&offset=2&message_direction+=outbound 
        [offset] => 0 
        [previous] => 
        [total_count] => 70 
    ) [objects] => Array ( 
        [0] => Array ( 
            [from_number] => 1111111111 
            [message_direction] => inbound 
            [message_state] => sent 
            [message_time] => 2014-02-22 19:17:03+04:00 
            [message_type] => sms 
            [message_uuid] => dd4ba604-a262-11e4-a6e4-22000afa12b0 
            [resource_uri] => /v1/Account/XXXXXXXXXXXXXXX/Message/dd4ba604-a262-11e4-a6e4-22000afa12b0/ 
            [to_number] => 1111111111 
            [total_amount] => 0.01300 
            [total_rate] => 0.00650 
            [units] => 2 
        ) [1] => Array ( 
            [from_number] => 1111111111 
            [message_direction] => inbound 
            [message_state] => sent 
            [message_time] => 2014-02-22 22:12:56+04:00 
            [message_type] => sms 
            [message_uuid] => 2698aefc-a262-11e4-890b-22000aec819c 
            [resource_uri] => /v1/Account/XXXXXXXXXXXXXXX/Message/2698aefc-a262-11e4-890b-22000aec819c/ 
            [to_number] => 1111111111 
            [total_amount] => 0.00650 
            [total_rate] => 0.00650 
            [units] => 1 
        ) 
    ) 
)

Sample Output with Filters
(
    [api_id] => f9adfd4a-a264-11e4-a2d1-22000ac5040c 
    [meta] => Array ( 
        [limit] => 2 
        [next] => /v1/Account/XXXXXXXXXXXXXXX/Message/?message_state=sent&limit=2&offset=2&message_direction+=outbound 
        [offset] => 0 
        [previous] => 
        [total_count] => 70 
    ) [objects] => Array ( 
        [0] => Array ( 
            [from_number] => 1111111111 
            [message_direction] => outbound 
            [message_state] => sent 
            [message_time] => 2015-01-22 22:17:03+04:00 
            [message_type] => sms 
            [message_uuid] => dd4ba604-a262-11e4-a6e4-22000afa12b0 
            [resource_uri] => /v1/Account/XXXXXXXXXXXXXXX/Message/dd4ba604-a262-11e4-a6e4-22000afa12b0/ 
            [to_number] => 1111111111 
            [total_amount] => 0.01300 
            [total_rate] => 0.00650 
            [units] => 2 
        ) [1] => Array ( 
            [from_number] => 1111111111 
            [message_direction] => outbound 
            [message_state] => sent 
            [message_time] => 2015-01-22 22:11:56+04:00 
            [message_type] => sms 
            [message_uuid] => 2698aefc-a262-11e4-890b-22000aec819c 
            [resource_uri] => /v1/Account/XXXXXXXXXXXXXXX/Message/2698aefc-a262-11e4-890b-22000aec819c/ 
            [to_number] => 1111111111 
            [total_amount] => 0.00650 
            [total_rate] => 0.00650 
            [units] => 1 
        ) 
    ) 
)
-->