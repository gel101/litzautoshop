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
		.search{
			position: relative;
			width: 100%;
			height: 90px;
			z-index: 0;
		}
		.searchbar{
			position: absolute;
			right: 10px;
			bottom: 20%;
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
                                <h4 class="mb-sm-0">Car</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Admin</a></li>
                                        <li class="breadcrumb-item">Stock</li>
                                        <li class="breadcrumb-item active">Car</li>
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
									<br>
									<div class="col-md-2">
										<span class="buttonSpan float-end"><button type="button" onclick="addCar()" class="btn btn-primary">Add New Car</button></span>
									</div>
								</div>
								<br>
								<table class="table text-center" id="table11">
									<thead style="color: #1873d3">
										<tr>
											<th scope="col">Car ID</th>
											<th scope="col">Img</th>
											<th scope="col">Car Type</th>
											<th scope="col">Name</th>
											<th scope="col">Model</th>
											<th scope="col">Engine Transmission</th>
											<!-- <th scope="col">Quantity</th>
											<th scope="col">Sold</th> -->
											<th scope="col">Price</th>
											<th scope="col">Details</th>
											<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										include 'db/connection.php';

										$sql = mysqli_query($conn, "SELECT * FROM cars WHERE quantity > 0 AND (status IS NULL OR status != 'archived') ORDER BY car_id DESC");

										while($data = mysqli_fetch_assoc($sql)){
										?>
										<tr>
											<td><?php echo $data['car_id']; ?></td>
											<td><img src="db/<?php echo $data['car_img']; ?>" alt="" style="width: 40px; height: 40px;"></td>
											<td><?php echo strlen($data['car_type']) > 10 ? substr($data['car_type'], 0, 10) . '...' : $data['car_type'];  ?></td>
											<td><?php echo $data['name']; ?></td>
											<td><?php echo $data['model']; ?></td>
											<td><?php echo $data['engine']; ?></td>
											<!-- <td><?php echo $data['quantity']; ?></td>
											<td><?php echo $data['sold']; ?></td> -->
											<td>&#8369; <?php echo number_format($data['price'], 2); ?></td>
											<td><?php echo strlen($data['details']) > 5 ? substr($data['details'], 0, 5) . '...' : $data['details'];  ?></td>
											<td class="text-end text-center">
												<button class="btn btn-warning" value="<?php echo $data['details']; ?>" onclick="editCar(
                                                        '<?php echo $data['car_id']; ?>',
                                                        '<?php echo $data['car_type']; ?>',
                                                        '<?php echo $data['name']; ?>',
                                                        '<?php echo $data['model']; ?>',
                                                        '<?php echo $data['engine']; ?>',
                                                        '<?php echo $data['quantity']; ?>',
                                                        '<?php echo $data['price']; ?>',
                                                        '<?php echo $data['chassis']; ?>',
                                                        '<?php echo $data['tempPlate']; ?>',
														this.value
                                                        )"><i class="fas fa-pen"></i></button>
												<button class="btn btn-danger" value="<?php echo $data['details']; ?>" onclick="archiveCar(
													'<?php echo $data['car_id']; ?>',
													'<?php echo $data['car_img']; ?>',
													'<?php echo $data['car_type']; ?>',
													'<?php echo $data['name']; ?>',
													'<?php echo $data['model']; ?>',
													'<?php echo $data['engine']; ?>',
													'<?php echo $data['quantity']; ?>',
													'<?php echo $data['price']; ?>',
													this.value
													)"><i class="fas fa-folder-minus"></i></button>
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


