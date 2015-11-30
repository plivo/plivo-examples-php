<?php
    require 'vendor/autoload.php';

    $auth_token = "Your AUTH_TOKEN";

    $signature = $_SERVER["HTTP_X_PLIVO_SIGNATURE"];

    $url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    $uri = explode('?',$url);
    $uri1 = $uri[0];    
    
    $parse = parse_url($url,PHP_URL_QUERY);

    parse_str($parse, $get_array);

    $post_params = $_POST;
    $array = array_merge($get_array,$post_params);

    $valid = validate_signature($uri1,$array,$signature,$auth_token);
    // echo $valid;

    // Generate a Speak XML with the details of the text to play on the call.
    $body = 'Hi, Calling from Plivo';
    $attributes = array (
    'loop' => 2,
    );

    $r = new Response(); 

    // Add speak element
    $r->addSpeak($body,$attributes);

    Header('Content-type: text/xml');
    echo($r->toXML());
?>