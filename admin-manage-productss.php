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
                                <h4 class="mb-sm-0">Product</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Data</a></li>
                                        <li class="breadcrumb-item active">Product</li>
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
								<div class="productNames">
									<br>
									<h4>Types Of Engine Available
										<span class="buttonSpan"><button type="button" onclick="addEngineData()" class="btn btn-primary">Add</button></span>
									</h4>
								</div>
								<br>
								<div class="search">
								<!-- Search: <input type="text" id="searchBar" placeholder="Search engine type" onkeyup="searchTable()"> -->
								</div>
								<table class="table table-hover text-center" id="table11">
									<thead style="color: #1873d3">
										<tr>
											<th scope="col">EngineID</th>
											<th scope="col">Engine</th>
											<th scope="col">Quantity</th>
											<th scope="col">Price</th>
											<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										include 'db/connection.php';

										$stmt = mysqli_query($conn, "SELECT * FROM engines ORDER BY quantity ASC");

										while($data = mysqli_fetch_assoc($stmt)){
										?>
										<tr>
											<td><?php echo $data['engine_id']; ?></td>
											<td><?php echo $data['engine_type']; ?></td>
											<td><?php echo $data['quantity']; ?></td>
											<td>&#8369;<?php echo number_format($data['price'], 2); ?></td>
											<td class="text-end text-center">
												<button class="btn btn-warning" onclick="editEngine('<?php echo $data['engine_type']; ?>',
														'<?php echo $data['quantity']; ?>', '<?php echo $data['price']; ?>','<?php echo $data['engine_id']; ?>')">
													<i class="fas fa-pen"></i>
												</button>
												<button class="btn btn-danger" onclick="deleteEngine('<?php echo $data['engine_id']; ?>')">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>


							<div class="card">
								<div class="productNames">
								<br>
								<h4>Minivan Model Available 
								<span class="buttonSpan"><button type="button" onclick="addModel()" class="btn btn-primary">Add</button></span></h4>
								</div>
								<br>
								<table class="table table-hover text-center" class="table1">
									<thead style="color: #1873d3">
										<tr>
										<th scope="col">Model ID</th>
										<th scope="col">Model</th>
										<th scope="col">Quantity</th>
										<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
										
										<?php
											include 'db/connection.php';

											$stmt = mysqli_query($conn, "SELECT * FROM minivanmodel ORDER BY quantity ASC");

											while($data = mysqli_fetch_assoc($stmt)){
										?>
										<tr>
											<td><?php echo $data['model_id']; ?></td>
											<td><?php echo $data['model']; ?></td>
											<td><?php echo $data['quantity']; ?></td>
											<td class="text-end text-center">
												<button class="btn btn-warning" onclick="editModel('<?php echo $data['model']; ?>',
												'<?php echo $data['quantity']; ?>','<?php echo $data['model_id']; ?>')"><i class="fas fa-pen"></i></button>
												<button class="btn btn-danger" onclick="deleteModel('<?php echo $data['model_id']; ?>')"><i class="fas fa-trash"></i></button>
											</td>
										</tr>
											<?php
												}
											?>
									</tbody>
								</table>
                            </div>


                            <div class="card">
								<br>
								<div class="productNames">
								<h4>Paint Color Available
								<span class="buttonSpan"><button type="button" onclick="addPaintData()" class="btn btn-primary">Add</button></span></h4>
								</div>
								<br>
								<table class="table table-hover text-center" class="table1">
									<thead style="color: #1873d3">
									<tr>
										<th scope="col">Paint ID</th>
										<th scope="col">Paint Color</th>
										<th scope="col">Quantity</th>
										<th scope="col">Action</th>
									</tr>
									</thead>
									<tbody>
										
										<?php
											include 'db/connection.php';

											$stmt = mysqli_query($conn, "SELECT * FROM paints ORDER BY quantity ASC");

											while($data = mysqli_fetch_assoc($stmt)){
										?>
										<tr>
											<td><?php echo $data['paint_id']; ?></td>
											<td><?php echo $data['paint_color']; ?></td>
											<td><?php echo $data['quantity']; ?></td>
											<td class="text-end text-center">
												<button class="btn btn-warning" onclick="editPaint('<?php echo $data['paint_color']; ?>',
												'<?php echo $data['quantity']; ?>','<?php echo $data['paint_id']; ?>')"><i class="fas fa-pen"></i></button>
												<button class="btn btn-danger" onclick="deletePaint('<?php echo $data['paint_id']; ?>')"><i class="fas fa-trash"></i></button>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
                            </div>



                            <div class="card">
								<br>
								<div class="productNames">
								<h4>Spare Parts Available<span class="buttonSpan"><button onclick="addSparepartData()" type="button" class="btn btn-primary">Add</button></span></h4>
								</div>
								<br>
								<table class="table table-hover text-center" class="table1">
									<thead style="color: #1873d3">
										<tr>
										<th scope="col">SparePartID</th>
										<th scope="col">Spare Part</th>
										<th scope="col">Quantity</th>
										<th scope="col">Details</th>
										<th scope="col">Price</th>
										<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
										
										<?php
											include 'db/connection.php';

											$stmt = mysqli_query($conn, "SELECT * FROM spareparts ORDER BY quantity ASC");

											while($data = mysqli_fetch_assoc($stmt)){
										?>
										<tr>
											<td><?php echo $data['sparepart_id']; ?></td>
											<td><?php echo $data['sparepart']; ?></td>
											<td><?php echo $data['quantity']; ?></td>
											<td><?php echo strlen($data['details']) > 5 ? substr($data['details'], 0, 5) . '...' : $data['details'];  ?></td>
											<td>&#8369;<?php echo number_format($data['price'], 2); ?></td>
											<td class="text-end text-center">
												<button class="btn btn-warning" onclick="editSparepartsBtn('<?php echo $data['sparepart']; ?>',
												'<?php echo $data['quantity']; ?>','<?php echo $data['details']; ?>', '<?php echo $data['price']; ?>','<?php echo $data['sparepart_id']; ?>')"><i class="fas fa-pen"></i></button>
												<button class="btn btn-danger" onclick="deleteSparepart('<?php echo $data['sparepart_id']; ?>')"><i class="fas fa-trash"></i></button>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->





