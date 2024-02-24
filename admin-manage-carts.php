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

	<style>
		
        .archived{
            font-family: Georgia, serif;
            font-size: 13px;
            letter-spacing: 0px;
            word-spacing: -0.8px;
            color: red;
            font-weight: 700;
            text-decoration: none;
            font-style: italic;
            font-variant: normal;
            text-transform: uppercase;
        }
	</style>
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
                                <h4 class="mb-sm-0">Cart</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Admin</a></li>
                                        <li class="breadcrumb-item">Archive</li>
                                        <li class="breadcrumb-item active">Cart</li>
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
										<div class="col-md-4">
											<input class="form-control" type="text" id="table-filter" placeholder="Search...">
										</div>
										<div class="col-md-6">
											<!-- Content for the second column -->
										</div>
										<div class="col-md-2">
										</div>
									</div>
									<br>
									<table class="table text-center">
										<thead class="text-danger">
												<tr>
													<th scope="col">ID</th>
													<th scope="col">CustomerID</th>
													<th scope="col">Image</th>
													<th scope="col">Transaction ID</th>
													<th scope="col">Product</th>
													<th scope="col">Model</th>
													<th scope="col">Engine</th>
													<th scope="col">Price</th>
													<th scope="col">Color</th>
													<th scope="col">Quantity</th>
													<th scope="col">Status</th>
												</tr>
										</thead>
										<tbody>
												<?php
												include 'db/connection.php';

												$stmt = mysqli_query($conn, "SELECT * FROM carts WHERE status !='declined' AND (status IS NULL OR status != 'archived') ORDER BY cart_id DESC");

												while($data = mysqli_fetch_assoc($stmt)){
												?>
												<tr>
													<td><?php echo $data['cart_id']; ?></td>
													<td><?php if($data['cust_id'] == ""){ echo "None";}else{echo $data['cust_id'];} ?></td>
													<td><img src="db/<?php echo $data['img']; ?>" style="height:50px;width:50px;" alt="product img"></td>
													<td><?php if($data['tran_id'] != ""){echo $data['tran_id'];}else{echo "No ID";} ?></td>
													<td><?php echo $data['product']; ?></td>
													<td><?php echo $data['model']; ?></td>
													<td><?php echo $data['engine']; ?></td>
													<td>&#8369;<?php echo number_format($data['price'], 2); ?></td>
													<td><?php echo $data['color']; ?></td>
													<td><?php echo $data['quantity']; ?></td>
													<td><h5><span class="badge <?php 
														
														switch ($data['status']) {
															case "on cart":
																echo "bg-warning";
																break;
															case "Pending":
																echo "bg-warning";
																break;
															case "Accepted":
																echo "bg-info";
																break;
															case "Requirements Complete":
															case "Order Preparing":
																echo "bg-secondary";
																break;
															case "Ready to Pick Up":
															case "Completed":
																echo "bg-success";
																break;
															case "Declined":
															case "Canceled":
															case "archived":
																echo "bg-danger";
																break;
															default:
																echo "bg-primary";
														}

														
														?>"><?php echo $data['status']; ?></span></h5></td>
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
		$(document).ready(function(){

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