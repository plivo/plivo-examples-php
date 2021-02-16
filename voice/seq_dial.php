<?php
require 'vendor/autoload.php';

use Plivo\XML\Response;

$r = new Response();

$params = array(
    'timeout' => "20", # The duration (in seconds) for which the called party has to be given a ring.
    'action' => "https://example.com/dial_status.php" # Redirect to this URL after leaving Dial.
);

// Add Dial tag
$d = $r->addDial($params);
$number1 = "1111111111";
$d->addNumber($number1);

$d = $r->addDial();
$number2 = "2222222222";
$d->addNumber($number2);

Header('Content-type: text/xml');
echo ($r->toXML());

/*
Sample Output
<Response>
   <Dial timeout="20" action="https://example.com/dial_status/">
      <Number>1111111111</Number>
   </Dial>
   <Dial>
      <Number>2222222222</Number>
   </Dial>
</Response>
*/
