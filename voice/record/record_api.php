<?php
    require_once "./plivo.php";
    $auth_id = "Your AUTH_ID";
    $auth_token = "Your AUTH_TOKEN";

    $p = new RestAPI($auth_id, $auth_token);

    # To record a call

    $params = array(
        'call_uuid' => "xxxxxxxxxxx", # ID of the call
        'time_limit' => '40', # Max recording duration in seconds
        'callback_url' => "https://glacial-harbor-8656.herokuapp.com/testing.php/record_action/", # The URL invoked by the API when the recording ends
        'callback_method' => "GET", # The method which is used to invoke the callback_url
        'transcriptionType' => 'auto', # The type of transcription required
        'transcriptionUrl' => "https://glacial-harbor-8656.herokuapp.com/testing.php/transcription/", # The URL where the transcription while be sent from Plivo
        'transcriptionMethod' => 'GET' # The method used to invoke transcriptionUrl 
    );

    $resp = $p->record($params);
    print_r($resp);

    # To stop recording a call

    $params = array(
        'call_uuid' => "xxxxxxxxxxx", # ID of the call
    );

    $resp = $p->stop_record($params);
    print_r($resp);  

    # To record a conference call

    $params = array(
        'conference_name' => "demo", # The conference name
        'callback_url' => "https://glacial-harbor-8656.herokuapp.com/testing.php/record_action/", # The URL invoked by the API when the recording ends  
        'callback_method' => "GET" # The method which is used to invoke the callback_url
    );

    $resp = $p->record_conference($params);
    print_r($resp);

    # To stop recording a conference call

    $params = array(
        'conference_name' => "demo", # The conference name
    );

    $resp = $p->stop_record_conference($params);
    print_r($resp);