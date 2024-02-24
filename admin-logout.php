<?php
session_start();

if (isset($_POST['toLockscreen'])) {
    // The "Lock screen" button was clicked
    // Set the adminLogin session variable to false
    $_SESSION["adminLogin"] = false;
    // Redirect to a different page after setting the session variable
    header("Location: admin-lockscreen.php");
    exit();
} else {
    // Handle other actions when the button was not clicked
    unset($_SESSION['admin_last_activity']);
    // unset($_SESSION['username']);
    $_SESSION['adminLogin'] = false;
    unset($_SESSION['admin_username']);
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_image']);
    header("Location: admin-login.php");
    exit();
}
?>
