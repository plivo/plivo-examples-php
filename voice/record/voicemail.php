<?php
    require_once "./plivo.php";
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    # Generate a Record XML and ask the caller to leave a message

    $app->map('/voicemail', function() use ($app) {

        $res = new \Slim\Http\Response();
        $r = new Response();

        # The recorded file will be sent to the 'action' URL
        $record_params = array(
            'action'=> 'https://glacial-harbor-8656.herokuapp.com/testing.php/record_action', # Submit the result of the record to this URL
            'method' => 'GET', # HTTP method to submit the action URL
            'maxLength'=> '30', # Maximum number of seconds to record 
            'transcriptionType' => 'auto', # The type of transcription required
            'transcriptionUrl' => 'https://glacial-harbor-8656.herokuapp.com/testing.php/transcription', # The URL where the transcription while be sent from Plivo
            'transcriptionMethod' => 'GET' # The method used to invoke transcriptionUrl 
        );

        $r->addSpeak("Leave your message after the tone");
        $r->addRecord($record_params);

        $res->headers->set('Content-Type', 'text/xml');
        $res->setBody($r->toXML());
        error_log($r->toXML());
        $app->response = $res; 

    })->name('voicemail')->via('GET','POST');

    # Action URL Example
    $app->map('/record_action', function() use ($app) {

        $record_url = $_REQUEST['RecordUrl'];
        $record_duration = $_REQUEST['RecordingDuration'];
        $record_id = $_REQUEST['RecordingID'];
        error_log("Record URL : $record_url");
        error_log("Recording Duration : $record_duration");
        error_log("Recording ID : $record_id");

    })->name('record_action')->via('GET','POST');

    # Transcription URL Example
    $app->map('/transcription', function() use ($app) {

        $transcription = $_REQUEST['transcription'];
        error_log("Transcription is : $transcriptions ");

    })->name('transcription')->via('GET','POST');

    $app->run();

/*
Sample Output
<Response>
    <Speak>Leave your message after the tone</Speak>
    <Record action="https://glacial-harbor-8656.herokuapp.com/testing.php/record_action" method="GET" maxLength="30" transcriptionType="auto" transcriptionUrl="https://glacial-harbor-8656.herokuapp.com/testing.php/transcription" transcriptionMethod="GET"/>
</Response>

Record URL : https://s3.amazonaws.com/recordings_2013/4cc6dafe-bc0c-11e4-9dc1-842b2b096c5d.mp3
Recording Duration : 4
Recording ID : 4cc6dafe-bc0c-11e4-9dc1-842b2b096c5d

Transcription is : Hello
*/