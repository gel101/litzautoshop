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


try {
    $msg = $cust_id = $validID = $fname = $lname = $birthdate = $address = $phoneNum = $email = $uname = $pass = "";
    $valid = true;


    if (isset($_POST['cust_id']) && !empty($_POST['cust_id'])) {
        $cust_id = $_POST['cust_id'];
    } else {
        $valid = false;
        $error .= "Client ID is invalid";
        $cust_id = "";
    }

    if (isset($_POST['fname']) && !empty($_POST['fname'])) {
        $fname = $_POST['fname'];
    } else {
        $valid = false;
        $error .= "First Name is invalid";
        $fname = "";
    }

    if (isset($_POST['lname']) && !empty($_POST['lname'])) {
        $lname = $_POST['lname'];
    } else {
        $valid = false;
        $error .= "last Name is invalid";
        $lname = "";
    }

    if (isset($_POST['birthdate']) && !empty($_POST['birthdate'])) {
        $birthdate = $_POST['birthdate'];
    } else {
        $valid = false;
        $error .= "birthdate is invalid";
        $birthdate = "";
    }

    if (isset($_POST['address']) && !empty($_POST['address'])) {
        $address = $_POST['address'];
    } else {
        $valid = false;
        $error .= "address is invalid";
        $address = "";
    }

    if (isset($_POST['phoneNum']) && !empty($_POST['phoneNum'])) {
        $phoneNum = $_POST['phoneNum'];
    } else {
        $valid = false;
        $error .= "phone Number is invalid";
        $phoneNum = "";
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $valid = false;
        $error .= "Email is invalid";
        $email = "";
    }

    if (isset($_POST['uname']) && !empty($_POST['uname'])) {
        $uname = $_POST['uname'];
    } else {
        $valid = false;
        $error .= "Username is invalid";
        $uname = "";
    }

    if (isset($_POST['pass']) && !empty($_POST['pass'])) {
        $pass = $_POST['pass'];
    } else {
        $valid = false;
        $error .= "Password is invalid";
        $pass = "";
    }
        
    // Check if the email address has a valid format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $error = "Email is invalid";
        $email = "";
    }

	if(strlen($phoneNum) !== 11){
		$valid = false;
        $error = "Phone Number should be exactly 11 digits!";
	}



    if ($valid) {
        // Check if account already exists in the database
        // $query = "SELECT * FROM clientacc WHERE fname = '$fname' AND lname = '$lname' AND birthdate = '$birthdate'";
        $query2 = "SELECT * FROM clientacc WHERE username = '$uname' AND cust_id != '$cust_id' ";
        // $result = mysqli_query($conn, $query);
        $result2 = mysqli_query($conn, $query2);
        // if (mysqli_num_rows($result) > 0) {
        //     $msg = array("valid" => false, "msg" => "Client already existed.");
        //     echo json_encode($msg);
        //     exit;
        // }
        if (mysqli_num_rows($result2) > 0) {
            $msg = array("valid" => false, "msg" => "Username already existed!");
            echo json_encode($msg);
            exit;
        } else {
            if (isset($_FILES['evalidID']) && is_uploaded_file($_FILES['evalidID']['tmp_name'])) {
                $file = $_FILES['evalidID'];

                // Retrieve file information
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileError = $file['error'];

                // Validate file type
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                if (!in_array($fileExtension, $allowedExtensions)) {
                    $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
                    $valid = false;
                }

                // Validate file size
                $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
                if ($fileSize > $maxFileSize) {
                    $error = "File size exceeds the maximum limit of 10MB.";
                    $valid = false;
                }

                if ($valid) {
                    // Move the uploaded file to the desired location
                    $uniqueName = uniqid('', true);
                    $directory = 'img/validID/';
                    $destination = $directory . $uniqueName;
                    move_uploaded_file($fileTmpName, $destination);
                    $validID = $destination;
                    
                    $sql = mysqli_query($conn, "UPDATE clientacc SET validID = '$validID', fname = '$fname', lname = '$lname', birthdate = '$birthdate', address = '$address', phoneNum = '$phoneNum', email = '$email' , username = '$uname' , pass = '$pass' WHERE cust_id = '$cust_id' ");
                    
                    //Email query
                    $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
                    
                    $row5 = mysqli_fetch_assoc($custEmailQuery);
                    $customerEmail = $row5['email'];
                    $customerName = $row5['fname'] . " " . $row5['lname'] ;
                    $custLname = $row5['lname'];

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
                    $message .= "<p>I hope this message finds you well. We want to inform you that there have been recent changes made to your account. Below is the information:</p>";
                    $message .= "<ul>";
                    $message .= "<li>Phone #: $phoneNum</li>";
                    $message .= "<li>Username: $uname</li>";
                    $message .= "<li>Password: $pass</li>";
                    $message .= "</ul>";
                    $message .= "<p>$signature</p>";
                    $message .= "</body></html>";

                    
                    $emailName = "Litz Autoshop";
                    $emailAdd = "litzautoshop@gmail.com";
                    $emailSubject = "Litz Autoshop Update Account";

                    $mail->setFrom($emailAdd, $emailName);
                    $mail->addAddress($customerEmail, $customerName);

                    $mail->isHTML(true);
                    $mail->Subject = $emailSubject;
                    $mail->Body = $message;
                    $mail->send();


                    $msg = array("valid" => true, "msg" => "Client Information Updated!");
                    echo json_encode($msg);
                    exit;

                } else {
                    $msg = array("valid" => false, "msg" => $error);
                    echo json_encode($msg);
                    exit; // Stop further execution
                }
            }

            $sql = mysqli_query($conn, "UPDATE clientacc SET fname = '$fname', lname = '$lname', birthdate = '$birthdate', address = '$address', phoneNum = '$phoneNum', email = '$email' , username = '$uname' , pass = '$pass' WHERE cust_id = '$cust_id' ");

            //Email query
            $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
            
            $row5 = mysqli_fetch_assoc($custEmailQuery);
            $customerEmail = $row5['email'];
            $customerName = $row5['fname'] . " " . $row5['lname'] ;
            $custLname = $row5['lname'];

            $signature = "<br>";
            $signature .= "<br>";
            $signature .= "<br>";
			$signature .= "Regards,<br>";
            $signature .= "Litz Autoshop<br>";
            $signature .= "Email Notification<br>";
            $signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
            $signature .= "Phone: 09169834159<br>";
            $signature .= "Email: marjlit1@gmail.com</p>";

            $message = "<html><body>";
            $message .= "<p>Dear Mr/Mrs. $custLname,</p>";
            $message .= "<p>I hope this message finds you well. We want to inform you that there have been recent updates made to your account.</p>";
            $message .= "<p>Below is the information:</p>";
            $message .= "<ul>";
            $message .= "<li>Phone #: $phoneNum</li>";
            $message .= "<li>Username: $uname</li>";
            $message .= "<li>Password: $pass</li>";
            $message .= "</ul>";
            $message .= $signature;
            $message .= "</body></html>";
            
            $emailName = "Litz Autoshop";
            $emailAdd = "litzautoshop@gmail.com";
            $emailSubject = "Litz Autoshop Update Account";

            $mail->setFrom($emailAdd, $emailName);
            $mail->addAddress($customerEmail, $customerName);

            $mail->isHTML(true);
            $mail->Subject = $emailSubject;
            $mail->Body = $message;
            $mail->send();

            $msg = array("valid" => true, "msg" => "Client Information Updated!");
            echo json_encode($msg);
            exit;
        }
    } else {
        $msg = array("valid" => false, "msg" => $error);
        echo json_encode($msg);
        exit;
    }
} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>