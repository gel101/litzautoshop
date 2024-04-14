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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

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
        .cntr{
            display:flex;
            justify-content: center;
            place-items: center;
        }

        #con1{
            display: none;
        }

        #con2{
            display: none;
        }

        /* *{
            border: 1px solid red;
        } */
        .material-symbols-outlined{
            margin: 5px 25px 5px 5px;
            width: 100%;
            height: auto;
            max-width: 900px;
        }

        .button-transition {
            transition: background-color 0.5s ease;
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
                                <h4 class="mb-sm-0">PRODUCT TRANSACTION</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
                                        <li class="breadcrumb-item">My Transaction</li>
                                        <li class="breadcrumb-item active">Order</li>
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
                                    <table class="table text-center">
                                        <thead class="text-secondary">
                                            <tr>
                                                <th scope="col">Transaction ID</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Transaction Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include 'db/connection.php';
                                                if (isset($_SESSION['cust_id'])) {
                                                    $cust_id = $_SESSION['cust_id'];
                                                }
                                                $stmt = mysqli_query($conn, "SELECT * FROM orders WHERE cust_id='$cust_id' ORDER BY order_id DESC");

                                                while($data = mysqli_fetch_assoc($stmt)){
                                            ?>
                                            <tr>
                                                <td><?php echo $data['tran_id']; ?></td>
                                                <td class="text-left" style="text-align:left"><?php

                                                $tran_id = $data['tran_id'];
                                                $stmt11 = mysqli_query($conn, "SELECT product FROM carts WHERE tran_id='$tran_id' ORDER BY cart_id DESC");
                                                
                                                while($data11 = mysqli_fetch_assoc($stmt11)){
                                                    echo "&bull; " . $data11['product'] . "<br>";
                                                    
                                                }
                                                
                                                ?></td>
                                                <td><?php $date = new DateTime($data['date']); $formattedDate = $date->format('m-d-Y'); echo $formattedDate;  ?></td>
                                                <td>&#8369; <?php echo number_format($data['totalprice'], 2); ?></td>
                                                <td><h5><span class="badge <?php 
                                                
                                                switch ($data['status']) {
                                                    case "Pending":
                                                        echo "bg-warning";
                                                        break;
                                                    case "Accepted":
                                                        echo "bg-info";
                                                        break;
                                                    case "Requirements Complete":
                                                    case "Order Preparing":
                                                        echo "bg-secondary";
                                                        break;
                                                    case "Ready to Pick Up":
                                                    case "Completed":
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
                                                    <button type="button" class="btn btn-warning" onclick="showOrder('<?php echo $data['payment_term'] . '(' . $data['payment_mode'] . ' ' . $data['reference_number'] . ')'; ?>','<?php echo $data['cust_id']; ?>', '<?php echo $data['tran_id']; ?>', '<?php echo $data['status']; ?>')" data-bs-toggle="modal" data-bs-target="#vanDetail"><i class="fas fa-shopping-cart"></i></button>
                                                    <button type="button" onclick="cancelOrder(<?php echo $data['order_id']; ?>)" value="true" class="btn btn-danger <?php if ($data['status'] != "Pending") {echo 'd-none';} ?>"><i class="fas fa-ban"></i></button>
                                                    <button type="button" onclick="showReq('<?php echo $data['tran_id']; ?>')"  data-bs-toggle="modal" data-bs-target="#showAllReq" class="btn btn-primary <?php if ($data['status'] != "Accepted") {echo 'd-none';} ?>" ><i class="fas fa-file"></i></button>
                                                    <button type="button" onclick="uploadFile('<?php echo $data['cust_id']; ?>','<?php echo $data['tran_id']; ?>', this.value)" value="<?php 
                                                    $id = $data['tran_id'];
                                                    $stmtt12 = mysqli_query($conn, "SELECT brgy_clearance, validID_1, electric_bill FROM client_documents WHERE tran_id='$id' ");
    
                                                    $data32 = mysqli_fetch_assoc($stmtt12);
                                                    echo $data32['brgy_clearance'] . $data32['validID_1'] . $data32['electric_bill'];
                                                    ?>" class="btn btn-info <?php if ($data['status'] != "Accepted") {echo 'd-none';} ?>" ><i class="fas fa-file-upload"></i></button>
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
<div class="modal fade" id="vanDetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Client's Order</h3><span id="paymentStatus"><span class="badge bg-success" style="margin-left:10px" id="paymentTerm"></span></span>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
			</div>
			<div class="modal-body">
                <div class="card table-responsive">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <table class="table table-hover text-center">
                        <thead style="color: #1873d3">
                            <tr>
                            <th scope="col">Image of the Product</th>
                            <th scope="col">Product</th>
                            <th scope="col">Requested Color</th>
                            <th scope="col">Engine</th>
                            <th scope="col">Model</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody id="clientsOrder">

                        </tbody>
                    </table>
                </div>
			</div>
            <div class="modal-footer">
                <button data-bs-dismiss="modal" class="btn btn-danger">Close</button>
            </div>
		</div>
	</div>
</div>
<!-- END OF SHOW MORE INFO MODAL -->


<!-- FILE IMAGE MODAL -->
<div class="modal fade" id="fileUploadModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
                <input type="hidden" name="cust_id" id="cust_id">
                <input type="hidden" name="tran_id" id="tran_id">
				<h3 id="title">Requirement Details <span id="documentVerify" class="badge"></span></h3>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
			</div>
			<div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row cntr">
                            <button style="height:70px" onclick="employeed()" id="btn1" class="btn button-transition btn-success w-75 justify-content-center"><i class="fas fa-user fa-lg"></i> EMPLOYED</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row cntr">
                            <button style="height:70px" onclick="Semployeed()" id="btn2" class="btn button-transition btn-secondary w-75 justify-content-center"><i class="fas fa-portrait fa-lg"></i> SELF-EMPLOYED</button>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="con1">
                <h3 class="cntr">Upload Image</h3>
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Barangay Clearance</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="brgyClearance" id="brgyClearance" required>
                                <br>
                                <label for="" class="form-label">Valid ID</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="validID1" id="validID1" required>
                                <br>
                                <label for="" class="form-label">Wife / Partner Valid ID</label><span class="text-danger"> *Optional</span>
                                <input class="form-control" type="file" name="validID2" id="validID2">
                                <br>
                                <label for="" class="form-label">Marriage Contract / Birth Certificate</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="mContract" id="mContract" required>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Certificate of Employee</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="certofEmployee" id="certofEmployee" required>
                                <br>
                                <label for="" class="form-label">Latest Payslip(3 months)</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="payslip" id="payslip" required>
                                <br>
                                <label for="" class="form-label">Latest Electric Bill</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="electricBill" id="electricBill" required>
                                <br>
                                <br>
                                <br>
                                <input type="submit" value="Upload" name="upload1" class="btn btn-success float-end">

                            </div>
                        </div>
                    </form>
                </div>
                <div id="con2">
                <h3 class="cntr">Upload Image</h3>
                    <form id="uploadForm2" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Barangay Clearance</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="s_brgyClearance" id="s_brgyClearance" required>
                                <br>
                                <label for="" class="form-label">Valid ID</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="s_validID1" id="s_validID1" required>
                                <br>
                                <label for="" class="form-label">Wife / Partner Valid ID</label><span class="text-danger"> *Optional</span>
                                <input class="form-control" type="file" name="s_validID2" id="s_validID2">
                                <br>
                                <label for="" class="form-label">Marriage Contract / Birth Certificate</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="s_mContract" id="s_mContract" required>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Business Permit</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="s_bPermit" id="s_bPermit" required>
                                <br>
                                <label for="" class="form-label">Latest Bank Statement(3 months/Receipt 3 months)</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="s_bStatement" id="s_bStatement" required>
                                <br>
                                <label for="" class="form-label">Latest Electric Bill</label><span class="text-danger"> *Required</span>
                                <input class="form-control" type="file" name="s_electricBill" id="s_electricBill" required>
                                <br>
                                <br>
                                <br>
                                <input type="submit" value="Upload" name="upload2" class="btn btn-secondary float-end">
                            </div>
                        </div>
                    </form>
                </div>
			</div>
            <div class="modal-footer">
                <!-- <button data-bs-dismiss="modal" class="btn btn-warning">Upload</button> -->
            </div>
		</div>
	</div>
</div>
<!-- END OF FILE IMAGE MODAL -->


<!-- SHOW MORE INFO MODAL -->
<div class="modal fade zoomIn" id="showAllReq">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Show All Requirements</h3>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="showReq">
                
			</div>
                <div class="modal-footer">
                <button data-bs-dismiss="modal" class="btn btn-danger">CLOSE</button>
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


        function showOrder(paymentTerm, custId, id, status) {
            var custID = custId;
            var tran_id = id;
            var status = status;

            if (paymentTerm == "( )") {
                $("#paymentStatus").hide();
            }else{
                $("#paymentStatus").show();
                $("#paymentTerm").text(paymentTerm);
            }

            $("#clientID").val(custId);
            $("#clientInfo").val(id);
            $("#clientStatus").val(status);

            $("#clientsOrder").load("db/ajaxShowOrder.php", {
                thecustomerID: custId,
                thetran_id: id,
                tranStatus: status
            }, function() {
                // Callback function after AJAX is completed
                checkClientStatus();
            });
        }

        
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

                var id = $("#cust_id").val();
                var tran_id = $("#tran_id").val();
			    var img1 = $("#certofEmployee").prop("files")[0]; // Get the file object
			    var img2 = $("#payslip").prop("files")[0]; // Get the file object
			    var img3 = $("#electricBill").prop("files")[0]; // Get the file object
			    var img4 = $("#brgyClearance").prop("files")[0]; // Get the file object
			    var img5 = $("#validID1").prop("files")[0]; // Get the file object
			    var img6 = $("#validID2").prop("files")[0]; // Get the file object
			    var img7 = $("#mContract").prop("files")[0]; // Get the file object

                if (confirm("Upload all the images?")) {
                    var form_data = new FormData(); // Create a new FormData object
                    form_data.append("id", id);
                    form_data.append("tran_id", tran_id);
                    form_data.append("img1", img1);
                    form_data.append("img2", img2);
                    form_data.append("img3", img3);
                    form_data.append("img4", img4);
                    form_data.append("img5", img5);
                    if (typeof img6 !== "undefined") {
                        form_data.append("img6", img6);
                    }
                    form_data.append("img7", img7);

                    // Send the image data and other form data to PHP using AJAX
                    $.ajax({
                        url: "db/requirementsAdd1.php",
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
                            } else {
                                $('#loadingModal').modal('hide');
                                $('.dismissBtn').click();
                                $('#successModal').modal('show');

                                // Close successModal after 2 seconds and trigger redirection
                                setTimeout(function () {
                                    $('#successModal').modal('hide');
								    location.reload();
                                },1000);

                                // Clear the file inputs after successful upload
                                $('input[type="file"]').val('');
                            }
                        }
                    });
                } else {
                    // Handle invalid form
                }
            });
            
            $('#uploadForm2').submit(function (e) {
                e.preventDefault(); // Prevent default form submission

                var id = $("#cust_id").val();
                var tran_id = $("#tran_id").val();
			    var img1 = $("#s_bPermit").prop("files")[0]; // Get the file object
			    var img2 = $("#s_bStatement").prop("files")[0]; // Get the file object
			    var img3 = $("#s_electricBill").prop("files")[0]; // Get the file object
			    var img4 = $("#s_brgyClearance").prop("files")[0]; // Get the file object
			    var img5 = $("#s_validID1").prop("files")[0]; // Get the file object
			    var img6 = $("#s_validID2").prop("files")[0]; // Get the file object
			    var img7 = $("#s_mContract").prop("files")[0]; // Get the file object

                if (confirm("Upload all the images?")) {
                    var form_data = new FormData(); // Create a new FormData object
                    form_data.append("id", id);
                    form_data.append("tran_id", tran_id);
                    form_data.append("img1", img1);
                    form_data.append("img2", img2);
                    form_data.append("img3", img3);
                    form_data.append("img4", img4);
                    form_data.append("img5", img5);
                    if (typeof img6 !== "undefined") {
                        form_data.append("img6", img6);
                    }
                    form_data.append("img7", img7);

                    // Send the image data and other form data to PHP using AJAX
                    $.ajax({
                        url: "db/requirementsAdd2.php",
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
                            } else {
                                $('#loadingModal').modal('hide');
                                alert(responseData.msg);
								    location.reload();

                                // Clear the file inputs after successful upload
                                $('input[type="file"]').val('');
                            }
                        }
                    });
                } else {
                    // Handle invalid form
                }
            });


        });

        function cancelOrder(id){
            var order_id = id;
            if (confirm("Do you want to Cancel the Order?")) {
                var form_data = {
                    order_id : order_id
                }
                
                $.ajax({
                    url : "db/orderCancel.php",
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

        
        function showReq(tran_id){
            $("#showReq").load("db/ajaxShowRequirements.php", {
                tran_id : tran_id
            });
        }

        function uploadFile(id, tran_id, docu_id){
            if (docu_id != "") {
                $('#documentVerify').addClass('bg-primary');
                $('#documentVerify').removeClass('bg-warning');
                $('#documentVerify').text('Uploaded File');
            }else{
                $('#documentVerify').addClass('bg-warning');
                $('#documentVerify').removeClass('bg-primary');
                $('#documentVerify').text('No Uploaded File');
            }
            
            var fileUploadModal = new bootstrap.Modal(document.getElementById("fileUploadModal"));
            fileUploadModal.show();
		    $("#cust_id").val(id);
		    $("#tran_id").val(tran_id);
        }


        function employeed(){
            $('#con2').css('display', 'none');
            $('#con1').css('display', 'block');
            $('#btn2').css('opacity', '0.5');
            $('#btn1').css('opacity', '1');
        }

        function Semployeed(){
            $('#con1').css('display', 'none');
            $('#con2').css('display', 'block');
            $('#btn1').css('opacity', '0.5');
            $('#btn2').css('opacity', '1');
        }

            
        function showVanDetailModal() {
            var vanDetailModal = new bootstrap.Modal(document.getElementById("vanDetail"));
            vanDetailModal.show();
        }

        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('custIDTransaction')) { 
            showVanDetailModal();
        }
    </script>
</body>

</html>