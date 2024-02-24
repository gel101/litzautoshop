<?php
include "connection.php";

try {
    $msg = $cust_id = $reqID = $price = $priceReason = "";
    $valid = true;

    if (isset($_POST['cust_id']) && !empty($_POST['cust_id'])) {
        $cust_id = $_POST['cust_id'];
    } else {
        $valid = false;
        $error .= "Customer ID is invalid";
        $cust_id = "";
    }

    if (isset($_POST['reqID']) && !empty($_POST['reqID'])) {
        $reqID = $_POST['reqID'];
    } else {
        $valid = false;
        $error .= "Request ID is invalid";
        $reqID = "";
    }


    if (isset($_POST['price']) && !empty($_POST['price'])) {
        $price = $_POST['price'];
    } else {
        $valid = false;
        $error .= "Price is invalid";
        $price = "";
    }

    if (isset($_POST['priceReason']) && !empty($_POST['priceReason'])) {
        $priceReason = $_POST['priceReason'];
    } else {
        $valpriceReason = false;
        $error .= "Reasons is Invalid";
        $priceReason = "";
    }

    // $currentDateTime = date("Y-m-d H:i:s");
    $date = date("Y-m-d H:i:s");

    $status = "Processing";
    $message = "Request ID : " . $reqID . ". The Service Requested Has Been Processing.";
    $tran = "service";
    

    if ($valid) {
        
        $sql = mysqli_query($conn, "UPDATE request_services SET price = '$price', price_reason='$priceReason', date = '$date', status='$status' WHERE request_id = '$reqID'");
        $sql22 = mysqli_query($conn, "INSERT INTO notifications(cust_id, message, date, transaction, status) VALUES('$cust_id','$message','$date','$tran','$status')");

        $msg = array("valid" => true, "msg" => "Request Approved!");
        echo json_encode($msg);
    } else {
        $msg = array("valid" => false, "msg" => $error);
        echo json_encode($msg);
    }
} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>