<!-- ADD ENGINE MONAL -->
<div class="modal fade" id="AddEngineModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Add Engine</h4>
			</div>
			<div class="modal-body">
                <!-- <form action="db/insertData/php" method="post"> -->
                    <label class="form-label">Engine Type</label><span class="e_name_err text-danger"></span>
                    <input class="form-control" id="addeType" type="text" placeholder="Enter Engine Type" required>
                    <br>
                    <label class="form-label">Quantity</label><span class="e_quantity_err text-danger"></span>
                    <input class="form-control" id="addeQuantity" type="number" placeholder="Enter Quantity" required>
                    <br>
                    <label class="form-label">Price</label><span class="e_price_err text-danger"></span>
                    <input class="form-control" id="addePrice" type="number" placeholder="Enter Price" required>
                    <br>
                    <button type="submit" class="btn btn-success" id="addProduct">Save</button>
                <!-- </form> -->
                <br>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-warning">Cancel</button>
                </div>
			</div>	
		</div>
	</div>
</div>
<!-- END OF ADD ENGINE MODAL -->

<!-- ENGINE MODAL -->
<div class="modal fade" id="engineModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Edit Product</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="" id="eId">
				<label class="form-label">Product Name</label><span class="pr_name_err text-danger"></span>
				<input class="form-control" id="eType" type="text" placeholder="Enter Product Name">
				<br>
				<label class="form-label">Quantity</label><span class="quantity_err text-danger"></span>
				<input class="form-control" id="eQuantity" type="number" placeholder="Enter Quantity">
				<br>
				<label class="form-label">Price</label><span class="price_err text-danger"></span>
				<input class="form-control" id="ePrice" type="number" placeholder="Enter Price">
                <br>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" id="editProduct">Save</button>
				<button data-bs-dismiss="modal" class="btn btn-warning">Cancel</button>
			</div>	
		</div>
	</div>
