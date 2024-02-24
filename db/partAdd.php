<?php
	include "connection.php";
	
	try{
		$msg = $cust_id = $prodId = $img = $product = $quantity = $price = $details = "";
		$error = "";
		$valid = true;

		if(isset($_POST['prodId']) && !empty($_POST['prodId'])){
			$prodId = $_POST['prodId'];
		}else{
			$valid = false;
			$error = "Product ID is invalid";
			$prodId = "";
		}

		if(isset($_POST['cust_id']) && !empty($_POST['cust_id'])){
			$cust_id = $_POST['cust_id'];
		}else{
			$valid = false;
			$error = "Customer ID is invalid";
			$cust_id = "";
		}

		if(isset($_POST['img']) && !empty($_POST['img'])){
			$img = $_POST['img'];
		}else{
			$valid = false;
			$error = "No image source";
			$img = "";
		}

		if(isset($_POST['product']) && !empty($_POST['product'])){
			$product = $_POST['product'];
		}else{
			$valid = false;
			$error = "Product is invalid";
			$product = "";
		}

		if(isset($_POST['quantity']) && !empty($_POST['quantity'])){
			$quantity = $_POST['quantity'];
		}else{
			$valid = false;
			$error = "Quantity is invalid";
			$quantity = "";
		}

		if(isset($_POST['price']) && !empty($_POST['price'])){
			$price = $_POST['price'];
		}else{
			$valid = false;
			$error = "price is invalid";
			$price = "";
		}

		$leftQ = (int)$_POST['newleftQ'];
		$details = $_POST['details'];
		$status = "on cart";

		if($valid){
			// Check if engine_type already exists in the database
			$query = "SELECT * FROM carts WHERE product = '$product' and cust_id='$cust_id' and status='$status'";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) > 0) {

				$sql = mysqli_query($conn, "UPDATE carts SET quantity = quantity + '$quantity' WHERE sparepart_id = '$prodId'");

				$msg = array("valid" => true, "msg" => "ADDED TO CART!");
				echo json_encode($msg);
			} else {
				$sql = mysqli_query($conn, "INSERT INTO carts(cust_id, img, sparepart_id, product, quantity, leftQuantity, price, details, status) VALUES('$cust_id','$img','$prodId','$product','$quantity','$leftQ','$price','$details','$status')");
					if (!$sql) {
						$msg = array("valid" => false, "msg" => "QUERY ERROR.");
					}
				$msg = array("valid" => true, "msg" => "ADDED TO CART!");
				echo json_encode($msg);
			}
		} else {
			$msg = array("valid" => false, "msg" => $error);
			echo json_encode($msg);
		}
	} catch (Exception $e) {
		$msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
		echo json_encode($msg);
	}
?>