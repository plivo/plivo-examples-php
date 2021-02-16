<?php
require 'vendor/autoload.php';

use Plivo\Response;

$r = new Response();

// Generate a Hangup XML
$params = array(
    'reason' => 'busy', # Specify the reason for hangup
    'schedule' => '60' # Schedule the hangup
);

$body = "This call will be hung up in 1 minute";
$r->addSpeak($body);
$r->addHangup($params);

Header('Content-type: text/xml');
echo ($r->toXML());

/*
Sample Output
<Response>
   <Speak>This call will be hung up in 1 minute</Speak>
   <Hangup reason="busy" schedule="60" />
</Response>
*/
