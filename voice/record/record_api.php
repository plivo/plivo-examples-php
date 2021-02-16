<?php

require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;

$client = new RestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");

# To record a call
try {
    $response = $client->calls->startRecording(
        'eba53b9e-8fbd-45c1-9444-696d2172fbc8', # ID of the call
        [
            'time_limit' => '40', # Max recording duration in seconds
            'callback_url' => "https://example.com/record_action/", # The URL invoked by the API when the recording ends
            'callback_method' => "GET", # The method which is used to invoke the callback_url
            'transcriptionType' => 'auto', # The type of transcription required
            'transcriptionUrl' => "https://example.com/transcription/", # The URL where the transcription while be sent from Plivo
            'transcriptionMethod' => 'GET' # The method used to invoke transcriptionUrl 
        ]
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

# To stop recording a call

try {
    $response = $client->calls->stopRecording(
        'eba53b9e-8fbd-45c1-9444-696d2172fbc8' # ID of the call.
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

# To record a conference call

try {
    $response = $client->conferences->startRecording(
        'My conference' #Name of the conference.
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

# To stop recording a conference call

try {
    $response = $client->conferences->stopRecording(
        'My conference'
    );
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}
