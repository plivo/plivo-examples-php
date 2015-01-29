<?php
    require_once '../plivo.php';
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";
    $p = new RestAPI($auth_id, $auth_token);
    // Send a message
    $params = array(
            'src' => '1111111111', // Sender's phone number with country code
            'dst' => '2222222222<3333333333', // receiver's phone number with country code
            'text' => 'Hi, Message from Plivo' // Your SMS text message
        );
    // Send message
    $response = $p->send_message($params);

    // Print the response
    print_r ($response['response']);

    // Loop throught the message uuids
    $uuids = $response['response']['message_uuid'];
        
    // Print the uuids
    foreach($uuids as $value){
        print_r ("Message UUID : {$value} <br>");
    }
?>

<!--
Sample Output
( 
    [api_id] => 266dd470-a262-11e4-b153-22000abcaa64 
    [message] => message(s) queued 
    [message_uuid] => Array ( [0] => 2698aefc-a262-11e4-890b-22000aec819c [1] => 26989ff2-a262-11e4-b328-22000afd044b ) 
) 
    Message UUID : 2698aefc-a262-11e4-890b-22000aec819c 
    Message UUID : 26989ff2-a262-11e4-b328-22000afd044b 
-->