<?php
    require 'vendor/autoload.php';
    use Plivo\Response;

    $r = new Response(); 

    $params = array(
        'dialMusic' => 'https://example.com/custom_tone.php' # Music to be played to the caller while the call is being connected. 
    );

    // Add Dial tag
    $d = $r->addDial($params);
    $number = "1111111111";
    $d->addNumber($number);

    Header('Content-type: text/xml');
    echo($r->toXML());

?>

<!--custom_tone.php-->

<?php
    
    require 'vendor/autoload.php';
    use Plivo\Response;

    $r = new Response(); 

    $body = "https://s3.amazonaws.com/plivocloud/music.mp3";

    // Add Play tag
    $r->addPlay($body);

    Header('Content-type: text/xml');
    echo($r->toXML());

    
/*
Sample Output
<Response>
    <Dial dialMusic="https://glacial-harbor-8656.herokuapp.com/testing.php/custom_tone">
        <Number>1111111111</Number>
    </Dial>
</Response>

<Response>
    <Play>https://s3.amazonaws.com/plivocloud/music.mp3</Play>
</Response>
*/