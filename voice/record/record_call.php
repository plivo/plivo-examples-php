<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    # Generate a Record XML
    $app->map('/record', function() use ($app) {

        $res = new \Slim\Http\Response();
        $r = new Response(); 

        $record_params = array(
            'action'=> 'https://glacial-harbor-8656.herokuapp.com/testing.php/record_action', # Submit the result of the record to this URL
            'method' => 'GET', # HTTP method to submit the action URL
            'callbackUrl' => 'https://glacial-harbor-8656.herokuapp.com/testing.php/recording_callback', # If set, this URL is fired in background when the recorded file is ready to be used.
            'callbackMethod' => 'GET' # Method used to notify the callbackUrl.
        );

        $r->addRecord($record_params);
        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        print($r->toXML());
        $app->response = $res;      

    })->name('record')->via('GET','POST');

    # Action URL Example
    $app->map('/record_action', function() use ($app) {

        $record_url = $_REQUEST['RecordUrl'];
        $record_duration = $_REQUEST['RecordingDuration'];
        $record_id = $_REQUEST['RecordingID'];
        print("Record URL : $record_url");
        print("Recording Duration : $record_duration");
        print("Recording ID : $record_id");

    })->name('record_action')->via('GET','POST');

    # Callback URL Example
    $app->map('/recording_callback', function() use ($app) {

        $record_url = $_REQUEST['record_url'];
        $record_duration = $_REQUEST['recording_duration'];
        $record_id = $_REQUEST['recording_id'];
        print("Record URL : $record_url");
        print("Recording Duration : $record_duration");
        print("Recording ID : $record_id");

    })->name('recording_callback')->via('GET','POST');

    $app->run();

/*
Sample Output
<Response>
    <Record action="https://glacial-harbor-8656.herokuapp.com/testing.php/record_action" method="GET" 
        callbackUrl="https://glacial-harbor-8656.herokuapp.com/testing.php/recording_callback" callbackMethod="GET"/>
</Response>

Sample output for Action URL
Record URL : http://s3.amazonaws.com/recordings_2013/11111111-5555-6666-2222-999944421718.mp3 
Recording Duration : 8 
Recording ID : a34d252c-94b1-11e4-ab5e-842b2b021718

Sample output for Callback URL
Record URL : http://s3.amazonaws.com/recordings_2013/11111111-5555-6666-2222-999944421718.mp3 
Recording Duration : 8 
Recording ID : a34d252c-94b1-11e4-ab5e-842b2b021718
*/