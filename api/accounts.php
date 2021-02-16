<?php

require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
// Get account details
try {
    $response = $client->accounts->get();
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}
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
try {
    $response = $client->accounts->update('Test Account', 'Austin', 'Test Address');
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
Sample Output
(
    [_message] => changed
    [apiId] => 242d5542-6961-11eb-8a92-0242ac110003
    [statusCode] => 202
)
*/

// Create a sub account

try {
    $response = $client->subaccounts->create(
        'Test Subaccount', # Name of the subaccount
        True  # Specify if the subaccount should be enabled or not
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}


/*
Sample Output
(
    [authId:protected] => SAM2M3OWM4N2UTYWE5YY
    [authToken:protected] => YTYxYTU5YWEtMTMwNi00OTlkLThiMjYtNzFlN2Vl
    [_message] => created
    [apiId] => 744b280a-7015-11eb-9dde-0242ac110004
    [statusCode] => 202
)
*/

// Modify a subaccount
try {
    $response = $client->subaccounts->update(
        'SAM2M3OWM4N2UTYWE5YY', # Sub account auth_id
        'Updated Subaccount Name'  # Updated Sub account name
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

/*
Sample Output
( 
    [api_id] => 9ff42ff4-ac37-11e4-b423-22000ac8a2f8 
    [message] => changed 
)
*/

// Get details of all sub accounts
try {
    $response = $client->subaccounts->list(
        3, # limit
        2 # offset
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
};

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

// Get details of a aprticular sub account
try {
    $response = $client->subaccounts->get(
        'SAMWJKYJFHZTM2YQSE4OW' # Auth ID of the sub acccount for which the details have to be retrieved
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

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
try {
    $response = $client->subaccounts->delete(
        'SAXXXXXXXXXXXXXXXXXX',
        true
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}
/*
Sample Output
( 
    [response] =>
)

Unsuccessful Output
(
    [message:protected] => 404
)
*/
