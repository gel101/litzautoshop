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
                                <h4 class="mb-sm-0">Paint</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Admin</a></li>
                                        <li class="breadcrumb-item">Stock</li>
                                        <li class="breadcrumb-item active">Paint</li>
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
											<span class="buttonSpan float-end"><button type="button" onclick="addPaint()" class="btn btn-primary">Add New Paint</button></span>
										</div>
									</div>
									<br>
									<table class="table text-center" id="table11">
										<thead style="color: #1873d3">
											<tr>
												<th scope="col">Paint ID</th>
												<th scope="col">Main Image</th>
												<th scope="col">Additional Image 1</th>
												<th scope="col">Additional Image 2</th>
												<th scope="col">Color</th>
												<th scope="col">Quantity</th>
												<th scope="col">Used</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											include 'db/connection.php';

											$sql = mysqli_query($conn, "SELECT * FROM paints WHERE (status IS NULL OR status != 'archived') AND quantity > 0 ORDER BY paint_id DESC");

											while($data = mysqli_fetch_assoc($sql)){
											?>
											<tr class="<?php
												if ($data['quantity'] >= 6 && $data['quantity'] <= 10) {
													echo 'text-warning';
												} elseif ($data['quantity'] <= 5) {
													echo 'text-danger';
												}
												?>"
												>
												<td><?php echo $data['paint_id']; ?></td>
												<td><img src="db/<?php echo $data['img']; ?>" alt="" style="width: 40px; height: 40px;"></td>
												<td><img src="db/<?php echo $data['img2']; ?>" alt="" style="width: 40px; height: 40px;"></td>
												<td><img src="db/<?php echo $data['img3']; ?>" alt="" style="width: 40px; height: 40px;"></td>
												<td><?php echo $data['paint_color']; ?></td>
												<td><?php echo $data['quantity']; ?></td>
												<td><?php echo $data['sold']; ?></td>
												<td class="text-end text-center">
													<button class="btn btn-warning" onclick="editPaint(
															'<?php echo $data['paint_id']; ?>',
															'<?php echo $data['paint_color']; ?>',
															'<?php echo $data['quantity']; ?>'
															)"><i class="fas fa-pen"></i></button>
													<button class="btn btn-danger" onclick="deletePaint('<?php echo $data['paint_id']; ?>','<?php echo $data['img']; ?>','<?php echo $data['paint_color']; ?>','<?php echo $data['quantity']; ?>')"><i class="fas fa-folder-minus"></i></button>
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
				<h4 id="title">Add Paint</h4>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<label class="form-label">Main Image</label><span class="a_img_err text-danger"></span>
				<input class="form-control" type="file" name="paintImg" id="paintImg"required>
				<br>
				<label class="form-label">Additional Image</label><span class="a_img_err text-danger"></span>
				<input class="form-control" type="file" name="paintImg2" id="paintImg2"required>
				<input class="form-control" type="file" name="paintImg3" id="paintImg3"required>
				<br>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Color Name</label><span class="a_name_err text-danger"></span>
						<input class="form-control" id="paintName" name="paintName" type="text" placeholder="Enter Color" required>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">Quantity</label><span class="a_quantity_err text-danger"></span>
						<input class="form-control" id="paintQuantity" name="paintQuantity" type="number" placeholder="Enter Quantity" required>
						<br>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button type="submit" class="btn btn-primary" id="savepaintBtn">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- END OF ADD ENGINE MODAL -->

