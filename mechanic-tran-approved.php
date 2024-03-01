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
    <link rel="stylesheet" href="css/staff.css">
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
<?php include 'mechanic-header.php' ?>
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
        <?php include 'mechanic-sidebar.php' ?>

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
                                <h4 class="mb-sm-0">Service Request</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Mechanic</a></li>
                                        <li class="breadcrumb-item active">Approved Request</li>
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
                                <div class="card-body table-responsive table-responsive">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <!-- <label class="form-label">Product Order</label> -->
                                        </div>
                                        <div class="col-md-5 col-sm-12">
                                            <!-- Content for the second column -->
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <!-- Set a row limit : <input type="number" id="row-limit" placeholder="Limit"> -->
                                            <input class="form-control" type="text" id="table-filter" placeholder="Search...">
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table text-center ">
                                        <thead class="text-secondary">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Client Name</th>
                                                <th scope="col">Type of Service</th>
                                                <th scope="col">Date Requested</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Service Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                                include 'db/connection.php';

                                                $mechanic_id = $_SESSION['mechanic_id'];
                                                $stmt = mysqli_query($conn, "SELECT * FROM request_services where mechanic_id='$mechanic_id' AND status != 'declined' ORDER BY request_id DESC");
                                                while($data = mysqli_fetch_assoc($stmt)){
                                            ?>

                                            <tr>
                                                <td><?php echo $data['request_id']; ?></td>
                                                <td><?php echo $data['cust_name']; ?></td>
                                                <td><?php echo $data['request']; ?></td>
                                                <td><?php $date = new DateTime($data['dateSelected']); $formattedDate = $date->format('m-d-Y'); echo $formattedDate; ?></td>
                                                <td>&#8369; <?php echo number_format($data['price'], 2); ?></td>
                                                <td><h5><?php 
                                                
                                                switch ($data['status']) {
                                                    case "Approved":
                                                        echo "<span class='badge bg-warning'>Pending</span>";
                                                        break;
                                                    case "Request Completed":
                                                        echo "<span class='badge bg-success'>Request Complete</span>";
                                                        break;
                                                    default:
                                                        echo "<span class='badge bg-danger'>Somethings Error</span>";
                                                }

                                                
                                                ?></h5></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-value-1="<?php echo $data['details']; ?>" data-value-2="<?php echo $data['price_reason']; ?>" onclick="showClientInfo('<?php echo $data['cust_id']; ?>', '<?php echo $data['request_id']; ?>', '<?php echo $data['dateSelected']; ?>', '<?php echo $data['vehicleType']; ?>', this.getAttribute('data-value-1'), '<?php echo $data['status']; ?>', this.getAttribute('data-value-2'))" data-bs-toggle="modal" data-bs-target="#clientDetail"><i class="fas fa-eye"></i></button>
                                                    <button type="button" class="btn btn-success <?php if($data['status'] != "Approved"){echo "d-none";} ?>" onclick="processReq('<?php echo $data['cust_id']; ?>','<?php echo $data['request_id']; ?>','<?php echo $data['cust_email']; ?>')"><i class="fas fa-check-circle"></i></button>
                                                    <!-- <button type="button" class="btn btn-success <?php if($data['status'] != "Processing"){echo "d-none";} ?>" onclick="processedReq('<?php echo $data['cust_id']; ?>','<?php echo $data['request_id']; ?>')"> Processed</button>
                                                    <button type="button" class="btn btn-success <?php if($data['status'] != "Processed"){echo "d-none";} ?>" onclick="completedBtn('<?php echo $data['request_id']; ?>','<?php echo $data['cust_id']; ?>')"><i class="fas fa-check-circle"></i></button> -->
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
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h3 id="title">Client Details</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div id="showClientInfo">
                                        <!-- Content to be dynamically populated -->
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
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <!-- Date Requested -->
                                            <br>
                                            <label for="dateSelected" class="form-label">Date Requested</label>
                                            <input type="text" class="form-control" id="dateSelected" disabled>
                                            <br>

                                            <!-- Things that Needed for the Service / Reason to the Price -->
                                            <label for="priceReason" class="form-label">List of Used Services & the Price</label>
                                            <textarea class="form-control" style="resize:none; overflow:auto" id="priceReason" cols="30" rows="5" disabled></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button data-bs-dismiss="modal" class="btn btn-danger">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END OF SHOW MORE INFO MODAL -->


                    




<!-- SHOW MORE INFO MODAL -->
<div class="modal fade" id="tranDetail">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Additional Information</h3>
                <input type="hidden" name="" id="cust_id">
                <input type="hidden" name="" id="reqqID">
                <input type="hidden" name="" id="reqEmail">
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                    <label for="minfo" class="form-label">List of Used Services & the Price</label><span class="text-danger" id="validServices"></span>
                    <textarea class="form-control" style="resize:none;overflow:auto;" id="minfo" name="minfo" rows="10" placeholder="Enter Used Services Here..." required></textarea>
                    <br>
                    <label class="form-label">Total Cost of the Service:</label><span class="text-danger" id="validprice_err"></span>
                    <div class="row">
                        <div class="col-auto">
                            <h4 class="float-start">₱</h4>
                        </div>
                        <div class="col-auto">
                            <input type="number" id="totalPrice" class="form-control" placeholder="Enter Total Cost Here" required>
                        </div>
                    </div>
			</div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-danger">Close</button>
                    <button onclick="addPrice()" class="btn btn-primary">Confirm</button>
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


        function completedBtn(reqID, cust_id){
            var valid = true;
            
            if (reqID == "") {
                valid = false;
                alert("Service ID empty");
            }
            if (valid) {
                    if(confirm('Has the request been completed?')){
                        var form_data = {
                            reqID : reqID,
                            cust_id : cust_id
                        };

                        $.ajax({
                            url : "db/requestComplete.php",
                            type : "POST",
                            data : form_data,
                            dataType: "json",
                            beforeSend: function () {
                                $('#loadingModal').modal('show');
                                $('.dismissBtn').click();
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
        
        function addPrice(){
            valid = true;
            var letterPattern = /[a-zA-Z]/;
            var cust_id = $('#cust_id').val();
            var reqID = $('#reqqID').val();
            var reqEmail = $('#reqEmail').val();
            var price = $('#totalPrice').val();
            var priceReason = $('#minfo').val();

            if (price === "" || letterPattern.test(price)) {
                $('#validprice_err').html(" *Price Invalid");
                valid = false;
            }else{
                $('#validprice_err').html(" ");
            }

            if (priceReason === "") {
                $('#validServices').html(" *Please specify the reason(s) for the price!");
                valid = false;
            }else{
                $('#validServices').html(" ");
            }

            if (valid) {
                if (confirm("Are you sure about all the details you've provided?")) {
                    var form_data = {
                        cust_id : cust_id,
                        reqID : reqID,
                        price : price,
                        priceReason : priceReason,
                        reqEmail : reqEmail
                    }
                    
                    $.ajax({
                        url : "db/requestComplete.php", // original "db/requestProcessing.php",
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
                                            $('.messageText').text('Request Completed!'); // Change the text
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
                                    // },
                                    complete: function () {
                                            $('.messageText').text('Request Completed!'); // Change the text
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
                        }
                    });

                }
            }else{

            }
        }


        function showClientInfo(cust_id, reqID, dateSelected, vehicleType, details, status, priceReason){
            details = details.replace(/\n/g, '<br>');
            $('#showDetails').val(details.replace(/<br>/g, '\n'));

            priceReason = priceReason.replace(/\n/g, '<br>');
            $('#priceReason').val(priceReason.replace(/<br>/g, '\n'));
            
            // Convert the date to a JavaScript Date object
            var dateObject = new Date(dateSelected);

            // Get the components of the date
            var year = dateObject.getFullYear();
            var month = (dateObject.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 because months are zero-based
            var day = dateObject.getDate().toString().padStart(2, '0');

            // Create the new formatted date string 'mm-dd-yyyy'
            var formattedDate = month + '-' + day + '-' + year;
            $('#dateSelected').val(formattedDate);
            $('#vehicleType').val(vehicleType);
            $('#showClientInfo').html('');

            // Load content using AJAX
            $("#showClientInfo").load("db/ajaxShowClientProfile.php", {
                clientInfo: cust_id
            }, function (responseText) {
                // Callback function after AJAX is completed
                if ($.trim(responseText) === "") {
                    // If the loaded data is empty, display "No System Account"
                    $("#showClientInfo").html("<h3 class='text-warning text-center'>No System Account</h3>");
                } else {
                    // If data is present, continue with checkRequestStatus()
                    checkRequestStatus();
                }
            }).fail(function () {
                // Callback function in case of failure
                $("#showClientInfo").html("<h2>No System Account</h2>");
            });
        }


        
        function processReq(cust_id, reqID, reqEmail){
            $('#cust_id').val(cust_id);
            $('#reqqID').val(reqID);
            $('#reqEmail').val(reqEmail);
            $("#tranDetail").modal("show");
        }

        function processedReq(cust_id, reqID){
            if (confirm("Was the service request confirmed to be processed?")) {
                var form_data = {
                    cust_id : cust_id,
                    reqID : reqID
                }
                
                $.ajax({
                    url : "db/requestProcessed.php",
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
                            $('.messageText').text('Request Processed!'); // Change the text
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
                        // This function will be executed after success or error
                    }
                });
            }else{

            }
        }

        

    </script>
</body>

</html>