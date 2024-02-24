<?php
	include "connection.php";
	try{
		$msg = $id = $error = "";
		$valid = true;

		if(isset($_POST['id']) && !empty($_POST['id'])){
			$id = $_POST['id'];
		}else{
			$valid = false;
			$error .= "PRODUCT ID is invalid";
			$id = "";
		}

			$img = $_POST['img'];
			$product = $_POST['product'];
			$quantity = $_POST['quantity'];
			$price = $_POST['price'];
			$details = $_POST['details'];

			$status="archived";
		
		if($valid){
			// $sql = mysqli_query($conn, "INSERT INTO spareparts_accessories_archived(img, product, quantity, price, details) VALUES('$img','$product','$quantity','$price','$details')");
			$sqll = mysqli_query($conn, "UPDATE spareparts_accessories SET status='$status' WHERE sparepart_id = '$id'");

		$msg = array("valid"=>true, "msg"=>"SPAREPARTS TRANSACTION ARCHIVED!.");
		echo json_encode($msg);
	}else{
		$msg = array("valid"=>false, "msg"=>$error);
		echo json_encode($msg);
	}
	}catch (Exception $e){
		$msg =  array("valid"=>true, "msg"=>'Error-> '. $e->getMessage(). '\n');
		echo json_encode($msg);
	}
