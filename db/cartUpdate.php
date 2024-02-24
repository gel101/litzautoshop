<?php
	include "connection.php";
	
	try{
		$msg = $cart_id = $color = $quantity = "";
		$error = "";
		$valid = true;

		if(isset($_POST['cart_id']) && !empty($_POST['cart_id'])){
			$cart_id = $_POST['cart_id'];
		}else{
			$valid = false;
			$error = "Session ID is invalid";
			$cart_id = "";
		}

		if(isset($_POST['quantity']) && !empty($_POST['quantity'])){
			$quantity = $_POST['quantity'];
		}else{
			$valid = false;
			$error = "Quantity is invalid";
			$quantity = "";
		}

		$color = $_POST['color'];
		$status = "on cart";

		if($valid){
				$sql = mysqli_query($conn, "UPDATE carts SET color='$color', quantity='$quantity' WHERE cart_id='$cart_id' ");
				$msg = array("valid" => true, "msg" => "Updated!.");
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