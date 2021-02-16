<form action="send_sms_from_browser.php" method="post">
    From No:<input type="text" name="From"><br><br>
    To&nbsp;&nbsp;&nbsp;&nbsp;No:<input type="text" name="To"><br><br>
    Message:<br>
    <textarea name="Text" rows="3" cols="30">Message Text</textarea><br><br>
    <input type="submit" value="Send SMS">
</form>

<?php
require 'vendor/autoload.php';

use Plivo\RestClient;

$to = $_POST['To'];
$from = $_POST['From'];
$text = $_POST['Text'];
echo "<br/>Sent Message info:<br/><br/>To: $to<br/>";
echo "From: $from  <br/>";
echo "Message: $text <br/>";
$client = new RestClient("auth_id", "auth_token");
$response = $client->messages->create(
    $from, // Sender's phone number with country code
    [$to], // receiver's phone number with country code
    $text, // Your SMS text message
    ["url" => "http://foo.com/sms_status/"],
);
print_r($response);
if (array_shift(array_values($response)) == "202") {
    echo "<br /><br />Message status: Sent";
} else {
    echo "<br /><br />Error: Please ensure that From number is a valid and sms feature enabled Plivo DID number";
}
?>