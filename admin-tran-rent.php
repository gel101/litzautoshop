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
                                <h4 class="mb-sm-0">CURRENT TRANSACTION</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item">Transaction</li>
                                        <li class="breadcrumb-item active">Rental</li>
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
											<th scope="col">Price</th>
											<th scope="col">Amount of Payment</th>
											<th scope="col">Rent Date</th>
											<th scope="col">Date</th>
											<th scope="col">Status</th>
											<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                            $sql = mysqli_query($conn, "SELECT * FROM rent_transactions WHERE status != 'archived' AND status != 'canceled' ORDER BY rent_id DESC");
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
                                            <td><?php if($data['price'] != 0){echo "&#8369; " . number_format($data['price'], 2); }elseif($data['status']=="Canceled" || $data['status']=="Declined"){echo '<p><span class="badge bg-danger">' .$data['status'].'</span></p>';}else{echo '<p><span class="badge bg-warning">Pending</span></p>';} ?></td>
                                            <td><?php if($data['downpayment'] != 0){echo "&#8369; " . number_format($data['downpayment'], 2); }elseif($data['status']=="Canceled" || $data['status']=="Declined"){echo '<p><span class="badge bg-danger">' .$data['status'].'</span></p>';}else{echo '<p><span class="badge bg-warning">Pending</span></p>';} ?></td>
                                            <td><?php $date = new DateTime($data['rentDate']); $formattedDate = $date->format('m-d-Y'); echo $formattedDate;  ?></td>
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
												case "Canceled":
												case "Declined":
													echo "bg-danger";
													break;
												default:
													echo "bg-primary";
											}
											?>"><?php echo $data['status']; ?></span></h5></td>
											<td class="text-end text-center">
                                                <button type="button" class="btn btn-primary" onclick="showClientInfo('<?php echo $data['cust_id']; ?>')" data-bs-toggle="modal" data-bs-target="#clientDetail"><i class="fas fa-user"></i></button>
                                                <button type="button" class="btn btn-info <?php if ($data['status'] != "Pending") {echo 'd-none';} ?>" onclick="acceptRent('<?php echo $data['rent_id']; ?>', '<?php echo $data['cust_id']; ?>')" data-bs-toggle="modal"><i class="fas fa-check"></i></button>
                                                <button type="button" class="btn btn-secondary <?php if ($data['status'] != "Accepted") {echo 'd-none';} ?>" onclick="preApprove('<?php echo $data['rent_id']; ?>', '<?php echo $data['cust_id']; ?>')" data-bs-toggle="modal" data-bs-target="#fileUploadModal"><i class="fas fa-check-double"></i></button>
                                                <button type="button" class="btn btn-success <?php if ($data['status'] != "In Use") {echo 'd-none';} ?>" onclick="returnRent('<?php echo $data['rent_id']; ?>', '<?php echo $data['cust_id']; ?>', '<?php echo $data['price']; ?>')"><i class="fas fa-car"></i> <i class="fas fa-check"></i></button>
												<button class="btn btn-danger <?php if ($data['status'] == "Canceled" OR $data['status'] == "Declined" OR $data['status'] == "Accepted" OR $data['status'] == "In Use" OR $data['status'] == "Rent Completed") {echo 'd-none';} ?>" type="button" value="" onclick="cancelRent(
													'<?php echo $data['rent_id']; ?>',
													'<?php echo $data['cust_id']; ?>',
													'<?php echo $data['price']; ?>',
													'<?php echo $data['downpayment']; ?>'
													)"><i class="fas fa-archive"></i></button>
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



<!-- SHOW MORE INFO MODAL -->
<div class="modal fade zoomIn" id="clientDetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Client Details</h3>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <div id="showClientInfo">

                </div>
			</div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-danger">CLOSE</button>
                </div>
		</div>
	</div>
</div>
<!-- END OF SHOW MORE INFO MODAL -->

                    


