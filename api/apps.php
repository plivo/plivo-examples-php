<?php
    
    require_once './plivo.php';
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";
    
    $p = new RestAPI($auth_id, $auth_token);

    // Create an Application
    $params = array(
            'answer_url' => 'http://example.com', # The URL Plivo will fetch when a call executes this application
            'app_name' => 'Testing' # The name of your application
        );

    $response = $p->create_application($params);
    // print_r ($response['response']);
    
    /*
    Sample Output
    ( 
        [api_id] => ad7a2eb8-ac45-11e4-b932-22000ac50fac 
        [app_id] => 23061826722302672 
        [message] => created 
    ) 
    */
    
    // Get Details of all existing Applications
    $response = $p->get_applications();
    // print_r ($response['response']);

    /*
    Sample Output
    ( 
        [api_id] => cff47926-ac45-11e4-b153-22000abcaa64 
        [meta] => Array ( 
            [limit] => 20 
            [next] => 
            [offset] => 0 
            [previous] => 
            [total_count] => 2
        ) [objects] => Array ( 
            [0] => Array ( 
                [answer_method] => POST 
                [answer_url] => http://example.com 
                [app_id] => 23061826722302672 
                [app_name] => Testing 
                [default_app] => 
                [default_endpoint_app] => 
                [enabled] => 1 
                [fallback_answer_url] => 
                [fallback_method] => POST 
                [hangup_method] => POST 
                [hangup_url] => http://example.com 
                [message_method] => POST 
                [message_url] => 
                [public_uri] => 
                [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Application/23061826722302672/ 
                [sip_uri] => sip:23061826722302672@app.plivo.com 
                [sub_account] => 
            ) [1] => Array ( 
                [answer_method] => POST 
                [answer_url] => http://plivodirectdial.herokuapp.com/response/sip/route/?DialMusic=real&CLID=919663489533 
                [app_id] => 16982793927977910 
                [app_name] => Sip default 
                [default_app] => 
                [default_endpoint_app] => 1 
                [enabled] => 1 
                [fallback_answer_url] => http://plivodirectdial.herokuapp.com/response/sip/route/?DialMusic=real&CLID=919663489533 
                [fallback_method] => POST 
                [hangup_method] => POST 
                [hangup_url] => http://plivodirectdial.herokuapp.com/response/sip/route/?DialMusic=real&CLID=919663489533 
                [message_method] => POST 
                [message_url] => http://plivodirectdial.herokuapp.com/response/sip/route/?DialMusic=real&CLID=919663489533 
                [public_uri] => 
                [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Application/16982793927977910/ 
                [sip_uri] => sip:16982793927977910@app.plivo.com 
                [sub_account] => 
            )
        }
    )
    */

    // Print the total number of Applications
    // echo "<br> Total count : ";
    // echo ($response['response']['meta']['total_count']);

    /*
    Sample Output
    Total count : 2
    */

    // Print public_uri, default_app, default_endpoint
    /*
    $count = ($response['response']['meta']['total_count']);
    echo "<br>Count : $count";
    for ($i=0; $i<$count; $i++)
    {
        echo "<br> Public URI : ";
        echo ($response['response']['objects'][i]['public_uri']);
        echo "<br> Default App : ";
        echo ($response['response']['objects'][i]['default_app']);
        echo "<br> Default Endpoint App : ";
        echo ($response['response']['objects'][i]['default_endpoint_app']);
    }
    */

    // Get details of Single Application
    $params = array(
            'app_id' => '23061826722302672' # ID of the application for which the details have to be retrieved
            
        );

    $response = $p->get_application($params);
    // print_r ($response['response']);

    /*
    Sample Output
    ( 
        [answer_method] => POST 
        [answer_url] => http://example.com 
        [api_id] => abe963d8-ac4b-11e4-b423-22000ac8a2f8 
        [app_id] => 23061826722302672 
        [app_name] => Testing 
        [default_app] => 
        [default_endpoint_app] => 
        [enabled] => 1 
        [fallback_answer_url] => 
        [fallback_method] => POST 
        [hangup_method] => POST 
        [hangup_url] => http://example.com 
        [message_method] => POST 
        [message_url] => 
        [public_uri] => 
        [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Application/23061826722302672/ 
        [sip_uri] => sip:23061826722302672@app.plivo.com 
        [sub_account] => 
    ) 
    */

    // Modify an Application
    $params = array(
            'app_id' => '23061826722302672', # ID of the applictiob for which has to be modified
            'answer_url' => 'http://yourexample.com' # Values that have to be updated
        );

    $response = $p->modify_application($params);
    // print_r ($response['response']);

    /*
    Sample Output
    ( 
        [api_id] => 16bf2cf6-ac4c-11e4-b932-22000ac50fac 
        [message] => changed 
    ) 
    */

    // Delete an Application
    $params = array(
        'app_id' => '23061826722302672' # Auth ID of the sub acccount for which the details has to be deleted
        );

    $response = $p->delete_application($params);
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
