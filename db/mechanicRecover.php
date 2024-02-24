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
		$msg = $mechanic_id = $error = "";
		$valid = true;

		if(isset($_POST['mechanic_id']) && !empty($_POST['mechanic_id'])){
			$mechanic_id = $_POST['mechanic_id'];
		}else{
			$valid = false;
			$error .= "Mechanic ID is invalid";
			$mechanic_id = "";
		}

		$status="";

		if($valid){
		$sql = mysqli_query($conn, "UPDATE mechanic SET status='$status' WHERE mechanic_id = '$mechanic_id'");

        //Email query
        $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM mechanic WHERE mechanic_id='$mechanic_id'");
        
        $row5 = mysqli_fetch_assoc($custEmailQuery);
        $staffEmail = $row5['email'];
        $staffName = $row5['fname'] . " " . $row5['lname'] ;

		$signature = "<br>";
		$signature .= "<br>";
		$signature .= "Regards,<br>";
		$signature .= "Litz Autoshop<br>";
		$signature .= "Email Notification<br>";
		$signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
		$signature .= "Phone: 09169834159<br>";
		$signature .= "Email: marjlit1@gmail.com</p>";

		$message = "<html><body>";
		$message .= "<p>Dear $staffName,</p>";
		$message .= "<p>I hope this message finds you well. We want to inform you that your account has been recovered.</p>";
		$message .= "<p>If you have any questions or suggestions, please feel free to reach out to us.</p>";
		$message .= $signature;
		$message .= "</body></html>";

		$emailName = "Litz Autoshop";
		$emailAdd = "malano.angelo@dnsc.edu.ph";
		$emailSubject = "Account Status Notification";

        $mail->setFrom($emailAdd, $emailName);
        $mail->addAddress($staffEmail, $staffName);

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
		$msg =  array("valid"=>true, "msg"=>'Error-> '. $e->getMessage(). '\n');
		echo json_encode($msg);
	}