<!-- ENGINE MODAL -->
<div class="modal fade" id="editPaintModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Edit Color</h4>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="paint_id" id="epaint_id">
				<label class="form-label">Change Main Color</label><span class="e_img_err text-danger"></span>
				<input class="form-control" type="file" name="epaintImg" id="epaintImg" required>
				<br>
				<label class="form-label">Additional Image</label><span class="a_img_err text-danger"></span>
				<input class="form-control" type="file" name="epaintImg2" id="epaintImg2"required>
				<input class="form-control" type="file" name="epaintImg3" id="epaintImg3"required>
				<br>
				<div class="row">
					<div class="col md-6">
						<label class="form-label">Color Name</label><span class="e_name_err text-danger"></span>
						<input type="text" class="form-control" id="epaintName" name="epaintName">
						<br>
					</div>
					<div class="col md-6">
						<label class="form-label">Quantity</label><span class="e_quantity_err text-danger"></span>
						<input class="form-control" id="epaintQuantity" name="epaintQuantity" type="number" placeholder="Enter Quantity" required>
						<br>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button class="btn btn-primary" id="editPaintBtn">Save</button>
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

		$("#savepaintBtn").click(function() {
			var valid = true;
			var img = $("#paintImg").prop("files")[0]; // Get the file object
			var img2 = $("#paintImg2").prop("files")[0]; // Get the file object
			var img3 = $("#paintImg3").prop("files")[0]; // Get the file object
			var color = $("#paintName").val();
			var quantity = $("#paintQuantity").val();

			if(color == ""){
				valid = false;
				$(".a_name_err").html(" *Please enter a Color");
			}

			if(quantity == ""){
				valid = false;
				$(".a_quantity_err").html(" *Please enter a Quantity");
			}

			if (valid) {
				var form_data = new FormData(); // Create a new FormData object
				form_data.append("paintImg", img);
				if (typeof img2 !== "undefined") {
					form_data.append("paintImg2", img2);
				}
				if (typeof img3 !== "undefined") {
					form_data.append("paintImg3", img3);
				}
				form_data.append("color", color);
				form_data.append("quantity", quantity);

				// Send the image data and other form data to PHP using AJAX
				$.ajax({
					url: "db/paintAdd.php",
					type: "POST",
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response){
						var responseData = JSON.parse(response);
						if(responseData.valid == false){
							alert(responseData.msg);
						} else {
							$('.dismissBtn').click();
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



		$("#editPaintBtn").click(function(){
			var valid = true;
			var paint_id = $("#epaint_id").val();
			var img = $("#epaintImg").prop("files")[0]; // Get the file object
			var img2 = $("#epaintImg2").prop("files")[0]; // Get the file object
			var img3 = $("#epaintImg3").prop("files")[0]; // Get the file object
			var color = $("#epaintName").val();
			var quantity = $("#epaintQuantity").val();


			if (paint_id == "") {
				valid = false;
				alert("No Paint ID");
			}

			if (color == "") {
				valid = false;
				$(".e_name_err").html(" *Please enter a Car Name");
			}

			if (quantity == "") {
				valid = false;
				$(".e_quantity_err").html(" *Please enter a quantity");
			}

			if (valid) {
				var form_data = new FormData(); // Create a new FormData object
				form_data.append("paint_id", paint_id);
				if (typeof img !== "undefined") {
					form_data.append("epaintImg", img);
				}
				if (typeof img2 !== "undefined") {
					form_data.append("epaintImg2", img2);
				}
				if (typeof img3 !== "undefined") {
					form_data.append("epaintImg3", img3);
				}
				form_data.append("color", color);
				form_data.append("quantity", quantity);
				
				// Send the image data and other form data to PHP using AJAX
				$.ajax({
					url: "db/paintUpdate.php",
					type: "POST",
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response){
						var responseData = JSON.parse(response);
						if(responseData.valid == false){
							alert(responseData.msg);
						} else {
							$('.dismissBtn').click();
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
        
    function addPaint(){
		$("#addModal").modal("show");
	}


	function editPaint(paint_id, color, quantity){
		var paint_id = paint_id;
		var color = color;
		var quantity = quantity;

		$("#epaint_id").val(paint_id);
		$("#epaintName").val(color);
		$("#epaintQuantity").val(quantity);


		$("#editPaintModal").modal("show");
	}

    
	function deletePaint(paint_id, img, color, quantity){
		if (confirm("Do you want to archive this record?")) {
			var form_data = {
				paint_id : paint_id,
				img : img,
				color : color,
				quantity : quantity
			}

			$.ajax({
	        	url : "db/paintDelete.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid']==false){
	              alert(response['msg']);
	            }else{
					$('.dismissBtn').click();
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