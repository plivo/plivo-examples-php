<form action="send_sms_from_browser.php" method="post">
From No:<input type="text" name="From"><br><br>
To&nbsp;&nbsp;&nbsp;&nbsp;No:<input type="text" name="To"><br><br>
Message:<br>
<textarea name="Text" rows="3" cols="30" >Message Text</textarea><br><br>
<input type="submit" value="Send SMS">
</form> 

<?php
    require 'vendor/autoload.php';
    use Plivo\RestAPI;
    $to = $_POST['To'];
    $from = $_POST['From'];
    $text = $_POST['Text'];
    echo "<br/>Sent Message info:<br/><br/>To: $to<br/>";
    echo "From: $from  <br/>";
    echo "Message: $text <br/>";
    $auth_id = <"Your AUTHID">;
    $auth_token = <"Your AUTHTOKEN">;

    $p = new RestAPI($auth_id, $auth_token);


    // Send a message
    $params = array(
            'src' => "$from",
            'dst' => "$to",
            'text' => "$text",
            'type' => 'sms',
        );
    $response = $p->send_message($params);
    echo $response[0];
    if (array_shift(array_values($response)) == "202")
    {
        echo "<br/><br/>Message status: Sent";
    }
    else
    {
        echo "<br/><br/>Error: Please ensure that From number is a valid and sms feature enabled Plivo DID number";
    }
?>
