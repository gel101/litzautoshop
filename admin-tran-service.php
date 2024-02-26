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
    <title>Garage</title>
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
            right: 10px;
            bottom: 10px;
        }
    </style>

</head>

<body onload="checkRequestStatus()">

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
                                <h4 class="mb-sm-0">Service</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Admin</a></li>
                                        <li class="breadcrumb-item">Transaction</li>
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
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewRequest">New Service</button>
                                        </div>
                                        <div class="col-md-5">
                                        </div>
                                        <div class="col-md-4">
                                            <!-- Set a row limit : <input type="number" id="row-limit" placeholder="Limit"> -->
                                            <input class="form-control" type="text" id="table-filter" placeholder="Search...">
                                        </div>
                                    </div>
                                    <br>
                                        <table class="table text-center">
                                            <thead class="text-secondary">
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Client Name</th>
                                                    <th scope="col">Type of Service</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Services Price</th>
                                                    <th scope="col">Assigned</th>
                                                    <th scope="col">Service Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                    include 'db/connection.php';

                                                    $stmt = mysqli_query($conn, "SELECT * FROM request_services WHERE status!='canceled' ORDER BY request_id DESC");
                                                    while($data = mysqli_fetch_assoc($stmt)){
                                                ?>

                                                <tr>
                                                    <td><?php echo $data['request_id']; ?></td>
                                                    <td><?php echo $data['cust_name']; ?></td>
                                                    <td><?php echo $data['request']; ?></td>
                                                    <td><?php $date = new DateTime($data['date']); $formattedDate = $date->format('m-d-Y'); echo $formattedDate;  ?></td>
                                                    <td><?php if($data['price'] != 0){echo "&#8369; " . number_format($data['price'], 2); }elseif($data['status']=="Canceled" || $data['status']=="Declined"){echo '<p><span class="badge bg-danger">' .$data['status'].'</span></p>';}else{echo '<p><span class="badge bg-warning">Pending</span></p>';} ?></td>
                                                    <td><?php $mecID = $data['mechanic_id']; 
                                                    $mechQuery = mysqli_query($conn, "SELECT fname, lname FROM staff WHERE staff_id = '$mecID'");
                                                    $datamec = mysqli_fetch_assoc($mechQuery);
                                                    if ($datamec) {
                                                        echo $datamec['fname'] . " " . $datamec['lname'];
                                                    }else {
                                                        echo "Not yet";
                                                    }
                                                    ?></td>
                                                    <td><h5><span class="badge <?php 
                                                    
                                                    switch ($data['status']) {
                                                        case "Pending":
                                                            echo "bg-warning";
                                                            break;
                                                        case "Approved":
                                                            echo "bg-primary";
                                                            break;
                                                        case "Processing":
                                                            echo "bg-secondary";
                                                            break;
                                                        case "Processed":
                                                        case "Request Completed":
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
                                                    <td>
                                                    <div class="d-flex align-items-center justify-content-center"> <!-- Wrap buttons in a flex container -->
                                                        <button type="button" class="btn btn-warning me-1" data-value-1="<?php echo $data['details']; ?>" data-value-2="<?php echo $data['price_reason']; ?>" onclick="showClientInfo('<?php echo $data['cust_id']; ?>', '<?php echo $data['request_id']; ?>', '<?php echo $data['dateSelected']; ?>', '<?php echo $data['vehicleType']; ?>', this.getAttribute('data-value-1'), '<?php echo $data['status']; ?>', this.getAttribute('data-value-2'), '<?php echo $data['cust_email']; ?>', '<?php echo $data['cust_num']; ?>', '<?php echo $data['paintColor']; ?>', '<?php echo $data['tintColor']; ?>')" data-bs-toggle="modal" data-bs-target="#clientDetail"><i class="fas fa-eye"></i></button>
                                                        <!-- <button type="button" class="btn btn-success <?php if($data['status'] != "Processed"){echo "d-none";} ?>" onclick="completedBtn('<?php echo $data['request_id']; ?>','<?php echo $data['cust_id']; ?>')">Complete <i class="fas fa-car"></i></button> -->
                                                        <button type="button" class="btn btn-danger <?php if($data['status'] != "Pending" AND $data['status'] != "Approved"){echo "d-none";} ?>" onclick="declineBtn('<?php echo $data['request_id']; ?>', '<?php echo $data['cust_id']; ?>')" ><i class="fas fa-archive"></i></button>
                                                        </td>
                                                    </div>
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



<!-- Bootstrap Modal -->
<div class="modal fade" id="addNewRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Service Request</h5>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">Customer Name</label><span class="err_name text-danger"></span>
                        <input type="text" class="form-control" id="addname" placeholder="Enter name">

                    </div>
                    <div class="col-md-6">
                        <label for="vehicleType" class="form-label">Type of Vehicle</label><span class="err_vehicle text-danger"></span>
                        <select class="form-select" id="addvehicle" name="addvehicle" required>
                                            
                            <?php
                                include 'db/connection.php';
                                $stmtpaintdelete = mysqli_query($conn, "SELECT * FROM vehicletype_service ORDER BY id DESC");
                                while($data = mysqli_fetch_assoc($stmtpaintdelete)){
                            ?>

                            <option class="<?php echo $data['id']; ?>" value="<?php echo $data['vehicleType']; ?>"><?php echo $data['vehicleType']; ?></option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- <br>
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="form-label">Address</label><span class="err_address text-danger"></span>
                        <input type="text" class="form-control" id="addaddress">
                    </div>
                </div> -->
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <label for="addrequest" class="form-label">Service Request</label><span class="err_request text-danger"></span>
                        <div class="row checkboxes">
                            <!-- checkboxes -->
                        </div>
                        <br>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">Select Date</label><span class="err_date text-danger"></span>
                        <input type="date" class="form-control" name="adddate" id="adddate">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Contact Details</label><span class="err_email text-danger" id="infoText"></span>
                        <input type="number" class="form-control" id="addnumber" placeholder="Enter Phone Number"  oninput="validateNumber(this)">
                        <input type="email" class="form-control" id="addemail" placeholder="Enter email">


                    </div>
                </div>
                <br>
                    <label for="" class="form-label">Suggestions/Comments/Reasons (Optional)</label>
                    <textarea name="" class="form-control" id="adddetails" cols="30" rows="6"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addRequest()">Confirm</button>
            </div>
        </div>
    </div>
</div>


<!-- SHOW MORE INFO MODAL -->
<div class="modal fade zoomIn" id="clientDetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
                <input type="hidden" name="" id="custID" value="">
                <input type="hidden" name="" id="requestID" value="">
                <input type="hidden" name="" id="requestStatus" value="">
                <input type="hidden" name="" id="requestEmail" value="">
                <input type="hidden" name="" id="requestNumber" value="">
				<h3 id="title">Client Details</h3>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <div id="showClientInfo">

                </div>
                <hr>

                <!-- Two-column layout -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- Vehicle Type -->
                        <label for="vehicleType" class="form-label">Vehicle Type</label>
                        <input type="text" class="form-control" id="vehicleType" disabled>
                        <br>

                        <!-- Comments/Suggestions/Requests/Descriptions -->
                        <label for="showDetails" class="form-label">Comments/Suggestions/Requests/Descriptions</label>
                        <textarea class="form-control" style="resize:none; overflow:auto" id="showDetails" cols="30" rows="5" disabled></textarea>
                        <br>
                    </div>

                    <div class="col-md-6">
                        <!-- Date Requested -->
                        <label for="dateSelected" class="form-label">Date Requested</label>
                        <input type="text" class="form-control" id="dateSelected" disabled>
                        <br>

                        <!-- Things that Needed for the Service / Reason to the Price -->
                        <label for="priceReason" class="form-label">List of Used Services & the Price</label>
                        <textarea class="form-control" style="resize:none; overflow:auto" id="priceReason" cols="30" rows="5" disabled></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <label for="" class="form-label assignMecBtn">Assign a Mechanic</label>
                    <div class="col-md-9">
                        <select class="assignMecBtn form-select" name="" id="chooseMechanic">
                            <?php
                                include 'db/connection.php';
                                $mechaniccc = mysqli_query($conn, "SELECT * FROM staff WHERE position = 'Mechanic' AND status !='archived' ORDER BY staff_id DESC");

                                while ($data = mysqli_fetch_assoc($mechaniccc)) {
                            ?>
                                                    <option value="<?php echo $data['staff_id']; ?>"><?php echo $data['fname']. ' ' . $data['lname'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="col-md-3 float-end assignMecBtn">
                        <button class="btn btn-primary float-end mr-2" onclick="assignMec(document.getElementById('custID').value, document.getElementById('chooseMechanic').value, document.getElementById('requestID').value, document.getElementById('dateSelected').value, document.getElementById('requestEmail').value, document.getElementById('requestNumber').value)" >ASSIGN</button>
                        <button data-bs-dismiss="modal" class="btn btn-danger float-end ml-2">CLOSE</button>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                </div> -->
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    
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
        
        document.addEventListener('DOMContentLoaded', function() {
            // Call the function when the page is ready
            updateCheckboxOptions();

            // Add event listener for the change event on the addvehicle dropdown
            document.getElementById('addvehicle').addEventListener('change', function() {
                updateCheckboxOptions();
            });
        });

        function updateCheckboxOptions() {
            // Get the id of the selected option based on its class value
            var selectedOption = document.getElementById('addvehicle').options[document.getElementById('addvehicle').selectedIndex];

            // Get the class attribute of the selected option
            var selectedVehicleType = selectedOption.getAttribute('class');

            // Fetch and update options for checkboxes
            fetch('db/utilitiesvehicle.php?vehicleType=' + selectedVehicleType)
                .then(response => response.json())
                .then(data => {
                    // Loop through received data to create checkboxes
                    var checkboxContainer = document.querySelector('.col-md-12 .row');
                    checkboxContainer.innerHTML = ''; // Clear existing checkboxes
                    data.forEach(function(service) {
                        var checkboxDiv = document.createElement('div');
                        checkboxDiv.classList.add('col-md-6', 'service-request');

                        var checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.classList.add('form-check-input');
                        checkbox.name = 'requestType[]';
                        checkbox.value = service.service; // Assuming 'service' is the field containing checkbox values

                        var label = document.createElement('label');
                        label.classList.add('form-check-label');
                        if (service.price == 0) {
                            service.price = "Price vary";
                        }
                        label.textContent =  " " + service.service + " ₱" + service.price; // Assuming 'service' is the field containing checkbox values

                        checkboxDiv.appendChild(checkbox);
                        checkboxDiv.appendChild(label);

                        checkboxContainer.appendChild(checkboxDiv);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }

		
		function validateNumber(input) {
			var infoText = document.getElementById('infoText');

			if (input.value.length !== 11) {
			infoText.textContent = ' *Should be exactly 11 digits and starts with 09! Ex.(09104445556)';
			} else {
			infoText.textContent = '';
			}
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

        function addRequest() {
            var valid = true;
            var addname = $('#addname').val();
            // var addaddress = $('#addaddress').val();
            var addemail = $('#addemail').val();
            var addnumber = $('#addnumber').val();
            var addvehicle = $('#addvehicle').val();
            var adddate = $('#adddate').val();
            var adddetails = $('#adddetails').val();
            
            var checkboxValues = [];
            var checkboxes = document.querySelectorAll('input[name="requestType[]"]:checked');
            checkboxes.forEach(function (checkbox) {
                checkboxValues.push(checkbox.value);
            });

            
    // Now checkboxValues array contains the values of the checked checkboxes
    console.log(checkboxValues);
                

            var currentDate = new Date();
			if(addname == ""){
				valid = false;
				$(".err_name").html(" *Please enter Customer Name ");
			}
			// if(addaddress == ""){
			// 	valid = false;
			// 	$(".err_address").html(" *Please enter an Address");
			// }
			if(addemail == ""){
				valid = false;
				$(".err_email").html(" *Please enter an Email");
			}
			if(addnumber == ""){
				valid = false;
				$(".err_email").html(" *Please enter Phone Number");
			}
			if(addvehicle == ""){
				valid = false;
				$(".err_vehicle").html(" *Please Select Vehicle Type");
			}
    
            // Check if any of the values is an empty string
            if (checkboxValues.length === 0) {
                // Alert that there was an empty string in the array
                alert('Please Select Service Request!');
                valid = false;
                return; // Skip adding this request to the array
            }

			if(adddate == "" || new Date(adddate) < currentDate){
				valid = false;
				$(".err_date").html(" *Date Invalid");
			}


            if (valid) {
                if(confirm('Add the Request?')){
                    var form_data = {
                        addname : addname,
                        addemail : addemail,
                        addnumber : addnumber,
                        addvehicle : addvehicle,
                        addrequest : checkboxValues,
                        adddate : adddate,
                        adddetails : adddetails
                    };

                    $.ajax({
                        url : "db/requestAddNew.php",
                        type : "POST",
                        data : form_data,
                        dataType: "json",
                        beforeSend: function () {
                            $('#loadingModal').modal('show');
                            $('.dismissBtn').click();
                        },
                        success: function(response){
                            $('#loadingModal').modal('hide'); // Hide the modal on success
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

        function showClientInfo(cust_id, reqID, dateSelected, vehicleType, details, status, priceReason, email, number, paintColor, tintColor){
            $('#custID').val(cust_id);
            $('#requestID').val(reqID);
            $('#requestStatus').val(status);
            
            
            // Convert the date to a JavaScript Date object
            var dateObject = new Date(dateSelected);

            // Get the components of the date
            var year = dateObject.getFullYear();
            var month = (dateObject.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 because months are zero-based
            var day = dateObject.getDate().toString().padStart(2, '0');

            // Create the new formatted date string 'mm-dd-yyyy'
            var formattedDate = month + '-' + day + '-' + year;
            $('#dateSelected').val(formattedDate);
            $('#requestDate').val(dateSelected);
            $('#vehicleType').val(vehicleType);
            $('#showDetails').val(details);
            $('#requestEmail').val(email);
            $('#requestNumber').val(number);

            if (paintColor != "") {
                paintColor = "Paint color: " + paintColor + ", Initial Price: ₱20,000(varies by size)" + "\n";
            }if (tintColor != "") {
                tintColor = "Tint color : " + tintColor + ", Initial Price: ₱5,000(varies by size)" + "\n";
            }

            details = details.replace(/\n/g, '<br>');
            $('#showDetails').val(details.replace(/<br>/g, '\n'));

            priceReason = priceReason.replace(/\n/g, '<br>');
            $('#priceReason').val(paintColor + tintColor + priceReason.replace(/<br>/g, '\n'));


            $("#showClientInfo").load("db/ajaxShowClientProfile.php", {
                clientInfo: cust_id
            }, function (responseText) {
                // Callback function after AJAX is completed
                if ($.trim(responseText) === "") {
                    // If the loaded data is empty, display "No System Account"
                    $("#showClientInfo").html("<h3 class='text-warning text-center'>No System Account</h3>");
                    // If data is present, continue with checkRequestStatus()
                    checkRequestStatus();
                } else {
                    // If data is present, continue with checkRequestStatus()
                    checkRequestStatus();
                }
            }).fail(function () {
                // Callback function in case of failure
                $("#showClientInfo").html("<h2>Walk in Service</h2>");
            });

        }

        
        function checkRequestStatus() {
            var Status = $('#requestStatus').val();
            var reqBtn = $('.assignMecBtn');

            if (Status == "Pending") {
                reqBtn.show();
            } else {
                reqBtn.hide();
            }
        }


        function assignMec(cust_id, mechanic_id, reqID, reqDate, reqEmail, reqNumber){
		if (confirm("Is it confirmed that a mechanic is being assigned to approve the request?")) {
			var form_data = {
				cust_id : cust_id,
				mechanic_id : mechanic_id,
				reqID : reqID,
				reqDate : reqDate,
				reqEmail : reqEmail,
				reqNumber : reqNumber
			}

            $('.messageText').text('Successfully Assigned a Mechanic'); // Change the confirmation text
			$.ajax({
	        	url : "db/requestAssign.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
                beforeSend: function () {
                    $('#loadingModal').modal('show');
                    $('.dismissBtn').click();
                },
                success: function(response){
                
                    var sms_data = {
                        number : response['number'],
                        message : response['message'],
                        provider : "semaphore"
                    }

                    $.ajax({
                        url : "sms/sendSms.php",
                        type : "POST",
                        data : sms_data,
                        dataType: "json",
                        success: function(response){
                            if (response['valid'] == false) {
                                alert(response['msg']);
                                $('#loadingModal').modal('hide');
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
                        // error: function (jqXHR, textStatus, errorThrown) {
                        //     alert("Error: " + errorThrown);
                        //     $('#loadingModal').modal('hide'); // Hide the modal on error
                        // }
                        complete: function(){
                            $('#successModal').modal('show');

                            // Close successModal after 2 seconds and trigger redirection
                            setTimeout(function () {
                                $('#successModal').modal('hide');
                                location.reload();
                            },1000);

                        }
                    });
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

    
        function declineBtn(serviceID, cust_id){
            var valid = true;
            var serviceID = serviceID;
            
            if (serviceID == "") {
                valid = false;
                alert("Service ID empty");
            }
            if (valid) {
                if(confirm('Do you want to decline the request?')){
                    var form_data = {
                        serviceID : serviceID,
                        cust_id : cust_id
                    };

                    $.ajax({
                        url : "db/requestDelete.php",
                        type : "POST",
                        data : form_data,
                        dataType: "json",
                        beforeSend: function () {
                            $('#loadingModal').modal('show');
                            $('.dismissBtn').click();
                        },
                        success: function(response){
                            $('#loadingModal').modal('hide'); // Hide the modal on success
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

        function completedBtn(serviceID, cust_id){
            var valid = true;
            
            if (serviceID == "") {
                valid = false;
                alert("Service ID empty");
            }
            if (valid) {
                    if(confirm('Has the request been completed?')){
                        var form_data = {
                            serviceID : serviceID,
                            cust_id : cust_id
                        };

                        $.ajax({
                            url : "db/requestComplete.php",
                            type : "POST",
                            data : form_data,
                            dataType: "json",
                            beforeSend: function () {
                                $('#loadingModal').modal('show');
                            },
                            success: function(response){
                                $('#loadingModal').modal('hide'); // Hide the modal on success
                                if(response['valid'] == false){
                                alert(response['msg']);
                                }else{
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