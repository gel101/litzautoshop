<?php
include "connection.php";

try {
    $msg = $tran_id = $paymentMode = $paymentTerm = $paymentReceived = $date = "";
    $error = "";
    $valid = true;

    // Check if a file was uploaded
    if (isset($_FILES['screenshot']) && is_uploaded_file($_FILES['screenshot']['tmp_name'])) {
        $file = $_FILES['screenshot'];

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

    }


    if (isset($_POST['tran_id']) && !empty($_POST['tran_id'])) {
        $tran_id = $_POST['tran_id'];
    } else {
        $valid = false;
        $error = "Transaction ID is invalid";
        $tran_id = "";
    }

    if (isset($_POST['paymentTerm']) && !empty($_POST['paymentTerm'])) {
        $paymentTerm = $_POST['paymentTerm'];
    } else {
        $valid = false;
        $error = "Payment Term is invalid";
        $paymentTerm = "";
    }

    if (isset($_POST['date']) && !empty($_POST['date'])) {
        $date = $_POST['date'];
    } else {
        $valid = false;
        $error = "Date is empty";
        $date = "";
    }

    // $paymentReceived = $_POST['paymentReceived'];
    $paymentMode = $_POST['paymentMode'];
    $referenceInput = $_POST['referenceInput'];


    if ($valid) {
        if (isset($_FILES['screenshot']) && is_uploaded_file($_FILES['screenshot']['tmp_name'])) {

            $uniqueName = uniqid('', true);
            $directory = 'img/screenshots/';
            $destination = $directory . $uniqueName;
            move_uploaded_file($fileTmpName, $destination);
            $img = $destination;
    
            $sql = mysqli_query($conn, "UPDATE orders SET payment_term='$paymentTerm', payment_mode='$paymentMode', reference_number='$referenceInput', screenshot='$img', date='$date' WHERE tran_id = '$tran_id' ");
    
            $msg = array('valid' => true, 'msg' => 'Transaction Edited!');
            echo json_encode($msg);

        }else{

            $sql = mysqli_query($conn, "UPDATE orders SET payment_term='$paymentTerm', payment_mode='$paymentMode', reference_number='$referenceInput', screenshot='', date='$date' WHERE tran_id = '$tran_id' ");
    
            $msg = array("valid" => true, "msg" => "Transaction Edited!");
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

