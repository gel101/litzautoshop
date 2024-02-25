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
		/* *{
			border: 1px solid red;
		} */
		.validIDImg{
			overflow: hidden;
			height: 90%;
		}
		.validIDBtn{
			height: 90%;
		}
		.textDetails{
			overflow: auto;
		}
		#showvalidID{
			width: 100%;
			overflow: hidden;
		}
		

        .Verified{
            font-family: Georgia, serif;
            font-size: 13px;
            letter-spacing: 0px;
            word-spacing: -0.8px;
            color: blue;
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
                                <h4 class="mb-sm-0">Client</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Admin</a></li>
                                        <li class="breadcrumb-item">User</li>
                                        <li class="breadcrumb-item active">Client</li>
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
											<button type="button" onclick="addClient()" class="btn btn-primary float-end">Add Account</button>
										</div>
									</div>
									<br>
									<table class="table text-center" id="table11">
										<thead style="color: #1873d3">
											<tr>
												<th scope="col">ClientID</th>
												<th scope="col">ValidID</th>
												<th scope="col">Full Name</th>
												<th scope="col">Birthdate</th>
												<th scope="col">Address</th>
												<th scope="col">Phone#</th>
												<th scope="col">Email</th>
												<th scope="col">Username</th>
												<th scope="col">Status</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											include 'db/connection.php';

											$sql = mysqli_query($conn, "SELECT * FROM clientacc WHERE (status IS NULL OR status != 'Denied') ORDER BY cust_id DESC");
												// WHERE status != 'Verified' UNION SELECT * FROM clientacc WHERE status='Verified'
											while($data = mysqli_fetch_assoc($sql)){
											?>
											<tr>
												<td><?php echo $data['cust_id']; ?></td>
												<td><img src="db/<?php echo $data['validID']; ?>" alt="" style="width: 40px; height: 40px;"></td>
												<td><?php echo $data['fname']; ?> <?php echo $data['lname']; ?></td>
												<td><?php echo date('m/d/Y', strtotime($data['birthdate'])); ?></td>
												<td><?php echo strlen($data['address']) > 5 ? substr($data['address'], 0, 5) . '...' : $data['address'];  ?></td>
												<td><?php echo $data['phoneNum']; ?></td>
												<td><?php echo strlen($data['email']) > 5 ? substr($data['email'], 0, 5) . '...' : $data['email'];  ?></td>
												<td><?php echo $data['username']; ?></td>
                                                <td><h5><span class="badge <?php 
                                                
                                                switch ($data['status']) {
                                                    case "Pending":
                                                        echo "bg-warning";
                                                        break;
                                                    case "Verified":
                                                        echo "bg-success";
                                                        break;
                                                    default:
                                                        echo "bg-primary";
                                                }

                                                
                                                ?>"><?php echo $data['status']; ?></span></h5></td>
												<td class="text-end text-center">
                                                    <div class="d-flex align-items-center justify-content-center"> <!-- Wrap buttons in a flex container -->
														<button class="btn btn-info me-1" onclick="verify(
																'<?php echo $data['cust_id']; ?>',
																'<?php echo $data['validID']; ?>',
																'<?php echo $data['fname']; ?>',
																'<?php echo $data['lname']; ?>',
																'<?php echo $data['birthdate']; ?>',
																'<?php echo $data['address']; ?>',
																'<?php echo $data['phoneNum']; ?>',
																'<?php echo $data['email']; ?>',
																'<?php echo $data['username']; ?>',
																'<?php echo $data['pass']; ?>',
																'<?php echo $data['status']; ?>'
																)"><i class="fas fa-eye"></i></button>
														<button class="btn btn-warning" onclick="editCar(
																'<?php echo $data['cust_id']; ?>',
																'<?php echo $data['fname']; ?>',
																'<?php echo $data['lname']; ?>',
																'<?php echo $data['birthdate']; ?>',
																'<?php echo $data['address']; ?>',
																'<?php echo $data['phoneNum']; ?>',
																'<?php echo $data['email']; ?>',
																'<?php echo $data['username']; ?>',
																'<?php echo $data['pass']; ?>',
																'<?php echo $data['status']; ?>'
																)"><i class="fas fa-pen"></i></button>
													</div>
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
				<h4 id="title">Add Client</h4>
        		<button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<label class="form-label">ValidID</label><span class="a_img_err text-danger"></span>
				<input class="form-control" type="file" name="validID" id="validID"required>
				<br>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label col-md-6">First Name</label><span class="a_fname_err text-danger"></span>
						<input class="form-control" id="clientfname" name="clientfname" type="text" placeholder="Enter First Name" required>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">Last Name</label><span class="a_lname_err text-danger"></span>
						<input class="form-control" id="clientlname" name="clientlname" type="text" placeholder="Enter Last Name" required>
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Birthdate</label><span class="a_birthdate_err text-danger"></span>
						<input class="form-control" id="clientbirthdate" name="clientbirthdate" type="date" placeholder="Enter birthdate" required>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">Phone Number</label><span class="a_phoneNum_err text-danger"></span></span><span id="infoText" class="text-danger"></span>
						<input class="form-control" id="clientphoneNum" name="clientphoneNum" type="number" placeholder="Enter Phone Number" required oninput="validateNumber(this)">
						<br>
					</div>
				</div>
				<label class="form-label">Address</label><span class="a_address_err text-danger"></span>
				<input class="form-control" id="clientadd" name="clientadd" type="text" placeholder="Enter Address" required>
				<br>
				<label class="form-label">Email</label><span class="a_email_err text-danger"></span>
				<input class="form-control" id="clientemail" name="clientemail" type="email" placeholder="Enter Email" required>
				<br>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label col-md-6">Username</label><span class="a_uname_err text-danger"></span>
						<input class="form-control" id="clientuname" name="clientuname" type="text" placeholder="Enter Username" required>
						<br>
					</div>
					<div class="col-md-6">
						<label class="form-label">Password</label><span class="a_pass_err text-danger"></span>
						<input class="form-control" id="clientpass" name="clientpass" type="password" placeholder="Enter Password" required>
						<br>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button type="submit" class="btn btn-primary" id="saveClientBtn">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- END OF ADD ENGINE MODAL -->

