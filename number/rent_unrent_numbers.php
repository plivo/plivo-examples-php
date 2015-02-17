<?php
    require_once './plivo.php';
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";
    
    $p = new RestAPI($auth_id, $auth_token);

    # Search for new number
    $params = array(
            'country_iso' => 'US', # The ISO code A2 of the country
            'type' => 'local', # The type of number you are looking for. The possible number types are local, national and tollfree.
            'pattern' => '210', # Represents the pattern of the number to be searched. 
            'region' => 'Texas' # This filter is only applicable when the number_type is local. Region based filtering can be performed.
        );

    $response = $p->search_phone_numbers($params);
    print_r ($response);

    /*
    Sample Output
    (
        [status] => 200
        [response] => Array
        (
            [api_id] => 059936ae-b68a-11e4-af95-22000ac54c79
            [meta] => Array
            (
                [limit] => 20
                [next] => /v1/Account/XXXXXXXXXXXX/PhoneNumber/?limit=20&country_iso=US&pattern=210&region=Texas&offset=20&type=local
                [offset] => 0
                [previous] => 
                [total_count] => 98
            )

            [objects] => Array
            (
                [0] => Array
                (
                    [country] => UNITED STATES
                    [lata] => 566
                    [monthly_rental_rate] => 0.80000
                    [number] => 12109206500
                    [prefix] => 210
                    [rate_center] => SANANTONIO
                    [region] => Texas, UNITED STATES
                    [resource_uri] => /v1/Account/XXXXXXXXXXXX/PhoneNumber/12109206500/
                    [restriction] => 
                    [restriction_text] => 
                    [setup_rate] => 0.00000
                    [sms_enabled] => 1
                    [sms_rate] => 0.00000
                    [type] => fixed
                    [voice_enabled] => 1
                    [voice_rate] => 0.00850
                )

                [1] => Array
                (
                    [country] => UNITED STATES
                    [lata] => 566
                    [monthly_rental_rate] => 0.80000
                    [number] => 12109206501
                    [prefix] => 210
                    [rate_center] => SANANTONIO
                    [region] => Texas, UNITED STATES
                    [resource_uri] => /v1/Account/XXXXXXXXXXXX/PhoneNumber/12109206501/
                    [restriction] => 
                    [restriction_text] => 
                    [setup_rate] => 0.00000
                    [sms_enabled] => 1
                    [sms_rate] => 0.00000
                    [type] => fixed
                    [voice_enabled] => 1
                    [voice_rate] => 0.00850
                )
            )
        )
    )    
    */

    # Buy a phone number
    $params = array(
        'number' => '12109206499' # The phone number
    );

    $response = $p->buy_phone_number($params);
    print_r ($response);

    /*
    Sample Output
    (
        [status] => 201
        [response] => Array
        (
            [api_id] => 405f14e8-b68a-11e4-b932-22000ac50fac
            [message] => created
            [numbers] => Array
            (
                [0] => Array
                (
                    [number] => 12109206499
                    [status] => Success
                )
            )
            [status] => fulfilled
        )
    )
    */

    # Unrent a number
    $params = array(
            'number' => '12109206499' # Number that has to be unrented
    );

    $response = $p->unrent_number($params);
    print_r ($response);

    /*
    Sample Output
    (
        [status] => 204
        [response] => 
    )
    */