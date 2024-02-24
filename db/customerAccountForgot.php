<?php
include 'connection.php' ;

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
    $msg = $error = $uname = $email = $randomString = "";
    $valid = true;

    if(isset($_POST['uname']) && !empty($_POST['uname'])){
        $uname = $_POST['uname'];
    }else{
        $valid = false;
        $error = "Username is invalid";
        $uname = "";
    }

    if(isset($_POST['email']) && !empty($_POST['email'])){
        $email = $_POST['email'];
        
        // Check if the email address has a valid format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $error = "Email is invalid";
            $email = "";
        }
    }else{
        $valid = false;
        $error = "Email is invalid";
        $email = "";
    }

    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle($characters), 0, $length);
        return $randomString;
    }

    $randomString = generateRandomString();

    if($valid){
        $sql = "SELECT * FROM clientacc WHERE username='$uname' AND email='$email'";
        $result = $conn->query($sql);
    
        if ($result->num_rows == 1) {

            $updateQuery = mysqli_query($conn, "UPDATE clientacc SET pass = '$randomString' WHERE username = '$uname' AND email = '$email' ");

            if ($updateQuery) {

                function generateEmailBody() {
                    global $randomString;
                    global $uname;
                    $signature = "<br>";
                    $signature .= "Regards,<br>";
                    $signature .= "Litz Autoshop<br>";
                    $signature .= "Email Notification<br>";
                    $signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
                    $signature .= "Phone: 09169834159<br>";
                    $signature .= "Email: marjlit1@gmail.com</p>";
                    $message = "<html><body>";
                    $message .= "<h4>Account Recovery</h4>";
                    $message .= "<p>Thank you for reaching us, here is your temporary account password:<h3>Username: $uname</h3> <h3> New password: $randomString</h3></p>";
                    $message .= "<br>";
                    $message .= $signature;
                    $message .= "</body></html>";

                    return $message;
                }

                $message = generateEmailBody();
        
                $emailName = "Litz Autoshop";
                $emailAdd = "malano.angelo@dnsc.edu.ph";
                $emailSubject = "Account Recovery";
        
                $mail->setFrom($emailAdd, $emailName);
                $mail->addAddress($email, "Litz Autoshop Customer");
        
                $mail->isHTML(true);
                $mail->Subject = $emailSubject;
                $mail->Body = $message;
                $mail->send();
        
                // Clear recipients and reset the email object for the next iteration
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
        
                // Close the mail connection after sending all emails
                $mail->smtpClose();


                // header("Location: customer-car.php");
                // exit;
                $msg = array("valid" => true, "msg" => "Successfully resets the account password!");
                echo json_encode($msg);
                exit;
                    
            }else {
                $msg = array("valid" => false, "msg" => "Update Query Failed!");
                echo json_encode($msg);
                exit;
            }
            
        }else{
            $msg = array("valid" => false, "msg" => "Unable to Find your Account in our System!");
            echo json_encode($msg);
            exit;
        }
        
    } else {
        $msg = array("valid" => false, "msg" => $error);
        echo json_encode($msg);
    }

} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
    echo json_encode($msg);
}



