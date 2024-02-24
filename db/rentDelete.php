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
		$msg = $rent_id = $cust_id = $rentPrice = $rentPayment = "";
		$error = "";
		$valid = true;

		if(isset($_POST['rent_id']) && !empty($_POST['rent_id'])){
			$rent_id = $_POST['rent_id'];
		}else{
			$valid = false;
			$error = "Rent ID is invalid";
			$rent_id = "";
		}

		if(isset($_POST['cust_id']) && !empty($_POST['cust_id'])){
			$cust_id = $_POST['cust_id'];
		}else{
			$valid = false;
			$error = "Customer ID is invalid";
			$cust_id = "";
		}

		if (isset($_POST['rentPrice']) && !empty($_POST['rentPrice'])) {
			$rentPrice = $_POST['rentPrice'];
		} else {
			$valid = false;
			$error = "Rent Price invalid";
			$rentPrice = "";
		}
	
		if (isset($_POST['rentPayment']) && !empty($_POST['rentPayment'])) {
			$rentPayment = $_POST['rentPayment'];
		} else {
			$valid = false;
			$error = "Rent Payment invalid";
			$rentPayment = "";
		}

		$status = "Declined";
		$currentDateTime = date("Y-m-d H:i:s");

		if($valid){
				$sql = mysqli_query($conn, "UPDATE rent_transactions SET status = '$status', date= '$currentDateTime' WHERE rent_id = '$rent_id'");

        

				// Customer email sending logic
				$custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
				$row5 = mysqli_fetch_assoc($custEmailQuery);
				$customerEmail = $row5['email'];
				$customerName = $row5['fname'] . " " . $row5['lname'];
				$custLname = $row5['lname'];
						
		
				$signature = "<br>";
				$signature .= "<p>Regards,<br>";
				$signature .= "Litz Autoshop<br>";
				$signature .= "Email Notification<br>";
				$signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
				$signature .= "Phone: 09169834159<br>";
				$signature .= "Email: marjlit1@gmail.com</p>";
				
				$message = "<html><body>";
				$message .= "<p>Dear Mr/Mrs. $custLname,</p>";
				$message .= "<p>I hope this message finds you well. Regrettably, we must inform you that your recent order request has been declined. We understand that this news may be disappointing, and we sincerely apologize for any inconvenience this may cause.</p>";
				$message .= "<p>While we are unable to fulfill the order at this time, we encourage you to submit another order in the future. Our team is here to assist you, and we appreciate your understanding.</p>";			
				$message .= "<br>";
				$message .= "<h4>Transaction Details</h4>";
				$message .= "<p>Rent ID: $rent_id <br>Customer Name: $customerName</p>";        
				$message .= "<h4>Renting Car Details: </h4>";
				$message .= "<table style='width: 100%; border-collapse: collapse;' class='table text-center'>";
				$message .= "<thead style='background-color: #f2f2f2;' class='text-secondary'>";
				$message .= "<tr>";
				$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Rent Request ID</th>";
				$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Requested Duration</th>";
				$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Date</th>";
				$message .= "</tr>";
				$message .= "</thead>";
				
				$stmtrent = mysqli_query($conn, "SELECT * FROM rent_transactions WHERE rent_id = '$rent_id' ");

				while ($rowrent = mysqli_fetch_assoc($stmtrent)) {
					$rent_id = $rowrent['rent_id'];
					$rentTime = $rowrent['rentTime'] . " " . $rowrent['rentTimeType'];
					$inputDate = $rowrent['rentDate'];
					$date = DateTime::createFromFormat('Y-m-d', $inputDate);
					$formattedDate = $date->format('m-d-Y');
						
					
					$message .= "<tr>";
					$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$rent_id</td>";
					$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$rentTime</td>";
					$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$formattedDate</td>";
					$message .= "</tr>";
				}
        
                $message .= "</table>";
                $message .= "<br>";
                $message .= $signature;
                $message .= "</body></html>";
		
		
				$emailName = "Litz Autoshop";
				$emailAdd = "malano.angelo@dnsc.edu.ph";
				$emailSubject = "Rent Request Declined";
		
				$mail->setFrom($emailAdd, $emailName);
				$mail->addAddress($customerEmail, $customerName);
		
				$mail->isHTML(true);
				$mail->Subject = $emailSubject;
				$mail->Body = $message;
				$mail->send();


				$msg = array("valid" => true, "msg" => "Rent Declined!.");
				echo json_encode($msg);
			
		} else {
			$msg = array("valid" => false, "msg" => $error);
			echo json_encode($msg);
		}
	} catch (Exception $e) {
		$msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
		echo json_encode($msg);
	}
?>