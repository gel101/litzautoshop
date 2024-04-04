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
		$msg = $rent_id = $cust_id = $rentPrice = "";
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

		if(isset($_POST['rentPrice']) && !empty($_POST['rentPrice'])){
			$rentPrice = $_POST['rentPrice'];
		}else{
			$valid = false;
			$error = "Rent ID is invalid";
			$rentPrice = "";
		}

		// Set the timezone to the Philippines
		date_default_timezone_set('Asia/Manila');
		$currentDateTime = date("Y-m-d H:i:s");
		$status = "Rent Completed";

		if($valid){

				$stmt = mysqli_query($conn, "SELECT rentalcar_id, cust_id FROM rent_transactions WHERE rent_id = '$rent_id' ");
				$data = mysqli_fetch_assoc($stmt);
				$car_id = $data['rentalcar_id'];
				$cust_id = $data['cust_id'];
				
				$stmt3 = mysqli_query($conn, "SELECT fname, lname FROM clientacc WHERE cust_id = '$cust_id' ");
				$data3 = mysqli_fetch_assoc($stmt3);
				$clientname = $data3['fname'] . " " . $data3['lname'];

				$stmt2 = mysqli_query($conn, "UPDATE car_rental SET status = 'Available' WHERE rentalcar_id = '$car_id' ");

				$sql = mysqli_query($conn, "UPDATE rent_transactions SET date = '$currentDateTime', status = '$status' WHERE rent_id = '$rent_id'");



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
				$message .= "<p>I hope this message finds you well. We want to inform you that your recent rent request has been successfully completed!</p>";
				$message .= "<br>";
                $message .= "<h4>Transaction Details</h4>";
                $message .= "<p>Rent Price: &#8369;" . number_format($rentPrice, 2) . "<br>Rent ID: $rent_id</p>";
                $message .= "<h4>Rent Details: </h4>";
                $message .= "<table style='width: 100%; border-collapse: collapse;' class='table text-center'>";
                $message .= "<thead style='background-color: #f2f2f2;' class='text-secondary'>";
                $message .= "<tr>";
                $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>ID</th>";
                $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Rent Duration</th>";
                $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Date</th>";
                $message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Price</th>";
                $message .= "</tr>";
                $message .= "</thead>";
        
                
                global $conn;
                global $rent_id;
                $stmtcarts = mysqli_query($conn, "SELECT * FROM rent_transactions WHERE rent_id = '$rent_id' ");
				while ($rowcarts = mysqli_fetch_assoc($stmtcarts)) {
					$rent_id = $rowcarts['rent_id'];
					$rentTime = $rowcarts['rentTime'];
					$rentTimeType = $rowcarts['rentTimeType'];
					$price = $rowcarts['price'];
					$inputDate = $rowcarts['date'];
					
					// Adjust the format to match your database DATETIME format
					$date = DateTime::createFromFormat('Y-m-d H:i:s', $inputDate);

					if ($date !== false) {
						$formattedDate = $date->format('m-d-Y');

						$message .= "<tr>";
						$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$rent_id</td>";
						$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$rentTime $rentTimeType</td>";
						$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$formattedDate</td>";
						$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>&#8369;$price</td>";
						$message .= "</tr>";
					} else {
						// Handle the case where the DateTime object could not be created
						$message .= "<tr>";
						$message .= "<td colspan='4'>Invalid date format: $inputDate</td>";
						$message .= "</tr>";
					}
				}
        
                $message .= "</table>";
                $message .= "<br>";
                $message .= $signature;
                $message .= "</body></html>";
		
			
				$emailName = "Litz Autoshop";
				$emailAdd = "litzautoshop@gmail.com";
				$emailSubject = "Rent Completed";
		
				$mail->setFrom($emailAdd, $emailName);
				$mail->addAddress($customerEmail, $customerName);
		
				$mail->isHTML(true);
				$mail->Subject = $emailSubject;
				$mail->Body = $message;
				$mail->send();



				$msg = array("valid" => true, "msg" => "Rent Completed!.");
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