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

$mail->Username = "malano.angelo@dnsc.edu.ph";
$mail->Password = "chllzawmbgoskeyk";


try {
    $msg = $cust_id = $reqID = "";
    $valid = true;

    if (isset($_POST['cust_id']) && !empty($_POST['cust_id'])) {
        $cust_id = $_POST['cust_id'];
    } else {
        $valid = false;
        $error .= "Customer ID is invalid";
        $cust_id = "";
    }

    if (isset($_POST['reqID']) && !empty($_POST['reqID'])) {
        $reqID = $_POST['reqID'];
    } else {
        $valid = false;
        $error .= "Request ID is invalid";
        $reqID = "";
    }

    $currentDateTime = date("Y-m-d H:i:s");

    $status = "Processed";
    $messageClient = "The Service Requested Has Been Processed, You can now Get your Unit at the Litz Autoshop. " . "Request ID : " . $reqID;
    $tran = "service";


    if ($valid) {
        
        $sql = mysqli_query($conn, "UPDATE request_services SET date = '$currentDateTime', status='$status' WHERE request_id = '$reqID'");
        $sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$messageClient','$currentDateTime','$tran','$status')");
        
        //Email query
        $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
        
        $row5 = mysqli_fetch_assoc($custEmailQuery);
        $customerEmail = $row5['email'];
        $customerName = $row5['fname'] . " " . $row5['lname'] ;

        $signature = "<br>";
        $signature .= "Regards,<br>";
        $signature .= "Litz Autoshop<br>";
        $signature .= "Email Notification<br>";
        $signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
        $signature .= "Phone: 09169834159<br>";
        $signature .= "Email: marjlit1@gmail.com</p>";

        $message = "<html><body>";
        $message .= "<p>I hope this message finds you well. We want to inform you that your recent service request has been fully processed, and your unit is now ready for pickup at our shop. We appreciate your trust in Litz Autoshop, and we are committed to ensuring your satisfaction.</p>";
        $message .= "<br>";
        $message .= "<h4>Request Details: </h4>";
        $message .= "<p>Request ID : $reqID</p>";
        $message .= "<br>";
        $message .= $signature;
        $message .= "</body></html>";
    
        $emailName = "Litz Autoshop";
        $emailAdd = "malano.angelo@dnsc.edu.ph";
        $emailSubject = "Request Service Processed";

        $mail->setFrom($emailAdd, $emailName);
        $mail->addAddress($customerEmail, $customerName);

        $mail->isHTML(true);
        $mail->Subject = $emailSubject;
        $mail->Body = $message;
        $mail->send();

        
        $msg = array("valid" => true, "msg" => "Request Processed!");
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