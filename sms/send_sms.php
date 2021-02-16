<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("auth_id", "auth_token");
$response = $client->messages->create(
 '+14152223333', // Sender's phone number with country code
  ['+14152223333'], // receiver's phone number with country code
  "Hello, this is a sample text", // Your SMS text message
   // 'こんにちは、元気ですか？' # Your SMS Text Message - Japanese
   // 'Ce est texte généré aléatoirement' # Your SMS Text Message - French
  ["url"=>"http://foo.com/sms_status/"],
);
print_r($response);
?>

<!--
Sample Output
(
    [messageUuid:protected] => Array
        (
            [0] => a3ade4da-7028-11eb-9c24-0242ac110004
        )

    [_message] => message(s) queued
    [apiId] => a3a826a8-7028-11eb-9c24-0242ac110004
    [statusCode] => 202
)
-->
