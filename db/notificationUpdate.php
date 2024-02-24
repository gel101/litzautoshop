<?php
include "connection.php";

try{
    $msg = "";

    if(isset($_POST['cust_notif'])){
        $cust_id = $_POST['cust_id'];

        $sql = mysqli_query($conn, "UPDATE notifications SET saw_status = true WHERE cust_id = '$cust_id' ");
        $msg = array("valid"=>true, "msg"=>"Data updated.");
        echo json_encode($msg);
    }
    
    if(isset($_POST['admin_notif'])){

        $sql = mysqli_query($conn, "UPDATE notifications SET saw_status = true WHERE messageTo = 'admin' ");
        $msg = array("valid"=>true, "msg"=>"Data updated.");
        echo json_encode($msg);
    }
    
    if(isset($_POST['mechanic_notif'])){

        $sql = mysqli_query($conn, "UPDATE notifications SET saw_status = true WHERE messageTo = 'mechanic' ");
        $msg = array("valid"=>true, "msg"=>"Data updated.");
        echo json_encode($msg);
    }
    
    if(isset($_POST['staff_notif'])){

        $sql = mysqli_query($conn, "UPDATE notifications SET saw_status = true WHERE messageTo = 'staff' ");
        $msg = array("valid"=>true, "msg"=>"Data updated.");
        echo json_encode($msg);
    }





} catch (Exception $e) {
    $msg =  array("valid"=>false, "msg"=>'Error-> '. $e->getMessage(). '\n');
    echo json_encode($msg);
}
?>