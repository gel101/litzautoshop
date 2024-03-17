<?php
include "connection.php";

require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "litzautoshop@gmail.com";
$mail->Password = "afwaansxpvhbrtcw";


try {
    $msg = $cust_id = $mechanic_id = $reqID = $reqEmail = $textMessage = $number = "";
    $valid = true;


    $cust_id = $_POST['cust_id'];

    if (isset($_POST['mechanic_id']) && !empty($_POST['mechanic_id'])) {
        $mechanic_id = $_POST['mechanic_id'];
    } else {
        $valid = false;
        $error .= "Mechanic ID is Invalid";
        $mechanic_id = "";
    }

    if (isset($_POST['reqID']) && !empty($_POST['reqID'])) {
        $reqID = $_POST['reqID'];
    } else {
        $valid = false;
        $error .= "Request ID is invalreqID";
        $reqID = "";
    }

    if (isset($_POST['reqDate']) && !empty($_POST['reqDate'])) {
        $reqDate = $_POST['reqDate'];
    } else {
        $valid = false;
        $error .= "Requested Date is Invalid";
        $reqDate = "";
    }
    
    $reqEmail = $_POST['reqEmail'];
    $reqNumber = $_POST['reqNumber'];
    
    $status = "Approved";
    $currentDateTime = date("Y-m-d H:i:s");
    $messageMechanic = "A New Approved Service Request has been Made. " . "Request ID : " . $reqID;
    $messageClient = "The Service Request Was Approved, You can Go on our Shop At The Date of " . $reqDate . " You are Choosen. " . "Request ID : " . $reqID;
    $tran = "service";

    if ($valid) {
        
        $sql = mysqli_query($conn, "UPDATE request_services SET mechanic_id = '$mechanic_id', date = '$currentDateTime', status='$status' WHERE request_id = '$reqID' ");
        if ($cust_id != "") {
            $sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$messageClient','$currentDateTime','$tran','$status')");
        }
        $sql223 = mysqli_query($conn, "INSERT INTO notifications(messageTo, message, date, transaction, status) VALUES('mechanic','$messageMechanic','$currentDateTime','$tran','$status')");


    // Function to send email
    function sendEmail($recipientEmail, $recipientName, $subject, $messageContent, $messageContentOutro) {
        global $mail;

        $signature = "<br>";
        $signature .= "<p>Regards,<br>";
        $signature .= "Litz Autoshop<br>";
        $signature .= "Email Notification<br>";
        $signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
        $signature .= "Phone: 09169834159<br>";
        $signature .= "Email: marjlit1@gmail.com</p>";

        $message = "<html><body>";
        $message .= $messageContent;
        $message .= "<br>";
        $message .= "<h4>Service Request Details: </h4>";
        $message .= "<table style='width: 100%; border-collapse: collapse;' class='table text-center'>";
        $message .= "<thead style='background-color: #f2f2f2;' class='text-secondary'>";
        $message .= "<tr>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Request ID</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Customer Name</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Vehicle Type</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Request</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Vehicle Type</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Requested Date</th>";
        $message .= "</tr>";
        $message .= "</thead>";

        global $conn;
        global $reqID;
        global $mechanic_id;
        $stmtservice = mysqli_query($conn, "SELECT * FROM request_services WHERE request_id ='$reqID' AND mechanic_id = '$mechanic_id' ");

        while ($rowservice = mysqli_fetch_assoc($stmtservice)) {

            $request_id = $rowservice['request_id'];
            $cust_name = $rowservice['cust_name'];
            $vehicleType = $rowservice['vehicleType'];
            $request = $rowservice['request'];
            $vehicleType = $rowservice['vehicleType'];
            $inputDate = $rowservice['dateSelected'];
            $date = DateTime::createFromFormat('Y-m-d', $inputDate);
            $formattedDate = $date->format('m-d-Y');

            $message .= "<tr>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$request_id</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$cust_name</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$vehicleType</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$request</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$vehicleType</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$formattedDate</td>";
            $message .= "</tr>";
        }

        $message .= "</table>";
        $message .= "<br>";
        $message .= $messageContentOutro;
        $message .= $signature;
        $message .= "</body></html>";

        $emailName = "Litz Autoshop";
        $emailAdd = "litzautoshop@gmail.com";

        $mail->setFrom($emailAdd, $emailName);
        $mail->addAddress($recipientEmail, $recipientName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Check if the email was sent successfully
        if (!$mail->send()) {
           $erroremail = "Mailer Error: " . $mail->ErrorInfo;
            $msg = array("valid" => false, "msg" => $erroremail);
            echo json_encode($msg);
            exit;
        }

        // Clear recipients and reset the email object for the next email
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
    }

        
    // Email query for mechanic
    $mechanicEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM staff WHERE staff_id = '$mechanic_id'");
    $rowMechanic = mysqli_fetch_assoc($mechanicEmailQuery);

    if ($rowMechanic) {
        $mechanicEmail = $rowMechanic['email'];
        $mechanicName = $rowMechanic['fname'] . " " . $rowMechanic['lname'];

        // Check if the email address is not empty before sending the email
        if (!empty($mechanicEmail)) {
            sendEmail($mechanicEmail, $mechanicName, "New Assigned Service", "<p>You have a new assigned service request. Open the App and take a look.</p>", "");
        }
    }

    // Email query for customer
    if ($cust_id != "") {
        $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
        $rowCustomer = mysqli_fetch_assoc($custEmailQuery);

        if ($rowCustomer) {
            $customerEmail = $rowCustomer['email'];
            $customerName = $rowCustomer['fname'] . " " . $rowCustomer['lname'];
            $custLname = $rowCustomer['lname'];

            // Check if the email address is not empty before sending the email
            if (!empty($customerEmail)) {
                sendEmail($customerEmail, $customerName, "Request Service Approved", "<p>Dear Mr/Mrs. $custLname,</p><p>We hope this message finds you well. We want to inform you that your recent service request has been approved. Visit our shop at your requested date.</p>", "<p>Thank you for choosing Litz Autoshop for your service needs. We look forward to serving you!</p>");
            }
        }

$serviceQuery = mysqli_query($conn, "SELECT * FROM request_services WHERE request_id ='$reqID'");
$serviceRow = mysqli_fetch_assoc($serviceQuery);
$vehicleType = $serviceRow['vehicleType'];
$requests = $serviceRow['request'];
$date = new DateTime($serviceRow['dateSelected']); 
$formattedDate = $date->format('M-d-Y');

$textMessage = "Hi Mr/Mrs. $custLname!, this is Litz Autoshop. We are pleased to inform you that your service request has been accepted. Please visit our shop on the date you requested: $formattedDate.
Your Mechanic: $mechanicName
Request ID: $reqID

Vehicle Type: $vehicleType
Requested Services: $requests.";
            
            
        $stmtclientNum = mysqli_query($conn, "SELECT phoneNum FROM clientacc WHERE cust_id = '$cust_id' ");
        $dataPhone = mysqli_fetch_assoc($stmtclientNum);

        $number = $dataPhone['phoneNum'];
        $prefixedNumber = "+63" . substr($number, 1);
    }
    
    if ($reqEmail != "") {
        $customerEmail = $reqEmail;

        $noaccRequest = mysqli_query($conn, "SELECT * FROM request_services WHERE request_id ='$reqID' ");
        $requestData = mysqli_fetch_assoc($noaccRequest);
        $customerName = $requestData['cust_name'];
        $vehicleType = $requestData['vehicleType'];
        $request = $requestData['request'];
        $date = new DateTime($requestData['dateSelected']); 
        $formattedDate = $date->format('M-d-Y');

        sendEmail($customerEmail, $customerName, "Request Service Approved", "<p>Dear Mr/Mrs. $customerName,</p><p>We hope this message finds you well. We want to inform you that your recent service request has been approved. Visit our shop at your requested date.</p>", "<p>Thank you for choosing Litz Autoshop for your service needs. We look forward to serving you!</p>");

            

$textMessage = "Hi $customerName!, this is Litz Autoshop. We are pleased to inform you that your service request has been accepted. Please visit our shop on the date you requested: $formattedDate.
Your Mechanic: $mechanicName
Request ID: $reqID

Vehicle Type: $vehicleType
Requested Services: $request.";
            
        $number = $reqNumber;
        $prefixedNumber = "+63" . substr($number, 1);
    }



        $msg = array("valid" => true, "msg" => "Request Approved!", "number" => $prefixedNumber, "message" => $textMessage);
        echo json_encode($msg);
    } else {
        $msg = array("valid" => false, "msg" => $error);
        echo json_encode($msg);
    }
} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>