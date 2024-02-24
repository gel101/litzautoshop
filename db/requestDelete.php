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
		$msg = $serviceID = "";
		$error = "";
		$valid = true;

		if(isset($_POST['serviceID']) && !empty($_POST['serviceID'])){
			$serviceID = $_POST['serviceID'];
		}else{
			$valid = false;
			$error = "Service ID is invalid";
			$serviceID = "";
		}

		$cust_id = $_POST['cust_id'];

		$currentDateTime = date("Y-m-d H:i:s");
		$status = "Declined";
		$messageSystem = "The Service was Unfortunately Declined. Feel free to make a new Request. " . "Request ID: " . $serviceID;
		$tran = "service";

		if($valid){
				$sql = mysqli_query($conn, "UPDATE request_services SET status = '$status', date = '$currentDateTime' WHERE request_id = '$serviceID'");
				if ($cust_id != "") {
					$sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$messageSystem','$currentDateTime','$tran','$status')");
				}				

				if ($cust_id == "") {
					//Email query
					$emailRequestCust = mysqli_query($conn, "SELECT cust_email, cust_name FROM request_services WHERE request_id='$serviceID'");
					
					$row123 = mysqli_fetch_assoc($emailRequestCust);
					$customerEmail = $row123['cust_email'];
					$customerName = $row123['cust_name'];
					$custLname = $row5['cust_name'];
				}else {
					//Email query
					$custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
					
					$row5 = mysqli_fetch_assoc($custEmailQuery);
					$customerEmail = $row5['email'];
					$customerName = $row5['fname'] . " " . $row5['lname'] ;
					$custLname = $row5['lname'];
				}

				

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
				$message .= "<p>I hope this message finds you well. Regrettably, we must inform you that your recent service request has been declined. We understand that this news may be disappointing, and we sincerely apologize for any inconvenience this may cause.</p>";
				$message .= "<p>While we are unable to fulfill the request at this time, we encourage you to submit another service request in the future. Our team is here to assist you, and we appreciate your understanding.</p>";				
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
				$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Selected Date</th>";
				$message .= "</tr>";
				$message .= "</thead>";

				$stmtservice = mysqli_query($conn, "SELECT * FROM request_services WHERE request_id ='$serviceID' ");
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
				$message .= "</body></html>";


				$emailName = "Litz Autoshop";
				$emailAdd = "malano.angelo@dnsc.edu.ph";
				$emailSubject = "Request Service Declined";
				
				$mail->setFrom($emailAdd, $emailName);
				$mail->addAddress($customerEmail, $customerName);

				$mail->isHTML(true);
				$mail->Subject = $emailSubject;
				$mail->Body = $message;
				$mail->send();

				$msg = array("valid" => true, "msg" => "Data Deleted!.");
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