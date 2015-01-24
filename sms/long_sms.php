<?php
    require_once '../plivo.php';
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";
    $p = new RestAPI($auth_id, $auth_token);
    // Send a message
    $params = array(
            'src' => '1111111111',
            'dst' => '2222222222',
            'text' => 'This randomly generated text can be used in your layout (webdesign , websites, books, posters ... ) for free. This text is entirely free of law. Feel free to link to this site by using the image below or by making a simple text link'
        );
    $response = $p->send_message($params);

    // Print the response
    print_r ($response['response']);

?>

<!--
( 
    [api_id] => dd294730-a262-11e4-b153-22000abcaa64 
    [message] => message(s) queued 
    [message_uuid] => Array ( [0] => dd4ba604-a262-11e4-a6e4-22000afa12b0 ) 
)
-->