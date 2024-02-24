<?php
	include "connection.php";
	
	try{
		$msg = $cust_id = $img = $carId = $car_type = $name = $model = $engine = $price = $color = $quantity = $details  = "";
		$error = "";
		$valid = true;

		if(isset($_POST['carId']) && !empty($_POST['carId'])){
			$carId = $_POST['carId'];
		}else{
			$valid = false;
			$error = "Car ID is invalid";
			$carId = "";
		}

		if(isset($_POST['cust_id']) && !empty($_POST['cust_id'])){
			$cust_id = $_POST['cust_id'];
		}else{
			$valid = false;
			$error = "Session ID is invalid";
			$cust_id = "";
		}

		if(isset($_POST['img']) && !empty($_POST['img'])){
			$img = $_POST['img'];
		}else{
			$valid = false;
			$error = "No image Path is invalid";
			$img = "";
		}

		if(isset($_POST['car_type']) && !empty($_POST['car_type'])){
			$car_type = $_POST['car_type'];
		}else{
			$valid = false;
			$error = "Car Type is invalid";
			$car_type = "";
		}

		if(isset($_POST['name']) && !empty($_POST['name'])){
			$name = $_POST['name'];
		}else{
			$valid = false;
			$error = "Car name is invalid";
			$name = "";
		}

		if(isset($_POST['model']) && !empty($_POST['model'])){
			$model = $_POST['model'];
		}else{
			$valid = false;
			$error = "Model is invalid";
			$model = "";
		}

		if(isset($_POST['engine']) && !empty($_POST['engine'])){
			$engine = $_POST['engine'];
		}else{
			$valid = false;
			$error = "engine is invalid";
			$engine = "";
		}

		if(isset($_POST['price']) && !empty($_POST['price'])){
			$price = $_POST['price'];
		}else{
			$valid = false;
			$error = "price is invalid";
			$price = "";
		}

		if(isset($_POST['color']) && !empty($_POST['color'])){
			$color = $_POST['color'];
		}else{
			$valid = false;
			$error = "color is invalid";
			$color = "";
		}

		if(isset($_POST['quantity']) && !empty($_POST['quantity'])){
			$quantity = $_POST['quantity'];
		}else{
			$valid = false;
			$error = "Quantity is invalid";
			$quantity = "";
		}


		$leftQ = $_POST['leftQ'];
		$details = $_POST['details'];
		$status = "on cart";

		if($valid){
			// Check if model already exists in the database
			$query = "SELECT * FROM carts WHERE car_id ='$carId' and product='$car_type' and model='$model' and engine='$engine' and status='$status'";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) > 0) {

				$query1 = "UPDATE carts SET color = '$color' WHERE car_id = '$carId' and cust_id ='$cust_id' and product='$car_type' and model='$model' and engine='$engine' and status='$status' ";
				$result1 = mysqli_query($conn, $query1);
				
				$msg = array("valid" => true, "msg" => "Car was Already in the Cart but the Selected Color Changed to $color!");
				echo json_encode($msg);
			} else {

				// Insert rows based on the quantity value
				for ($i = 0; $i < $quantity; $i++) {
					$sql = mysqli_query($conn, "INSERT INTO carts(cust_id, img, car_id, product, name, model, engine, price, color, quantity, leftQuantity, details, status) VALUES('$cust_id','$img','$carId','$car_type','$name','$model','$engine','$price','$color','1','$leftQ','$details','$status')");
				
					if (!$sql) {
						$msg = array("valid" => false, "msg" => "QUERY ERROR.");
						echo json_encode($msg);
						exit(); // Exit the script if an error occurs
					}
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