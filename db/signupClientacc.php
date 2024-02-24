<?php
	include "connection.php";

	if(isset($_POST['buhataccount'])){

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$age = $_POST['age'];
		$pnum = $_POST['pnum'];
		$email = $_POST['email'];
		$uname = $_POST['uname'];
		$pass = $_POST['pass'];

		$sql = mysqli_query($conn, ("INSERT INTO clientacc(fname, lname, age, phoneNum, email, username, pass) VALUES('$fname', '$lname', '$age', '$pnum', '$email', '$uname', '$pass')"));

		mysqli_close($conn);
		echo "<script>
		window.location.href='../customer-signup.php';
		alert('Account Successfully Created!'); </script>";
	}else{
		echo "<script>
		window.location.href='../customer-signup.php'; 
		alert('Failed Creating Account!');
		</script>";
	}

	// // Connect to the database
	// $servername = "localhost";
	// $username = "username";
	// $password = "password";
	// $dbname = "database";
	// $conn = new mysqli($servername, $username, $password, $dbname);

	// // Check for errors
	// if ($conn->connect_error) {
	//     die("Connection failed: " . $conn->connect_error);
	// }
	
	global $getAcc;
	global $data;

	// Check if the form was submitted
	if (isset($_POST['login'])) {
		// Get the username and password from the form
		
		global $username;
		$username = $_POST["logUsername"];
		$password = $_POST["logPassword"];

		// Query the database to see if the username and password are valid
		$sql = "SELECT * FROM clientacc WHERE username='$username' AND pass='$password'";
		$result = $conn->query($sql);

		// If the query returns one row, the username and password are valid
		if ($result->num_rows == 1) {
				// Set a session variable to indicate that the user is logged in
				$_SESSION["loggedin"] = true;
				
				$getAcc = mysqli_query($conn, "SELECT * FROM clientacc WHERE username='$username'");
				$data = mysqli_fetch_assoc($getAcc);
				$userID = $data['userId'];

				// Redirect to another page and pass the user ID as a query string parameter
				header("Location: ../customer.php?userId=" . urlencode($userID));

				
				exit;

		} else {
			// If the query returns no rows, the username and password are not valid
				header("Location: ../index.php");
		}
	}

	// Close the database connection
	$conn->close();
	?>







		