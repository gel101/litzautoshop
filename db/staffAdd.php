<?php
	include "connection.php";
	
	try {
		$msg = $fname = $lname = $birthdate = $pNum = $email = $position = $user = $pass = "";
		$error = "";
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
		
		if (isset($_POST['position']) && !empty($_POST['position'])) {
			$position = $_POST['position'];
		} else {
			$valid = false;
			$error = "position is invalid";
			$position = "";
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
        
		// Check if the email address has a valid format
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$valid = false;
			$error = "Email is invalid";
			$email = "";
		}
	
		if(strlen($pNum) !== 11){
			$valid = false;
			$error = "Phone Number should be exactly 11 digits!";
		}

		if ($valid) {
			// Check if Staff already exists in the database
			$query = "SELECT * FROM staff WHERE user = '$user' ";
			$query2 = "SELECT * FROM staff WHERE email = '$email' ";
			$result = mysqli_query($conn, $query);
			$result2 = mysqli_query($conn, $query2);
			if (mysqli_num_rows($result) > 0) {
				$msg = array("valid" => false, "msg" => "Username already existed!");
				echo json_encode($msg);
				exit;
			}

			if (mysqli_num_rows($result2) > 0) {
				$msg = array("valid" => false, "msg" => "The email has already have an Account!");
				echo json_encode($msg);
				exit;
			}

			$sql = mysqli_query($conn, "INSERT INTO staff (fname, lname, birthdate, pNum, email, position, user, pass) VALUES ('$fname', '$lname', '$birthdate', '$pNum', '$email', '$position', '$user', '$pass')");

			$msg = array("valid" => true, "msg" => "Account Created!");
			echo json_encode($msg);
			exit;
			
		} else {
			$msg = array("valid" => false, "msg" => $error);
			echo json_encode($msg);
			exit;
		}
	} catch (Exception $e) {
		$msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
		echo json_encode($msg);
	}
?>
