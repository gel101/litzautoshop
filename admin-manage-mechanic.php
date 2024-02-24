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
                                <h4 class="mb-sm-0">Mechanic</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Admin</a></li>
                                        <li class="breadcrumb-item">User</li>
                                        <li class="breadcrumb-item">Mechanic</li>
                                        <li class="breadcrumb-item active">Manage</li>
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
											<button onclick="addDate()" type="button" class="btn btn-primary">Add Account</button>
										</div>
									</div>
									<br>
									<table class="table table-hover text-center">
										<thead style="color: #1873d3">
												<tr>
													<th scope="col">Mechanic ID</th>
													<th scope="col">First Name</th>
													<th scope="col">Last Name</th>
													<th scope="col">Birthdate</th>
													<th scope="col">Phone #</th>
													<th scope="col">Email</th>
													<th scope="col">Username</th>
													<th scope="col">Action</th>
												</tr>
										</thead>
										<tbody>
												<?php
												include 'db/connection.php';

												$stmt = mysqli_query($conn, "SELECT * FROM mechanic WHERE (status IS NULL OR status != 'archived') ORDER BY mechanic_id ASC");

												while($data = mysqli_fetch_assoc($stmt)){
												?>
												<tr>
													<td><?php echo $data['mechanic_id']; ?></td>
													<td><?php echo $data['fname']; ?></td>
													<td><?php echo $data['lname']; ?></td>
													<td><?php echo date('m/d/Y', strtotime($data['birthdate'])); ?></td>
													<td><?php echo $data['pNum']; ?></td>
													<td><?php echo $data['email']; ?></td>
													<td><?php echo $data['user']; ?></td>
													<td class="text-end text-center">
														<button class="btn btn-warning" onclick="editmechanic('<?php echo $data['fname']; ?>', '<?php echo $data['lname']; ?>','<?php echo $data['birthdate']; ?>','<?php echo $data['pNum']; ?>','<?php echo $data['email']; ?>','<?php echo $data['user']; ?>','<?php echo $data['pass']; ?>','<?php echo $data['mechanic_id']; ?>')"><i class="fas fa-pen"></i></button>
														<button class="btn btn-danger" onclick="deletemechanic('<?php echo $data['mechanic_id']; ?>','<?php echo $data['fname']; ?>','<?php echo $data['lname']; ?>','<?php echo $data['birthdate']; ?>','<?php echo $data['pNum']; ?>','<?php echo $data['email']; ?>','<?php echo $data['user']; ?>','<?php echo $data['pass']; ?>')"><i class="fas fa-folder-minus"></i></button>
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




<!-- Add Data -->
<div class="modal fade" id="addDateModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Add Mechanic</h4>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<label class="form-label">First Name</label><span class="fname_err text-danger"></span>
				<input class="form-control" id="fname" type="text" placeholder="Enter First Name">
				<br>
				<label class="form-label">Last Name</label><span class="lname_err text-danger"></span>
				<input class="form-control" id="lname" type="text"  placeholder="Enter Last Name">
				<br>
				<label class="form-label">Birthdate</label><span class="birthdate_err text-danger"></span>
				<input class="form-control" id="birthdate" type="date"  placeholder="Enter Birthdate">
				<br>
				<label class="form-label">Phone Number</label><span class="pNum_err text-danger"></span><span id="infoText" class="text-danger"></span>
				<input class="form-control" id="pNum" type="number"  placeholder="Enter Phone Number" oninput="validateNumber(this)">
				<br>
				<label class="form-label">Email</label><span class="email_err text-danger"></span>
				<input class="form-control" id="email" type="email"  placeholder="Enter Email">
				<br>
				<label class="form-label">Username</label><span class="user_err text-danger"></span>
				<input class="form-control" id="user" type="text" value="mechanic" placeholder="Enter Username">
				<br>
				<label class="form-label">Password</label><span class="pass_err text-danger"></span>
				<input class="form-control" id="pass" type="password" placeholder="Enter Password">
				<br>
                <br>
			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button type="submit" class="btn btn-primary" id="addDatess">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- EDIT DATE MODAL -->
<div class="modal fade" id="editDateModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Edit Data</h4>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="" id="mechanic_id">
					<label class="form-label">First Name</label><span class="fname_errr text-danger"></span>
                    <input class="form-control" id="efname" type="text" placeholder="Enter First Name">
					<br>
                    <label class="form-label">Last Name</label><span class="lname_errr text-danger"></span>
                    <input class="form-control" id="elname" type="text"  placeholder="Enter Last Name">
                    <br>
                    <label class="form-label">Birthdate</label><span class="birthdate_errr text-danger"></span>
                    <input class="form-control" id="ebirthdate" type="date"  placeholder="Enter birthdate">
                    <br>
                    <label class="form-label">Phone Number</label><span class="pNum_errr text-danger"></span> <span id="infoText1" class="text-danger"></span>
                    <input class="form-control" id="epNum" type="number"  placeholder="Enter Phone Number" oninput="validateNumber1(this)">
                    <br>
                    <label class="form-label">Email</label><span class="email_errr text-danger"></span>
                    <input class="form-control" id="eemail" type="email"  placeholder="Enter Email">
                    <br>
                    <label class="form-label">Username</label><span class="user_errr text-danger"></span>
                    <input class="form-control" id="euser" type="text" placeholder="Enter Username">
                    <br>
                    <label class="form-label">Password</label><span class="pass_errr text-danger"></span>
                    <input class="form-control" id="epass" type="password" placeholder="Enter Password">
                    <br>
			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-primary" id="addmechanicc">Save</button>
			</div>	
		</div>
	</div>
</div>
<!-- END OF EDIT DATE MODAL -->







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
		
		function validateNumber(input) {
			var infoText = document.getElementById('infoText');

			if (input.value.length > 11) {
			infoText.textContent = ' *Maximum length is 11 digits';
			} else {
			infoText.textContent = '';
			}
		}
		
		function validateNumber1(input) {
			var infoText = document.getElementById('infoText1');

			if (input.value.length > 11) {
			infoText.textContent = ' *Maximum length is 11 digits';
			} else {
			infoText.textContent = '';
			}
		}
        
	// FOR SPARE PARTS 
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


		$("#addModal").click(function() {
			$("#modals").modal("show");
		});

		$("#addDatess").click(function() {
			var valid = true;
			var fname = $("#fname").val();
			var lname = $("#lname").val();
			var birthdate = $("#birthdate").val();
			var pNum = $("#pNum").val();
			var email = $("#email").val();
			var user = $("#user").val();
			var pass = $("#pass").val();
            

			if(fname == ""){
				valid = false;
				$(".fname_err").html(" *Please enter First Name ");
			}

			if(lname == ""){
				valid = false;
				$(".lname_err").html(" *Please enter Last Name");
			}

			if(birthdate == ""){
				valid = false;
				$(".birthdate_err").html(" *Please enter birthdate");
			}

			if(pNum == ""){
				valid = false;
				$(".pNum_err").html(" *Please enter a Phone Number");
			}

			if (pNum.length !== 11) {
				valid = false;
				alert("Phone Number should be exactly 11 digits");
			}

			if(email == ""){
				valid = false;
				$(".email_err").html(" *Please enter an email");
			}

			if(user == ""){
				valid = false;
				$(".user_err").html(" *Please enter an username");
			}

			if(pass == ""){
				valid = false;
				$(".pass_err").html(" *Please enter a password");
			}

			if(valid){
				var form_data = {
                    fname : fname,
                    lname : lname,
                    birthdate : birthdate,
                    pNum : pNum,
                    email : email,
                    user : user,
                    pass : pass
      	        }; 
                

				$.ajax({
	        	url : "db/mechanicAdd.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid'] == false){
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
					// window.location.href="admin-manbirthdate-product.php";
				}
            
		});

		$("#addmechanicc").click(function(){
			var valid = true;
			var fname = $("#efname").val();
			var lname = $("#elname").val();
			var birthdate = $("#ebirthdate").val();
			var pNum = $("#epNum").val();
			var email = $("#eemail").val();
			var user = $("#euser").val();
			var pass = $("#epass").val();
			var mechanic_id = $("#mechanic_id").val();
			
			if(fname == ""){
				valid = false;
				$(".fname_errr").html(" *Please enter a First Name ");
			}

			if(lname == ""){
				valid = false;
				$(".lname_errr").html(" *Please enter a Last Name");
			}

			if(birthdate == ""){
				valid = false;
				$(".birthdate_errr").html(" *Please enter birthdate");
			}

			if(pNum == ""){
				valid = false;
				$(".pNum_errr").html(" *Please enter a phone Number");
			}
			
			if (pNum.length !== 11) {
				valid = false;
				alert("Phone Number should be exactly 11 digits");
			}

			if(email == ""){
				valid = false;
				$(".email_errr").html(" *Please enter an email");
			}

			if(user == ""){
				valid = false;
				$(".user_errr").html(" *Please enter an username");
			}

			if(pass == ""){
				valid = false;
				$(".pass_errr").html(" *Please enter a password");
			}


			if(valid){
				if(confirm('Are you sure you want to Update?')){
					var form_data = {
						fname : fname,
						lname : lname,
						birthdate : birthdate,
						pNum : pNum,
						email : email,
						user : user,
						pass : pass,
						mechanic_id : mechanic_id
					};

					$.ajax({
	        	url : "db/mechanicUpdate.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
	          success: function(response){
	            if(response['valid'] == false){
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
		});
	});

        
    function addDate(){
		$("#addDateModal").modal("show");
	}


	function editmechanic(fname, lname, birthdate, pNum, email, user, pass, mechanic_id){
		var fname = fname;
		var lname = lname;
		var birthdate = birthdate;
		var pNum = pNum;
		var email = email;
		var user = user;
		var pass = pass;
		var mechanic_id = mechanic_id;

		$("#efname").val(fname);
		$("#elname").val(lname);
		$("#ebirthdate").val(birthdate);
		$("#epNum").val(pNum);
		$("#eemail").val(email);
		$("#euser").val(user);
		$("#epass").val(pass);
		$("#mechanic_id").val(mechanic_id);

		$("#editDateModal").modal("show");
	}

    
	function deletemechanic(mechanic_id, fname, lname, birthdate, pNum, email, user, pass){
		if (confirm("Are you sure to archive this Account?")) {
			var form_data = {
				mechanic_id : mechanic_id,
				fname : fname,
				lname : lname,
				birthdate : birthdate,
				pNum : pNum,
				email : email,
				user : user,
				pass : pass
			}

			$.ajax({
	        	url : "db/mechanicDelete.php",
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