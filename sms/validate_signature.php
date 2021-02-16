<?php
    require 'vendor/autoload.php';
    use Plivo\Util\signatureValidation;

    $auth_token = "Your_Auth_Token";
    $signature = $_SERVER["HTTP_X_PLIVO_SIGNATURE_V2"];
    $nonce = $_SERVER["HTTP_X_PLIVO_SIGNATURE_V2_NONCE"];
    
    $url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $uri = explode('?',$url);   
    $uri1 = $uri[0];    

    $SVUtil = new signatureValidation();
    $output = $SVUtil->validateSignature($uri1,$nonce,$signature,$auth_token);
    var_export($output);
    
    $from_number = $_REQUEST["From"];// Sender's phone numer
    $to_number = $_REQUEST["To"];// Receiver's phone number - Plivo number
    $text = $_REQUEST["Text"];// The SMS text message which was received
    
    echo("Message received from $from_number : $text");
?>