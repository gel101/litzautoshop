<?php
include "connection.php";

try {
    $msg = $request_id = "";
    $valid = true;


    if (isset($_POST['request_id']) && !empty($_POST['request_id'])) {
        $request_id = $_POST['request_id'];
    } else {
        $valid = false;
        $error .= "Request ID is invalid";
        $request_id = "";
    }
    

    if ($valid) {
        $sql = mysqli_query($conn, "UPDATE request_services SET status ='Pending' WHERE request_id = '$request_id' ");

        $msg = array("valid" => true, "msg" => "Request Recovered!");
        echo json_encode($msg);
    }

} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>