<?php
// Set session cookie to expire after 12 hours (43200 seconds)
$sessionExpiration = 86400 + 86400 + 86400;
session_set_cookie_params($sessionExpiration);
session_start();

include 'db/connection.php';

if (isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password-input"];
    $_SESSION['trylogin'] = false;

    $admin = "SELECT * FROM admin WHERE BINARY username ='$username' AND BINARY password ='$password' ";
    $adminresult = $conn->query($admin);

    $staff = "SELECT * FROM staff WHERE BINARY user ='$username' and BINARY pass ='$password' and status!='archived' ";
    $staffresult = $conn->query($staff);

    if ($adminresult->num_rows == 1) {
        
        $getAcc = mysqli_query($conn, $admin);
        $data = mysqli_fetch_assoc($getAcc);
        $userID = $data['admin_id'];
        $_SESSION['admin_image'] = $data['img'];
        $_SESSION['admin_username'] = $data['username'];
        $_SESSION["admin_last_activity"] = time(); // Store the session start time

        $_SESSION['adminLogin'] = true;
        $_SESSION['admin_id'] = $userID;
        // $_SESSION['username'] = "ADMIN";
        header("Location: admin-dashboard.php");
    }elseif ($staffresult->num_rows == 1) {

        $getAcc = mysqli_query($conn, $staff);
        $data = mysqli_fetch_assoc($getAcc);
        $userID = $data['staff_id'];
        $fname = $data['fname'];
        $lname = $data['lname'];
        $position = $data['position'];
        
        if ($position == "Staff") {
            $_SESSION["staff_last_activity"] = time(); // Store the session start time
            $_SESSION['staffLogin'] = true;
            $_SESSION['staff_id'] = $userID;
            $_SESSION['staff_image'] = $data['img'];
            $_SESSION['stafffirstname'] = ucwords(strtolower($fname));
            $_SESSION['stafflastname'] = ucwords(strtolower($stafflastname));
            $_SESSION['staff_username'] = "STAFF";
            header("Location: staff-dashboard.php");
        }elseif ($position == "Mechanic") {
            $_SESSION["mechanic_last_activity"] = time(); // Store the session start time
            $_SESSION['mechanicLogin'] = true;
            $_SESSION['mechanic_id'] = $userID;
            $_SESSION['mechanic_image'] = $data['img'];
            $_SESSION['mechanicfname'] = ucwords(strtolower($fname));
            $_SESSION['mechaniclname'] = ucwords(strtolower($lname));
            $_SESSION['mechanic_username'] = "MECHANIC";
            header("Location: mechanic-dashboard.php");
        }
    }

    // $mechanic = "SELECT * FROM mechanic WHERE BINARY user ='$username' and BINARY pass ='$password' and status!='archived' ";
    // $mechanicresult = $conn->query($mechanic);
    // if ($mechanicresult->num_rows == 1) {
    //     $getAcc = mysqli_query($conn, $mechanic);
    //     $data = mysqli_fetch_assoc($getAcc);
    //     $userID = $data['mechanic_id'];
    //     $fname = $data['fname'];
    //     $lname = $data['lname'];

    //     $_SESSION["mechanic_last_activity"] = time(); // Store the session start time
    //     $_SESSION['mechanicLogin'] = true;
    //     $_SESSION['mechanic_id'] = $userID;
    //     $_SESSION['mechanicfname'] = ucwords(strtolower($fname));
    //     $_SESSION['mechaniclname'] = ucwords(strtolower($lname));
    //     $_SESSION['mechanic_username'] = "MECHANIC";
    //     header("Location: mechanic-dashboard.php");
    // }

}

?>





<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | Litz Autoshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        

.image-container {
    max-width: 300px; /* Set a default maximum width */
    max-height: 400px; /* Set a default maximum height */
    width: 100%; /* Make the image container take full width of its parent */
    margin: 0 auto; /* Center the image container */
    overflow: hidden; /* Hide any overflow */
}

.responsive-image {
    width: 100%; /* Make the image take full width of its parent (image-container) */
    height: auto; /* Let the height adjust proportionally based on the width */
    display: block; /* Remove any inline spacing issues with the image */
}
    </style>
</head>

<body>


<!-- removeNotificationModal -->
<div id="alertModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#e83a30" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Login Error!</h4>
                        <p class="text-muted mx-4 mb-0">Please Login Again</p>
                    </div>
                </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-dismiss="modal">RETURN</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<!-- <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="alertModalLabel">Alert</h5>
      </div>
      <div class="modal-body">
                <div class="image-container">
                    <img src="img/error.png" alt="" class="responsive-image">
                </div>
        Login Error! Please Try Again.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">RETURN</button>
      </div>
    </div>
  </div>
</div> -->

<!-- Hidden button to trigger the modal -->
<button id="hiddenButton" style="display: none;" data-toggle="modal" data-target="#alertModal"></button>

<?php

    if (($_SESSION["trylogin"]) === false && $_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
          document.getElementById('hiddenButton').click();
        });
        </script>";
    }

?>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="#" class="d-inline-block auth-logo">
                                    <!-- <img src="assets/images/logo-light.png" alt="" height="20"> -->
                                </a>
                            </div>
                            <br>
                            <p class="mt-3 fs-15 fw-medium">Litz Autoshop</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="admin-login.php" method="post">

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" placeholder="Enter username">
                                        </div>

                                        <div class="mb-3">
                                            <!-- <div class="float-end">
                                                <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a>
                                            </div> -->
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" name="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" name="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
<!-- 
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div> -->

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" name="login" type="submit">Log In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Go to <a href="customer-login.php" class="fw-semibold text-primary text-decoration-underline"> Client Login </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>
</body>
</html>