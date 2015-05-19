<?php
    require_once "./plivo.php";


    # Generate a Record XML
    $r = new Response(); 

    $record_params = array(
        'action'=> 'https://example.com/record_action', # Submit the result of the record to this URL
        'method' => 'GET', # HTTP method to submit the action URL
        'callbackUrl' => 'https://example.com/recording_callback', # If set, this URL is fired in background when the recorded file is ready to be used.
        'callbackMethod' => 'GET' # Method used to notify the callbackUrl.
    );

    $r->addRecord($record_params);
    Header('Content-type: text/xml');
    echo($r->toXML());  
?>

<!--record_action.php-->

<?php
    # Action URL Example

    $record_url = $_REQUEST['RecordUrl'];
    $record_duration = $_REQUEST['RecordingDuration'];
    $record_id = $_REQUEST['RecordingID'];
    print("Record URL : $record_url");
    print("Recording Duration : $record_duration");
    print("Recording ID : $record_id");

?>

<!--recording_callback.php-->

<?php

    # Callback URL Example
    $record_url = $_REQUEST['record_url'];
    $record_duration = $_REQUEST['recording_duration'];
    $record_id = $_REQUEST['recording_id'];
    print("Record URL : $record_url");
    print("Recording Duration : $record_duration");
    print("Recording ID : $record_id");


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