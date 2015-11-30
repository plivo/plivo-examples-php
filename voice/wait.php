<?php
    require 'vendor/autoload.php';
    use Plivo\Response;

    $r = new Response();

    // Add Speak tag
    $body = "I will wait for 10 seconds";
    $r->addSpeak($body);

    // Add Wait tag
    $params = array(
        'length' => '10' # Time to wait in seconds
      );  

    $r->addWait($params);

    // Add Speak tag
    $body1 = "I just waited 10 seconds";
    $r->addSpeak($body1);

    Header('Content-type: text/xml');
    echo($r->toXML());

/*
Sample Wait XML
 <Response>
    <Speak>I will wait for 10 seconds</Speak>
    <Wait length="10" />
    <Speak>I just waited 10 seconds</Speak>
</Response>
*/

?>

<!-- Delayed answer -->

<?php
    require 'vendor/autoload.php';
    use Plivo\Response;
    
    $r = new Response();

    // Add Wait tag
    $params = array(
        'length' => '10' # Time to wait in seconds
      );  

    $r->addWait($params);

    // Add Speak tag
    $body = "Hello";
    $r->addSpeak($body);

    Header('Content-type: text/xml');
    echo($r->toXML());

/* 
Sample Wait XML
<Response>
    <Wait length="10" />
    <Speak>Hello</Speak>
</Response>
*/

?>

<!-- Beep detetion -->

<?php
    require 'vendor/autoload.php';
    use Plivo\Response;
    
    $r = new Response();

    // Add Wait tag
    $params = array(
        'length' => '10', # Time to wait in seconds
        'beep' =>'true' # Used to detect a voice mail machine.
      );  

    $r->addWait($params);

    // Add Speak tag
    $body = "Hello";
    $r->addSpeak($body);

    Header('Content-type: text/xml');
    echo($r->toXML());
/*
Sample Wait XML
<Response>
    <Wait length="10" beep="true" />
    <Speak>Hello</Speak>
</Response>
*/