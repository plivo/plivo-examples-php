<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";
    
    $p = new RestAPI($auth_id, $auth_token);

    # Link an application to a number
    $params = array(
            'number' => '1111111111', # Number that has to be linked to an application
            'app_id' => '16638156474000802' # Application ID that has to be linked
        );

    #$response = $p->link_application_number($params);
    #print_r ($response);

    /*
    Sample Output
    (
        [status] => 202
        [response] => Array
        (
            [api_id] => 3ca792ba-b68c-11e4-af95-22000ac54c79
            [message] => changed
        )
    )
    */

    # Unlink an application from an number
    $params = array(
            'number' => '1111111111' # Number that has to be unlikned to an application
    );

    $response = $p->unlink_application_number($params);
    print_r ($response);

    /*
    Sample Output
    (
        [status] => 202
        [response] => Array
        (
            [api_id] => 50640c34-b68c-11e4-8ccf-22000afb14f7
            [message] => changed
        )
    )
    */