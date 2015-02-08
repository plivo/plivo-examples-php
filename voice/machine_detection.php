<?php
    require_once "./plivo.php";
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    $params = array(
        'to' => '14155069431', # The phone numer to which the all has to be placed
        'from' => '18583650866', # The phone number to be used as the caller id
        'answer_url' => "https://glacial-harbor-8656.herokuapp.com/testing.php/detect", # The URL invoked by Plivo when the outbound call is answered
        'answer_method' => "GET", # The method used to call the answer_url
        'machine_detection' => "true", # Used to detect if the call has been answered by a machine. The valid values are true and hangup.
        'machine_detection_time' => "10000", # Time allotted to analyze if the call has been answered by a machine. The default value is 5000 ms.
        'machine_detection_url' => "https://glacial-harbor-8656.herokuapp.com/testing.php/machine_detect", # A URL where machine detection parameters will be sent by Plivo.
        'machine_detection_method' => "GET" # Method used to invoke machine_detection_url
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

    $app->map('/machine_detect', function() use ($app) {

        $from_number = $_REQUEST['From'];
        $to_number = $_REQUEST['To'];
        $machine = $_REQUEST['Machine'];
        $call_uuid = $_REQUEST['CallUUID'];
        $event = $_REQUEST['Event'];
        $call_status = $_REQUEST['CallStatus'];
        error_log("From = $from_number , To = $to_number , Machine = $machine , Call UUID = $call_uuid , Event = $event , Call Status = $call_status");
        echo "From = $from_number , To = $to_number , Machine = $machine , Call UUID = $call_uuid , Event = $event , Call Status = $call_status";

    })->name('machine_detect')->via('GET', 'POST');

    $app->map('/detect', function() use ($app) {

        $res = new \Slim\Http\Response();

        $r = new Response();

        // Add Wait tag
        $params = array(
            'length' => '1000',
            'silence' => 'true',
            'minSilence' => '3000'
        );
        $r->addWait($params);

        / Add Speak tag
        $body = "Hello voicemeail";
        $r->addSpeak($body);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        $app->response = $res;

    })->name('detect')->via('GET', 'POST');

    $app->run();

/*
Sample Output
<Response>
    <Wait length="10" silence="true" minSilence="500"/>
    <Speak>Hello Voicemail!</Speak>
</Response>

From = 1111111111 , To = 2222222222 , Machine = true , Call UUID = fee30404-aee9-11e4-a5d9-850813b6efc3 , Event = MachineDetection , Call Status = in-progress
*/

