<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("auth_id", "auth_token");
$response = $client->messages->get('0936ec98-7c4c-11e4-9bd8-22000afa12b9'); # MessageUuid
print_r($response);
?>

<!--
Sample Output
( 
    [api_id] => 0a7cf0e6-a264-11e4-a2d1-22000ac5040c 
    [from_number] => 1111111111 
    [message_direction] => outbound 
    [message_state] => delivered 
    [message_time] => 2014-12-05 10:57:54+04:00 
    [message_type] => sms 
    [message_uuid] => 0936ec98-7c4c-11e4-9bd8-22000afa12b9 
    [resource_uri] => /v1/Account/XXXXXXXXXXXX/Message/0936ec98-7c4c-11e4-9bd8-22000afa12b9/ 
    [to_number] => 2222222222 
    [total_amount] => 0.02600 
    [total_rate] => 0.00650 
    [units] => 4
)
-->