<?php

    require_once './plivo.php';

    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    // Create an Endpoint
    $params = array(
            'username' => 'Testing', # The username for the endpoint to be created
            'password' => 'TestingCity', # The password for your endpoint username
            'alias' => 'Sample address' # Alias for this endpoint
        );

    $response = $p->create_endpoint($params);
    // print_r ($response['response']);
    
    /*
    Sample Output
    ( 
        [alias] => Sample address 
        [api_id] => f800f950-ac43-11e4-ac1f-22000ac51de6 
        [endpoint_id] => 32969375408354 
        [message] => created 
        [username] => Testing150204080105 
    )
    */
    
    // Get Details of all existing Endpoints
    $response = $p->get_endpoints();
    // print_r ($response['response']);

    /*
    Sample Output
    ( 
        [api_id] => 13632e02-ac44-11e4-b423-22000ac8a2f8 
        [meta] => Array ( 
            [limit] => 20 
            [next] => 
            [offset] => 0 
            [previous] => 
            [total_count] => 2 
        ) 
        [objects] => Array ( 
            [0] => Array ( 
                [alias] => Sample address 
                [application] => /v1/Account/xxxxxxxxxxxxxxxx/Application/16982793927977910/ 
                [endpoint_id] => 32969375408354 
                [password] => 7681fb638a6edc7c70a522f58659af10 
                [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Endpoint/32969375408354/ 
                [sip_registered] => false 
                [sip_uri] => sip:Testing150204080105@phone.plivo.com 
                [sub_account] => 
                [username] => Testing150204080105 
            ) [1] => Array ( 
                [alias] => pkyjzb 
                [application] => /v1/Account/xxxxxxxxxxxxxxxx/Application/16982793927977910/ 
                [endpoint_id] => 23652884295839 
                [password] => d592b36b4855eeb3b1c53cd53e031438 
                [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Endpoint/23652884295839/ 
                [sip_registered] => false 
                [sip_uri] => sip:pkyjzb150204052138@phone.plivo.com 
                [sub_account] => 
                [username] => pkyjzb150204052138 
            ) 
        ) 
    )
    */

    // Print the total number of Endpoints
    // echo "<br> Total count : ";
    // echo ($response['response']['meta']['total_count']);

    /*
    Sample Output
    Total count : 2
    */

    // Get details of Single Endpoint
    $params = array(
            'endpoint_id' => '23652884295839' # ID of the endpoint for which the details have to be retrieved
            
        );

    $response = $p->get_endpoint($params);
    // print_r ($response['response']);

    /*
    Sample Output
    ( 
        [alias] => pkyjzb 
        [api_id] => cd8011ec-ac44-11e4-b932-22000ac50fac 
        [application] => /v1/Account/xxxxxxxxxxxxxxxx/Application/16982793927977910/ 
        [endpoint_id] => 23652884295839 
        [password] => d592b36b4855eeb3b1c53cd53e031438 
        [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Endpoint/23652884295839/ 
        [sip_registered] => false 
        [sip_uri] => sip:pkyjzb150204052138@phone.plivo.com 
        [sub_account] => 
        [username] => pkyjzb150204052138 
    )
    */

    // Modify an Endpoint
    $params = array(
            'endpoint_id' => '23652884295839', # ID of the endpoint for which has to be modified
            'alias' => 'SampleAlias' # Values that have to be updated
        );

    $response = $p->modify_endpoint($params);
    // print_r ($response['response']);

    /*
    Sample Output
    ( 
        [api_id] => 067341d6-ac45-11e4-b932-22000ac50fac 
        [message] => changed 
    )
    */

    // Delete an Endpoint
    $params = array(
        'endpoint_id' => '23652884295839' # Auth ID of the sub acccount for which the details has to be deleted
        );

    $response = $p->delete_endpoint($params);
    // print_r ($response);

    /*
    Sample Output
    ( 
        [status] => 204 
        [response] => 
    )

    Unsuccessful Output
     ( 
        [status] => 404 
        [response] => Array ( 
            [api_id] => c0cf0530-ac39-11e4-96e3-22000abcb9af 
            [error] => not found 
        x`) 
     )
    */
