<?php

require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
try {
    $response = $client->calls->create(
        '+14151234567', # The phone number to be used as the caller id
        ['+15671234567<15671234891'], # The phone numer to which the all has to be placed
        'http://s3.amazonaws.com/static.plivo.com/answer.xml', # The URL invoked by Plivo when the outbound call is answered
        'GET', # The method used to call the answer_url
        [
            'sip_headers' => "Test=Sample", # List of SIP headers in the form of 'key=value' pairs, separated by commas.   
        ]
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

/* Sample Output
(
    [requestUuid:protected] => 2d7fb6f1-76ec-42f8-a935-bde99c5fc3b0
    [_message] => call fired
    [apiId] => 75fb7714-7046-11eb-9c7a-0242ac110006
    [statusCode] => 201
)

    The SIP header can be seen as a query parameter in the answer_url
    path="/answer.xml?Direction=outbound&From=18583650866&ALegUUID=6e699c0a-af55-11e4-91ce-377ffe01233f&BillRate=0.03570&
    To=11111111111&X-PH-Test=Sample&CallUUID=6e699c0a-af55-11e4-91ce-377ffe01233f&ALegRequestUUID=b1c64cdd-cecc-43a7-bc5b-cbcbb8988c8d&
    RequestUUID=b1c64cdd-cecc-43a7-bc5b-cbcbb8988c8d&CallStatus=in-progress&Event=StartApp" 
    host=glacial-harbor-8656.herokuapp.com request_id=213e871a-50cb-4d46-a95f-0c5e8113504e fwd="184.169.163.156" 
    dyno=web.1 connect=0ms service=14ms status=200 bytes=314

    */