</div>
<!-- END OF ENGINE MODAL -->




<!-- ADD MODEL MODAL -->
<div class="modal fade" id="AddModelModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Add Model</h4>
			</div>
			<div class="modal-body">
                <!-- <form action="db/insertData/php" method="post"> -->
                    <label class="form-label">Minivan Model</label><span class="m_name_err text-danger"></span>
                    <input class="form-control" id="addmModel" type="text" placeholder="Enter Minivan Model" required>
                    <br>
                    <label class="form-label">Quantity</label><span class="m_quantity_err text-danger"></span>
                    <input class="form-control" id="addmQuantity" type="number" placeholder="Enter Quantity" required>
                    <br>
                    <button type="submit" class="btn btn-success" id="saveModel">Save</button>
                <!-- </form> -->
                <br>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-warning">Cancel</button>
                </div>
			</div>	
		</div>
	</div>
</div>
<!-- END OF ADD MODEL MODAL -->

<!-- MODEL MODAL -->
<div class="modal fade" id="modelModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Edit Minivan Model</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="" id="mId">
				<label class="form-label">Minivan Model</label><span class="mm_name_err text-danger"></span>
				<input class="form-control" id="mType" type="text" placeholder="Enter Minivan Model">
				<br>
				<label class="form-label">Quantity</label><span class="mm_quantity_err text-danger"></span>
				<input class="form-control" id="mQuantity" type="number" placeholder="Enter Quantity">
				<br>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" id="editModell">Save</button>
				<button data-bs-dismiss="modal" class="btn btn-warning">Cancel</button>
			</div>	
		</div>
	</div>
</div>
<!-- END OF MODEL MODAL -->




<!-- ADD PAINT MODAL -->
<div class="modal fade" id="AddPaintModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Add Paint Color</h4>
			</div>
			<div class="modal-body">
                <!-- <form action="db/insertData/php" method="post"> -->
                    <label class="form-label">Paint Color</label><span class="p_name_err text-danger"></span>
                    <input class="form-control" id="addpColor" type="text" placeholder="Enter Paint Color" required>
                    <br>
                    <label class="form-label">Quantity</label><span class="p_quantity_err text-danger"></span>
                    <input class="form-control" id="addpQuantity" type="number" placeholder="Enter Quantity" required>
                    <br>
                    <button type="submit" class="btn btn-success" id="addPaint">Save</button>
                <!-- </form> -->
                <br>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-warning">Cancel</button>
                </div>
			</div>	
		</div>
	</div>
</div>
<!-- END OF ADD PAINT MODAL -->

<!-- PAINT MODAL -->
<div class="modal fade" id="paintModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Edit Paint Color</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="" id="pId">
				<label class="form-label">Paint Color</label><span class="paint_name_err text-danger"></span>
				<input class="form-control" id="pColor" type="text" placeholder="Enter Paint Color Name">
				<br>
				<label class="form-label">Quantity</label><span class="paint_quantity_err text-danger"></span>
				<input class="form-control" id="pQuantity" type="number" placeholder="Enter Quantity">
				<br>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" id="editPaintBtn">Save</button>
				<button data-bs-dismiss="modal" class="btn btn-warning">Cancel</button>
			</div>	
		</div>
	</div>
</div>
<!-- END OF PAINT MODAL -->



