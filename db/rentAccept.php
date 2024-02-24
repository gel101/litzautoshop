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
		$msg = $rent_id = "";
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

		$currentDateTime = date("Y-m-d H:i:s");
		$status = "Accepted";

		if($valid){

				$stmt = mysqli_query($conn, "SELECT rentalcar_id, cust_id FROM rent_transactions WHERE rent_id = '$rent_id' ");
				$data = mysqli_fetch_assoc($stmt);
				$car_id = $data['rentalcar_id'];
				$cust_id = $data['cust_id'];
				
				$stmt3 = mysqli_query($conn, "SELECT fname, lname FROM clientacc WHERE cust_id = '$cust_id' ");
				$data3 = mysqli_fetch_assoc($stmt3);
				$clientname = $data3['fname'] . " " . $data3['lname'];

				$stmt2 = mysqli_query($conn, "UPDATE car_rental SET status = 'Occupied' WHERE rentalcar_id = '$car_id' ");

				$sql = mysqli_query($conn, "UPDATE rent_transactions SET date = '$currentDateTime', status = '$status' WHERE rent_id = '$rent_id'");



				
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
				$message .= "<p>I hope this message finds you well. We want to inform you that your Renting Car Request has been accepted. We welcome you to our store for the payment process, requirements, and to review your renting car.</p>";
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
		
					$message .= "<h4>List of Requirements:</h4>";
					$message .= "<h5>For Renting a Car:</h5><p>
					- DRIVERS LICENSE IF YOU HAVE A DRIVER<br>
					- ANY GOVERNMENT ID<br>
					</p>";
						
				
				$message .= $signature;
				$message .= "</body></html>";
		
				$emailName = "Litz Autoshop";
				$emailAdd = "malano.angelo@dnsc.edu.ph";
				$emailSubject = "Rent Request Accepted";
		
				$mail->setFrom($emailAdd, $emailName);
				$mail->addAddress($customerEmail, $customerName);
		
				$mail->isHTML(true);
				$mail->Subject = $emailSubject;
				$mail->Body = $message;
				$mail->send();

				// Clear recipients and reset the email object for the next iteration
				$mail->ClearAllRecipients();
				$mail->ClearAttachments();
		
				// Close the mail connection after sending all emails
				$mail->smtpClose();
	
	
	
	 
$textMessage = "Hello $customerName, this is Litz Autoshop. We are pleased to inform you that your car rental request has been accepted.
Rent Request ID: $rent_id";
				
				
			$stmtclientNum = mysqli_query($conn, "SELECT phoneNum FROM clientacc WHERE cust_id = '$cust_id' ");
			$dataPhone = mysqli_fetch_assoc($stmtclientNum);
	
			$number = $dataPhone['phoneNum'];
			$prefixedNumber = "+63" . substr($number, 1);



				$msg = array("valid" => true, "msg" => "Rent Successfully Accepted!.");
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