<!-- ENGINE MODAL -->
<div class="modal fade" id="editClientModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Edit Client Information</h4>
        		<button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                    <input type="hidden" id="ecust_id" value="">
                    <label class="form-label">ValidID</label><span class="a_img_errr text-danger"></span>
                    <input class="form-control" type="file" name="evalidID" id="evalidID" required>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label col-md-6">First Name</label><span class="a_fname_errr text-danger"></span>
                            <input class="form-control" id="eclientfname" name="eclientfname" type="text" placeholder="Enter First Name" required disabled>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label><span class="a_lname_errr text-danger"></span>
                            <input class="form-control" id="eclientlname" name="eclientlname" type="text" placeholder="Enter Last Name" required disabled>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Birthdate</label><span class="a_birthdate_errr text-danger"></span>
                            <input class="form-control" id="eclientbirthdate" name="eclientbirthdate" type="date" placeholder="Enter birthdate" required disabled>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label><span class="a_phoneNum_errr text-danger"></span></span><span id="infoText1" class="text-danger"></span>
                            <input class="form-control" id="eclientphoneNum" name="eclientphoneNum" type="number" placeholder="Enter Phone Number" required oninput="validateNumber1(this)">
                            <br>
                        </div>
                    </div>
                    <label class="form-label">Address</label><span class="a_address_errr text-danger"></span>
                    <input class="form-control" id="eclientadd" name="eclientadd" type="text" placeholder="Enter Address" required disabled>
                    <br>
                    <label class="form-label">Email</label><span class="a_email_errr text-danger"></span>
                    <input class="form-control" id="eclientemail" name="eclientemail" type="email" placeholder="Enter Email" required disabled>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Username</label><span class="a_uname_errr text-danger"></span>
                            <input class="form-control" id="eclientuname" name="eclientuname" type="text" placeholder="Enter Username" required>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password</label><span class="a_pass_errr text-danger"></span>
                            <input class="form-control" id="eclientpass" name="eclientpass" type="password" placeholder="Enter Password" required>
                            <br>
                        </div>
                    </div>
				</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button class="btn btn-primary" id="editClientBtn">Save</button>
			</div>	
		</div>
	</div>
