<?php
	include "connection.php";
	
	try{
		$msg = $fname = $lname = $birthdate = $pNum = $email = $user = $pass = $mechanic_id = "";
		$valid = true;

		if (isset($_POST['fname']) && !empty($_POST['fname'])) {
			$fname = $_POST['fname'];
		} else {
			$valid = false;
			$error = "Name is invalid";
			$fname = "";
		}

		if (isset($_POST['lname']) && !empty($_POST['lname'])) {
			$lname = $_POST['lname'];
		} else {
			$valid = false;
			$error = "lname is invalid";
			$lname = "";
		}

		if (isset($_POST['birthdate']) && !empty($_POST['birthdate'])) {
			$birthdate = $_POST['birthdate'];
		} else {
			$valid = false;
			$error = "birthdate is invalid";
			$birthdate = "";
		}

		if (isset($_POST['pNum']) && !empty($_POST['pNum'])) {
			$pNum = $_POST['pNum'];
		} else {
			$valid = false;
			$error = "pNum is invalid";
			$pNum = "";
		}

		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$email = $_POST['email'];
		} else {
			$valid = false;
			$error = "email is invalid";
			$email = "";
		}

		if (isset($_POST['user']) && !empty($_POST['user'])) {
			$user = $_POST['user'];
		} else {
			$valid = false;
			$error = "user is invalid";
			$user = "";
		}

		if (isset($_POST['pass']) && !empty($_POST['pass'])) {
			$pass = $_POST['pass'];
		} else {
			$valid = false;
			$error = "pass is invalid";
			$pass = "";
		}

		if (isset($_POST['mechanic_id']) && !empty($_POST['mechanic_id'])) {
			$mechanic_id = $_POST['mechanic_id'];
		} else {
			$valid = false;
			$error = "mechanic_id is invalid";
			$mechanic_id = "";
		}
     

		if($valid){
			// Check if the engine_type already exists in the database
			// $existingEngine = mysqli_query($conn, "SELECT * FROM mechanic WHERE fname = '$fname' and mechanic_id !='$mechanic_id'");

			// if(mysqli_num_rows($existingEngine) > 0) {
			// 	$msg = array("valid"=>false, "msg"=>"Mechanic already existed.");
			// 	echo json_encode($msg);
			// 	exit; // Stop execution further if engine type exists
			// }

			$sql = mysqli_query($conn, "UPDATE staff SET fname = '$fname', lname = '$lname', birthdate = '$birthdate', pNum = '$pNum', email = '$email', user = '$user', pass = '$pass' WHERE staff_id = '$mechanic_id' ");

			$msg = array("valid"=>true, "msg"=>"Data updated.");
			echo json_encode($msg);
		} else {
			$msg = array("valid"=>false, "msg"=>$error);
			echo json_encode($msg);
		}
	} catch (Exception $e) {
		$msg =  array("valid"=>false, "msg"=>'Error-> '. $e->getMessage(). '\n');
		echo json_encode($msg);
	}
?>