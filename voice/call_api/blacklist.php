<?php
    require 'vendor/autoload.php';
    use Plivo\Response;
    
    $from_number = $_REQUEST['From'];
    $caller = array('1111111111', '2222222222', '3333333333');

    $r = new Response();
    if (in_array($from_number, $caller))
    {
        $params = array(
            'reason' => 'rejected'
        );
        $r->addHangup($params);
    }
    else
    {
        $body = "Hello, from Plivo!";
        $r->addSpeak($body);
    }

    Header('Content-type: text/xml');
    echo($r->toXML());

/*
Sample output when From number is in blacklist
<Response>
    <Hangup reason="rejected"/>
</Response>

Sample Output when From number is not in blacklist
<Response>
    <Speak>Hello from Plivo</Speak>
</Response>
*/