</div>
<!-- END OF ENGINE MODAL -->



<!-- VERIFY VALID ID MODAL -->
<div class="modal fade" id="verifyModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Verify Client Account</h4>
        		<button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="validIDImg col-md-7">
						<img src="" id="showvalidID" alt="valid ID">
					</div>
					<div class="validIDBtn col-md-5">
						<input type="hidden" id="verifyID">
						<label class="form-label" for="">Full Name</label>
						<input type="text" id="fullname" class="form-control" disabled>
						<br>
						<label class="form-label" for="">Birth Date</label>
						<input type="text" id="bdate" class="form-control" disabled>
						<br>
						<label class="form-label" for="">Address</label>
						<input type="text" id="addressss" class="form-control" disabled>
						<br>
						<label class="form-label" for="">Phone Number</label>
						<input type="text" id="phoneNumber" class="form-control" disabled>
						<br>
						<label class="form-label" for="">Email</label>
						<input type="text" id="showemail" class="form-control" disabled>
						<hr>
						<div class="row">
							<button class="btn btn-success" id="verifyBtn" onclick="verifyClient($('#verifyID').val())">VERIFY</button>
							<hr>
						</div>
						<div class="row">
							<button class="btn btn-danger" id="denyBtn" data-bs-dismiss="modal" data-bs-target="#reasonModal" data-bs-toggle="modal">DENY</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" class="btn btn-warning">CLOSE</button>
			</div>	
		</div>
	</div>
</div>
<!-- END OF VERIFY VALID ID MODAL -->


<!-- VERIFY VALID ID MODAL -->
<div class="modal fade zoomIn" id="reasonModal">
	<div class="modal-dialog modal-dialog-center">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="title">Reason for Denying an Account</h4>
        		<button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<label for="denyReason" class="form-label text-danger">*Required</label>
				<textarea class="form-control" name="" id="denyReason" cols="30" rows="10" style="resize:none;"></textarea>

			</div>
			<div class="modal-footer">
				<button data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#verifyModal" class="btn btn-warning">BACK</button>
				<button type="button" class="btn btn-primary" onclick="archiveClient($('#verifyID').val())">SUBMIT</button>
			</div>	
		</div>
	</div>
