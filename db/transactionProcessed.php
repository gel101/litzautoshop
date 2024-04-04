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
$msg = $order_id = "";
	$valid = true;

	if(isset($_POST['order_id']) && !empty($_POST['order_id'])){
		$order_id = $_POST['order_id'];
	}else{
		$valid = false;
		$error .= "order ID is invalid";
		$order_id = "";
	}

	if(isset($_POST['date']) && !empty($_POST['date'])){
		$date = $_POST['date'];
	}else{
		$valid = false;
		$error .= "Date is invalid";
		$date = "";
	}

	if(isset($_POST['tran_id']) && !empty($_POST['tran_id'])){
		$tran_id = $_POST['tran_id'];
	}else{
		$valid = false;
		$error .= "Transaction ID is invalid";
		$tran_id = "";
	}

    if (isset($_POST['cust_id']) && !empty($_POST['cust_id'])) {
        $cust_id = $_POST['cust_id'];
    } else {
        $noAccStmt = mysqli_query($conn, "SELECT noAccEmail, noAccPhone, customerName FROM orders WHERE tran_id = '$tran_id'");
        $noAccRow = mysqli_fetch_assoc($noAccStmt);
        $noAccEmail = $noAccRow['noAccEmail'];
        $noAccPhone = $noAccRow['noAccPhone'];
        $noAccName = $noAccRow['customerName'];
    }

	// Set the timezone to the Philippines
	date_default_timezone_set('Asia/Manila');
	$currentDateTime = date("Y-m-d H:i:s");
	$status = "Ready to Pick Up";
	$messageClient = "The Order is Ready To Pick Up. Go to the store and get your item. " . "Transaction ID : " . $tran_id;
	$messageAdmin = "The Order is Ready To Pick Up. The Client was Informed to Get the Order. " . "Transaction ID : " . $tran_id;
	$tran = "order";
	
    $emailName = "Litz Autoshop";
    $emailAdd = "litzautoshop@gmail.com";
    $emailSubject = "Transaction Status Notification";

	if($valid){

		$sql = mysqli_query($conn, "UPDATE orders SET status = '$status', date = '$currentDateTime' WHERE order_id = '$order_id' ");
		$sql = mysqli_query($conn, "UPDATE carts SET status = '$status', date = '$currentDateTime' WHERE tran_id = '$tran_id' ");
		$sqlll = mysqli_query($conn, "UPDATE client_documents SET status = '$status' WHERE tran_id = '$tran_id' ");
		if (!empty($cust_id)) {
			$sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$messageClient','$currentDateTime','$tran','$status')");
		}
		$sql22 = mysqli_query($conn, "INSERT INTO notifications(messageTo, message, date, transaction, status) VALUES('admin','$messageAdmin','$currentDateTime','$tran','$status')");
		$sql42 = mysqli_query($conn, "INSERT INTO notifications(messageTo, message, date, transaction, status) VALUES('staff','$messageAdmin','$currentDateTime','$tran','$status')");


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

        if (!empty($cust_id)) {
            // Customer email sending logic
            $custEmailQuery = mysqli_query($conn, "SELECT email, fname, lname FROM clientacc WHERE cust_id='$cust_id'");
            $row5 = mysqli_fetch_assoc($custEmailQuery);
            $customerEmail = $row5['email'];
            $customerName = $row5['fname'] . " " . $row5['lname'];
			$custLname = $row5['lname'];
        }else {
            $customerEmail = $noAccEmail;
            $customerName = $noAccName;
            $custLname = $customerName;
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
		$message .= "<p>Good news! We, from Litz Autoshop, want to inform you that your order is now ready for pickup! We welcome you to our store to get your order as soon as possible. Thank you for your purchase.</p>";
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
		$message .= "<p>If you have any questions or special requests, please don't hesitate to come or contact us.</p>";
		$message .= $signature;
		$message .= "</body></html>";
		
		$emailName = "Litz Autoshop";
		$emailAdd = "litzautoshop@gmail.com";
		$emailSubject = "Good News from Litz Autoshop";

        $mail->setFrom($emailAdd, $emailName);
        $mail->addAddress($customerEmail, $customerName);
	
		$mail->isHTML(true);
        $mail->Subject = $emailSubject;
        $mail->Body = $message;
        $mail->send();
 


$price = number_format($totalpricetran, 2);
$textMessage = "Hello $customerName, this is Litz Autoshop. Good news! your order was ready for pick up.
Total Price: ₱$price
Transaction ID: $tran_id
Ordered Product: ";


$productQuery = mysqli_query($conn, "SELECT * FROM carts WHERE tran_id='$tran_id'");
while ($productRow = mysqli_fetch_assoc($productQuery)) {
    if ($productRow['car_id'] !== null) {
        $textMessage .= $productRow['product'] . " " . $productRow['engine'] . "(" . $productRow['model'] . ")";
    }else {
        $textMessage .= $productRow['product'] . "(" . $productRow['quantity'] . "x) ₱" . number_format($productRow['price'], 2) . ", ";
    }
}
	if (!empty($cust_id)) {
        $stmtclientNum = mysqli_query($conn, "SELECT phoneNum FROM clientacc WHERE cust_id = '$cust_id' ");
        $dataPhone = mysqli_fetch_assoc($stmtclientNum);

        $oldnumber = $dataPhone['phoneNum'];
        // $prefixedNumber = "+63" . substr($number, 1);
	}else{
        $oldnumber = $noAccPhone;
	}

		$msg = array("valid"=>true, "msg"=>"Data updated.", "number" => $oldnumber, "message" => $textMessage);
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