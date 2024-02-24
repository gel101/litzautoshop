<?php
	include "connection.php";
	
	try{
		$msg = $rent_id = "";
		$error = "";
		$valid = true;

		if(isset($_POST['rent_id']) && !empty($_POST['rent_id'])){
			$rent_id = $_POST['rent_id'];
		}else{
			$valid = false;
			$error = "Rent ID is invalid";
			$rent_id = "";
		}

		$status = "Canceled";

		if($valid){
				$sql = mysqli_query($conn, "UPDATE rent_transactions SET status = '$status' WHERE rent_id = '$rent_id'");

				$msg = array("valid" => true, "msg" => "Rent Canceled!.");
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