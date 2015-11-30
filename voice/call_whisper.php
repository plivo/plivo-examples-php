<?php
    require 'vendor/autoload.php';
    use Plivo\Response;

    $r = new Response(); 

    $params = array(
        'confirmSound' => 'https://example.com/confirm_sound.php', 
        # A remote URL fetched with POST HTTP request which must return an XML response with Play, Wait and/or Speak elements only
        'confirmKey' => '5' # The digit to be pressed by the called party to accept the call.
    );

    // Add Dial tag
    $d = $r->addDial($params);
    $number1 = "11111111111";
    $d->addNumber($number1);
    $number2 = "2222222222";
    $d->addNumber($number2);
    $number3 = "abcd1234@phone.plivo.com<";
    $d->addUser($number3);

    Header('Content-type: text/xml');
    echo($r->toXML());
?>

<!-- confirm_sound.php-->
<?php   
    require 'vendor/autoload.php';
    use Plivo\Response;

    $r = new Response(); 

    $body = "Press 5 to answer the call";

    //Add Speak tag
    $r->addSpeak($body);

    Header('Content-type: text/xml');
    echo($r->toXML());

/*
Sample Output
<Response>
    <Dial confirmSound=https://glacial-harbor-8656.herokuapp.com/testing.php/confirm_sound confirmKey=5>
        <Number>1111111111</Number>
        <Number>2222222222</Number>
        <User>sip:abcd1234@phone.plivo.com</User>
    </Dial>
</Response>

<Response>
    <Speak>Press 5 to answer the call</Speak>
</Response>
*/