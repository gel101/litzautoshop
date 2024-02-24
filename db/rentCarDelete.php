<?php
	include "connection.php";
	try{
		$msg = $rentalcar_id = $error = "";
		$valid = true;

		if(isset($_POST['rentalcar_id']) && !empty($_POST['rentalcar_id'])){
			$rentalcar_id = $_POST['rentalcar_id'];
		}else{
			$valid = false;
			$error .= "CAR ID is invalid";
			$rentalcar_id = "";
		}

			$car_img = $_POST['car_img'];
			$car_type = $_POST['car_type'];
			$name = $_POST['name'];
			$model = $_POST['model'];
			$engine = $_POST['engine'];
			$details = $_POST['details'];

			$status="archived";
		
		if($valid){
			// $sql = mysqli_query($conn, "INSERT INTO cars_archived(car_img, car_type, name, model, engine, quantity, price, details) VALUES('$car_img','$car_type','$name','$model','$engine','$quantity','$price','$details')");
			$sqll = mysqli_query($conn, "UPDATE car_rental SET status='$status' WHERE rentalcar_id = '$rentalcar_id'");

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
