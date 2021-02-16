<?php
require 'vendor/autoload.php';

use Plivo\Response;

$r = new Response();

//Add Speak tag
$body = "Please wait while your call is being transferred";

$r->addSpeak($body);

// Add Redirect tag
$redirect = "https://example.com/connect.php";

$r->addRedirect($redirect);

Header('Content-type: text/xml');
echo ($r->toXML());

?>

<!--connect.php-->

<?php
require 'vendor/autoload.php';

use Plivo\Response;

$r = new Response();

// Add Speak tag
$body = "Connecting your call..";
$attributes = array(
    'action' => "https://example.com/dial_status.php", # Redirect to this URL after leaving Dial. 
    'method' => "GET", # Submit to action URL using GET or POST.
    'redirect' => "true" # If set to false, do not redirect to action URL. The call will be controlled based on the XML returned from the action URL.
);

$r->addSpeak($body);

// Add Dial tag
$d = $r->addDial($attributes);
$number = "11111111111";
$d->addNumber($number);

Header('Content-type: text/xml');
echo ($r->toXML());

/*
Sample Output
<Response>
   <Speak>Please wait while your call is being transferred</Speak>
   <Redirect>https://glacial-harbor-8656.herokuapp.com/testing.php/connect</Redirect>
</Response>

<Response>
   <Speak>Connecting your call..</Speak>
   <Dial action="https://morning-ocean-4669.herokuapp.com/dial_status/" method="GET" redirect="true">
      <Number>11111111111</Number>
   </Dial>
</Response>
*/