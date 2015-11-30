<?php
    require 'vendor/autoload.php';
    use Plivo\Response;

    # Generate a Record XML and ask the caller to leave a message
    $r = new Response();

    # The recorded file will be sent to the 'action' URL
    $record_params = array(
        'action'=> 'https://example.com/record_action.php', # Submit the result of the record to this URL
        'method' => 'GET', # HTTP method to submit the action URL
        'maxLength'=> '30', # Maximum number of seconds to record 
        'transcriptionType' => 'auto', # The type of transcription required
        'transcriptionUrl' => 'https://example.com/transcription.php', # The URL where the transcription while be sent from Plivo
        'transcriptionMethod' => 'GET' # The method used to invoke transcriptionUrl 
    );

    $r->addSpeak("Leave your message after the tone");
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
    echo("Record URL : $record_url");
    echo("Recording Duration : $record_duration");
    echo("Recording ID : $record_id");

?>

<!--transcription.php-->

<?php
    # Transcription URL Example
    $transcription = $_REQUEST['transcription'];
    echo("Transcription is : $transcription ");


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