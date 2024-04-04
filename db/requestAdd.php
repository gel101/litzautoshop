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
		$valid = true;
		$error = "";
		
		$tempID = uniqid();
		$req_groupID = $tempID;


        $SystemMessage = "Your Made a Service Request, Please Wait for the Confirmation.";
		$messageAdmin = "A New Service Request has been Made.";



		if (isset($_POST['requestsData']) && is_array($_POST['requestsData'])) {
			foreach ($_POST['requestsData'] as $requestData) {
				$cust_id = $requestData['cust_id'];
				$name = $requestData['name'];
            	$request = implode(", ", $requestData['requestType']); // Convert array to comma-separated string
				$vehicleType = $requestData['vehicleType'];
				$dateSelected = $requestData['dateSelected'];
				$repaintColor = $requestData['repaintColor'];
				$retintColor = $requestData['retintColor'];
				$details = $requestData['requestDetails'];

				// Set the timezone to the Philippines
				date_default_timezone_set('Asia/Manila');
				$currentDateTime = date("Y-m-d H:i:s");
				$status = "Pending";
				$tran = "service";

				// Rest of your code for processing a single service request...
				// Note: You may want to modify the code inside this loop accordingly.
				// ...

				
				$sql1 = mysqli_query($conn, "INSERT INTO request_services(cust_id, cust_name, request, vehicleType, paintColor, tintColor, details, dateSelected, date, req_groupID, status) VALUES('$cust_id','$name','$request','$vehicleType','$repaintColor','$retintColor','$details','$dateSelected', '$currentDateTime', '$req_groupID', '$status')");
	
				// if ($valid) {
				// 	// Your existing code for sending emails...
				// 	// ...
				// }
			}
			
			$sql2 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$SystemMessage','$currentDateTime','$tran','$status')");
			$sql3 = mysqli_query($conn, "INSERT INTO notifications(messageTo,message, date, transaction, status) VALUES('admin','$messageAdmin','$currentDateTime','$tran','$status')");
			
			//Email query
			$adminEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM admin");
			
			while ($rowadmin = mysqli_fetch_assoc($adminEmailQuery)) {
				if (!empty($rowadmin['email'])) {
					$adminEmail = $rowadmin['email'];
				}
				$adminName = $rowadmin['fname'] . " " . $rowadmin['lname'] ;
				

				$message = "<html><body>";
				$message .= "<p>A new Service Request has just been placed. Please log in to the admin dashboard to review and process the request promptly.</p>";
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
		
				$stmtservice = mysqli_query($conn, "SELECT * FROM request_services WHERE cust_id = '$cust_id' AND req_groupID ='$req_groupID' AND status ='$status' ");
		
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
				$emailAdd = "litzautoshop@gmail.com";
				$emailSubject = "New Service Request";

				$mail->setFrom($emailAdd, $emailName);
				$mail->addAddress($adminEmail, $adminName);

				$mail->isHTML(true);
				$mail->Subject = $emailSubject;
				$mail->Body = $message;
				$mail->send();

			}
		
			$msg = array("valid" => true, "msg" => "Request Service Sucessful!");
			echo json_encode($msg);






			
		}
		//  else {
		// 	$msg = array("valid" => false, "msg" => $error);
		// 	echo json_encode($msg);
		// }
	} catch (Exception $e) {
		$msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
		echo json_encode($msg);
	}
?>