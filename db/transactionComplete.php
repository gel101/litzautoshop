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
$msg = $order_id = $cust_id = $tran_id = $plateNum = "";
	$valid = true;

	if(isset($_POST['order_id']) && !empty($_POST['order_id'])){
		$order_id = $_POST['order_id'];
	}else{
		$valid = false;
		$error .= "Transaction ID is invalid";
		$order_id = "";
	}

	$cust_id = $_POST['cust_id'];

	if(isset($_POST['tran_id']) && !empty($_POST['tran_id'])){
		$tran_id = $_POST['tran_id'];
	}else{
		$valid = false;
		$error .= "tran_id is invalid";
		$tran_id = "";
	}
	
	if(isset($_POST['plateNum']) && !empty($_POST['plateNum'])){
		$plateNum = $_POST['plateNum'];
	}else{
		$valid = false;
		$error .= " Plate Number is invalid";
		$plateNum = "";
	}

	$currentDateTime = date("Y-m-d H:i:s");
	$status = "Completed";
	$messageSystem = "This Order was declared as Completed. " . "Transaction ID : " . $tran_id;
	$tran = "order";

	if($valid){

		$sql = mysqli_query($conn, "UPDATE orders SET status = '$status', date = '$currentDateTime', plate_number='$plateNum' WHERE order_id = '$order_id' ");
		$sql = mysqli_query($conn, "UPDATE carts SET status = '$status', date = '$currentDateTime' WHERE tran_id = '$tran_id' ");
		$sqlll = mysqli_query($conn, "UPDATE client_documents SET status = '$status' WHERE tran_id = '$tran_id' ");
		if ($cust_id != "") {
			$sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$messageSystem','$currentDateTime','$tran','$status')");
		}
		$sql22 = mysqli_query($conn, "INSERT INTO notifications(messageTo, message, date, transaction, status) VALUES('admin','$messageSystem','$currentDateTime','$tran','$status')");
		$sql62 = mysqli_query($conn, "INSERT INTO notifications(messageTo, message, date, transaction, status) VALUES('staff','$messageSystem','$currentDateTime','$tran','$status')");

		//Transaction Detail query
		$transactionDetailQuery = mysqli_query($conn, "SELECT * FROM orders WHERE tran_id='$tran_id'");

		$rowtransaction = mysqli_fetch_assoc($transactionDetailQuery);
		$totalpricetran = $rowtransaction['totalprice'];
		$customernametran = $rowtransaction['customerName'];
        if ($rowtransaction['payment_term'] == "For Finance") {
            $finalpaymentTerm = $rowtransaction['payment_term'];
        }else {
            $finalpaymentTerm = $rowtransaction['payment_term'] . "(" . $rowtransaction['payment_mode'] . " " . $rowtransaction['reference_number'] . ")";
        }

        if ($cust_id != "") {
            // Customer email sending logic
            $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
            $row5 = mysqli_fetch_assoc($custEmailQuery);
            $customerEmail = $row5['email'];
            $customerName = $row5['fname'] . " " . $row5['lname'];
			$custLname = $row5['lname'];
        }else {
            $custEmailQuery2 = mysqli_query($conn, "SELECT noAccEmail, customerName FROM orders WHERE tran_id = '$tran_id' ");
            $rowemail = mysqli_fetch_assoc($custEmailQuery2);
            $customerEmail = $rowemail['noAccEmail'];
            $customerName = $rowemail['customerName'];
			$custLname = $rowemail['customerName'];
        }
						

		$signature = "<br>";
		$signature .= "<p>Regards,<br>";
		$signature .= "Litz Autoshop<br>";
		$signature .= "Email Notification<br>";
		$signature .= "Litz Auto Surplus Prk. 2 Brgy. Little Panay Panabo Davao Del Norte , Panabo, Philippines<br>";
		$signature .= "Phone: 09169834159<br>";
		$signature .= "Email: marjlit1@gmail.com</p>";

		$message = "<html><body>";
		$message .= "<p>Dear Mr/Mrs. $custLname,</p>";
		$message .= "<p>We want to inform you that your recent order has been successfully completed!</p>";
		$message .= "<br>";
		$message .= "<h4>Transaction Details</h4>";
		$message .= "<p>Total Price: &#8369;" . number_format($totalpricetran, 2) . "<br>Payment Status: $finalpaymentTerm<br>Transaction ID: $tran_id</p>";		
		$message .= "<h4>Order Details: </h4>";
		$message .= "<table style='width: 100%; border-collapse: collapse;' class='table text-center'>";
		$message .= "<thead style='background-color: #f2f2f2;' class='text-secondary'>";
		$message .= "<tr>";
		$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>ID</th>";
		$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Product</th>";
		$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Color</th>";
		$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Engine</th>";
		$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Model</th>";
		$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Quantity</th>";
		$message .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Price</th>";
		$message .= "</tr>";
		$message .= "</thead>";

		$stmtcarts = mysqli_query($conn, "SELECT * FROM carts WHERE tran_id = '$tran_id' ");

		while ($rowcarts = mysqli_fetch_assoc($stmtcarts)) {
			$cart_id = $rowcarts['cart_id'];
			$product = $rowcarts['product'];
			$color = $rowcarts['color'];
			$engine = $rowcarts['engine'];
			$model = $rowcarts['model'];
			$quantity = $rowcarts['quantity'];
			$price = number_format($rowcarts['price'], 2);

			$message .= "<tr>";
			$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$cart_id</td>";
			$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$product</td>";
			$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$color</td>";
			$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$engine</td>";
			$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$model</td>";
			$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$quantity</td>";
			$message .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>&#8369;$price</td>";
			$message .= "</tr>";
		}

		$message .= "</table>";
		$message .= "<br>";
		$message .= "<p>Thank you for choosing Litz Autoshop for your purchase. We appreciate your trust in us and it is a pleasure if you order on us again.</p>";
		$message .= $signature;
		$message .= "</body></html>";

	
		$emailName = "Litz Autoshop";
		$emailAdd = "litzautoshop@gmail.com";
		$emailSubject = "Order Completed - Thank You for Your Purchase!";

        $mail->setFrom($emailAdd, $emailName);
        $mail->addAddress($customerEmail, $customerName);

		$mail->isHTML(true);
        $mail->Subject = $emailSubject;
        $mail->Body = $message;
        $mail->send();


		$msg = array("valid"=>true, "msg"=>"Data updated.");
		echo json_encode($msg);
	} else {
		$msg = array("valid"=>false, "msg"=>$error);
		echo json_encode($msg);
	}
} catch (Exception $e) {
	$msg =  array("valid"=>false, "msg"=>'Error-> '. $e->getMessage(). '\n');
	echo json_encode($msg);
}
?>