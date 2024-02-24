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
        .cartButton{
            position: absolute;
            right: 10px;
            bottom: 10px;
        }
        
        .declined{
            font-family: Georgia, serif;
            font-size: 13px;
            letter-spacing: 0px;
            word-spacing: -0.8px;
            color: #FF0000;
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
                                <h4 class="mb-sm-0">ARCHIVED</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Admin</a></li>
                                        <li class="breadcrumb-item">Transaction</li>
                                        <li class="breadcrumb-item">Archived</li>
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
                                <br>
                                <h4>Declined Order</h4>
                                <br>
                                <table class="table text-center">
                                <thead class="text-danger">
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'db/connection.php';

                                    $stmt = mysqli_query($conn, "SELECT * FROM orders WHERE status='declined' ORDER BY order_id DESC");

                                    while($data = mysqli_fetch_assoc($stmt)){
                                    ?>
                                    <tr>
                                        <td><?php echo $data['order_id']; ?></td>
                                        <td><?php echo $data['tran_id']; ?></td>
                                        <td><?php echo $data['customerName']; ?></td>
                                        <td>&#8369; <?php echo number_format($data['totalprice'], 2); ?></td>
                                        <td><?php $date = new DateTime($data['date']); $formattedDate = $date->format('m-d-Y'); echo $formattedDate;  ?></td>
                                        <td class="<?php echo $data['status']; ?>"><?php echo $data['status']; ?></td>
                                        <td>
                                            <button class="btn btn-warning" onclick="showOrder('<?php echo $data['order_id']; ?>','<?php echo $data['cust_id']; ?>', '<?php echo $data['tran_id']; ?>', '<?php echo $data['status']; ?>')" data-bs-toggle="modal" data-bs-target="#vanDetail" type="button"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-primary" onclick="recoverBtn('<?php echo $data['order_id']; ?>')" type="button"><i class="fas fa-trash-restore"></i></button>
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



<!-- SHOW MORE INFO MODAL -->
<div class="modal fade" id="vanDetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Client's Order</h3>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                
                <input type="hidden" id="tranID" value="">
                <input type="hidden" id="clientID" value="">
                <input type="hidden" id="clientInfo" value="">
                <input type="hidden" id="clientStatus" value="">
			</div>
			<div class="modal-body">
                <div class="card table-responsive">
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
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">CLOSE</button>
                </div>
		</div>
	</div>
</div>
<!-- END OF SHOW MORE INFO MODAL -->


<!-- SHOW MORE INFO MODAL -->
<div class="modal fade" id="clientDetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Client Details</h3>
			</div>
			<div class="modal-body">
                <div class="card">

<?php
if (isset($_GET['viewclientInfo'])) {

    $customerID = $_GET['clientInfo'];

    include 'db/connection.php';
    $stmt = mysqli_query($conn, "SELECT * FROM clientacc WHERE cust_id='$customerID'");

    while ($data = mysqli_fetch_assoc($stmt)) {
?>
                        <div class="row">
                            <div class="col-md-3">
                        <label for="" class="form-label">Client Name</label>
                        <input type="text" class="form-control" value="<?php echo $data['fname']; ?> <?php echo $data['lname']; ?>" disabled>
                            </div>
                            <div class="col-md-3">
                        <label for="" class="form-label">Birthdate</label>
                        <input type="text" class="form-control" value="<?php echo $data['birthdate']; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                        <label for="" class="form-label">Address</label>
                        <input type="text" class="form-control" value="<?php echo $data['address']; ?>" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                        <label for="" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" value="<?php echo $data['phoneNum']; ?>" disabled>
                            </div>
                            <div class="col-md-3">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control" value="<?php echo $data['username']; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" value="<?php echo $data['email']; ?>" disabled>
                            </div>
                        </div>
<?php
    }
}
?>

                </div>
                <br>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" class="btn btn-warning">Okay</button>
                </div>
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
        
        function showOrder(tranID, custId, id, status) {
            var tranID = tranID;
            var custID = custId;
            var tran_id = id;
            var status = status;

            $("#tranID").val(tranID);
            $("#clientID").val(custId);
            $("#clientInfo").val(id);
            $("#clientStatus").val(status);

            $("#clientsOrder").load("db/ajaxShowOrder.php", {
                thecustomerID: custId,
                thetran_id: id,
                tranStatus: status
            }, function() {
                // Callback function after AJAX is completed
                // checkClientStatus();
            });
        }

        function recoverBtn(order_id){
            if (confirm('Are you sure you want to recover this information?')) {
                var form_data = {
                    order_id : order_id
                };

                $.ajax({
                    url : "db/transactionRecover.php",
                    type : "POST",
                    data : form_data,
                    dataType: "json",
                    success: function(response){
                        if(response['valid'] == false){
                            alert(response['msg']);
                        }else{
                            alert("Transaction Recovered!");
                            location.reload();
                        }        
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Error: " + errorThrown);
                    }
                });

            }else {
            }
        }
    </script>
</body>

</html>