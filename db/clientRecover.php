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


	try{
		$msg = $cust_id = $error = "";
		$valid = true;

		if(isset($_POST['cust_id']) && !empty($_POST['cust_id'])){
			$cust_id = $_POST['cust_id'];
		}else{
			$valid = false;
			$error .= "Client ID is invalid";
			$cust_id = "";
		}

		$status="Pending";

		if($valid){
		$sql = mysqli_query($conn, "UPDATE clientacc SET status='$status' WHERE cust_id = '$cust_id'");

		
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
		$message .= "<p>Dear Mr/Mrs. $custLname,</p>";
		$message .= "<P>I hope this message finds you well, we want to inform you that your account has been recovered from the denied status.</p>";
		$message .= "<p>If you have any questions or suggestions, please feel free to reach out to us.</p>";
		$message .= $signature;
		$message .= "</body></html>";

		$emailName = "Litz Autoshop";
		$emailAdd = "litzautoshop@gmail.com";
		$emailSubject = "Account Status Notification";

        $mail->setFrom($emailAdd, $emailName);
        $mail->addAddress($customerEmail, $customerName);

        $mail->isHTML(true);
        $mail->Subject = $emailSubject;
        $mail->Body = $message;
        $mail->send();


		$msg = array("valid"=>true, "msg"=>"Account Recovered!");
		echo json_encode($msg);
	}else{
		$msg = array("valid"=>false, "msg"=>$error);
		echo json_encode($msg);
	}
	}catch (Exception $e){
		$msg =  array("valid"=>false, "msg"=>'Error-> '. $e->getMessage(). '\n');
		echo json_encode($msg);
	}