<!-- ADD SPARE PARTS MODAL -->
<div class="modal fade" id="AddSparepartModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Add Engine</h4>
			</div>
			<div class="modal-body">
                <!-- <form action="db/insertData/php" method="post"> -->
                    <label class="form-label">Spare Part</label><span class="s_name_err text-danger"></span>
                    <input class="form-control" id="addsSparepart" type="text" placeholder="Enter Spare Part" required>
                    <br>
                    <label class="form-label">Quantity</label><span class="s_quantity_err text-danger"></span>
                    <input class="form-control" id="addsQuantity" type="number" placeholder="Enter Quantity" required>
                    <br>
                    <label class="form-label">Details</label><span class="s_quantity_err text-danger"></span>
                    <textarea class="form-control" id="addDetails" type="text" placeholder="Enter Details if have" rows="4" cols="50"></textarea>
                    <br>
                    <label class="form-label">Price</label><span class="s_price_err text-danger"></span>
                    <input class="form-control" id="addsPrice" type="number" placeholder="Enter Price" required>
                    <br>
                    <button type="submit" class="btn btn-success" id="addSparepart">Save</button>
                <!-- </form> -->
                <br>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-warning">Cancel</button>
                </div>
			</div>	
		</div>
	</div>
</div>
<!-- END OF ADD SPARE PARTS MODAL -->

<!-- SPARE PARTS MODAL -->
<div class="modal fade" id="sparepartModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Edit Product</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="" id="sId">
				<label class="form-label">Product Name</label><span class="sparepart_name_err text-danger"></span>
				<input class="form-control" id="sSparepart" type="text" placeholder="Enter Spare Part Name">
				<br>
				<label class="form-label">Quantity</label><span class="sparepart_quantity_err text-danger"></span>
				<input class="form-control" id="sQuantity" type="number" placeholder="Enter Quantity">
				<br>
				<label class="form-label">Details</label><span class="sparepart_quantity_err text-danger"></span>
				<textarea class="form-control" id="sDetails" type="text" row="4" column="50" placeholder="Enter Detail if have"></textarea>
				<br>
				<label class="form-label">Price</label><span class="sparepart_price_err text-danger"></span>
				<input class="form-control" id="sPrice" type="number" placeholder="Enter Price">
                <br>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" id="editSparepart">Save</button>
				<button data-bs-dismiss="modal" class="btn btn-warning">Cancel</button>
			</div>	
		</div>
	</div>
</div>
<!-- END OF SPARE PARTS MODAL -->










<!-- FOOTER -->

<?php include 'admin-footer.php' ?>

<!-- END OF FOOTER -->


    <!-- JAVASCRIPT -->
    <script src="js/jquery-3.6.3.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    
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

		
	// $(document).ready(function(){
	// 	$("#table11").DataTable({
	// 		 lengthMenu: [
    //         [10, 15, 25, -1],
    //         [10, 15, 25, 'All'],
    //     ],
    //     ordering : false
	// 	});
		
	// 	$(".dataTables_length").css("position", "absolute");
	// 	$(".dataTables_length").css("left", "230px");

	// 	$("#table11").parent().css("property", "");

	// 	// Reset the background color of the table header
	// 	$("#table11").css("background-color", "");

	// 	// Remove the added CSS class from table cells in the body
	// 	$("#table11").removeClass("table-cell-style");

	// 	// Reset the text alignment of cells with a specific class
	// 	$("#table11").css("text-align", "");

	// 	// Reset the font size of the table
	// 	$("#table11").css("font-size", "");

	// });


	// function searchTable() {
	// // Declare variables
	// var input, filter, table, tr, td, i, j, txtValue;
	// input = document.getElementById("searchBar");
	// filter = input.value.toUpperCase();
	// table = document.getElementById("table11");
	// tr = table.getElementsByTagName("tr");

	// // Loop through all table rows, and hide those that don't match the search query
	// for (i = 0; i < tr.length; i++) {
	// 	var match = false; // Flag to indicate if the row matches the search query
	// 	td = tr[i].getElementsByTagName("td");

	// 	// Skip the loop if it's a table header row
	// 	if (td.length === 0) {
	// 	continue;
	// 	}

	// 	// Loop through all columns of the current row
	// 	for (j = 0; j < td.length; j++) {
	// 	if (td[j]) {
	// 		txtValue = td[j].textContent || td[j].innerText;
	// 		if (txtValue.toUpperCase().indexOf(filter) > -1) {
	// 		match = true; // Row matches the search query
	// 		break; // No need to check other columns of the same row
	// 		}
	// 	}
	// 	}

	// 	// Show/hide the row based on the match flag
	// 	if (match) {
	// 	tr[i].style.display = "";
	// 	} else {
	// 	tr[i].style.display = "none";
	// 	}
	// }
	// }





        
