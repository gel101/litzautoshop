<?php
include "connection.php";

try {
  $msg = $staff_id = $img = $fname = $lname = $birthdate = $pNum = $email = $uname = $pass = "";
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

  if (isset($_POST['staff_id']) && !empty($_POST['staff_id'])) {
    $staff_id = $_POST['staff_id'];
  } else {
    $valid = false;
    $error .= "CUSTOMER ID is invalid";
    $staff_id = "";
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

  $accValid = $_POST['accValid'];

  
  
  function validatePassword($password) {
    // Define a regular expression pattern for the password requirements
    $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d\W_]{8,}$/';

    // Test the password against the pattern
    $isValid = preg_match($passwordPattern, $password);

    return $isValid;
  }

  
  if (strlen($pass) < 8) {
    $valid = false;
    $error = "Password should be at least 8 characters long.";
    $pass = "";
  } else {
    if (!validatePassword($pass)) {
        $valid = false;
        $error = "Password should have Uppercase, Lowercase, Number, and a Special Character!";
        $pass = "";
    }
  }


  if ($valid) {

    // Check if account already exists in the database
    $query2 = "SELECT * FROM staff WHERE user = '$uname' AND staff_id != '$staff_id' ";
    $result2 = mysqli_query($conn, $query2);
    if (mysqli_num_rows($result2) > 0) {
        $msg = array("valid" => false, "msg" => "Username already existed!");
        echo json_encode($msg);
        exit;
    } else {
      if ($accValid == "STAFF") {
        if (isset($fileTmpName)) {
          $uniqueName = uniqid('', true);
          $directory = 'img/validID/';
          $destination = $directory . $uniqueName;
          move_uploaded_file($fileTmpName, $destination);
          $profile_img = $destination;
  
          $sql = "UPDATE staff SET img = '$profile_img', fname='$fname', lname='$lname', birthdate='$birthdate', pNum='$pNum', email='$email', user='$uname', pass='$pass' WHERE staff_id='$staff_id'";
        }else {
          $sql = "UPDATE staff SET fname='$fname', lname='$lname', birthdate='$birthdate', pNum='$pNum', email='$email', user='$uname', pass='$pass' WHERE staff_id='$staff_id'";
        }
      } elseif ($accValid == "MECHANIC") {
        if (isset($fileTmpName)) {
          $uniqueName = uniqid('', true);
          $directory = 'img/validID/';
          $destination = $directory . $uniqueName;
          move_uploaded_file($fileTmpName, $destination);
          $profile_img = $destination;
  
          $sql = "UPDATE staff SET img = '$profile_img', fname='$fname', lname='$lname', birthdate='$birthdate', pNum='$pNum', email='$email', user='$uname', pass='$pass' WHERE staff_id='$staff_id'";
        }else {
          $sql = "UPDATE staff SET fname='$fname', lname='$lname', birthdate='$birthdate', pNum='$pNum', email='$email', user='$uname', pass='$pass' WHERE staff_id='$staff_id'";
        }
      }
      
      if (mysqli_query($conn, $sql)) {
          $msg = array("valid" => true, "msg" => "Information Updated!");
          echo json_encode($msg);
          exit;
      } else {
          $msg = array("valid" => false, "msg" => "Failed to update data in the database.");
          echo json_encode($msg);
          exit;
      }

    }
  }else {
    $msg = array("valid"=>false, "msg"=>$error);
    echo json_encode($msg);
    exit;
  }

} catch (Exception $e) {
  $msg =  array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
  echo json_encode($msg);
}
?>
