<?php
require 'vendor/autoload.php';

use Plivo\XML\Response;

// Generate a Play XML with the details of the audio file to play on the call.
$body = "https://s3.amazonaws.com/plivocloud/Trumpet.mp3";

$r = new Response();

// Add Play element
$r->addPlay($body);

Header('Content-type: text/xml');
echo ($r->toXML());

/*
Sample Output
<Response>
    <Play>https://s3.amazonaws.com/plivocloud/Trumpet.mp3</Play>
</Response>
*/