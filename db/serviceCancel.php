<?php
	include "connection.php";
	
	try{
		$msg = $serviceID = "";
		$error = "";
		$valid = true;

		if(isset($_POST['serviceID']) && !empty($_POST['serviceID'])){
			$serviceID = $_POST['serviceID'];
		}else{
			$valid = false;
			$error = "Service ID is invalid";
			$serviceID = "";
		}

		$status = "Canceled";

		if($valid){
				$sql = mysqli_query($conn, "UPDATE request_services SET status = '$status' WHERE request_id = '$serviceID'");

				$msg = array("valid" => true, "msg" => "Data Deleted!.");
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