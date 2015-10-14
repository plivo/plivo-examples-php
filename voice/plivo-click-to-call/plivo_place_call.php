<?php
    require 'plivo.php';
    	
    $auth_id = "XXXXXXXXXXXXXXXXXXXXXXXXXXX";
    $auth_token = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
    
    $p = new RestAPI($auth_id, $auth_token);

    $first_user = $_REQUEST['firstuser'];
    $second_user= $_REQUEST['second_user'];
    $custom_id = '12121211110';
    
    // Make Call
    $params = array(
            'to' => $first_user,
            'from' => $custom_id,
            'ring_url' => 'http://' . $_SERVER["SERVER_NAME"] . '/ring_url.php',
            'answer_url' => 'http://' . $_SERVER["SERVER_NAME"] . '/plivo_call_second_user.php?CLID=' . $first_user . '&TO=' . $second_user, 
            'hangup_url' => 'http://' . $_SERVER["SERVER_NAME"] . '/hangup_url.php',
            'answer_method' => 'GET',
            'hangup_method' => 'GET',
        );

    $response = $p->make_call($params);

?>