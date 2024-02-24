<?php 

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

$ch = curl_init();

$parameters = array(
    'apikey' => 'e086e40b39907c02b824c2524b972255', //Your API KEY
    'number' => $number,
    'message' => $message,
    'sendername' => 'SEMAPHORE'
);
curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/priority' ); // https://semaphore.co/api/v4/messages
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