$(document).ready(function(){
            $("#productSidebar").attr({
            "class" : "list-group-item list-group-item-action bg-transparent primary-text"
            });
        });
		
        $(document).ready(function(){
            $("#mngBtn").attr({
            "class" : "list-group-item list-group-item-action bg-transparent primary-text fw-bold"
            });
        });


		
// FOR ENGINE AVALABLE
        $(document).ready(function(){
		$("#addModal").click(function() {
			$("#modals").modal("show");
		});

		$("#addProduct").click(function() {
			var valid = true;
			var engine_type = $("#addeType").val();
			var quantity = $("#addeQuantity").val();
			var price = $("#addePrice").val();
            

			if(engine_type == ""){
				valid = false;
				$(".e_name_err").html(" *Please enter an Engine Type");
			}

			if(quantity == ""){
				valid = false;
				$(".e_quantity_err").html(" *Please enter a quantity");
			}

			if(price == ""){
				valid = false;
				$(".e_price_err").html(" *Please enter a price");
			}
			

			if(valid){
				var form_data = {
                    engine_type : engine_type,
                    quantity : quantity,
                    price : price
      	        }; 
                

				$.ajax({
	        	url : "db/engineAdd.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid'] == false){
	              alert(response['msg']);
	            }else{
	           		alert("Engine Added!");
					location.reload();
	            }        
	          }
	        });
 
			}else {
					// window.location.href="admin-manage-product.php";
				}
            
		});

		$("#editProduct").click(function(){
			var valid = true;
			var engine_type = $("#eType").val();
			var quantity = $("#eQuantity").val();
			var price = $("#ePrice").val();
			var engine_id = $("#eId").val();
			
			if(engine_type == ""){
				valid = false;
				$(".pr_name_err").html(" *Please enter a Engine Type");
			}

			if(quantity == ""){
				valid = false;
				$(".quantity_err").html(" *Please enter a quantity");
			}

			if(price == ""){
				valid = false;
				$(".price_err").html(" *Please enter a price");
			}


			if(valid){
				if(confirm('Are you sure you want to Update?')){
					var form_data = {
						engine_id : engine_id,
                        engine_type : engine_type,
                        quantity : quantity,
                        price : price
					}

					$.ajax({
	        	url : "db/engineUpdate.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid'] == false){
	              alert(response['msg']);
	            }else{
	           		alert("Information updated!");
					location.reload();
	            }        
	          }
	        });

				}else {
					// window.location.href="admin-manage-product.php";
				}
			}
		});
	});

        
    function addEngineData(){
		$("#AddEngineModal").modal("show");
	}


	function editEngine(engine_type, quantity, price, engine_id){
		var engine_type = engine_type;
		var engine_id = engine_id;
		var quantity = quantity;
		var price = price;

		$("#eType").val(engine_type);
		$("#eQuantity").val(quantity);
		$("#ePrice").val(price);
		$("#eId").val(engine_id);

		$("#engineModal").modal("show");
	}

    
	function deleteEngine(engine_id){
		if (confirm("Are you sure you want to delete this record?")) {
			var form_data = {
				engine_id : engine_id
			}

			$.ajax({
	        	url : "db/engineDelete.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid']==false){
	              alert(response['msg']);
	            }else{
	           		alert("Engine deleted!");
					location.reload();
	            }        
	          }
	        });
		}else {
			
		}
	}
    


