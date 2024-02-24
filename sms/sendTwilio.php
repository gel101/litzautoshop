<?php

// Include the Twilio PHP library
require_once "../vendor/autoload.php";
use Twilio\Rest\Client;



// Twilio credentials
$accountSid = 'AC7fa287732f9f6ba422e069d598b6b004';
$authToken  = '86c838edf8cdc57cd16593897799d2a6';
$twilioNumber = '+12015968273';

// Recipient's phone number
$recipientNumber = '09106556395';

// Message to be sent
$message = 'Test';

// Initialize Twilio client
$twilio = new Client($accountSid, $authToken);

try {
    // Send the SMS
    $twilio->messages->create(
        $recipientNumber,
        [
            'from' => $twilioNumber,
            'body' => $message
        ]
    );

    echo "SMS sent successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


