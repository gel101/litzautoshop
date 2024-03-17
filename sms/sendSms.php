<?php

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use Twilio\Rest\Client;

require_once "../vendor/autoload.php";
// require __DIR__ . "./vendor/autoload.php";

$msg = $error = $number = $message = $provider = "";
$valid = true;

if (isset($_POST["number"])) {
    $number = $_POST["number"];
}
if (isset($_POST["message"])) {
    $message = $_POST["message"];
}
if (isset($_POST["provider"])) {
    $provider = $_POST["provider"];
}

try {

    if ($provider === "infobip") {

        $base_url = "https://n8q2py.api.infobip.com";
        $api_key = "31442a24dd91fa5b98fffa33c6a1662e-05079b51-8a32-4124-8e86-3a5b424c3581";

        $configuration = new Configuration(host: $base_url, apiKey: $api_key);

        $api = new SmsApi(config: $configuration);

        $destination = new SmsDestination(to: $number);


            $message = new SmsTextualMessage(
                destinations: [$destination],
                text: $message,
                from: "Litz Autoshop"
            );
        
            $request = new SmsAdvancedTextualRequest(messages: [$message]);

            $response = $api->sendSmsMessage($request);
            


            $msg = array("valid" => true, "msg" => "Infobip: Sms Sent Successfully!");
            echo json_encode($msg);
            exit;


    }

    if ($provider === "twilio") {

        $account_id = "AC7fa287732f9f6ba422e069d598b6b004";
        $auth_token = "86c838edf8cdc57cd16593897799d2a6";

        $client = new Client($account_id, $auth_token);

        $twilio_number = "+12015968273";

            // Send the SMS
            $client->messages->create(
                $number,
                [
                    "from" => $twilio_number,
                    "body" => $message
                ]
            );

            $msg = array("valid" => true, "msg" => "Twilio: Sms Sent Successfully!");
            echo json_encode($msg);
            exit;


    }

    if ($provider === "semaphore") {
        
        $ch = curl_init();

            $parameters = array(
                'apikey' => 'e086e40b39907c02b824c2524b972255', //Your API KEY
                'number' => $number,
                'message' => $message,
                'sendername' => 'LitzAuto'
            );
            curl_setopt( $ch, CURLOPT_URL,'https://api.semaphore.co/api/v4/priority' ); // https://semaphore.co/api/v4/messages
            curl_setopt( $ch, CURLOPT_POST, 1 );
            
            //Send the parameters set above with the request
            curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
            
            // Receive response from server
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $output = curl_exec( $ch );
            curl_close ($ch);
            
            //Show the server response
            echo $output;
            
            $msg = array("valid" => true, "msg" => "Semaphore: Sms Sent Successfully!");
            echo json_encode($msg);
            exit;
    }
    
    // echo "Code Execute!";

} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
    echo json_encode($msg);
}


        // Code for sending a data from other page to this page


		// // Now, initiate an HTTP request to sms.php with the required data
		// $smsData = array(
		// 	'number' => $pNum,      // Assuming $pNum is the phone number you want to send SMS to
		// 	'message' => 'Your custom message here',
		// 	'provider' => 'infobip'
		// );
		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, 'http://localhost/newgarage/sms/sendsms.php'); // Change this to your actual URL
		// curl_setopt($ch, CURLOPT_POST, 1);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($smsData));
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $response = curl_exec($ch);
		// curl_close($ch);

		// // You can handle the response from sms.php if needed
		// // $smsResponse = json_decode($response, true);
		// // Handle $smsResponse...