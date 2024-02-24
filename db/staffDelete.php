<?php
	include "connection.php";
	try{
		$msg = $staff_id = $error = "";
		$valid = true;

		if(isset($_POST['staff_id']) && !empty($_POST['staff_id'])){
			$staff_id = $_POST['staff_id'];
		}else{
			$valid = false;
			$error .= "Staff ID is invalid";
			$staff_id = "";
		}

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $birthdate = $_POST['birthdate'];
        $pNum = $_POST['pNum'];
        $email = $_POST['email'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
		$status = "archived";


		if($valid){
		$sql = mysqli_query($conn, "UPDATE staff SET status='$status' WHERE staff_id = '$staff_id'");
		// $sql2 = mysqli_query($conn, "INSERT INTO staff_archived(fname, lname, birthdate, pNum, user, pass) VALUES('$fname', '$lname', '$birthdate', '$pNum', '$user', '$pass')");
		

		$msg = array("valid"=>true, "msg"=>"Staff info Deleted!.");
		echo json_encode($msg);
	}else{
		$msg = array("valid"=>false, "msg"=>$error);
		echo json_encode($msg);
	}
	}catch (Exception $e){
		$msg =  array("valid"=>true, "msg"=>'Error-> '. $e->getMessage(). '\n');
		echo json_encode($msg);
	}
