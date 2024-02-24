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

try {
    $msg = $rent_id = $cust_id = $driverL = $governmentID = $rentPrice = $rentPayment = "";
    $error = "";
    $valid = true;

    if (isset($_POST['rent_id']) && !empty($_POST['rent_id'])) {
        $rent_id = $_POST['rent_id'];
    } else {
        $valid = false;
        $error = "Rent ID invalid";
        $rent_id = "";
    }

    if (isset($_POST['cust_id']) && !empty($_POST['cust_id'])) {
        $cust_id = $_POST['cust_id'];
    } else {
        $valid = false;
        $error = "Customer ID invalid";
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


    // Check if a file was uploaded
    if (isset($_FILES['driverL']) && is_uploaded_file($_FILES['driverL']['tmp_name'])) {
        $file1 = $_FILES['driverL'];

        // Retrieve file information
        $fileName1 = $file1['name'];
        $fileTmpName1 = $file1['tmp_name'];
        $fileSize1 = $file1['size'];
        $fileError1 = $file1['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize1 = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize1 > $maxFileSize1) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }
    }else {
		$error = "DRIVER'S LICENSE EMPTY";
		$valid = false;
	}


    // Check if a file was uploaded
    if (isset($_FILES['governmentID']) && is_uploaded_file($_FILES['governmentID']['tmp_name'])) {
        $file2 = $_FILES['governmentID'];

        // Retrieve file information
        $fileName1 = $file2['name'];
        $fileTmpName2 = $file2['tmp_name'];
        $fileSize1 = $file2['size'];
        $fileError1 = $file2['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize1 = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize1 > $maxFileSize1) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }
    }else {
		$error = "GOVERNMENT ID EMPTY";
		$valid = false;
	}


    // // Check if a file was uploaded
    // if (isset($_FILES['addProff']) && is_uploaded_file($_FILES['addProff']['tmp_name'])) {
    //     $file3 = $_FILES['addProff'];

    //     // Retrieve file information
    //     $fileName1 = $file3['name'];
    //     $fileTmpName3 = $file3['tmp_name'];
    //     $fileSize1 = $file3['size'];
    //     $fileError1 = $file3['error'];

    //     // Validate file type
    //     $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    //     $fileExtension = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
    //     if (!in_array($fileExtension, $allowedExtensions)) {
    //         $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
    //         $valid = false;
    //     }

    //     // Validate file size
    //     $maxFileSize1 = 10 * 1024 * 1024; // 10MB in bytes
    //     if ($fileSize1 > $maxFileSize1) {
    //         $error = "File size exceeds the maximum limit of 10MB.";
    //         $valid = false;
    //     }
    // }else {
	// 	$error = "PROOF OF ADDRESS EMPTY";
	// 	$valid = false;
	// }

        
    $currentDateTime = date("Y-m-d H:i:s");

    $status = "In Use";
    $messageStaff = "The Car being rented claims that Requirements are Complete, and the car was already in use. " . "Rent ID : " . $rent_id;
    $messageClient = "The Car being rented claims that Requirements are Complete, and the car was already in use. " . "Rent ID : " . $rent_id;
    $tran = "rent";
    

    if ($valid) {
            // Move the uploaded file to the desired location
            $uniqueName1 = uniqid('', true);
            $directory1 = 'img/rent_documents/';
            $destination1 = $directory1 . $uniqueName1;
            move_uploaded_file($fileTmpName1, $destination1);
            $movedriverL = $destination1;

            $uniqueName2 = uniqid('', true);
            $directory2 = 'img/rent_documents/';
            $destination2 = $directory2 . $uniqueName2;
            move_uploaded_file($fileTmpName2, $destination2);
            $movegovernmentID = $destination2;

            // $uniqueName3 = uniqid('', true);
            // $directory3 = 'img/rent_documents/';
            // $destination3 = $directory3 . $uniqueName3;
            // move_uploaded_file($fileTmpName3, $destination3);
            // $moveaddProff = $destination3;


			$sql = mysqli_query($conn, "UPDATE rent_transactions SET driver_license='$movedriverL', government_id='$movegovernmentID', downpayment='$rentPayment', price='$rentPrice', date = '$currentDateTime', status = '$status' WHERE rent_id='$rent_id' ");
			



            // Function to generate email body and signature
            function generateEmailBody($messageContent, $rentPrice, $customerName, $rent_id, $rentPayment) {
                $signature = "<br>";
                $signature .= "Regards,<br>";
                $signature .= "Litz Autoshop<br>";
                $signature .= "Email Notification<br>";
                $signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
                $signature .= "Phone: 09169834159<br>";
                $signature .= "Email: marjlit1@gmail.com</p>";

                $message = "<html><body>";
                $message .= $messageContent;
                $message .= "<br>";
                $message .= "<h4>Transaction Details</h4>";
                $message .= "<p>Rent Price: &#8369;" . number_format($rentPrice, 2) . "<br>Customer's Payment: &#8369;$rentPayment<br>Rent ID: $rent_id</p>";
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
					$inputDate = $rowcarts['rentDate'];
					$date = DateTime::createFromFormat('Y-m-d', $inputDate);
					$formattedDate = $date->format('m-d-Y');
        
                    $message .= "<tr>";
                    $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$rent_id</td>";
                    $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$rentTime $rentTimeType</td>";
                    $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$formattedDate</td>";
                    $message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>&#8369;$price</td>";
                    $message .= "</tr>";
                }
        
                $message .= "</table>";
                $message .= "<br>";
                $message .= $signature;
                $message .= "</body></html>";

                return $message;
            }

            if ($cust_id != "") {
                // Customer email sending logic
                $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
                $row5 = mysqli_fetch_assoc($custEmailQuery);
                $customerEmail = $row5['email'];
                $customerName = $row5['fname'] . " " . $row5['lname'];
                $custLname = $row5['lname'];
            }else {
                $custEmailQuery2 = mysqli_query($conn, "SELECT noAccEmail, customerName FROM orders WHERE rent_id = '$rent_id' ");
                $rowemail = mysqli_fetch_assoc($custEmailQuery2);
                $customerEmail = $rowemail['noAccEmail'];
                $customerName = $rowemail['customerName'];
            }

            $messageContent = "<p>Dear Mr/Mrs. $custLname,</p>";
            $messageContent .= "<p>I hope this message finds you well. Litz Autoshop is pleased to inform you that the required documents for your rent request have been successfully compiled, and the process is now in progress.</p>";

            $message = generateEmailBody($messageContent, $rentPrice, $customerName, $rent_id, $rentPayment);

            $emailName = "Litz Autoshop";
            $emailAdd = "malano.angelo@dnsc.edu.ph";
            $emailSubject = "Rent Requirements Complete and Approved";

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






            $msg = array("valid" => true, "msg" => "Requirements Uploaded and Transaction Approved!");
            echo json_encode($msg);
        
    } else {
        $msg = array("valid" => false, "msg" => $error);
        echo json_encode($msg);
    }
} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>
