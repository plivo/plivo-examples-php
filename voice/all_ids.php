<?php

require 'vendor/autoload.php';
use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;
$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

# API ID is returned for every API request.
# Request UUID is request id of the call. This ID is returned as soon as the call is fired irrespective of whether the call is answered or not
try {
    $response = $client->calls->create(
        '+14151234567', # The phone number to be used as the caller id
        ['+15671234567'], # The phone numer to which the all has to be placed
        'http://s3.amazonaws.com/static.plivo.com/answer.xml', # The URL invoked by Plivo when the outbound call is answered
        'GET', # The method used to call the answer_url
        
    );
    print_r($response->apiId);
    print_r($response->requestUuid);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

/* 
Sample Output
(
    [requestUuid:protected] => e4b8fc7b-af3a-4644-ad61-f78f3ebeb050
    [_message] => call fired
    [apiId] => 56e51a7e-7040-11eb-896e-0242ac110005
    [statusCode] => 201
)
    */

# Call UUID is th id of a live call. This ID is returned only after the call is answered.

$params1 = array(
    'status' => 'live' # The status of the call
);

# Get the details of all live calls
try{
    $response = $client->calls->listLive();
    print_r($response->calluuid);
}

/*
Sample Output
    Call UUID : a60f44dc-926f-11e4-82f5-b559cbfe39b9
    Call UUID : af399206-926f-11e4-8b6f-fd067af138be
*/