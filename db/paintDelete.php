<?php
	include "connection.php";
	try{
		$msg = $paint_id = $error = "";
		$valid = true;

		if(isset($_POST['paint_id']) && !empty($_POST['paint_id'])){
			$paint_id = $_POST['paint_id'];
		}else{
			$valid = false;
			$error .= "Paint ID is invalid";
			$paint_id = "";
		}

			$img = $_POST['img'];
			$color = $_POST['color'];
			$quantity = $_POST['quantity'];
			$status ="archived";
		
		if($valid){
			// $sql = mysqli_query($conn, "INSERT INTO paints_archived(img, paint_color, quantity) VALUES('$img','$color','$quantity')");
			$sqll = mysqli_query($conn, "UPDATE paints SET status='$status' WHERE paint_id = '$paint_id'");

		$msg = array("valid"=>true, "msg"=>"PAINT DELETED!.");
		echo json_encode($msg);
	}else{
		$msg = array("valid"=>false, "msg"=>$error);
		echo json_encode($msg);
	}
	}catch (Exception $e){
		$msg =  array("valid"=>true, "msg"=>'Error-> '. $e->getMessage(). '\n');
		echo json_encode($msg);
	}
