<?php
include "connection.php";

try {
    $msg = $validID = $fname = $lname = $birthdate = $address = $phoneNum = $email = $uname = $pass = "";
    $error = "";
    $valid = true;

    // Check if a file was uploaded
    if (isset($_FILES['validID']) && is_uploaded_file($_FILES['validID']['tmp_name'])) {
        $file = $_FILES['validID'];

        // Retrieve file information
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error = "Only image files (JPG, JPEG, PNG, webp) are allowed.";
            $valid = false;
        }

        // Validate file size
        $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($fileSize > $maxFileSize) {
            $error = "File size exceeds the maximum limit of 10MB.";
            $valid = false;
        }

    }else {
		$error = "NO VALID ID INSERTED";
		$valid = false;
	}

    if (isset($_POST['fname']) && !empty($_POST['fname'])) {
        $fname = $_POST['fname'];
    } else {
        $valid = false;
        $error = "First Name is invalid";
        $fname = "";
    }

    if (isset($_POST['lname']) && !empty($_POST['lname'])) {
        $lname = $_POST['lname'];
    } else {
        $valid = false;
        $error = "Last name Name is invalid";
        $lname = "";
    }

    if (isset($_POST['birthdate']) && !empty($_POST['birthdate'])) {
        $birthdate = $_POST['birthdate'];
    } else {
        $valid = false;
        $error = "birthdate is invalid";
        $birthdate = "";
    }

    if (isset($_POST['address']) && !empty($_POST['address'])) {
        $address = $_POST['address'];
    } else {
        $valid = false;
        $error = "address is invalid";
        $address = "";
    }

    if (isset($_POST['phoneNum']) && !empty($_POST['phoneNum'])) {
        $phoneNum = $_POST['phoneNum'];
    } else {
        $valid = false;
        $error = "phone Number is invalid";
        $phoneNum = "";
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $valid = false;
        $error = "email is invalid";
        $email = "";
    }

    if (isset($_POST['uname']) && !empty($_POST['uname'])) {
        $uname = $_POST['uname'];
    } else {
        $valid = false;
        $error = "Username is invalid";
        $uname = "";
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

	if(strlen($phoneNum) !== 11){
		$valid = false;
        $error = "Phone Number should be exactly 11 digits!";
	}
    
    $status = "Verified";

    // Set the timezone to the Philippines
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date("Y-m-d H:i:s");

    if ($valid) {
        // Check if birthdate_type already exists in the database
        $query = "SELECT * FROM clientacc WHERE fname = '$fname' AND lname = '$lname' AND birthdate = '$birthdate'";
        $query2 = "SELECT * FROM clientacc WHERE username = '$uname' ";
        $query3 = "SELECT * FROM clientacc WHERE email = '$email' ";
        $result = mysqli_query($conn, $query);
        $result2 = mysqli_query($conn, $query2);
        $result3 = mysqli_query($conn, $query3);
        if (mysqli_num_rows($result) > 0) {
            $msg = array("valid" => false, "msg" => "Client already existed.");
            echo json_encode($msg);
            exit;
        }else if (mysqli_num_rows($result2) > 0) {
            $msg = array("valid" => false, "msg" => "Username already existed!");
            echo json_encode($msg);
            exit;
        }else if (mysqli_num_rows($result3) > 0) {
            $msg = array("valid" => false, "msg" => "The email has already have an Account!");
            echo json_encode($msg);
            exit;
        } else {
            // Move the uploaded file to the desired location
            $uniqueName = uniqid('', true);
            $directory = 'img/validID/';
            $destination = $directory . $uniqueName;
            move_uploaded_file($fileTmpName, $destination);
            $validID = $destination;

			$sql = mysqli_query($conn, "INSERT INTO clientacc(validID, fname, lname, birthdate, address, phoneNum, email, username, pass, date, status) VALUES ('$validID', '$fname', '$lname', '$birthdate', '$address', '$phoneNum', '$email', '$uname', '$pass', '$currentDateTime', '$status')");

            $msg = array("valid" => true, "msg" => "Client Added!");
            echo json_encode($msg);
        }
    } else {
        $msg = array("valid" => false, "msg" => $error);
        echo json_encode($msg);
    }
} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>
