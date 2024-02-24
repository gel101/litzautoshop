<?php
include "connection.php";
$msg = $sparepart_id = $quantity = "";

if (isset($_POST['sparepart_id']) && isset($_POST['quantity'])) {
    $sparepart_id = $_POST['sparepart_id'];
    $quantity = $_POST['quantity'];
    
        $stmt = mysqli_query($conn, "UPDATE carts SET quantity = '$quantity' WHERE sparepart_id = '$sparepart_id' ");
    
        if ($stmt) {
            $msg = array("valid" => true, "msg" => "Query Success!");
            echo json_encode($msg);
            exit;
        }else {
            $msg = array("valid" => false, "msg" => "Unable to Update Query!");
            echo json_encode($msg);
            exit;
        }
}