<?php
include "connection.php";

try {
  $msg = $cust_id = $img = $fname = $lname = $birthdate = $address = $pNum = $email = $uname = $pass = "";
  $valid = true;
  $error = "";



  // Check if a file was uploaded
  if (isset($_FILES['img']) && is_uploaded_file($_FILES['img']['tmp_name'])) {
      $file = $_FILES['img'];

      // Retrieve file information
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];

      // Validate file type
      $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
      if (!in_array($fileExtension, $allowedExtensions)) {
          $error .= "Only image files (JPG, JPEG, PNG, WEBP) are allowed.";
          $valid = false;
      }

      // Validate file size
      $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
      if ($fileSize > $maxFileSize) {
          $error .= "File size exceeds the maximum limit of 10MB.";
          $valid = false;
      }
  }

  if (isset($_POST['cust_id']) && !empty($_POST['cust_id'])) {
    $cust_id = $_POST['cust_id'];
  } else {
    $valid = false;
    $error .= "CUSTOMER ID is invalid";
    $cust_id = "";
  }

  if (isset($_POST['fname']) && !empty($_POST['fname'])) {
    $fname = $_POST['fname'];
  } else {
    $valid = false;
    $error .= "First Name is invalid";
    $fname = "";
  }

  if (isset($_POST['lname']) && !empty($_POST['lname'])) {
    $lname = $_POST['lname'];
  } else {
    $valid = false;
    $error .= "Last Name is invalid";
    $lname = "";
  }

  if (isset($_POST['birthdate']) && !empty($_POST['birthdate'])) {
    $birthdate = $_POST['birthdate'];
  } else {
    $valid = false;
    $error .= "Birthdate is invalid";
    $birthdate = "";
  }

  if (isset($_POST['address']) && !empty($_POST['address'])) {
    $address = $_POST['address'];
  } else {
    $valid = false;
    $error .= "Address is invalid";
    $address = "";
  }

  if (isset($_POST['pNum']) && !empty($_POST['pNum'])) {
    $pNum = $_POST['pNum'];
  } else {
    $valid = false;
    $error .= "Phone Number is invalid";
    $pNum = "";
  }

  if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
  } else {
    $valid = false;
    $error .= "Email is invalid";
    $email = "";
  }

  if (isset($_POST['uname']) && !empty($_POST['uname'])) {
    $uname = $_POST['uname'];
  } else {
    $valid = false;
    $error .= "Username is invalid";
    $uname = "";
  }

  if (isset($_POST['pass']) && !empty($_POST['pass'])) {
    $pass = $_POST['pass'];
  } else {
    $valid = false;
    $error .= "Password is invalid";
    $pass = "";
  }

  if ($valid) {

      if (isset($fileTmpName)) {
        $uniqueName = uniqid('', true);
        $directory = 'img/validID/';
        $destination = $directory . $uniqueName;
        move_uploaded_file($fileTmpName, $destination);
        $profile_img = $destination;

        $sql = "UPDATE admin SET img = '$profile_img', fname = '$fname', lname = '$lname', birthdate = '$birthdate', address = '$address', phoneNum = '$pNum', email = '$email', username = '$uname', password = '$pass' WHERE admin_id = '$cust_id'";
      }else {
        $sql = "UPDATE admin SET fname = '$fname', lname = '$lname', birthdate = '$birthdate', address = '$address', phoneNum = '$pNum', email = '$email', username = '$uname', password = '$pass' WHERE admin_id = '$cust_id'";
      }

      if (mysqli_query($conn, $sql)) {
          $msg = array("valid" => true, "msg" => "Information Updated!");
      } else {
          $msg = array("valid" => false, "msg" => "Failed to update data in the database.");
      }
      echo json_encode($msg);
      
    } else {
      $msg = array("valid" => false, "msg" => $error);
      echo json_encode($msg);
  }
} catch (Exception $e) {
  $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
  echo json_encode($msg);
}
