<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    use Plivo\Response;

    $auth_token = "Your AUTH_TOKEN";

    $signature = $_SERVER["HTTP_X_PLIVO_SIGNATURE"];

    $url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    $uri = explode('?',$url);
    $uri1 = $uri[0];

    $parse = parse_url($url,PHP_URL_QUERY);

    parse_str($parse, $get_array);

    $post_params = $_POST;
    $array = array_merge($get_array,$post_params);

    $valid = RestAPI::validate_signature($uri1,$array,$signature,$auth_token);
    $valid_message = "Signature is " . ($valid ? "" : "not ") . "valid.";

    // Report signature validity to web server log
    error_log($valid_message);

    if ($valid) {
        // Signature is valid
        $r = new Response();

        // Generate a Speak XML with the details of the text to play on the call.
        $body = 'Hi, Calling from Plivo';

        // Add speak element
        $r->addSpeak($valid_message);

        Header('Content-type: text/xml');
        echo($r->toXML());
    } else {
        // Signature is invalid
        error_log("Error! Something is wrong. Please check!");
    }
?>