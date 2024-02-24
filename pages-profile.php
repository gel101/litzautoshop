<?php
// Set session cookie to expire after 12 hours (43200 seconds)
$sessionExpiration = 86400 + 86400 + 86400;
session_set_cookie_params($sessionExpiration);
session_start();
$customerID = $_SESSION['cust_id'];
global $customerID;

include 'db/connection.php';

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

    <meta charset="utf-8" />
    <title>Litz Autoshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- plugin css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

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

    <style>
        .password-input-container {
    position: relative;
}

.password-input-container .toggle-password {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
}

.password-input-container .form-control {
    padding-right: 40px; /* Adjust the padding to accommodate the icon */
}

    </style>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

<!-- HEADER -->
<?php include 'customer-header.php' ?>
<!-- CLOSING HEADER -->

<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<!-- SIDEBAR -->
        <?php include 'customer-sidebar.php' ?>

<!-- SIDEBAR CLOSING -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">My profile</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
                                        <li class="breadcrumb-item active">Profile</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


<!-- Main content -->
                    
                    <div class="row">
                        <div class="col-xl-12">

                            
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3 bg-primary text-white" style="padding:10px;border-radius:10px;">Personal Information</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                
                                    <?php
                                    include 'db/connection.php';

                                    $stmt = mysqli_query($conn, "SELECT * FROM clientacc WHERE cust_id='$customerID'");

                                    while($data = mysqli_fetch_assoc($stmt)){
                                    ?>
                                                <tr>
                                                    <th class="ps-0" scope="row">First Name :</th>
                                                    <td class="text-muted" id="fname"><?php echo $data['fname']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Last Name :</th>
                                                    <td class="text-muted" id="lname"><?php echo $data['lname']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Birthdate :</th>
                                                    <td class="text-muted" id="birthdate"><?php echo date('m/d/Y', strtotime($data['birthdate'])); ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Address :</th>
                                                    <td class="text-muted" id="address"><?php echo $data['address']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Phone Number :</th>
                                                    <td class="text-muted" id="phoneNum"><?php echo $data['phoneNum']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">E-mail :</th>
                                                    <td class="text-muted" id="email"><?php echo $data['email']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Username :</th>
                                                    <td class="text-muted" id="username"><?php echo $data['username']; ?></td>
                                                    <input type="hidden" id="pass" value="<?php echo $data['pass']; ?>"></input>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <td>
                                                        <button class="btn btn-warning" onclick="editProfile(
                                                            '<?php echo $data['fname']; ?>',
                                                            '<?php echo $data['lname']; ?>',
                                                            '<?php echo $data['birthdate']; ?>',
                                                            '<?php echo $data['address']; ?>',
                                                            '<?php echo $data['phoneNum']; ?>',
                                                            '<?php echo $data['email']; ?>',
                                                            '<?php echo $data['username']; ?>',
                                                            '<?php echo $data['pass']; ?>'
                                                        )">Edit Profile</button>
                                                    </td>
                                                </tr>
                                    <?php
                                    }
                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->

                        </div><!-- end col -->
                    </div><!-- end row -->



<!-- Modal -->
<div class="modal fade" id="editProf" tabindex="-1" aria-labelledby="editProfLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfLabel">Profile Information</h5>
        <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
        <label for="" class="form-label">First Name</label>
        <input type="text" class="form-control" id="efname" required>
            </div>
            <div class="col-md-6">
        <label for="" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="elname" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
        <label for="" class="form-label">Birthdate</label>
        <input type="date" class="form-control" id="ebirthdate" required>
            </div>
            <div class="col-md-6">
        <label for="" class="form-label">Phone Number</label>
        <input type="number" class="form-control" id="ephoneNum" required>
            </div>
        </div>
        <br>
        <label for="" class="form-label">Address</label>
        <input type="text" class="form-control" id="eadd" required>
        <label for="" class="form-label">Email</label>
        <input type="email" class="form-control" id="eemail" required>
        <br>
        <div class="row">
            <div class="col-md-6">
        <label for="" class="form-label">Username</label>
        <input type="text" class="form-control" id="euname" required>
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Password</label>
                <div class="password-input-container">
                    <input type="password" class="form-control" id="epass" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()"><i class="fas fa-eye"></i></span>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveinfo()">Save changes</button>
      </div>
    </div>
  </div>
