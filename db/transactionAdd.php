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
		$msg = $cust_id = $name = $totalprice = "";
		$error = "";
		$valid = true;

		if(isset($_POST['cust_id']) && !empty($_POST['cust_id'])){
			$cust_id = $_POST['cust_id'];
		}else{
			$valid = false;
			$error = "CUSTOMER ID INVALID";
			$cust_id = "";
		}

		if(isset($_POST['name']) && !empty($_POST['name'])){
			$name = $_POST['name'];
		}else{
			$valid = false;
			$error = "CUSTOMER NAME INVALID";
			$name = "";
		}

		if(isset($_POST['totalprice']) && !empty($_POST['totalprice'])){
			$totalprice = $_POST['totalprice'];
		}else{
			$valid = false;
			$error = "TOTAL PRICE INVALID";
			$totalprice = "";
		}

        $checkedItems = $_POST['checkedItems'];

        $order = $_POST['order'];
		// $tran_id = uniqid(); // GENERATE Transaction ID
        $status = "Pending";
		$tran = "order";
		$currentDateTime = date("Y-m-d H:i:s");
        $systemMessage = "You Made an Order, Please Wait for the Confirmation.";
        $messageAdmin = "A New Order has been Made.";

		if($valid){
            
            function generateUniqueID() {
                global $conn;
                // Fetch the current TransactionIndexID
                $stmt = mysqli_query($conn, "SELECT TransactionIndexID FROM datastoring WHERE id = 1 ");
                $dataTransaction = mysqli_fetch_assoc($stmt);
                $TransactionIndexID = $dataTransaction['TransactionIndexID'];
            
                // Increment TransactionIndexID by 1
                $TransactionIndexID++;
            
                // Pad the numerical part with zeros to ensure it's always six digits
                $paddedTransactionIndexID = str_pad($TransactionIndexID, 6, '0', STR_PAD_LEFT);
            
                // Construct the final ID with the current year and padded TransactionIndexID
                $currentYear = date('Y');
                $tran_id = $currentYear . '-' . $paddedTransactionIndexID;
            
                // Update the datastoring table with the incremented TransactionIndexID
                $stmt = mysqli_query($conn, "UPDATE datastoring SET TransactionIndexID = '$TransactionIndexID' WHERE id = 1 ");
            
                // Return the generated tran_id
                return $tran_id;
            }
            
            
            if ($order == "car") {
                foreach ($checkedItems as $cart_id) {
                    $carValidationQuery = mysqli_query($conn, "SELECT * FROM carts WHERE cart_id = '$cart_id' ");

                    $data = mysqli_fetch_assoc($carValidationQuery);
                    $cust_idcar = $data['cust_id'];
                    $totalpricecar = $data['price'] * $data['quantity'];
                    
                    $tran_id_car = generateUniqueID();  // Use a different variable for car orders
                    
                    mysqli_query($conn, "INSERT INTO orders(cust_id, customerName, tran_id, totalprice, date, transaction_type, status) VALUES('$cust_idcar', '$name', '$tran_id_car', '$totalpricecar', '$currentDateTime', '$order', '$status') ");
                    $sql2 = mysqli_query($conn, "INSERT INTO client_documents(cust_id, tran_id, status) VALUES('$cust_idcar','$tran_id_car','$status')");

                    mysqli_query($conn, "UPDATE carts SET status = '$status', date = '$currentDateTime', tran_id = '$tran_id_car' WHERE cart_id = '$cart_id'");
                }
            }else if ($order == "sparepart") {
                $tran_id_sparepart = generateUniqueID();  // Use a different variable for sparepart orders
                
                mysqli_query($conn, "INSERT INTO orders(cust_id, customerName, tran_id, totalprice, date, transaction_type, status) VALUES('$cust_id', '$name', '$tran_id_sparepart', '$totalprice', '$currentDateTime', '$order', '$status') ");
            
                foreach ($checkedItems as $cart_id) {
                    mysqli_query($conn, "UPDATE carts SET status = '$status', date = '$currentDateTime', tran_id = '$tran_id_sparepart' WHERE cart_id = '$cart_id' ");
                }
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

                        $messageContent = "<p>A Customer named $name made a new order. Please log in to the staff dashboard to review and process the order promptly.</p>";
                        
                        $message = generateEmailBody($messageContent);

                        $emailName = "Litz Autoshop";
                        $emailAdd = "malano.angelo@dnsc.edu.ph";
                        $emailSubject = "New Order";

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

                        $messageContent = "<p>A Customer named $name made a new order. Please log in to the admin dashboard to review and process the order promptly.</p>";
                        
                        $message = generateEmailBody($messageContent);

                        $emailName = "Litz Autoshop";
                        $emailAdd = "malano.angelo@dnsc.edu.ph";
                        $emailSubject = "New Order";

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


				$msg = array("valid" => true, "msg" => "Placing Order Successful.");
				echo json_encode($msg);
                
			
		} else {
			$msg = array("valid" => false, "msg" => $error);
			echo json_encode($msg);
		}
	} catch (Exception $e) {
		$msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
		echo json_encode($msg);
	}


