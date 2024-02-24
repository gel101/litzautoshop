<?php
	include "connection.php";
	
	try{
    $msg = $order_id = $cust_id = "";
		$valid = true;
		
		$cust_id = $_POST['cust_id'];


		if(isset($_POST['order_id']) && !empty($_POST['order_id'])){
			$order_id = $_POST['order_id'];
		}else{
			$valid = false;
			$error .= "Transaction ID is invalid";
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

        $status = "Order Preparing";
        $message = "Transaction ID : " . $tran_id . ". This Order was Preparing.";
		$tran = "order";

		if($valid){

			$sql = mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE order_id = '$order_id' ");
			$sql = mysqli_query($conn, "UPDATE carts SET status = '$status' WHERE tran_id = '$tran_id' ");
            $sqlll = mysqli_query($conn, "UPDATE client_documents SET status = '$status' WHERE tran_id = '$tran_id' ");
			if ($cust_id != "") {
				$sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$message','$date','$tran','$status')");
			}
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