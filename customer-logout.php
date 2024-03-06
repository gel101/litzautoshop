<?php
session_start();

unset($_SESSION['userStatus']);
unset($_SESSION["cust_id"]);
unset($_SESSION['userStatus']);
unset($_SESSION['fname']);
unset($_SESSION['lname']);
unset($_SESSION['customer_last_activity']);
unset($_SESSION['clientStatusNote']);
$_SESSION["loggedin"] = false;
header("Location: customer-login.php");
exit;
?>