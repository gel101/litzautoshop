<?php

include 'connection.php';

require_once "../vendor/autoload.php";

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
    $msg = $file = $error = "";
	$valid = true;
	
    
    // Check if a file was uploaded
    if (isset($_FILES['validID']) && is_uploaded_file($_FILES['validID']['tmp_name'])) {
        $file = $_FILES['validID'];

        // Retrieve file information
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize > $maxFileSize) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }
        
		// Move the uploaded file to the desired location
		$uniqueName = uniqid('', true);
		$directory = 'img/validID/';
		$destination = $directory . $uniqueName;
    }else {
		$error = "NO VALID ID INSERTED";
		$valid = false;
	}

    
    // Retrieve the form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $birthdate = $_POST['birthdate'];
	$pnum = $_POST['pnum'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $status = "Pending";

    
        
    // Check if the email address has a valid format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $error = "Email is invalid";
        $email = "";
    }

	if(strlen($pnum) !== 11){
		$valid = false;
        $error = "Phone Number should be exactly 11 digits!";
	}


    function validatePassword($password) {
        // Define a regular expression pattern for the password requirements
        $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/';

        // Test the password against the pattern
        $isValid = preg_match($passwordPattern, $password);

        return $isValid;
    }

    if (strlen($pass) < 8) {
        $valid = false;
        $error = "Password should be at least 8 characters long.";
        $pass = "";
    } else {
        if (!validatePassword($pass)) {
            $valid = false;
            $error = "Password should have Uppercase, Lowercase, and a Number!";
            $pass = "";
        }
    }

	
	if ($valid) {
        
        // Move the Valid ID picture in the directory
		move_uploaded_file($fileTmpName, $destination);
		$picture = $destination;

		//Database
		$sqlll = "SELECT * FROM clientacc WHERE username='$uname' and pass='$pass'";
		$result = mysqli_query($conn, $sqlll);
        
		//Database
		$sqlemail = "SELECT * FROM clientacc WHERE email = '$email' ";
		$result2 = mysqli_query($conn, $sqlemail);

        
		if (mysqli_num_rows($result) >= 1) {
            $msg = array("valid" => false, "msg" => "Username Already Taken!");
            echo json_encode($msg);
            exit;
        }else if (mysqli_num_rows($result2) >= 1) {
            $msg = array("valid" => false, "msg" => "The Email was Already Used!");
            echo json_encode($msg);
            exit;
        }else {
            $sql = "INSERT INTO clientacc (validID, fname, lname, birthdate, address, phoneNum, email, username, pass, status) VALUES ('$picture','$fname', '$lname', '$birthdate','$address', '$pnum', '$email', '$uname', '$pass','$status')";
            $result = mysqli_query($conn, $sql);
            
            
            if ($result) {
                $message = "<html><body>";
                $message .= "<h3>Hi admin, a new account has been created on the Litz Auto Shop Website. Please verify the user using the website for security purposes. Thank you!</h3>";
                $message .= "<h4>Account Details<h4>";
                $message .= "<p>Client name: $fname $lname<br>
                                Birth Date: $birthdate<br>
                                Address: $address<br>
                                Phone Number: $pnum<br>
                                Email Address: $email<br>
                                Username: $uname</p>";
                $message .= "<br>";
                $message .= "</body></html>";
                
                $emailName = "Litz Autoshop Website Auto Email";
                $emailAdd = "litzautoshop@gmail.com";
                $emailSubject = "New User Account Created!";

                $mail->setFrom($emailAdd, $emailName);
                $mail->addAddress("litzautoshop@gmail.com", "Litz Autoshop");
            
                $mail->isHTML(true);
                $mail->Subject = $emailSubject;
                $mail->Body = $message;
                $mail->send();

                // Clear recipients and reset the email object for the next iteration
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
        
                // Close the mail connection after sending all emails
                $mail->smtpClose();




                $msg = array("valid" => true, "msg" => "Creating Account Successful!");
                echo json_encode($msg);
                exit;
            }else {
                $msg = array("valid" => false, "msg" => "Error Creating Account!.");
                echo json_encode($msg);
                exit;
            }
        }
	}else {
		$msg = array("valid"=>false, "msg"=>$error);
		echo json_encode($msg);
    }

} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
    echo json_encode($msg);
}

