<?php
include 'connection.php' ;

// Set session cookie to expire after 12 hours (43200 seconds)
$sessionExpiration = 2 * 24 * 60 * 60;
session_set_cookie_params($sessionExpiration);
session_start();

$sessionExpirationTime = "";

global $getAcc;
global $data;
$_SESSION["trylogin1"] = false;

try{
    $msg = $error = $username = $password = "";
    $valid = true;

    if(isset($_POST['uname']) && !empty($_POST['uname'])){
        $username = $_POST['uname'];
    }else{
        $valid = false;
        $error = "Username is invalid";
        $username = "";
    }

    if(isset($_POST['pass']) && !empty($_POST['pass'])){
        $password = $_POST['pass'];
    }else{
        $valid = false;
        $error = "Password is invalid";
        $password = "";
    }


    
    if($valid){    
        $sql = "SELECT * FROM clientacc WHERE BINARY username='$username' AND BINARY pass='$password'";
        $result = $conn->query($sql);
    
        if ($result->num_rows == 1) {
            $_SESSION["loggedin"] = true;
    
            // Get the user's session expiration time from the database
            $data = mysqli_fetch_assoc($result);
            $sessionExpirationTime = "";
    
            if (empty($sessionExpirationTime)) {
                // Set the default session expiration time (12 hours) if not specified in the database
                $sessionExpirationTime = time() + $sessionExpiration;
            }
    
            $_SESSION["session_expiration"] = $sessionExpirationTime;
            $_SESSION["customer_last_activity"] = time(); // Store the session start time
     
            global $username;
            $getAcc = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($getAcc);
            $userID = $data['cust_id'];
            $fname = $data['fname'];
            $lname = $data['lname'];
    
            $_SESSION['userPic'] = $data['validID'];
            $_SESSION['cust_id'] = $userID;
            $_SESSION['fname'] = ucwords(strtolower($fname));
            $_SESSION['lname'] = ucwords(strtolower($lname));
    
    
            $getstatus = "SELECT * FROM clientacc WHERE cust_id='$userID' AND status='Pending'";
            $rslt = $conn->query($getstatus);
    
            if ($rslt->num_rows >= 1) {
                $_SESSION['userStatus'] = "Pending";
            }else{
                $_SESSION['userStatus'] = "Verified";
            }
    
            $getstatuss = "SELECT * FROM clientacc WHERE cust_id='$userID' AND status='Denied'";
            $rsltt = $conn->query($getstatuss);
            
            if ($rsltt->num_rows >= 1) {
                $_SESSION['userStatus'] = "Denied";
            }
    
            // header("Location: customer-car.php");
            // exit;
        
            $msg = array("valid" => true, "msg" => "Logged In Successfully!");
            echo json_encode($msg);
            exit;
        }else{

            $msg = array("valid" => false, "msg" => "Account Error!");
            echo json_encode($msg);
            exit;
        }
        
    } else {
        $msg = array("valid" => false, "msg" => $error);
        echo json_encode($msg);
    }

} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error-> ' . $e->getMessage() . '\n');
    echo json_encode($msg);
}



