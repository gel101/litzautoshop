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


try{
$msg = $error = $cust_id =  $reqID = $reqEmail =  $totalprice =  $priceReason = "";
	$valid = true;
    
    
    $cust_id = $_POST['cust_id'];

	if(isset($_POST['reqID']) && !empty($_POST['reqID'])){
		$reqID = $_POST['reqID'];
	}else{
		$valid = false;
		$error .= "Service ID is invalid";
		$reqID = "";
	}

	if(isset($_POST['price']) && !empty($_POST['price'])){
		$totalprice = $_POST['price'];
	}else{
		$valid = false;
		$error .= "Price is invalid";
		$totalprice = "";
	}

	if(isset($_POST['priceReason']) && !empty($_POST['priceReason'])){
		$priceReason = $_POST['priceReason'];
	}else{
		$valid = false;
		$error .= "Price Reason is invalid";
		$priceReason = "";
	}
    
    $reqEmail = $_POST['reqEmail'];

    $currentDateTime = date("Y-m-d H:i:s");
	$status = "Request Completed";
	$messageClient = "The Service Request was claimed as Completed." . "Service ID : " . $reqID ;
	$tran = "service";
	

	if($valid){

		$sql = mysqli_query($conn, "UPDATE request_services SET price = '$totalprice', price_reason = '$priceReason', date = '$currentDateTime', status = '$status' WHERE request_id = '$reqID' ");
		if ($cust_id != "") {
            $sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$messageClient','$currentDateTime','$tran','$status')");
        }
		$sql22 = mysqli_query($conn, "INSERT INTO notifications(messageTo, message, date, transaction, status) VALUES('admin','$messageClient','$currentDateTime','$tran','$status')");


        if ($cust_id != "") {
            //Email query
            $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
            
            while ($row5 = mysqli_fetch_assoc($custEmailQuery)) {
                $customerEmail = $row5['email'];
                $customerName = $row5['fname'] . " " . $row5['lname'] ;
                $custLname = "Mr/Mrs. " . $row5['lname'];
            }
            
        $stmtclientNum = mysqli_query($conn, "SELECT phoneNum FROM clientacc WHERE cust_id = '$cust_id' ");
        $dataPhone = mysqli_fetch_assoc($stmtclientNum);

        $number = $dataPhone['phoneNum'];
            
        }

        if ($reqEmail != "") {
            //Email query
            $customerEmail = $reqEmail;
            
            $noaccRequest = mysqli_query($conn, "SELECT * FROM request_services WHERE request_id ='$reqID' ");
            $noaccRequestData = mysqli_fetch_assoc($noaccRequest);
            $custLname = $noaccRequestData['cust_name'];
            $customerName = $noaccRequestData['cust_name'];
            $number = $noaccRequestData['cust_num'];


        }
		
		
        $signature = "<br>";
        $signature .= "<p>Regards,<br>";
        $signature .= "Litz Autoshop<br>";
        $signature .= "Email Notification<br>";
        $signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
        $signature .= "Phone: 09169834159<br>";
        $signature .= "Email: marjlit1@gmail.com</p>";
        $message = "<html><body>";
        $message .= "<p>Dear $custLname,</p>";
        $message .= "<p>I hope this message finds you well, We want to inform you that your recent service request has been successfully completed.</p>";
        $message .= "<br>";
        $message .= "<h4>Service Details</h4>";
        $message .= "<p>Request ID: $reqID <br>
                        Total Price: &#8369;" . number_format($totalprice, 2) . "<br>
                        Price Reason: $priceReason</p>";        
        $message .= "<h4>Request Details: </h4>";
        $message .= "<table style='width: 100%; border-collapse: collapse;' class='table text-center'>";
        $message .= "<thead style='background-color: #f2f2f2;' class='text-secondary'>";
        $message .= "<tr>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Request ID</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Assigned Mechanic</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Request</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Vehicle Type</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Price</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Price Reason</th>";
        $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Requested Date</th>";
        $message .= "</tr>";
        $message .= "</thead>";

        $stmtservice = mysqli_query($conn, "SELECT * FROM request_services WHERE request_id ='$reqID' ");

        while ($rowservice = mysqli_fetch_assoc($stmtservice)) {

            $request_id = $rowservice['request_id'];

            	$mechanic_id = $rowservice['mechanic_id'];
				$stmtmechanic = mysqli_query($conn, "SELECT fname, lname FROM staff WHERE staff_id = '$mechanic_id' ");
				while ($rowsmechanic = mysqli_fetch_assoc($stmtmechanic)) {
					$mechanicName = $rowsmechanic['fname'] . " " . $rowsmechanic['lname'];
				}

            $request = $rowservice['request'];
            $vehicleType = $rowservice['vehicleType'];
            $price = $rowservice['price'];
            $price_reason = $rowservice['price_reason'];
            $inputDate = $rowservice['dateSelected'];
            $date = DateTime::createFromFormat('Y-m-d', $inputDate);
            $formattedDate = $date->format('m-d-Y');

            $message .= "<tr>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$request_id</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$mechanicName</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$request</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$vehicleType</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>&#8369;" . number_format($price, 2) . "</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$price_reason</td>";
            $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$formattedDate</td>";
            $message .= "</tr>";
        }

        $message .= "</table>";
        $message .= "<br>";
        $message .= "<p>Thank you for choosing Litz Autoshop for your service needs.</p>";
        $message .= $signature;
        $message .= "</body></html>";

		$emailName = "Litz Autoshop";
		$emailAdd = "malano.angelo@dnsc.edu.ph";
		$emailSubject = "Request Service Completed";
		
        $mail->setFrom($emailAdd, $emailName);
        $mail->addAddress($customerEmail, $customerName);

        $mail->isHTML(true);
        $mail->Subject = $emailSubject;
        $mail->Body = $message;
        $mail->send();


        // Clear recipients and reset the email object for the next email
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();




$serviceQuery = mysqli_query($conn, "SELECT * FROM request_services WHERE request_id ='$reqID'");
$serviceRow = mysqli_fetch_assoc($serviceQuery);
$vehicleType = $serviceRow['vehicleType'];
$requests = $serviceRow['request'];


$totalprice = number_format($totalprice, 2);
$textMessage = "Hi $custLname!, this is Litz Autoshop. We are pleased to inform you that your service request has been completed.
Your Mechanic: $mechanicName
Service Total Cost: $totalprice
Request ID: $reqID

Vehicle Type: $vehicleType
Requested Services: $requests.";
            
            
        $prefixedNumber = "+63" . substr($number, 1);


		$msg = array("valid"=>true, "msg"=>"Data updated.", "number" => $prefixedNumber, "message" => $textMessage);
		echo json_encode($msg);
	} else {
		$msg = array("valid"=>false, "msg"=>$error);
		echo json_encode($msg);
	}
} catch (Exception $e) {
	$msg =  array("valid"=>false, "msg"=>'Error-> '. $e->getMessage(). '\n');
	echo json_encode($msg);
}
?>