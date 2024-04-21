<?php
include "connection.php";

try {
  $msg = $cust_id = $fname = $lname = $birthdate = $address = $pNum = $email = $uname = $pass = "";
  $valid = true;
  $error = "";

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
        $error = "Password should have Uppercase, Lowercase and a Number!";
        $pass = "";
    }
  }

  if ($valid) {

        // Check if account already exists in the 
        $query2 = "SELECT * FROM clientacc WHERE username = '$uname' AND cust_id != '$cust_id' ";
        $result2 = mysqli_query($conn, $query2);
        if (mysqli_num_rows($result2) > 0) {
            $msg = array("valid" => false, "msg" => "Username already existed!");
            echo json_encode($msg);
            exit;
        } else {
          $sql = "UPDATE clientacc SET fname = '$fname', lname = '$lname', birthdate = '$birthdate', address = '$address', phoneNum = '$pNum', email = '$email', username = '$uname', pass = '$pass' WHERE cust_id = '$cust_id'";
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
