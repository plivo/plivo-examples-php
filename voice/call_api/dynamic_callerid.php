<?php
    require 'vendor/autoload.php';
    use Plivo\Response;

    # Set te caller ID using Dial XML

    $r = new Response();

    // Generate a Dial XML ans set the caller ID
    $params = array(
            'callerId' => '1111111111' # Caller ID
        );

    $d = $r->addDial($params);
    $number = '2222222222';
    $d->addNumber($number);

    Header('Content-type: text/xml');
    echo($r->toXML());

/*
Sample successful output
<Response>
    <Dial callerId="1111111111">
        <Number>2222222222</Number>
    </Dial>
</Response>
*/
?>

<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    # Set the caller ID using Call API

    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    $params = array(
        'to' => '14155069431', # The phone numer to which the all has to be placed
        'from' => '18583650866', # The phone number to be used as the caller id
        'answer_url' => "https://example.com/detect", # The URL invoked by Plivo when the outbound call is answered
        'answer_method' => "GET", # The method used to call the answer_url
    );

    $response = $p->make_call($params);
    print_r ($response);

/* Sample Output
( 
    [status] => 201 
    [response] => Array ( 
        [api_id] => 32cba792-ae01-11e4-b153-22000abcaa64 
        [message] => call fired 
        [request_uuid] => 5b2db3d3-f478-4b63-992c-e47c527572e8 
)
*/ 
?>       