<?php
require 'vendor/autoload.php';
use Plivo\Exceptions\PlivoValidationException;
use Plivo\Util\v3SignatureValidation;
use Plivo\XML\Response;

if (preg_match('/speak/', $_SERVER["REQUEST_URI"])) {
    $auth_token = "your_auth_token";
    $signature = @$_SERVER["X-Plivo-Signature-V3"] ?: 'signature';
    $nonce = @$_SERVER["X-Plivo-Signature-V3-Nonce"] ?: 'nonce';
    $url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $method = $_SERVER['REQUEST_METHOD'];
    $SVUtil = new v3SignatureValidation();
    if ($method == "GET") {
        try {
            $valid = $SVUtil->validateV3Signature($method, $url, $nonce, $auth_token, $signature);
        } catch (PlivoValidationException $e) {
            echo("error");
        }
    } else {
        $body = file_get_contents("php://input");
        $params = json_decode($body, true);
        try {
            $valid = $SVUtil->validateV3Signature($method, $url, $nonce, $auth_token, $signature, $params);
        } catch (PlivoValidationException $e) {
            echo("error");
        }
    }
    echo $valid;
    $body = 'Hi, Calling from Plivo';
    $attributes = array(
        'loop' => 3,
    );
    $r = new Response();
    $r->addSpeak($body, $attributes);
    echo($r->toXML());
} else {
    echo "<p>Welcome to Plivo</p>";
}