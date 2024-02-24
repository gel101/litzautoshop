<?php
// Set session cookie to expire after 12 hours (43200 seconds)
$sessionExpiration = 86400 + 86400 + 86400;
session_set_cookie_params($sessionExpiration);
session_start();

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
        
        .cartButton{
            position: absolute;
            right:20px;
            bottom: 1px;
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
                                <h4 class="mb-sm-0">CAR RENTAL TRANSACTION</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
                                        <li class="breadcrumb-item">My Transaction</li>
                                        <li class="breadcrumb-item active">Rent</li>
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
								<table class="table text-center" id="table11">
									<thead style="color: #1873d3">
										<tr>
											<th scope="col">ID</th>
											<th scope="col">Img</th>
											<th scope="col">Requested Duration</th>
											<th scope="col">Date of Rent</th>
											<th scope="col">Price</th>
											<th scope="col">Date</th>
											<th scope="col">Status</th>
											<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                        if (isset($_SESSION['cust_id'])) {
                                            $cust_id = $_SESSION['cust_id'];
                                        }
										$sql = mysqli_query($conn, "SELECT * FROM rent_transactions WHERE status != 'archived' AND cust_id = '$cust_id' ORDER BY rent_id DESC");
										while($data = mysqli_fetch_assoc($sql)){
										?>
										<tr>
											<td><?php echo $data['rent_id']; ?></td>
											<td><?php
                                                    $id = $data['rentalcar_id'];
                                                    $sql2 = mysqli_query($conn, "SELECT car_img FROM car_rental WHERE rentalcar_id = '$id' ");
                                                    $data2 = mysqli_fetch_assoc($sql2);
                                                    $img = $data2['car_img'];
                                                ?>
                                                <img src="db/<?php echo $img; ?>" alt="" style="width: 40px; height: 40px;">
                                            </td>
											<td><?php echo $data['rentTime'] . " " . $data['rentTimeType']; ?></td>
                                            <td><?php $date = new DateTime($data['rentDate']); $formattedDate = $date->format('m-d-Y'); echo $formattedDate;  ?></td>
                                            <td><?php if($data['price'] != 0){echo "&#8369; " . number_format($data['price'], 2); }elseif($data['status']=="Canceled" || $data['status']=="Declined"){echo '<p><span class="badge bg-danger">' .$data['status'].'</span></p>';}else{echo '<p><span class="badge bg-warning">Pending</span></p>';} ?></td>
                                            <td><?php $date = new DateTime($data['date']); $formattedDate = $date->format('m-d-Y'); echo $formattedDate;  ?></td>
											<td><h5><span class="badge <?php 
											
											switch ($data['status']) {
												case "Pending":
													echo "bg-warning";
													break;
												case "Accepted":
													echo "bg-secondary";
													break;
												case "Active":
													echo "bg-info";
													break;
												case "Rent Completed":
													echo "bg-success";
													break;
												case "Declined":
												case "Canceled":
													echo "bg-danger";
													break;
												default:
													echo "bg-primary";
											}

											
											?>"><?php echo $data['status']; ?></span></h5></td>
											<td class="text-end text-center">
												<button class="btn btn-danger <?php if ($data['status'] == "Canceled" OR $data['status'] == "Declined" OR $data['status'] == "Accepted" OR $data['status'] == "In Use" OR $data['status'] == "Rent Completed") {echo 'd-none';} ?>" type="button" value="" onclick="cancelRent(
													'<?php echo $data['rent_id']; ?>'
													)"><i class="fas fa-ban"></i></button>
											</td>
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


                    
<!-- Modal -->
<div class="modal fade zoomIn" id="showMoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Other Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div id="mechanicDiv">

                </div>
                <!-- Your provided code goes here -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="vehicleType" class="form-label">Vehicle Type</label>
                        <input type="text" class="form-control" id="vehicleType" disabled>
                        <br>
                        <label for="showDetails" class="form-label">Comments/Suggestions/Requests/Descriptions</label>
                        <textarea class="form-control" id="showDetails" cols="30" rows="5" disabled></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="dateSelected" class="form-label">Date Requested</label>
                        <input type="text" class="form-control" id="dateSelected" disabled>
                        <br>
                        <label for="priceReason" class="form-label">Things that use to the Service / Reason to the Price</label>
                        <textarea class="form-control" id="priceReason" cols="30" rows="5" disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-danger">Close</button>
            </div>
        </div>
    </div>
</div>


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
        

        
        $(document).ready(function () {

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

        function cancelRent(id){
            var rent_id = id;
            if (confirm("Do you want to Cancel this Rent Request?")) {
                var form_data = {
                    rent_id : rent_id
                }
                
                $.ajax({
                    url : "db/rentCancel.php",
                    type : "POST",
                    data : form_data,
                    dataType: "json",
                    success: function(response){
                        if(response['valid']==false){
                            alert(response['msg']);
                        }else{
                            $('#successModal').modal('show');

                            // Close successModal after 2 seconds and trigger redirection
                            setTimeout(function () {
                                $('#successModal').modal('hide');
								location.reload();
                            },1000);
                        }
                    }
                });
            }else{

            }
        }
    </script>
</body>

</html>