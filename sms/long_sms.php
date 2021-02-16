<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);
    
    // Send a message
    $params = array(
            'src' => '1111111111', # Sender's phone number
            'dst' => '2222222222', # Receiver's phone Number
            # Long text in English
            'text' => 'This randomly generated text can be used in your layout (webdesign , websites, books, posters ... ) for free. This text is entirely free of law. Feel free to link to this site by using the image below or by making a simple text link'
            # Long text in Japanese
            #'text' => "このランダムに生成されたテキストは、自由のためのあなたのレイアウト（ウェブデザイン、ウェブサイト、書籍、ポスター...）で使用することができます。このテキストは、法律の完全に無料です。下の画像を使用して、または単純なテキストリンクを作ることで、このサイトへのリンクフリーです"
            # Long text in French        
            #'text' => "Ce texte généré aléatoirement peut-être utilisé dans vos maquettes (webdesign, sites internet,livres, affiches...) gratuitement. Ce texte est entièrement libre de droit. N'hésitez pas à faire un lien sur ce site en utilisant l'image ci-dessous ou en faisant un simple lien texte"
        );
    $response = $p->send_message($params);

    // Print the response
    print_r ($response['response']);

    // Print the Message UUID
    $uuid = $response['response']['message_uuid'][0];
    print $uuid;

    $params = array(
            'record_id' => $uuid // The Message UUID
        );

    // To get the SMS split units
    $r = new RestAPI($auth_id, $auth_token);
    $response = $r->get_message($params);
    $units = $response['response']['units'];

    // Print the response
    print "Your sms was split into : {$units} units";

?>

<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("auth_id", "auth_token");
$response = $client->messages->create(
 '+14152223333', // Sender's phone number with country code
  ['+14152223333'], // receiver's phone number with country code
  # Long text in English
  'This randomly generated text can be used in your layout (webdesign , websites, books, posters ... ) for free. This text is entirely free of law. Feel free to link to this site by using the image below or by making a simple text link',
  # Long text in Japanese
//   "このランダムに生成されたテキストは、自由のためのあなたのレイアウト（ウェブデザイン、ウェブサイト、書籍、ポスター...）で使用することができます。このテキストは、法律の完全に無料です。下の画像を使用して、または単純なテキストリンクを作ることで、このサイトへのリンクフリーです"
  # Long text in French        
//   "Ce texte généré aléatoirement peut-être utilisé dans vos maquettes (webdesign, sites internet,livres, affiches...) gratuitement. Ce texte est entièrement libre de droit. N'hésitez pas à faire un lien sur ce site en utilisant l'image ci-dessous ou en faisant un simple lien texte"
  ["url"=>"http://foo.com/sms_status/"],
);
print_r($response);
?>

<!--
Sample Output
(
    [messageUuid:protected] => Array
        (
            [0] => a3ade4da-7028-11eb-9c24-0242ac110004
        )

    [_message] => message(s) queued
    [apiId] => a3a826a8-7028-11eb-9c24-0242ac110004
    [statusCode] => 202
)
-->