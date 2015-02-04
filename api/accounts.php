<?php
    require_once './plivo.php';
    
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";
    
    $p = new RestAPI($auth_id, $auth_token);

    // Get account details
    $response = $p->get_account();
    // print_r ($response['response']);
    
    /*
    Sample Output
    ( 
        [account_type] => standard 
        [address] => Example add 
        [api_id] => 096ca42e-ac34-11e4-96e3-22000abcb9af 
        [auth_id] => xxxxxxxxxxxxxxxx 
        [auto_recharge] => False
        [billing_mode] => prepaid 
        [cash_credits] => 79.40625 
        [city] => Test Place 
        [name] => User 
        [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/ 
        [state] => 
        [timezone] => Asia/Kolkata 
    )
    */
    
    // Modify account 
    $params = array(
            'name' => 'Testing', # Name of the account holder or business.
            'city' => 'Testing City', # City of the account holder
            'address' => 'Sample address', # Address of the account holder
            'timezone' => 'Indian/Mauritius' # Time zone of the account holder
        );

    $response = $p->modify_account($params);
    // print_r ($response['response']);

    /*
    Sample Output
    ( 
        [api_id] => 809248b4-ac35-11e4-a2d1-22000ac5040c 
        [message] => changed 
    )
    */

    // Create a sub account
    $params = array(
            'name' => 'TestingSubAcount', # Name of the subaccount
            'eabled' => 'True' # Specify if the subaccount should be enabled or not
        );

    $response = $p->create_subaccount($params);
    // print_r ($response['response']);

    /*
    Sample Output
    ( 
        [api_id] => 08175698-ac37-11e4-a2d1-22000ac5040c 
        [auth_id] => SAM2U3ZDEXOTK0NTMWMJ 
        [auth_token] => YjFhM2EzNWExM2M4NmU3MzNmZGRiMjFiM2M3N2Qz 
        [message] => created 
    )
    */

    // Modify a subaccount
    $params = array(
            'subauth_id' => 'SAMTRLYZG0MMRIODZKZM', # Name of the subaccount
            'name' => 'SampleModify' # Specify if the subaccount should be enabled or not
        );

    $response = $p->modify_subaccount($params);
    // print_r ($response['response']);
    
    /*
    Sample Output
    ( 
        [api_id] => 9ff42ff4-ac37-11e4-b423-22000ac8a2f8 
        [message] => changed 
    )
    */

    // Get details of all sub accounts
    $response = $p->get_subaccounts();
    // print_r ($response['response']);

    /*
    Sample Output
    ( 
        [api_id] => e085156a-ac37-11e4-ac1f-22000ac51de6 
        [meta] => Array ( 
            [limit] => 20 
            [next] => 
            [offset] => 0 
            [previous] => 
            [total_count] => 2 
        ) 
        [objects] => Array ( 
            [0] => Array ( 
                [account] => /v1/Account/xxxxxxxxxxxxxxxx/ 
                [auth_id] => SAM2U3ZDEXOTK0NTMWMJ 
                [auth_token] => YjFhM2EzNWExM2M4NmU3MzNmZGRiMjFiM2M3N2Qz 
                [created] => 2015-02-04 
                [enabled] => 
                [modified] => 2015-02-04 
                [name] => SampleModify 
                [new_auth_token] => YjFhM2EzNWExM2M4NmU3MzNmZGRiMjFiM2M3N2Qz 
                [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Subaccount/SAM2U3ZDEXOTK0NTMWMJ/ 
            ) [1] => Array ( 
                [account] => /v1/Account/xxxxxxxxxxxxxxxx/ 
                [auth_id] => SAMWJKYJFHZTM2YQSE4OW 
                [auth_token] => MjI4YzBiMDQ4MWFjODkyYWNkMDY3NDViMDZjZGUz 
                [created] => 2014-12-04 
                [enabled] => 1 
                [modified] => 
                [name] => Ramya 
                [new_auth_token] => MjI4YzBiMDQ4MWFjODkyYWNgHDY3NDViMDZjZGUz 
                [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Subaccount/SAMWJKYJFHZTM2YQSE4OW/ 
            ) 
        ) 
    )
    */

    // Print the total number of sub accounts
    // echo "<br> Total Sub accounts : ";
    // echo ($response['response']['meta']['total_count']);

    /*
    Sample Output
    Total Sub accounts : 2
    */

    // Get details of a aprticular sub account
    $params = array(
        'subauth_id' => 'SAM2U3ZDEXOTK0NTMWMJ' # Auth ID of the sub acccount for which the details have to be retrieved
        );

    $response = $p->get_subaccount($params);
    // print_r ($response['response']);

    /* 
    Sample Output
    ( 
        [account] => /v1/Account/xxxxxxxxxxxxxxxx/ 
        [auth_id] => SAM2U3ZDEXOTK0NTMWMJ 
        [auth_token] => YjFhM2EzNWExM2M4NmU3MzNmZGRiMjFiM2M3N2Qz 
        [created] => 2015-02-04 
        [enabled] => 
        [modified] => 2015-02-04 
        [name] => SampleModify 
        [new_auth_token] => YjFhM2EzNWExM2M4NmU3MzNmZGRiMjFiM2M3N2Qz 
        [resource_uri] => /v1/Account/xxxxxxxxxxxxxxxx/Subaccount/SAM2U3ZDEXOTK0NTMWMJ/ 
    )
    */

    // Delete a sub account
    $params = array(
        'subauth_id' => 'SAM2U3ZDEXOTK0NTMWMJ' # Auth ID of the sub acccount for which the details has to be deleted
        );

    $response = $p->delete_subaccount($params);
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
