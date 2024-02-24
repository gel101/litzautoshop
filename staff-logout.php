<?php
session_start();

unset($_SESSION['staff_id']);
unset($_SESSION['staff_image']);
unset($_SESSION['stafffirstname']);
unset($_SESSION['stafflastname']);

unset($_SESSION['staff_last_activity']);

$_SESSION['staffLogin'] = false;
header("Location: admin-login.php");
exit;
?>