<?php
require 'vendor/autoload.php';

use Plivo\Response;
use Plivo\XML\Response;

$from_number = $_REQUEST['From'];
$callers = array(
    '1111111111' => 'ABCDEF',
    '2222222222' => 'VWXYZ',
    '3333333333' => 'QWERTY'
);

$r = new Response();

if (array_key_exists($from_number, $callers)) {
    $body = "Hello {$callers[$from_number]}";
    $r->addSpeak($body);
} else {
    $body = "Hello Stranger!";
    $r->addSpeak($body);
}

Header('Content-type: text/xml');
echo ($r->toXML());

/*
Sample Output
<Response>
    <Speak>Hello,ABCDEF</Speak>
</Response>
*/