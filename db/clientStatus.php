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
		$msg = $cust_id = $error = $reason = "";
		$valid = true;

		if(isset($_POST['cust_id']) && !empty($_POST['cust_id'])){
			$cust_id = $_POST['cust_id'];
		}else{
			$valid = false;
			$error .= "NO CUSTOMER ID";
			$cust_id = "";
		}

		if (isset($_POST['reason'])) {
			$reason = $_POST['reason'];
		}

		$status = $_POST['status'];

		if($valid){
			$sql = mysqli_query($conn, " UPDATE clientacc set status='$status', acc_reason='$reason' where cust_id = '$cust_id'");

			//Email query
			$custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
			
			$row5 = mysqli_fetch_assoc($custEmailQuery);
			$customerEmail = $row5['email'];
			$customerName = $row5['fname'] . " " . $row5['lname'] ;
			$custLname = $row5['lname'];

			$signature = "<br>";
			$signature .= "<br>";
			$signature .= "Regards,<br>";
			$signature .= "Litz Autoshop<br>";
			$signature .= "Email Notification<br>";
			$signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
			$signature .= "Phone: 09169834159<br>";
			$signature .= "Email: marjlit1@gmail.com</p>";

			$message = "<html><body>";
			$message = "<p>Dear Mr/Mrs. $custLname,</p>";
			if ($status == "Denied") {
				$message .= "<p>I hope this message finds you well, regarding this matter we wanted to inform you that your account has unfortunately been denied in the system. The reason(s) is stated below:</p>";
				$message .= "<p><strong>". $reason ."</strong></p>";
			}else {
				$message .= "<p>I hope this message finds you well, We wanted to inform you that your account has been verified! You can now make order or service requests on the Litz Autoshop website. Thank you!</p>";
			}
			$message .= $signature;
			$message .= "</body></html>";

			$emailName = "Litz Autoshop";
			$emailAdd = "malano.angelo@dnsc.edu.ph";
			$emailSubject = "Account Status Notification";

			$mail->setFrom($emailAdd, $emailName);
			$mail->addAddress($customerEmail, $customerName);

			$mail->isHTML(true);
			$mail->Subject = $emailSubject;
			$mail->Body = $message;
			$mail->send();


			$msg = array("valid"=>true, "msg"=>"Client Account Updated!.");
			echo json_encode($msg);
		}else{
			$msg = array("valid"=>false, "msg"=>$error);
			echo json_encode($msg);
		}

	}catch (Exception $e){
		$msg =  array("valid"=>false, "msg"=>'Error-> '. $e->getMessage(). '\n');
		echo json_encode($msg);
	}
