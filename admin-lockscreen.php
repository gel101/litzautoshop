<?php
// Set session cookie to expire after 12 hours (43200 seconds)
$sessionExpiration = 86400 + 86400 + 86400;
session_set_cookie_params($sessionExpiration);
session_start();
$adminID = $_SESSION['admin_id'];
$username = $_SESSION['admin_username'];



include 'db/connection.php';

if (isset($_POST['unlock'])) {
    $password = $_POST["adminlockpassword"];

    $admin = "SELECT * FROM admin WHERE admin_id='$adminID' and password='$password' ";
    $adminresult = $conn->query($admin);
    if ($adminresult->num_rows >= 1) {
        $_SESSION['adminLogin'] = true;
        header("Location: admin-dashboard.php");
    }

    $_SESSION['trylogin'] = false;
}
?>



<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

    <meta charset="utf-8" />
    <title>Lock Screen | Litz Autoshop</title>
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
<body>

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

        

<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#e83a30" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Session Expired!</h4>
                        <p class="text-muted mx-4 mb-0">Please Login Again</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-dismiss="modal">RETURN</button>
                </div>
            </div>
        </div>
    </div>
</div>


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



        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <!-- <img src="assets/images/logo-light.png" alt="" height="20"> -->
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Litz Autoshop</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body table-responsive p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Lock Screen</h5>
                                    <p class="text-muted">Enter your password to unlock the screen!</p>
                                </div>
                                <div class="user-thumb text-center">
                                    <img src="assets/images/users/avatar-1.jpg" class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                                    <h5 class="font-size-15 mt-3"><?php 
                                include_once 'db/connection.php';

                                try {
                                    if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
                                        $adminID = $_SESSION['admin_id'];
                                        
                                        $sql = mysqli_query($conn, "SELECT fname, lname FROM admin WHERE admin_id='$adminID'");
                                        
                                        if (!$sql) {
                                            throw new Exception("Query failed: " . mysqli_error($conn));
                                        }
                                        
                                        $data = mysqli_fetch_assoc($sql);
                                        
                                        if ($data) {
                                            echo $data['fname'] . " " . $data['lname'];
                                        } else {
                                            echo "No Recent Logged!";
                                        }
                                    } else {
                                        echo "Null";
                                    }
                                } catch (Exception $e) {
                                    echo "Null"; // Display a custom error message
                                }
                                
                                 ?></h5>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="admin-lockscreen.php" method="post">
                                        <div class="mb-3">
                                            <label class="form-label" for="adminlockpassword">Password</label>
                                            <input type="password" class="form-control" name="adminlockpassword" placeholder="Enter password" required>
                                        </div>
                                        <div class="mb-2 mt-4">
                                            <button class="btn btn-success w-100" name="unlock" type="submit">Unlock</button>
                                        </div>
                                    </form><!-- end form -->

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Not you ? return <a href="admin-login.php" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
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