// FOR MODEL AVALABLE
$(document).ready(function(){
		$("#addModal").click(function() {
			$("#modals").modal("show");
		});

		$("#saveModel").click(function() {
			var valid = true;
			var model = $("#addmModel").val();
			var quantity = $("#addmQuantity").val();
            

			if(model == ""){
				valid = false;
				$(".m_name_err").html(" *Please enter a Minivan Model");
			}

			if(quantity == ""){
				valid = false;
				$(".m_quantity_err").html(" *Please enter a quantity");
			}

			

			if(valid){
				var form_data = {
                    model : model,
                    quantity : quantity
      	        };
                

				$.ajax({
	        	url : "db/modelAdd.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid'] == false){
	              alert(response['msg']);
	            }else{
	           		alert("Model Added!");
					location.reload();
	            }        
	          }
	        });
 
			}else {
					// window.location.href="admin-manage-product.php";
				}
            
		});

		$("#editModell").click(function(){
			var valid = true;
			var model = $("#mType").val();
			var quantity = $("#mQuantity").val();
			var model_id = $("#mId").val();
			
			if(model == ""){
				valid = false;
				$(".mm_name_err").html(" *Please enter a Minivan Model");
			}

			if(quantity == ""){
				valid = false;
				$(".mm_quantity_err").html(" *Please enter a quantity");
			}


			if(valid){
				if(confirm('Are you sure you want to Update?')){
					var form_data = {
						model_id : model_id,
                        model : model,
                        quantity : quantity
					}

					$.ajax({
	        	url : "db/modelUpdate.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid'] == false){
	              alert(response['msg']);
	            }else{
	           		alert("Information updated!");
					location.reload();
	            }        
	          }
	        });

				}else {
					// window.location.href="admin-manage-product.php";
				}
			}
		});
	});

        
    function addModel(){
		$("#AddModelModal").modal("show");
	}


	function editModel(model, quantity, model_id){
		var model = model;
		var model_id = model_id;
		var quantity = quantity;
		var price = price;

		$("#mType").val(model);
		$("#mQuantity").val(quantity);
		$("#mId").val(model_id);

		$("#modelModal").modal("show");
	}

    
	function deleteModel(model_id){
		if (confirm("Are you sure you want to delete this record?")) {
			var form_data = {
				model_id : model_id
			}

			$.ajax({
	        	url : "db/modelDelete.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid']==false){
	              alert(response['msg']);
	            }else{
	           		alert("Model deleted!");
					location.reload();
	            }        
	          }
	        });
		}else {
			
		}
	}
    




// FOR PAINT COLOR 
    $(document).ready(function(){
		$("#addModal").click(function() {
			$("#modals").modal("show");
		});

		$("#addPaint").click(function() {
			var valid = true;
			var paint_color = $("#addpColor").val();
			var quantity = $("#addpQuantity").val();
            

			if(paint_color == ""){
				valid = false;
				$(".p_name_err").html(" *Please enter an Paint Color");
			}

			if(quantity == ""){
				valid = false;
				$(".p_quantity_err").html(" *Please enter a Quantity");
			}
			

			if(valid){
				var form_data = {
                    paint_color : paint_color,
                    quantity : quantity
      	        }; 
                

				$.ajax({
	        	url : "db/paintAdd.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid']==false){
	              alert(response['msg']);
	            }else{
	           		alert("Information Updated");
					location.reload();
	            }        
	          }
	        });
 
			}else {
					// window.location.href="admin-manage-product.php";
				}
            
		});

		$("#editPaintBtn").click(function(){
			var valid = true;
			var paint_color = $("#pColor").val();
			var quantity = $("#pQuantity").val();
			var paint_id = $("#pId").val();
			
			if(paint_color == ""){
				valid = false;
				$(".paint_name_err").html(" *Please enter a Paint Color Type");
			}

			if(quantity == ""){
				valid = false;
				$(".paint_quantity_err").html(" *Please enter a quantity");
			}


			if(valid){
				if(confirm('Are you sure you want to Update?')){
					var form_data = {
						paint_id : paint_id,
                        paint_color : paint_color,
                        quantity : quantity
					}

					$.ajax({
	        	url : "db/paintUpdate.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid'] == false){
	              alert(response['msg']);
	            }else{
	           		alert("Paint Color updated!");
					location.reload();
	            }        
	          }
	        });

				}else {
					// window.location.href="admin-manage-product.php";
				}
			}
		});
	});

        
    function addPaintData(){
		$("#AddPaintModal").modal("show");
	}


	function editPaint(paint_color, quantity, paint_id){
		var paint_color = paint_color;
		var quantity = quantity;
		var paint_id = paint_id;

		$("#pColor").val(paint_color);
		$("#pQuantity").val(quantity);
		$("#pId").val(paint_id);

		$("#paintModal").modal("show");
	}

    
	function deletePaint(paint_id){
		if (confirm("Are you sure you want to delete the Paint?")) {
			var form_data = {
				paint_id : paint_id
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
	           		alert("Paint deleted!");
					location.reload();
	            }        
	          }
	        });
		}else {
			
		}
	}



