<?php
include "connection.php";

try {
    $msg = $order_id = "";
    $valid = true;


    if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
    } else {
        $valid = false;
        $error .= "Transaction ID is invalid";
        $order_id = "";
    }
    

    if ($valid) {
        $sql = mysqli_query($conn, "UPDATE orders SET status = 'Pending' WHERE order_id = '$order_id' ");

        $msg = array("valid" => true, "msg" => "Transaction Recovered!");
        echo json_encode($msg);
    }

} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => 'Error: ' . $e->getMessage());
    echo json_encode($msg);
}
?>