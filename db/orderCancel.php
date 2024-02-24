<?php
	include "connection.php";
	
	try{
		$msg = $order_id = "";
		$error = "";
		$valid = true;

		if(isset($_POST['order_id']) && !empty($_POST['order_id'])){
			$order_id = $_POST['order_id'];
		}else{
			$valid = false;
			$error = "Transaction ID is invalid";
			$order_id = "";
		}

        $status = "Canceled";

		if($valid){
				$sql = mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE order_id = '$order_id' ");
					
				$msg = array("valid" => true, "msg" => "Data Archived!.");
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