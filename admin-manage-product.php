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
                                <h4 class="mb-sm-0">Sparepart & Accessory</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Admin</a></li>
                                        <li class="breadcrumb-item">Stock</li>
                                        <li class="breadcrumb-item active">Sparepart & Accessory</li>
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
											<span class="buttonSpan"><button type="button" onclick="addProduct()" class="btn btn-primary">Add New Item</button></span>
										</div>
									</div>
									<br>
									<table class="table text-center" id="table11">
										<thead style="color: #1873d3">
											<tr>
												<th scope="col">Product ID</th>
												<th scope="col">Image</th>
												<th scope="col">Name</th>
												<th scope="col">Quantity</th>
												<th scope="col">Sold</th>
												<th scope="col">Price</th>
												<th scope="col">Details</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											include 'db/connection.php';

											$sql = mysqli_query($conn, "SELECT * FROM spareparts_accessories WHERE quantity > 0 AND (status IS NULL OR status != 'archived') ORDER BY sparepart_id DESC");

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
												<td><?php echo $data['sparepart_id']; ?></td>
												<td><img src="db/<?php echo $data['img']; ?>" alt="" style="width: 40px; height: 40px;"></td>
												<td><?php echo $data['product']; ?></td>
												<td><?php echo $data['quantity']; ?></td>
												<td><?php echo $data['sold']; ?></td>
												<td>&#8369; <?php echo number_format($data['price'], 2); ?></td>
												<td><?php echo strlen($data['details']) > 5 ? substr($data['details'], 0, 5) . '...' : $data['details'];  ?></td>
												<td class="text-end text-center">
													<button class="btn btn-warning" value="<?php echo $data['details']; ?>" onclick="editProduct(
															'<?php echo $data['sparepart_id']; ?>',
															'<?php echo $data['product']; ?>',
															'<?php echo $data['quantity']; ?>',
															'<?php echo $data['price']; ?>',
															this.value
															)"><i class="fas fa-pen"></i></button>
													<button class="btn btn-danger" value="<?php echo $data['details']; ?>" onclick="archiveProd('<?php echo $data['sparepart_id']; ?>','<?php echo $data['img']; ?>','<?php echo $data['product']; ?>','<?php echo $data['quantity']; ?>','<?php echo $data['price']; ?>', this.value)"><i class="fas fa-folder-minus"></i></button>
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
<div class="modal fade" id="addProductModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Add Product</h4>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<label class="form-label">Image</label><span class="a_img_err text-danger"></span>
				<input class="form-control" type="file" name="productImg" id="productImg" required>
				<br>
				<label class="form-label">Name</label><span class="a_name_err text-danger"></span>
				<input class="form-control" type="text" id="productName" name="productName" placeholder="Enter Product">
				<br>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Quantity</label><span class="a_quantity_err text-danger"></span>
						<input class="form-control" id="productQuantity" name="productQuantity" type="number" placeholder="Enter Quantity" required>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">Price</label><span class="a_price_err text-danger"></span>
						<input class="form-control" id="productPrice" name="productPrice" type="number" placeholder="Enter Price" required>
						<br>
					</div>
				</div>
				<label class="form-label">Details</label><span class="a_details_err text-danger"></span>
				<textarea class="form-control" name="productDetails" id="productDetails" cols="30" rows="10"></textarea>
			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button type="submit" class="btn btn-primary" id="saveProductBtn">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- END OF ADD ENGINE MODAL -->

<!-- ENGINE MODAL -->
<div class="modal fade" id="editProdModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Edit Product</h4>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="eproduct_id" id="eproduct_id">
				<label class="form-label">Image</label><span class="e_img_err text-danger"></span>
				<input class="form-control" type="file" name="eproductImg" id="eproductImg" required>
				<br>
				<label class="form-label">Name</label><span class="e_name_err text-danger"></span>
				<input type="text" class="form-control" name="eproductName" id="eproductName">
				<br>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Quantity</label><span class="e_quantity_err text-danger"></span>
						<input class="form-control" id="eproducyQuantity" name="eproducyQuantity" type="number" placeholder="Enter Quantity" required>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">Price</label><span class="e_price_err text-danger"></span>
						<input class="form-control" id="eproductPrice" name="eproductPrice" type="number" placeholder="Enter Price" required>
						<br>
					</div>
				</div>
				<label class="form-label">Details</label><span class="e_details_err text-danger"></span>
				<textarea class="form-control" name="eproductDetails" id="eproductDetails" cols="30" rows="10"></textarea>
			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button class="btn btn-primary" id="editProdBtn">Save</button>
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

		$("#saveProductBtn").click(function() {
			var valid = true;
			var img = $("#productImg").prop("files")[0]; // Get the file object
			var product = $("#productName").val();
			var quantity = $("#productQuantity").val();
			var price = $("#productPrice").val();
			var details = $("#productDetails").val();

			if(product == ""){
				valid = false;
				$(".a_name_err").html(" *Please enter a Name");
			}

			if(quantity == ""){
				valid = false;
				$(".a_quantity_err").html(" *Please enter a Quantity");
			}

			if(price == ""){
				valid = false;
				$(".a_price_err").html(" *Please verify the Price");
			}
			

			if (valid) {
				var form_data = new FormData(); // Create a new FormData object
				form_data.append("productImg", img);
				form_data.append("product", product);
				form_data.append("quantity", quantity);
				form_data.append("price", price);
				form_data.append("details", details);

				// Send the image data and other form data to PHP using AJAX
				$.ajax({
					url: "db/sparepartAdd.php",
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



		$("#editProdBtn").click(function(){
			var valid = true;
			var id = $("#eproduct_id").val();
			var img = $("#eproductImg").prop("files")[0]; // Get the file object
			var product = $("#eproductName").val();
			var quantity = $("#eproducyQuantity").val();
			var price = $("#eproductPrice").val();
			var details = $("#eproductDetails").val();


			if (id == "") {
				valid = false;
				alert("No Product ID");
			}

			if (product == "") {
				valid = false;
				$(".e_name_err").html(" *Please enter a Car Name");
			}

			if (quantity == "") {
				valid = false;
				$(".e_quantity_err").html(" *Please enter a quantity");
			}

			if (price == "") {
				valid = false;
				$(".e_price_err").html(" *Please enter a Price");
			}

			if (valid) {
				var form_data = new FormData(); // Create a new FormData object
				form_data.append("id", id);
				if (typeof img !== "undefined") {
					form_data.append("eproductImg", img);
				}
				form_data.append("product", product);
				form_data.append("quantity", quantity);
				form_data.append("price", price);
				form_data.append("details", details);
				
				// Send the image data and other form data to PHP using AJAX
				$.ajax({
					url: "db/sparepartUpdate.php",
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
        
    function addProduct(){
		$("#addProductModal").modal("show");
	}


	function editProduct(id, product, quantity, price, details){
		var id = id;
		var product = product;
		var quantity = quantity;
		var price = price;

		$("#eproduct_id").val(id);
		$("#eproductName").val(product);
		$("#eproducyQuantity").val(quantity);
		$("#eproductPrice").val(price);

		details = details.replace(/\n/g, '<br>');
        $('#eproductDetails').val(details.replace(/<br>/g, '\n'));


		$("#editProdModal").modal("show");
	}

    
	function archiveProd(id, img, product, quantity, price, details){
		if (confirm("Are you sure you want to Archive this record?")) {
			var form_data = {
				id : id,
				img : img,
				product : product,
				quantity : quantity,
				price : price,
				details : details
			}

			$.ajax({
	        	url : "db/sparepartDelete.php",
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