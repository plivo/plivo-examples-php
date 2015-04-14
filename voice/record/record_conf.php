<?php
    require_once "./plivo.php";

    # Generates a Conference XML
    $r = new Response();

    $params = array(
    'enterSound' => "beep:1", # Used to play a sound when a member enters the conference
    'callbackUrl' => "https://example.com/conf_callback.php", # If specified, information is sent back to this URL
    'callbackMethod' => "GET" # Method used to notify callbackUrl
    );

    $name = "demo";
    $r->addSpeak("You will now be placed into a demo conference. This is brought to you by Plivo. To know more visit us at plivo.com");
    $r->addConference($name,$params);
    
    Header('Content-type: text/xml');
    echo($r->toXML());

?>

<!--conf_callback.php-->

<?php
    require_once "./plivo.php";

    # Record API is called in the callback URL to record the conference
    
    $conf_name = $_REQUEST['ConferenceName'];
    $event = $_REQUEST['Event'];
    print("Conference Name : $conf_name");
    print("Event : $event");

    # The recording starts when the user enters the conference room
    if ($event == "ConferenceEnter")
    {
        $auth_id = "Your AUTH_ID";
        $auth_token = "Your AUTH_TOKEN";

        $p = new RestAPI($auth_id, $auth_token);
        $params = array(
            'conference_name' => $conf_name # Name of the conference
        );
        $resp = $p->record_conference($params);
        print("URL : {$resp['response']['url']}");
        print("Recording ID : {$resp['response']['recording_id']}");
        print("API ID : {$resp['response']['api_id']}");
        print("Message : {$resp['response']['message']}");
    }
    else
    {
        print("invalid");
    }

/*
Sample Output

<Response>
    <Speak>
        You will now be placed into a demo conference. This is brought to you by Plivo. To know more visit us at plivo.com
    </Speak>
    <Conference enterSound="beep:1" callbackUrl="https://glacial-harbor-8656.herokuapp.com/testing.php/conf_callback" callbackMethod="GET">demo</Conference>
</Response>

Recording ID : c37e5efc-bc10-11e4-81a4-0026b93d8e7c
Message : conference recording started
URL : https://s3.amazonaws.com/recordings_2013/c37e5efc-bc12-11e4-81a4-0026b93d8e7c.mp3
API ID : c37155fe-bc10-11e4-ac1f-22000ac51de6

*/