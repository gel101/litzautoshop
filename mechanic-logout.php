<?php
session_start();

unset($_SESSION['mechanic_id']);
unset($_SESSION['mechanic_image']);
unset($_SESSION['mechanicfirstname']);
unset($_SESSION['mechaniclastname']);

unset($_SESSION['mechanic_last_activity']);


$_SESSION['mechanicLogin'] = false;
unset($_SESSION['mechanicfname']);
unset($_SESSION['mechaniclname']);
header("Location: admin-login.php");
exit;
?>