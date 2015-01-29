<?php
    require_once '../plivo.php';
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    // Send a message
    $params = array(
            'src' => 'ALPHA-ID', // Sender's Alphanumeric ID
            'dst' => '447441906862', // Receiver's phone number with country ode
            'text' => 'Hi, Message from Plivo' // Your SMS text message
        );

    $response = $p->send_message($params);

    // Print the response
    print_r ($response['response']);
?>

<!--
Sample Output
( 
    [api_id] => 56007e9e-a263-11e4-b932-22000ac50fac 
    [message] => message(s) queued 
    [message_uuid] => Array ( [0] => 561ac844-a263-11e4-890b-22000aec819c ) 
)
-->