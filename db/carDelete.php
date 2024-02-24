<?php
	include "connection.php";
	try{
		$msg = $car_id = $error = "";
		$valid = true;

		if(isset($_POST['car_id']) && !empty($_POST['car_id'])){
			$car_id = $_POST['car_id'];
		}else{
			$valid = false;
			$error .= "CAR ID is invalid";
			$car_id = "";
		}

			$car_img = $_POST['car_img'];
			$car_type = $_POST['car_type'];
			$name = $_POST['name'];
			$model = $_POST['model'];
			$engine = $_POST['engine'];
			$quantity = $_POST['quantity'];
			$price = $_POST['price'];
			$details = $_POST['details'];

			$status="archived";
		
		if($valid){
			// $sql = mysqli_query($conn, "INSERT INTO cars_archived(car_img, car_type, name, model, engine, quantity, price, details) VALUES('$car_img','$car_type','$name','$model','$engine','$quantity','$price','$details')");
			$sqll = mysqli_query($conn, "UPDATE cars SET status='$status' WHERE car_id = '$car_id'");

		$msg = array("valid"=>true, "msg"=>"CAR ARCHIVED!.");
		echo json_encode($msg);
	}else{
		$msg = array("valid"=>false, "msg"=>$error);
		echo json_encode($msg);
	}
	}catch (Exception $e){
		$msg =  array("valid"=>true, "msg"=>'Error-> '. $e->getMessage(). '\n');
		echo json_encode($msg);
	}