<!-- FILE IMAGE MODAL -->
<div class="modal fade zoomIn" id="fileUploadModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
                <input type="hidden" name="cust_id" id="cust_id">
                <input type="hidden" name="rent_id" id="rent_id">
				<h3 id="title">Requirement Details <span id="documentVerify" class="badge"></span></h3>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
			</div>
			<div class="modal-body">
                <div id="con1">
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-label">Driver's License</label><span class="text-danger smalll"> *Not required for those who don't have a driver</span>
                                <input class="form-control" type="file" name="driverL" id="driverL" required>
                                <br>
                                <label for="" class="form-label">Any Government ID</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="governmentID" id="governmentID" required>
                                <br>
                                <label for="" class="form-label">Rent Price</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="number" name="rentPrice" id="rentPrice" placeholder="Enter Rent Price" required>
                                <br>
                                <label for="" class="form-label">Customer's Payment</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="number" name="rentPayment" id="rentPayment" placeholder="Enter Payment Amount" required>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal-footer">
                                <button data-bs-dismiss="modal" type="button" class="btn btn-danger">CLOSE</button>
                                <button type="submit" class="btn btn-primary">Submit Form</button>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- END OF FILE IMAGE MODAL -->



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


            $('#uploadForm').submit(function (e) {
                e.preventDefault(); // Prevent default form submission

                var rent_id = $("#rent_id").val();
                var cust_id = $("#cust_id").val();
			    var driverL = $("#driverL").prop("files")[0]; // Get the file object
			    var governmentID = $("#governmentID").prop("files")[0]; // Get the file object
			    // var addProff = $("#addProff").prop("files")[0]; // Get the file object
                var rentPrice = $("#rentPrice").val();
                var rentPayment = $("#rentPayment").val();

                if (confirm("Do you want to submit and sure about all the fields?")) {
                    var form_data = new FormData(); // Create a new FormData object
                    form_data.append("rent_id", rent_id);
                    form_data.append("cust_id", cust_id);
                    form_data.append("driverL", driverL);
                    form_data.append("governmentID", governmentID);
                    // form_data.append("addProff", addProff);
                    form_data.append("rentPrice", rentPrice);
                    form_data.append("rentPayment", rentPayment);

                    // alert(cust_id +" " + driverL + " " + governmentID + " " + rentPrice + " " + rentPayment);

                    // if (typeof img6 !== "undefined") {
                    //     form_data.append("img6", img6);
                    // }
                    // form_data.append("img7", img7);

                    // Send the image data and other form data to PHP using AJAX
                    $.ajax({
                        url: "db/rentApproved.php",
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            $('#loadingModal').modal('show');
                            $('.dismissBtn').click();
                        },
                        success: function (response) {
                            var responseData = JSON.parse(response);
                            if(responseData.valid == false){
                                $('#loadingModal').modal('hide');
                                alert(responseData.msg);
                            } else {
                                $('#successModal').modal('show');

                                // Close successModal after 2 seconds and trigger redirection
                                setTimeout(function () {
                                    $('#successModal').modal('hide');
                                    location.reload();
                                },1000);
                            }
                            $('#loadingModal').modal('hide');
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert("Error: " + errorThrown);
                            $('#loadingModal').modal('hide'); // Hide the modal on error
                        }
                    });
                } else {
                    // Handle invalid form
                }
            });


        });
        
        function showClientInfo(cust_id){
            $("#showClientInfo").load("db/ajaxShowClientProfile.php", {
                clientInfo : cust_id
            });
        }

        function preApprove(rent_id, cust_id){
            $('#rent_id').val(rent_id);
            $('#cust_id').val(cust_id);
        }

        function acceptRent(rent_id, cust_id){
            if (confirm("Do you want to Accept this Rent Request?")) {
                var form_data = {
                    rent_id : rent_id,
                    cust_id : cust_id
                }
                
                $.ajax({
                    url : "db/rentAccept.php",
                    type : "POST",
                    data : form_data,
                    dataType: "json",
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
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
                        $('#loadingModal').modal('hide');
                    }
                });
            }else{

            }
        }
        
        function returnRent(rent_id, cust_id ,rentPrice){
            if (confirm("Has the rent ended, and has the car been returned?")) {
                var form_data = {
                    rent_id : rent_id,
                    cust_id : cust_id,
                    rentPrice : rentPrice
                }
                
                $.ajax({
                    url : "db/rentReturned.php",
                    type : "POST",
                    data : form_data,
                    dataType: "json",
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
                    success: function(response){
                        if(response['valid']==false){
                            $('#loadingModal').modal('hide');
                            alert(response['msg']);
                        }else{
                            $('#successModal').modal('show');

                            // Close successModal after 2 seconds and trigger redirection
                            setTimeout(function () {
                                $('#successModal').modal('hide');
								location.reload();
                            },1000);
                        }
                        $('#loadingModal').modal('hide');
                    }
                });
            }else{

            }
        }

        function cancelRent(id, cust_id, rentPrice, rentPayment){
            var rent_id = id;
            if (confirm("Do you want to Cancel the Rent Request?")) {
                var form_data = {
                    rent_id : rent_id,
                    cust_id : cust_id,
                    rentPrice : rentPrice,
                    rentPayment : rentPayment
                }
                
                $.ajax({
                    url : "db/rentDelete.php",
                    type : "POST",
                    data : form_data,
                    dataType: "json",
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
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
                        $('#loadingModal').modal('hide');
                    }
                });
            }else{

            }
        }
    </script>
</body>

</html>