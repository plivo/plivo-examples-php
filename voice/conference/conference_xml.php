<?php
require 'vendor/autoload.php';

use Plivo\Response;

$r = new Response();

$body = "You will now be placed into a demo conference. This is brought to you by Plivo. To know more visit us at plivo.com";
$r->addSpeak($body);

$params = array(
    'enterSound' => "beep:2", # Used to play a sound when a member enters the conference
    'record' => "true", # Option to record the call
    'action' => "https://example.com/conf_action.php", # URL to which the API can send back parameters
    'method' => "GET", # method to invoke the action Url
    'record' => "true", # Option to record the call 
    'callbackUrl' => "https://example.com/conf_callback.php", # If specified, information is sent back to this URL
    'callbackMethod' => "GET", # Method used to notify callbackUrl
    # For moderated conference
    'startConferenceOnEnter' => "true", # When a member joins the conference with this attribute set to true, the conference is started.
    # If a member joins a conference that has not yet started, with this attribute value set to false, 
    # the member is muted and hears background music until another member joins the conference
    'endConferenceOnExit' => "true" # If a member with this attribute set to true leaves the conference, the conference ends and all 
    # other members are automatically removed from the conference. 
);

$conference_name = "demo";
$r->addConference($conference_name, $params);

Header('Content-type: text/xml');
echo ($r->toXML());

?>

<!--conf_action.php-->

<?php

$conf_name = $_REQUEST['ConferenceName'];
$conf_uuid = $_REQUEST['ConferenceUUID'];
$conf_mem_id = $_REQUEST['ConferenceMemberID'];
$record_url = $_REQUEST['RecordUrl'];
$record_id = $_REQUEST['RecordingID'];

error_log("Conference Name : $conf_name, Conference UUID : conf_uuid, Conference Member ID : conf_mem_id, Record URL : $record_url, Record ID : $record_id");
echo "Conference Name : $conf_name, Conference UUID : conf_uuid, Conference Member ID : conf_mem_id, Record URL : $record_url, Record ID : $record_id";

?>

<!--conf_callback.php-->

<?php

$conf_action = $_REQUEST['ConferenceAction'];
$conf_name = $_REQUEST['ConferenceName'];
$conf_uuid = $_REQUEST['ConferenceUUID'];
$conf_mem_id = $_REQUEST['ConferenceMemberID'];
$call_uuid = $_REQUEST['CallUUID'];
$record_url = $_REQUEST['RecordUrl'];
$record_id = $_REQUEST['RecordingID'];

error_log("Conference Action : $conf_action, Conference Name : $conf_name, Conference UUID : conf_uuid, 
        Conference Member ID : conf_mem_id, Call UUID : $call_uuid, Record URL : $record_url, Record ID : $record_id");
echo "Conference Action : $conf_action, Conference Name : $conf_name, Conference UUID : conf_uuid, 
        Conference Member ID : conf_mem_id, Call UUID : $call_uuid, Record URL : $record_url, Record ID : $record_id";


/*
Sample Output
<Response>
   <Speak>You will now be placed into a demo conference. This is brought to you by Plivo. To know more visit us at plivo.com</Speak>
   <Conference enterSound="beep:2" record="true" action="https://glacial-harbor-8656.herokuapp.com/testing.php/response/conf_action" method="GET" callbackUrl="https://glacial-harbor-8656.herokuapp.com/testing.php/response/conf_callback" callbackMethod="GET" startConferenceOnEnter="true" endConferenceOnExit="true">demo</Conference>
</Response>

Conference Name : demo, Conference UUID : 97cb91e8-af6e-11e4-8e67-377ffe01233f, Conference Member ID : 1129, 
Record URL : http://s3.amazonaws.com/recordings_2013/9792115c-vvvv-11e4-a664-0026b945b52b.mp3, Record ID : 9792115c-af6e-11e4-a664-0026b945b52b

Conference Action : enter, Conference Name : demo, Conference UUID : 97cb91e8-af6e-11e4-8e67-377ffe01233f, 
Conference Member ID : 1130, Call UUID : 8bd540aa-af6e-11e4-87a9-377ffe01233f, 
Record URL : http://s3.amazonaws.com/recordings_2013/9792115c-wwww-11w4-a664-0026b945b52b.mp3, Record ID : 9792115c-af6e-11e4-a664-0026b945b52b
*/