// FOR SPARE PARTS 
	$(document).ready(function(){
		$("#addModal").click(function() {
			$("#modals").modal("show");
		});

		$("#addSparepart").click(function() {
			var valid = true;
			var sparepart = $("#addsSparepart").val();
			var quantity = $("#addsQuantity").val();
			var details = $("#addDetails").val();
			var price = $("#addsPrice").val();
            

			if(sparepart == ""){
				valid = false;
				$(".s_name_err").html(" *Please enter an Spare Part");
			}

			if(quantity == ""){
				valid = false;
				$(".s_quantity_err").html(" *Please enter a quantity");
			}

			if(price == ""){
				valid = false;
				$(".s_price_err").html(" *Please enter a price");
			}
			

			if(valid){
				var form_data = {
                    sparepart : sparepart,
                    quantity : quantity,
                    details : details,
                    price : price
      	        }; 
                

				$.ajax({
	        	url : "db/sparepartAdd.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid']==false){
	              alert(response['msg']);
	            }else{
	           		alert("Spare Part Added!");
					location.reload();
	            }        
	          }
	        });
 
			}else {
					// window.location.href="admin-manage-product.php";
				}
            
		});

		$("#editSparepart").click(function(){
			var valid = true;
			var sparepart = $("#sSparepart").val();
			var quantity = $("#sQuantity").val();
			var details = $("#sDetails").val();
			var price = $("#sPrice").val();
			var sparepart_id = $("#sId").val();
			
			if(sparepart == ""){
				valid = false;
				$(".sparepart_name_err").html(" *Please enter a Spare Part Name");
			}

			if(quantity == ""){
				valid = false;
				$(".sparepart_quantity_err").html(" *Please enter a quantity");
			}

			if(price == ""){
				valid = false;
				$(".sparepart_price_err").html(" *Please enter a price");
			}


			if(valid){
				if(confirm('Are you sure you want to Update?')){
					var form_data = {
						sparepart_id : sparepart_id,
                        sparepart : sparepart,
                        quantity : quantity,
                        details : details,
                        price : price
					}

					$.ajax({
	        	url : "db/sparepartUpdate.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid']==false){
	              alert(response['msg']);
	            }else{
	           		alert("Information updated!");
					location.reload();
	            }        
	          }
	        });

				}else {
				}
			}
		});
	});

        
    function addSparepartData(){
		$("#AddSparepartModal").modal("show");
	}


	function editSparepartsBtn(sparepart, quantity, details, price, sparepart_id){
		var sparepart = sparepart;
		var sparepart_id = sparepart_id;
		var quantity = quantity;
		var details = details;
		var price = price;

		$("#sSparepart").val(sparepart);
		$("#sQuantity").val(quantity);
		$("#sDetails").val(details);
		$("#sPrice").val(price);
		$("#sId").val(sparepart_id);

		$("#sparepartModal").modal("show");
	}

    
	function deleteSparepart(sparepart_id){
		if (confirm("Are you sure you want to delete this Spare part?")) {
			var form_data = {
				sparepart_id : sparepart_id
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
	           		alert("Spare part deleted!");
					location.reload();
	            }        
	          }
	        });
		}else {
			
		}
	}	


    </script>
</body>

</html>