<?php
// Set session cookie to expire after 12 hours (43200 seconds)
$sessionExpiration = 86400 + 86400 + 86400;
session_set_cookie_params($sessionExpiration);
session_start();


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

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

<!-- HEADER -->
<?php include 'admin-header.php' ?>
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
        <?php include 'admin-sidebar.php' ?>

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
                                <h4 class="mb-sm-0">Completed Transaction</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Admin</a></li>
                                        <li class="breadcrumb-item">Transaction</li>
                                        <li class="breadcrumb-item">Completed Transaction</li>
                                        <li class="breadcrumb-item active">Service</li>
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
                                <div class="card-body table-responsive">
                                    <div class="row">
                                        <div class="col-md-3">
                                            
                                        </div>
                                        <div class="col-md-5">
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" type="text" id="table-filter" placeholder="Search...">
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table text-center">
                                        <thead class="text-secondary">
                                            <tr>
                                                <th scope="col">Request ID</th>
                                                <th scope="col">Client Name</th>
                                                <th scope="col">Type of Service</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php
                                            include 'db/connection.php';

                                            $stmt = mysqli_query($conn, "SELECT * FROM request_services where status='request completed'  ORDER BY request_id DESC");
                                            while($data = mysqli_fetch_assoc($stmt)){
                                        ?>

                                            <tr>
                                                <td><?php echo $data['request_id']; ?></td>
                                                <td><?php echo $data['cust_name']; ?></td>
                                                <td><?php echo $data['request']; ?></td>
                                                <td><?php $date = new DateTime($data['date']); $formattedDate = $date->format('m-d-Y'); echo $formattedDate;  ?></td>
                                                <td>&#8369;<?php echo number_format($data['price'], 2); ?></td>
                                                <td><span class="badge bg-success"><?php echo $data['status']; ?></span></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>

                                        </tbody>
                                    </table>


								</div><!-- end card-body -->
							</div> <!-- end card-->
						</div><!-- end col -->
					</div><!-- end row -->

<!-- SHOW MORE INFO MODAL -->
<div class="modal fade" id="clientDetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Client Details</h3>
			</div>
			<div class="modal-body">
                <div class="card">

<?php
if (isset($_GET['viewclientInfo'])) {

    $customerID = $_GET['clientInfo'];

    include 'db/connection.php';
    $stmt = mysqli_query($conn, "SELECT * FROM clientacc WHERE cust_id='$customerID'");

    while ($data = mysqli_fetch_assoc($stmt)) {
?>
                        <div class="row">
                            <div class="col-md-3">
                        <label for="" class="form-label">Client Name</label>
                        <input type="text" class="form-control" value="<?php echo $data['fname']; ?> <?php echo $data['lname']; ?>" disabled>
                            </div>
                            <div class="col-md-3">
                        <label for="" class="form-label">Birthdate</label>
                        <input type="text" class="form-control" value="<?php echo $data['birthdate']; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                        <label for="" class="form-label">Address</label>
                        <input type="text" class="form-control" value="<?php echo $data['address']; ?>" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                        <label for="" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" value="<?php echo $data['phoneNum']; ?>" disabled>
                            </div>
                            <div class="col-md-3">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control" value="<?php echo $data['username']; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" value="<?php echo $data['email']; ?>" disabled>
                            </div>
                        </div>
<?php
    }
}
?>

                </div>
                <br>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-warning">Okay</button>
                </div>
			</div>	
		</div>
	</div>
</div>
<!-- END OF SHOW MORE INFO MODAL -->

                    




<!-- SHOW MORE INFO MODAL -->
<div class="modal fade" id="tranDetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Additional Information</h3>
			</div>
			<div class="modal-body">
                    <label class="form-label">Valid ID</label><span class="validId_name_err text-danger"></span>
                    <img class="form-control" src="" alt="Valid ID" style="height:200px;">
                    <br>
                    <label for="minfo" class="form-label">More Information</label>
                    <textarea class="form-control" id="minfo" name="minfo" rows="3" required></textarea>
                    <br>
                <br>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-warning">Okay</button>
                </div>
			</div>	
		</div>
	</div>
</div>
<!-- END OF SHOW MORE INFO MODAL -->







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
        
        function showTranDetail(){
            $("#tranDetail").modal("show");
        }

        
        
        $(document).ready(function () {
            
            // Attach an event listener to the row limit input field
            $("#row-limit").on("keyup", function () {
                var limit = $(this).val(); // Get the user-entered limit
                showLimitedRows(limit);
            });

            // Function to show a limited number of rows
            function showLimitedRows(limit) {
                // Show all rows initially
                $("tbody tr").show();
                
                // Hide rows beyond the specified limit
                if (limit > 0) {
                    $("tbody tr:gt(" + (limit - 1) + ")").hide();
                }
            }
            
            // Initially, show all rows
            showLimitedRows(0); // 0 means no limit initially



            // Attach an event listener to the input field
            $("#table-filter").on("keyup", function () {
                var searchText = $(this).val().toLowerCase(); // Get the input value and convert it to lowercase

                // Loop through each row in the table
                $("tbody tr").each(function () {
                    var rowData = $(this).text().toLowerCase(); // Get the text content of the row and convert it to lowercase
                    
                    // Check if the row data contains the search text
                    if (rowData.indexOf(searchText) === -1) {
                        // If not, hide the row
                        $(this).hide();
                    } else {
                        // If yes, show the row
                        $(this).show();
                    }
                });
            });


        });

    </script>
</body>

</html>