<!-- ADD ENGINE MONAL -->
<div class="modal fade" id="addModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Add Car</h4>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<label class="form-label">Main Car Image</label><span class="a_img_err text-danger"></span>
				<input class="form-control" type="file" name="carImg" id="carImg"required>
				<br>
				<label class="form-label">Additional Car Image</label>
				<input class="form-control" type="file" name="img1" id="img1">
				<input class="form-control" type="file" name="img2" id="img2">
				<input class="form-control" type="file" name="img3" id="img3">
				<input class="form-control" type="file" name="img4" id="img4">
				<br>
				<label class="form-label">Car Name</label><span class="a_name_err text-danger"></span>
				<input class="form-control" id="carName" name="carName" type="text" placeholder="Enter Car Name" required>
				<br>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Car Type</label><span class="a_type_err text-danger"></span>
						<select class="form-select" name="carType" id="carType"required>
							<?php
								$stmtpaintdelete = mysqli_query($conn, "SELECT * FROM vehicletype_sell ORDER BY id DESC");
								while($data = mysqli_fetch_assoc($stmtpaintdelete)){
							?>
							<option value="<?php echo $data['vehicleType']; ?>"><?php echo $data['vehicleType']; ?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="col-md-6">
						<label class="form-label">Car Model</label><span class="a_model_err text-danger"></span>
						<select class="form-select" name="carModel" id="carModel"required>

						</select>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">Car Engine Transmission</label><span class="a_engine_err text-danger"></span>
						<select class="form-select" name="carEngine" id="carEngine" required>

						</select>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">Price</label><span class="a_price_err text-danger"></span>
						<input class="form-control" id="carPrice" name="carPrice" type="number" placeholder="Enter Price" required>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label d-none">Quantity</label><span class="a_quantity_err text-danger"></span>
						<input class="form-control d-none" id="carQuantity" name="carQuantity" type="number" placeholder="Enter Quantity" value="1" disabled>
						<br>
					</div>
					<div class="col-md-6">
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Chassis Number</label><span class="a_chassis_err text-danger"></span>
						<input class="form-control" id="carChassis" name="carChassis" type="text" oninput="chassisVerify(this)" placeholder="Enter Chassis Number" required>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">MV File No.(Temporary No.)</label><span class="a_tempPlate_err text-danger"></span>
						<input class="form-control" id="cartempPlate" name="cartempPlate" type="text" oninput="verifyFormat(this)" placeholder="Enter Temporary Plate Number" required>
						<br>
					</div>
				</div>
				<label class="form-label">Details</label><span class="a_details_err text-danger"></span>
				<textarea class="form-control" name="carDetails" id="carDetails" cols="30" rows="10" placeholder="Insert additional details..."></textarea>
			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button type="submit" class="btn btn-primary" id="saveCarBtn">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- END OF ADD ENGINE MODAL -->

<!-- ENGINE MODAL -->
<div class="modal fade" id="editCarModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Edit Car Information</h4>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="car_id" id="ecar_id">
				<label class="form-label">Main Car Image</label><span class="e_img_err text-danger"></span>
				<input class="form-control" type="file" name="ecarImg" id="ecarImg" required>
				<br>
				<label class="form-label">Additional Car Image</label>
				<input class="form-control" type="file" name="eimg1" id="eimg1">
				<input class="form-control" type="file" name="eimg2" id="eimg2">
				<input class="form-control" type="file" name="eimg3" id="eimg3">
				<input class="form-control" type="file" name="eimg4" id="eimg4">
				<br>
				<label class="form-label">Car Name</label><span class="e_name_err text-danger"></span>
				<input class="form-control" id="ecarName" name="ecarName" type="text" placeholder="Enter Car Name" required>
				<br>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Car Type</label><span class="e_type_err text-danger"></span>
						<select class="form-select" name="ecarType" id="ecarType" required>
									<?php
										$stmtpaintdelete = mysqli_query($conn, "SELECT * FROM vehicletype_sell ORDER BY id DESC");
										while($data = mysqli_fetch_assoc($stmtpaintdelete)){
									?>
									<option value="<?php echo $data['vehicleType']; ?>"><?php echo $data['vehicleType']; ?></option>
									<?php
										}
									?>
						</select>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">Car Model</label><span class="e_model_err text-danger"></span>
						<select class="form-select" name="ecarModel" id="ecarModel" required>
                                            
						</select>
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Car Engine Transmission</label><span class="e_engine_err text-danger"></span>
						<select class="form-select" name="ecarEngine" id="ecarEngine" required>
                                            
						</select>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">Price</label><span class="e_price_err text-danger"></span>
						<input class="form-control" id="ecarPrice" name="ecarPrice" type="number" placeholder="Enter Price" required>
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label d-none">Quantity</label><span class="e_quantity_err text-danger"></span>
						<input class="form-control d-none" id="ecarQuantity" name="ecarQuantity" type="number" placeholder="Enter Quantity" value="1" disabled>
						<br>
					</div>
					<div class="col-md-6">

					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Chasis Number</label><span class="e_chassis_err text-danger"></span>
						<input class="form-control" id="ecarChassis" name="ecarChassis" type="text" oninput="echassisVerify(this)" placeholder="Enter Chassis Number" required>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">MV File No.(Temporary No.)</label><span class="e_tempPlate_err text-danger"></span>
						<input class="form-control" id="ecartempPlate" name="ecartempPlate" type="text" oninput="everifyFormat(this)" placeholder="Enter Tempoarary Plate Number" required>
						<br>
					</div>
				</div>
				<label class="form-label">Details</label><span class="e_details_err text-danger"></span>
				<textarea class="form-control" name="ecarDetails" id="ecarDetails" cols="30" rows="10" placeholder="Insert additional details..."></textarea>
			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button class="btn btn-primary" id="editCarBtn">Save</button>
			</div>	
		</div>
	</div>
</div>
<!-- END OF ENGINE MODAL -->









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

		function chassisVerify(input){
			// Define the regular expression pattern for the desired format
			var chassisPattern = /^([A-Z0-9]{2}\d{2}[A-Z]-\d{6})$/;

			// Test if the chassis value matches the pattern
			if (!chassisPattern.test(input.value)) {
				valid = false;
				$(".a_chassis_err").html(" *Please verify the Chassis Number format (e.g., DA17V-203020)");
			}else{
				$(".a_chassis_err").html(" ");
			}
		}

		function echassisVerify(input){
			// Define the regular expression pattern for the desired format
			var chassisPattern = /^([A-Z0-9]{2}\d{2}[A-Z]-\d{6})$/;

			// Test if the chassis value matches the pattern
			if (!chassisPattern.test(input.value)) {
				valid = false;
				$(".e_chassis_err").html(" *Please verify the Chassis Number format (e.g., DA17V-203020)");
			}else{
				$(".e_chassis_err").html(" ");
			}
		}

		function verifyFormat(input){

				// Define the regular expression pattern for the desired format
				var tempPlatePattern = /^\d{4}-\d{11}$/;

				// Test if the tempPlate value matches the pattern
				if (!tempPlatePattern.test(input.value)) {
					$(".a_tempPlate_err").html(" *Please verify the Temporary Plate format (e.g., 1234-00012346789)");
				}else{
					$(".a_tempPlate_err").html(" ");
				}
		}

		function everifyFormat(input){

				// Define the regular expression pattern for the desired format
				var tempPlatePattern = /^\d{4}-\d{11}$/;

				// Test if the tempPlate value matches the pattern
				if (!tempPlatePattern.test(input.value)) {
					$(".e_tempPlate_err").html(" *Please verify the Temporary Plate format (e.g., 1234-00012346789)");
				}else{
					$(".e_tempPlate_err").html(" ");
				}
		}
		
	// FOR ENGINE AVALABLE
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
			
            $.ajax({
                url: 'db/utilitiesvehicle.php',
                type: 'GET',
                data: { 'action': 'getcarDetails' },
                dataType: 'json',
                success: function (data) {
                    // Populate the select element with the fetched car models
                    var selectElementModel = $('#carModel');
                    $.each(data.carModels, function (index, value) {
                        selectElementModel.append($('<option>', {
                            value: value.model,
                            text: value.model
                        }));
                    });
					
                    var eselectElementModel = $('#ecarModel');
                    $.each(data.carModels, function (index, value) {
                        eselectElementModel.append($('<option>', {
                            value: value.model,
                            text: value.model
                        }));
                    });

                    // Populate the select element with the fetched car engines
                    var selectElementEngine = $('#carEngine');
                    $.each(data.carEngines, function (index, value) {
                        selectElementEngine.append($('<option>', {
                            value: value.engine,
                            text: value.engine
                        }));
                    });
					
                    var eselectElementEngine = $('#ecarEngine');
                    $.each(data.carEngines, function (index, value) {
                        eselectElementEngine.append($('<option>', {
                            value: value.engine,
                            text: value.engine
                        }));
                    });
                },
                error: function () {
                    console.error('Error fetching data from the server.');
                }
            });

		$("#saveCarBtn").click(function() {
			var valid = true;
			var car_img = $("#carImg").prop("files")[0]; // Get the file object
			var img1 = $("#img1").prop("files")[0]; // Get the file object
			var img2 = $("#img2").prop("files")[0]; // Get the file object
			var img3 = $("#img3").prop("files")[0]; // Get the file object
			var img4 = $("#img4").prop("files")[0]; // Get the file object
			var car_type = $("#carType").val();
			var carName = $("#carName").val();
			var model = $("#carModel").val();
			var engine = $("#carEngine").val();
			var quantity = $("#carQuantity").val();
			var price = $("#carPrice").val();
			var chassis = $("#carChassis").val();
			var tempPlate = $("#cartempPlate").val();
			var details = $("#carDetails").val();
			
			if(car_type == ""){
				valid = false;
				$(".a_type_err").html(" *Please enter a Car Type");
			}

			if(carName == ""){
				valid = false;
				$(".a_name_err").html(" *Please enter a Car Name");
			}

			if(model == ""){
				valid = false;
				$(".a_model_err").html(" *Please enter a Car Model");
			}

			if(engine == ""){
				valid = false;
				$(".a_engine_err").html(" *Please enter an Engine");
			}

			if(quantity == ""){
				valid = false;
				$(".a_quantity_err").html(" *Please enter a Quantity");
			}

			if(price == ""){
				valid = false;
				$(".a_price_err").html(" *Please enter a Price");
			}
			

			// if(tempPlate == ""){
			// 	valid = false;
			// 	$(".a_tempPlate_err").html(" *Please enter a Temporary Plate Number");
			// }
			

			// if(chassis == ""){
			// 	valid = false;
			// 	$(".a_chassis_err").html(" *Please enter a chassis number");
			// }

			if (tempPlate !== "") {
				// Define the regular expression pattern for the desired format
				var tempPlatePattern = /^\d{4}-\d{11}$/;

				// Test if the tempPlate value matches the pattern
				if (!tempPlatePattern.test(tempPlate)) {
					valid = false;
					$(".a_tempPlate_err").html(" *Please verify the Temporary Plate format (e.g., 1234-00012346789)");
				}
			}

			if(chassis !== "") {
				// Define the regular expression pattern for the desired format
				var chassisPattern = /^([A-Z0-9]{2}\d{2}[A-Z]-\d{6})$/;

				// Test if the chassis value matches the pattern
				if (!chassisPattern.test(chassis)) {
					valid = false;
					$(".a_chassis_err").html(" *Please verify the Chassis Number format (e.g., DA17V-203020)");
				}
			}

			

			if (valid) {
				var form_data = new FormData(); // Create a new FormData object
				form_data.append("carImg", car_img);
				form_data.append("img1", img1);
				form_data.append("img2", img2);
				form_data.append("img3", img3);
				form_data.append("img4", img4);
				form_data.append("car_type", car_type);
				form_data.append("carName", carName);
				form_data.append("model", model);
				form_data.append("engine", engine);
				form_data.append("quantity", quantity);
				form_data.append("price", price);
				form_data.append("chassis", chassis);
				form_data.append("tempPlate", tempPlate);
				form_data.append("details", details);

				// Send the image data and other form data to PHP using AJAX
				$.ajax({
					url: "db/carAdd.php",
					type: "POST",
					data: form_data,
					contentType: false,
					processData: false,
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
					success: function(response){
						var responseData = JSON.parse(response);
						if(responseData.valid == false){
							alert(responseData.msg);
                        	$('#loadingModal').modal('hide');
							location.reload();
						} else {
							$('.dismissBtn').click();
                        	$('#loadingModal').modal('hide');
							$('#successModal').modal('show');

							// Close successModal after 2 seconds and trigger redirection
							setTimeout(function () {
								$('#successModal').modal('hide');
								location.reload();
							},1000);
						}
					}
				});
			} else {
				// Handle invalid form
			}
		});



		$("#editCarBtn").click(function(){
			var valid = true;
			var car_id = $("#ecar_id").val();
			var car_img = $("#ecarImg").prop("files")[0]; // Get the file object
			var img1 = $("#eimg1").prop("files")[0]; // Get the file object
			var img2 = $("#eimg2").prop("files")[0]; // Get the file object
			var img3 = $("#eimg3").prop("files")[0]; // Get the file object
			var img4 = $("#eimg4").prop("files")[0]; // Get the file object
			var car_type = $("#ecarType").val();
			var name = $("#ecarName").val();
			var model = $("#ecarModel").val();
			var engine = $("#ecarEngine").val();
			var quantity = $("#ecarQuantity").val();
			var price = $("#ecarPrice").val();
			var chassis = $("#ecarChassis").val();
			var tempPlate = $("#ecartempPlate").val();
			var details = $("#ecarDetails").val();


			if (car_id == "") {
				valid = false;
				alert("No car ID");
			}

			if (car_type == "") {
				valid = false;
				$(".e_type_err").html(" *Please enter a Car Type");
			}

			if (name == "") {
				valid = false;
				$(".e_name_err").html(" *Please enter a Car Name");
			}

			if (model == "") {
				valid = false;
				$(".e_model_err").html(" *Please enter a Car Model");
			}

			if (engine == "") {
				valid = false;
				$(".e_engine_err").html(" *Please enter an engine");
			}

			if (quantity == "") {
				valid = false;
				$(".e_quantity_err").html(" *Please enter a quantity");
			}

			if (price == "") {
				valid = false;
				$(".e_price_err").html(" *Please enter a Price");
			}
			
			if (tempPlate !== "") {
				// Define the regular expression pattern for the desired format
				var tempPlatePattern = /^\d{4}-\d{11}$/;

				// Test if the tempPlate value matches the pattern
				if (!tempPlatePattern.test(tempPlate)) {
					valid = false;
					$(".e_tempPlate_err").html(" *Please verify the Temporary Plate format (e.g., 1234-00012346789)");
				}
			}

			if(chassis !== "") {
				// Define the regular expression pattern for the desired format
				var chassisPattern = /^([A-Z0-9]{2}\d{2}[A-Z]-\d{6})$/;

				// Test if the chassis value matches the pattern
				if (!chassisPattern.test(chassis)) {
					valid = false;
					$(".e_chassis_err").html(" *Please verify the Chassis Number format (e.g., DA17V-203020)");
				}
			}


			if (valid) {
				var form_data = new FormData(); // Create a new FormData object
				form_data.append("car_id", car_id);
				if (typeof car_img !== "undefined") {
					form_data.append("ecarImg", car_img);
				}
				if (typeof img1 !== "undefined") {
					form_data.append("img1", img1);
				}
				if (typeof img2 !== "undefined") {
					form_data.append("img2", img2);
				}
				if (typeof img3 !== "undefined") {
					form_data.append("img3", img3);
				}
				if (typeof img4 !== "undefined") {
					form_data.append("img4", img4);
				}
				form_data.append("car_type", car_type);
				form_data.append("name", name);
				form_data.append("model", model);
				form_data.append("engine", engine);
				form_data.append("quantity", quantity);
				form_data.append("price", price);
				form_data.append("chassis", chassis);
				form_data.append("tempPlate", tempPlate);
				form_data.append("details", details);
				
				// Send the image data and other form data to PHP using AJAX
				$.ajax({
					url: "db/carUpdate.php",
					type: "POST",
					data: form_data,
					contentType: false,
					processData: false,
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
					success: function(response){
						var responseData = JSON.parse(response);
						if(responseData.valid == false){
							alert(responseData.msg);
                        	$('#loadingModal').modal('hide');
							location.reload();
						} else {
							$('.dismissBtn').click();
                        	$('#loadingModal').modal('hide');
							$('#successModal').modal('show');

							// Close successModal after 2 seconds and trigger redirection
							setTimeout(function () {
								$('#successModal').modal('hide');
								location.reload();
							},1000);
						}
					}
				});
			} else {
				// Handle invalid form
			}
		});

	});
        
    function addCar(){
		$("#addModal").modal("show");
	}


	function editCar(car_id, car_type, name, model, engine, quantity, price, chassis, tempPlate, details){
		var car_id = car_id;
		var car_type = car_type;
		var name = name;
		var model = model;
		var engine = engine;
		var quantity = quantity;
		var price = price;
		var details = details;

		$("#ecar_id").val(car_id);
		$("#ecarType").val(car_type);
		$("#ecarName").val(name);
		$("#ecarModel").val(model);
		$("#ecarEngine").val(engine);
		$("#ecarQuantity").val(quantity);
		$("#ecarPrice").val(price);
		$("#ecarChassis").val(chassis);
		$("#ecartempPlate").val(tempPlate);
		details = details.replace(/\n/g, '<br>');
		$('#ecarDetails').val(details.replace(/<br>/g, '\n'));


		$("#editCarModal").modal("show");
	}

    
	function archiveCar(car_id, car_img, car_type, name, model, engine, quantity, price, details){
		if (confirm("Are you sure you want to archive this record?")) {
			var form_data = {
				car_id : car_id,
				car_img : car_img,
				car_type : car_type,
				name : name,
				model : model,
				engine : engine,
				quantity : quantity,
				price : price,
				details : details
			}

			$.ajax({
	        	url : "db/carDelete.php",
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
					$('#loadingModal').modal('hide');
					location.reload();
	            }else{
					$('.dismissBtn').click();
					$('#loadingModal').modal('hide');
					$('#successModal').modal('show');

					// Close successModal after 2 seconds and trigger redirection
					setTimeout(function () {
						$('#successModal').modal('hide');
						location.reload();
					},1000);
	            }        
	          }
	        });
		}else {
			
		}
	}
    

    

    </script>
</body>

</html>