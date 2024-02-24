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
		$msg = $cust_id = $name = $rentalcar_id = $rentDate = $rentTimeType = $rentTime = "";
		$error = "";
		$valid = true;

		if(isset($_POST['rentalcar_id']) && !empty($_POST['rentalcar_id'])){
			$rentalcar_id = $_POST['rentalcar_id'];
		}else{
			$valid = false;
			$error = "Car ID is invalid";
			$rentalcar_id = "";
		}

		if(isset($_POST['cust_id']) && !empty($_POST['cust_id'])){
			$cust_id = $_POST['cust_id'];
		}else{
			$valid = false;
			$error = "Session ID is invalid";
			$cust_id = "";
		}

		if(isset($_POST['name']) && !empty($_POST['name'])){
			$name = $_POST['name'];
		}else{
			$valid = false;
			$error = "Customer Name is invalid";
			$name = "";
		}

		if(isset($_POST['rentDate']) && !empty($_POST['rentDate'])){
			$rentDate = $_POST['rentDate'];
		}else{
			$valid = false;
			$error = "Rent Date is invalid";
			$rentDate = "";
		}

		if(isset($_POST['rentTimeType']) && !empty($_POST['rentTimeType'])){
			$rentTimeType = $_POST['rentTimeType'];
		}else{
			$valid = false;
			$error = "Time Type is invalid";
			$rentTimeType = "";
		}

		if(isset($_POST['rentTime']) && !empty($_POST['rentTime'])){
			$rentTime = $_POST['rentTime'];
		}else{
			$valid = false;
			$error = "Rent Time is invalid";
			$rentTime = "";
		}

        $status = "Pending";
		$currentDateTime = date("Y-m-d H:i:s");
		$tran = "rent";
        $systemMessage = "You Made a Car Rent Request, Please Wait for the Confirmation.";
        $messageAdmin = "A New Car Rent Request has been Made.";

		if($valid){
			// // Check if model already exists in the database
			// $query = "SELECT * FROM carts WHERE cust_id ='$cust_id' and product='$car_type' and model='$model' and engine='$engine' and status='$status'";
			// $result = mysqli_query($conn, $query);
			// if (mysqli_num_rows($result) > 0) {

			// 	$query1 = "UPDATE carts SET quantity = quantity + '$quantity' WHERE cust_id ='$cust_id' and product='$car_type' and model='$model' and engine='$engine' and status='$status' ";
			// 	$result1 = mysqli_query($conn, $query1);
				
			// 	$msg = array("valid" => true, "msg" => "Inserted to cart.");
			// 	echo json_encode($msg);
			// } else {
                
                $sql = mysqli_query($conn, "INSERT INTO rent_transactions(cust_id, rentalcar_id, rentTimeType, rentTime, rentDate, date, status) VALUES('$cust_id','$rentalcar_id','$rentTimeType','$rentTime', '$rentDate', '$currentDateTime', '$status')");
            
                if (!$sql) {
                    $msg = array("valid" => false, "msg" => "QUERY ERROR.");
                    echo json_encode($msg);
                    exit(); // Exit the script if an error occurs
                }





				$sql3 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$systemMessage','$currentDateTime','$tran','$status')");
				$sql4 = mysqli_query($conn, "INSERT INTO notifications(messageTo,message, date, transaction, status) VALUES('admin','$messageAdmin','$currentDateTime','$tran','$status')");
				$sql5 = mysqli_query($conn, "INSERT INTO notifications(messageTo,message, date, transaction, status) VALUES('staff','$messageAdmin','$currentDateTime','$tran','$status')");


				// Function to generate email body and signature
				function generateEmailBody($messageContent) {
					$message = "<html><body>";
					$message .= $messageContent;
					$message .= "<br>";
					$message .= "</body></html>";

					return $message;
				}

				// Staff email sending logic
				$staffEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM staff WHERE status=''");
				while ($row12321 = mysqli_fetch_assoc($staffEmailQuery)) {
					if (!empty($row12321['email'])) {
						$staffEmail = $row12321['email'];
					}
					$staffName = $row12321['fname'] . " " . $row12321['lname'];

					$messageContent = "<p>A Customer named $name made a new rent request. Please log in to the staff dashboard to review and process the request promptly.</p>";
					
					$message = generateEmailBody($messageContent);

					$emailName = "Litz Autoshop";
					$emailAdd = "malano.angelo@dnsc.edu.ph";
					$emailSubject = "New Rent Request";

					$mail->setFrom($emailAdd, $emailName);
					$mail->addAddress($staffEmail, $staffName);

					$mail->isHTML(true);
					$mail->Subject = $emailSubject;
					$mail->Body = $message;

					// Check if the email was sent successfully
					if (!$mail->send()) {
						$emailError = "Mailer Error: " . $mail->ErrorInfo;
						$msg = array("valid" => false, "msg" => $emailError);
						echo json_encode($msg);
						exit;
					}

					// Clear recipients and reset the email object for the next iteration
					$mail->ClearAllRecipients();
					$mail->ClearAttachments();
				}

				// Admin email sending logic
				$adminEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM admin");
				while ($row12321 = mysqli_fetch_assoc($adminEmailQuery)) {
					if (!empty($row12321['email'])) {
						$adminEmail = $row12321['email'];
					}
					$adminName = $row12321['fname'] . " " . $row12321['lname'];

					$messageContent = "<p>A Customer named $name made a new rent request. Please log in to the admin dashboard to review and process the request promptly.</p>";
					
					$message = generateEmailBody($messageContent);

					$emailName = "Litz Autoshop";
					$emailAdd = "malano.angelo@dnsc.edu.ph";
					$emailSubject = "New Rent Request";

					$mail->setFrom($emailAdd, $emailName);
					$mail->addAddress($adminEmail, $adminName);

					$mail->isHTML(true);
					$mail->Subject = $emailSubject;
					$mail->Body = $message;

					// Check if the email was sent successfully
					if (!$mail->send()) {
						$emailError = "Mailer Error: " . $mail->ErrorInfo;
						$msg = array("valid" => false, "msg" => $emailError);
						echo json_encode($msg);
						exit;
					}

					// Clear recipients and reset the email object for the next iteration
					$mail->ClearAllRecipients();
					$mail->ClearAttachments();
				}

				// Close the mail connection after sending all emails
				$mail->smtpClose();

				
				$msg = array("valid" => true, "msg" => "Request Sent Successfully!.");
				echo json_encode($msg);
			// }
		} else {
			$msg = array("valid" => false, "msg" => $error);
			echo json_encode($msg);
		}
	} catch (Exception $e) {
		$msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
		echo json_encode($msg);
	}
?>