</div>
<!-- END OF VERIFY VALID ID MODAL -->








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

			if (input.value.length !== 11) {
			infoText.textContent = ' *Should be exactly 11 digits and starts with 09! Ex.(09104445556)';
			} else {
			infoText.textContent = '';
			}
		}
		
		function validateNumber1(input) {
			var infoText = document.getElementById('infoText1');

			if (input.value.length !== 11) {
			infoText.textContent = ' *Should be exactly 11 digits and starts with 09! Ex.(09104445556)';
			} else {
			infoText.textContent = '';
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

		$("#saveClientBtn").click(function() {
			var valid = true;
			var validID = $("#validID").prop("files")[0]; // Get the file object
			var fname = $("#clientfname").val();
			var lname = $("#clientlname").val();
			var birthdate = $("#clientbirthdate").val();
			var address = $("#clientadd").val();
			var phoneNum = $("#clientphoneNum").val();
			var email = $("#clientemail").val();
			var uname = $("#clientuname").val();
			var pass = $("#clientpass").val();
			
			if(fname == ""){
				valid = false;
				$(".a_fname_err").html(" *Please enter a First Name");
			}

			if(lname == ""){
				valid = false;
				$(".a_lname_err").html(" *Please enter a Last Name");
			}

			if(birthdate == ""){
				valid = false;
				$(".a_birthdate_err").html(" *Please enter Birthdate");
			}

			if(address == ""){
				valid = false;
				$(".a_address_err").html(" *Please enter the Address");
			}

			if(phoneNum == ""){
				valid = false;
				$(".a_phoneNum_err").html(" *Please Enter Phone Number");
			}
			
			if (phoneNum.length !== 11) {
				valid = false;
				$(".a_phoneNum_err").html(" *Should be exactly 11 digits and starts with 09! Ex.(09104445556)");
			}

			if(email == ""){
				valid = false;
				$(".a_email_err").html(" *Please enter an Email");
			}

			if(uname == ""){
				valid = false;
				$(".a_uname_err").html(" *Please enter an Username");
			}

			if(pass == ""){
				valid = false;
				$(".a_pass_err").html(" *Please enter Password");
			}
			

			if (valid) {
				var form_data = new FormData(); // Create a new FormData object
				form_data.append("validID", validID);
				form_data.append("fname", fname);
				form_data.append("lname", lname);
				form_data.append("birthdate", birthdate);
				form_data.append("address", address);
				form_data.append("phoneNum", phoneNum);
				form_data.append("email", email);
				form_data.append("uname", uname);
				form_data.append("pass", pass);

				// Send the image data and other form data to PHP using AJAX
				$.ajax({
					url: "db/clientAdd.php",
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



		$("#editClientBtn").click(function(){
			var valid = true;
			var cust_id = $("#ecust_id").val();
			var validID = $("#evalidID").prop("files")[0]; // Get the file object
			var fname = $("#eclientfname").val();
			var lname = $("#eclientlname").val();
			var birthdate = $("#eclientbirthdate").val();
			var address = $("#eclientadd").val();
			var phoneNum = $("#eclientphoneNum").val();
			var email = $("#eclientemail").val();
			var uname = $("#eclientuname").val();
			var pass = $("#eclientpass").val();


			if (cust_id == "") {
				valid = false;
				alert("No car ID");
			}

			if (fname == "") {
				valid = false;
				$(".a_fname_errr").html(" *Please enter a First Name");
			}

			if (lname == "") {
				valid = false;
				$(".a_lname_errr").html(" *Please enter a Last lname");
			}

			if (birthdate == "") {
				valid = false;
				$(".a_birthdate_errr").html(" *Please enter Birthdate");
			}

			if (address == "") {
				valid = false;
				$(".a_address_errr").html(" *Please enter an Address");
			}

			if (phoneNum == "") {
				valid = false;
				$(".a_phoneNum_errr").html(" *Please enter a Phone Number");
			}
			
			if (phoneNum.length !== 11) {
				valid = false;
				alert("Phone Number should be exactly 11 digits");
			}

			if(email == ""){
				valid = false;
				$(".a_email_errr").html(" *Please enter an Email");
			}

			if(uname == ""){
				valid = false;
				$(".a_uname_errr").html(" *Please enter an Username");
			}

			if(pass == ""){
				valid = false;
				$(".a_pass_errr").html(" *Please enter Password");
			}

			if (valid) {
				var form_data = new FormData(); // Create a new FormData object
				form_data.append("cust_id", cust_id);
				if (typeof validID !== "undefined") {
					form_data.append("evalidID", validID);
				}
				form_data.append("fname", fname);
				form_data.append("lname", lname);
				form_data.append("birthdate", birthdate);
				form_data.append("address", address);
				form_data.append("phoneNum", phoneNum);
				form_data.append("email", email);
				form_data.append("uname", uname);
				form_data.append("pass", pass);

				// Send the image data and other form data to PHP using AJAX
				$.ajax({
					url: "db/clientUpdate.php",
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
						if (responseData.valid == false) {
							alert(responseData.msg);
							location.reload();
						} else {
							$('#successModal').modal('show');

							// Close successModal after 2 seconds and trigger redirection
							setTimeout(function () {
								$('#successModal').modal('hide');
								location.reload();
							}, 1000);
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						alert("Error: " + errorThrown);
					},
					complete: function () {
						// This will be called regardless of success or failure
						$('#loadingModal').modal('hide');
					}
				});
			} else {
				// Handle invalid form
			}
		});

	});
        
    function addClient(){
		$("#addModal").modal("show");
	}


	function editCar(cust_id, fname, lname, birthdate, address, phoneNum, email, uname, pass){
		var cust_id = cust_id;
		var fname = fname;
		var lname = lname;
		var birthdate = birthdate;
		var address = address;
		var phoneNum = phoneNum;
		var email = email;
		var uname = uname;
		var pass = pass;

		$("#ecust_id").val(cust_id);
		$("#eclientfname").val(fname);
		$("#eclientlname").val(lname);
		$("#eclientbirthdate").val(birthdate);
		$("#eclientadd").val(address);
		$("#eclientphoneNum").val(phoneNum);
		$("#eclientemail").val(email);
		$("#eclientuname").val(uname);
		$("#eclientpass").val(pass);


		$("#editClientModal").modal("show");
	}

    
	function verify(cust_id, validID, fname, lname, birthdate, address, phoneNum, email, uname, pass, status){
		var textDetails = $("#textDetails");
		var validIDSrc = "db/" + validID;
		
		$("#verifyID").val(cust_id);
		$("#fullname").val(fname + " " + lname);
		$("#bdate").val(birthdate);
		$("#addressss").val(address);
		$("#phoneNumber").val(phoneNum);
		$("#showemail").val(email);

		$("#showvalidID").attr("src", validIDSrc);

		if (status == "Verified") {
			$('#verifyBtn').hide();
			$('#denyBtn').hide();
		}else{
			$('#verifyBtn').show();
			$('#denyBtn').show();
		}

		$("#verifyModal").modal("show");
	}


	function verifyClient(cust_id) {
		var status = "Verified";
		var valid = true;
		
		if(cust_id == ""){
				valid = false;
				alert("No Valid ID");
			}

			if (valid) {
				if (confirm("Do you want to verify the account?")) {
					var form_data = {
						cust_id : cust_id,
						status : status
					}

					$.ajax({
						url : "db/clientStatus.php",
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
								$('.dismissBtn').click();
								$('#successModal').modal('show');

								// Close successModal after 2 seconds and trigger redirection
								setTimeout(function () {
									$('#successModal').modal('hide');
								    location.reload();
								},1000); 
							}
						},
						error: function (jqXHR, textStatus, errorThrown) {
							$('#loadingModal').modal('hide'); // Hide the modal on error
							alert("Error: " + errorThrown);
						},
						complete: function () {
							$('#loadingModal').modal('hide');
						}
					});
				}else {
					
				}
			}
		
	}

	
	function archiveClient(cust_id){
		var status = "Denied";
		var reason = $('#denyReason').val();
		var valid = true;

		if(cust_id == ""){
			valid = false;
			alert("No Valid ID");
		}

		if(reason == ""){
			valid = false;
			alert("Please Specify the reason.");
		}

		if (valid) {
			if (confirm("Do you want to deny the account?")) {
				var form_data = {
					cust_id : cust_id,
					reason : reason,
					status : status
				}

				$.ajax({
					url : "db/clientStatus.php",
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
							$('.dismissBtn').click();
							$('#successModal').modal('show');

							// Close successModal after 2 seconds and trigger redirection
							setTimeout(function () {
								$('#successModal').modal('hide');
								location.reload();
							},1000); 
						}        
					},
					error: function (jqXHR, textStatus, errorThrown) {
						$('#loadingModal').modal('hide'); // Hide the modal on error
						alert("Error: " + errorThrown);
					},
					complete: function () {
						$('#loadingModal').modal('hide');
					}
				});
			}else {
				
			}
		}
		
	}
    

    

    </script>
</body>

</html>