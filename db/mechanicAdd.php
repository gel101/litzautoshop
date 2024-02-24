<?php
	include "connection.php";
	
	try {
		$msg = $fname = $lname = $birthdate = $pNum = $email = $user = $pass = "";
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

		if ($valid) {
			// Check if engine_type already exists in the database
			$query = "SELECT fname FROM mechanic WHERE fname = '$fname' AND lname = '$lname' AND birthdate = '$birthdate'";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) > 0) {
				$msg = array("valid" => false, "msg" => "Mechanic already exists in the database.");
				echo json_encode($msg);
				exit;
			}

			$sql = mysqli_query($conn, "INSERT INTO mechanic (fname, lname, birthdate, pNum, email, user, pass) VALUES ('$fname', '$lname', '$birthdate', '$pNum', '$email', '$user', '$pass')");

			$msg = array("valid" => true, "msg" => "Data Inserted.");
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
