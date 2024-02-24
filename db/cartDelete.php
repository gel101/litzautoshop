<?php
	include "connection.php";
	try{
		$msg = $cart_id = $cust_id = $product = $name = $model = $engine = $price = $color = $quantity = $error = "";
		$valid = true;

		if(isset($_POST['cart_id']) && !empty($_POST['cart_id'])){
			$cart_id = $_POST['cart_id'];
		}else{
			$valid = false;
			$error .= "CART ID is invalid";
			$cart_id = "";
		}

		$cart_id = $_POST['cart_id'];
		$cust_id = $_POST['cust_id'];
		$product = $_POST['product'];
		$name = $_POST['name'];
		$model = $_POST['model'];
		$engine = $_POST['engine'];
		$price = $_POST['price'];
		$color = $_POST['color'];
		$quantity = $_POST['quantity'];
		$status = $_POST['status'];

		$archiveStatus="archived";
		
		if($valid){
		// $sql = mysqli_query($conn, "INSERT INTO carts_archived(cust_id, product, name, model, engine, price, color, quantity, status) VALUES('$cust_id','$product','$name','$model','$engine','$price','$color','$quantity','$status')");
		$sqlLL = mysqli_query($conn, "UPDATE carts SET status='$archiveStatus' WHERE cart_id = '$cart_id'");

		$msg = array("valid"=>true, "msg"=>"CART INFORMATION REMOVED!.");
		echo json_encode($msg);
	}else{
		$msg = array("valid"=>false, "msg"=>$error);
		echo json_encode($msg);
	}
	}catch (Exception $e){
		$msg =  array("valid"=>true, "msg"=>'Error-> '. $e->getMessage(). '\n');
		echo json_encode($msg);
	}