</div>



<div id="errModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon 
                        src="https://cdn.lordicon.com/ygvjgdmk.json"
                        trigger="loop"
                        state="hover-error-2"
                        colors="primary:#e83a30,secondary:#e83a30"
                        style="width:250px;height:250px">
                    </lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h5 id="profError" class="text-danger">Error!</h5>
                    </div>
                    <div class="row">
                        <div class="center">
                            <!-- <button id="confirmAction" class="btn btn-primary">Yes</button> -->
                            <button class="btn btn-danger" id="errorBackBtn" data-bs-dismiss="modal">BACK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- FOOTER -->

<?php include 'admin-footer.php' ?>

<!-- END OF FOOTER -->
    <!-- JAVASCRIPT -->
    <script src="js/jquery-3.6.3.min.js"></script>
    
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script>
        
        function validatePassword(password) {
            // Define a regular expression pattern for the password requirements
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;

            // Test the password against the pattern
            var isValid = passwordPattern.test(password);

            return isValid;
        }

        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("epass");
            var toggleIcon = document.querySelector(".toggle-password i");
        
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }



        function editProfile(fname, lname, bdate, address, pnum, email, user, pass){
            $('#efname').val(fname);
            $('#elname').val(lname);
            $('#ebirthdate').val(bdate);
            $('#eadd').val(address);
            $('#ephoneNum').val(pnum);
            $('#eemail').val(email);
            $('#euname').val(user);
            $('#epass').val(pass);

            
		    $("#editProf").modal("show");
        }

        function saveinfo() {
            var cust_id = '<?php echo $_SESSION['cust_id']; ?>';
            var fname = $('#efname').val();
            var lname = $('#elname').val();
            var birthdate = $('#ebirthdate').val();
            var address = $('#eadd').val();
            var pNum = $('#ephoneNum').val();
            var email = $('#eemail').val();
            var uname = $('#euname').val();
            var pass = $('#epass').val();
            var valid = true;

            if (fname == "" || lname == "" || birthdate == "" || address == "" || pNum == "" || email == "" || uname == "") {
                valid = false;
                alert("Please fill in all the required fields!");
            } else {
                // if (pass.length < 8) {
                //     valid = false;
                //     alert("Password should be at least 8 characters long");
                // } else {
                //     if (!validatePassword(pass)) {
                //         valid = false;
                //         alert("Password must be include a combination of lowercase letters, uppercase letters, numbers, and at least one special character!");
                //     }
                // }
            }

            if (valid) {
                if (confirm("Confirm Changes?")) {
                    form_data = {
						fname : fname,
						lname : lname,
						birthdate : birthdate,
						address : address,
						pNum : pNum,
						email : email,
						uname : uname,
						pass : pass,
						cust_id : cust_id
                    };

					$.ajax({
                    url : "db/infoUpdate.php",
                    type : "POST",
                    data : form_data,
                    dataType: "json",
                    beforeSend: function () {
                        $('.dismissBtn').click();
                    },
                    success: function(response){
                        if(response['valid'] == false){
                            // alert(response['msg']);

                            $('#profError').text(response['msg']);
                            $('#errModal').modal('show');
                            $('#errorBackBtn').click(function(){
                                $('#editProf').modal('show');
                            });
                        }else{
                            $('.messageText').text('Information Changed!');
                            $('#successModal').modal('show');

                            setTimeout(function () {
                                $('#successModal').modal('hide');
								location.reload();
                            },1000);
                            // alert("Information updated!");
                            // window.location.href="pages-profile.php"; 
                        }
                    }
                });
                }else{

                }
            }
        }
    </script>
</body>

</html>