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
		$msg = $addname = $addemail = $addnumber = $addvehicle = $addrequest = $adddate = $adddetails   = "";
		$error = "";
		$valid = true;

		if(isset($_POST['addname']) && !empty($_POST['addname'])){
			$addname = $_POST['addname'];
		}else{
			$valid = false;
			$error = "addname is invalid";
			$addname = "";
		}

		if(isset($_POST['addemail']) && !empty($_POST['addemail'])){
			$addemail = $_POST['addemail'];
		}else{
			$valid = false;
			$error = "addemail is invalid";
			$addemail = "";
		}

		if(isset($_POST['addnumber']) && !empty($_POST['addnumber'])){
			$addnumber = $_POST['addnumber'];
		}else{
			$valid = false;
			$error = "Phone Number is invalid";
			$addnumber = "";
		}
		
		$addrequest = implode(", ", $_POST['addrequest']); // Convert array to comma-separated string

		if(isset($_POST['addvehicle']) && !empty($_POST['addvehicle'])){
			$addvehicle = $_POST['addvehicle'];
		}else{
			$valid = false;
			$error = "addvehicle is invalid";
			$addvehicle = "";
		}

		if(isset($_POST['adddate']) && !empty($_POST['adddate'])){
			$adddate = $_POST['adddate'];
		}else{
			$valid = false;
			$error = "adddate is invalid";
			$adddate = "";
		}

		$adddetails = $_POST['adddetails'];

		$currentDateTime = date("m-d-Y H:i:s");
        $status = "Pending";
		$tran = "service";
		$messageAdmin = "A New Service Request has been Made";

		if($valid){
				$sql = mysqli_query($conn, "INSERT INTO request_services(cust_name, cust_email, cust_num, request, vehicleType, details, dateSelected, date, status) VALUES('$addname','$addemail','$addnumber','$addrequest','$addvehicle','$adddetails','$adddate', '$currentDateTime', '$status')");
				$sql4 = mysqli_query($conn, "INSERT INTO notifications(messageTo,message, date, transaction, status) VALUES('admin','$messageAdmin','$currentDateTime','$tran','$status')");

				
                        $customerEmail = $addemail;
						$customerName = $addname;


                        $signature = "<br>";
						$signature .= "Regards,<br>";
                        $signature .= "Litz Autoshop<br>";
                        $signature .= "Email Notification<br>";
                        $signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
                        $signature .= "Phone: 09169834159<br>";
                        $signature .= "Email: marjlit1@gmail.com</p>";
	
						$message = "<html><body>";
						$message .= "<p>Dear $customerName,</p>";
						$message .= "<p>I hope this message finds you well. We want to inform you that your service request has been successfully created and is now in our system for further processing.</p>";
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
				
						$stmtservice = mysqli_query($conn, "SELECT * FROM request_services WHERE cust_name = '$addname' AND vehicleType ='$addvehicle' AND request ='$addrequest' AND dateSelected='$adddate' AND status ='$status' ");
				
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
                        $message .= $signature;
						$message .= "</body></html>";
						
						$emailName = "Litz Autoshop";
						$emailAdd = "litzautoshop@gmail.com";
						$emailSubject = "Request Successfully Created";
	
						$mail->setFrom($emailAdd, $emailName);
						$mail->addAddress($customerEmail, $customerName);
	
						$mail->isHTML(true);
						$mail->Subject = $emailSubject;
						$mail->Body = $message;

						// Check if the email was sent successfully
						if (!$mail->send()) {
						   $erroremail = "Mailer Error: " . $mail->ErrorInfo;
							$msg = array("valid" => false, "msg" => $erroremail);
							echo json_encode($msg);
							exit;
						}
	
					}

				global $sql;
				global $sql4;
				if (!$sql || !$sql4) {
					$msg = array("valid" => false, "msg" => "QUERY ERROR.");
					exit;
				}
				
				$msg = array("valid" => true, "msg" => "Request Service Sucessful!");
				echo json_encode($msg);
		
	} catch (Exception $e) {
		$msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
		echo json_encode($msg);
	}
?>