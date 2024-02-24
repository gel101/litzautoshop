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

        .box{
            margin:10px;
            padding: 20px;
            width: 316px;
            border-radius: 0.5rem;
        }
        .box img{
            width: 100%;
            height: 200px;
            object-fit: contain;
            object-position: center;
            margin-bottom: 1rem;
            overflow: hidden;
            /* mix-blend-mode: color-burn; */
            /* filter: hue-rotate(120deg); */
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
                                <h4 class="mb-sm-0">E-wallet</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Admin</a></li>
                                        <li class="breadcrumb-item">Archive</li>
                                        <li class="breadcrumb-item active">E-wallet</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


<!-- Main content -->

                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                            </div>
                        </div>
                        <div class="col-md-4 float-end">
                            <div class="input-group">
                                <input class="form-control" type="text" id="table-filter" placeholder="Search...">
                            </div>
                        </div>
                    </div>

                    <div class="card-container col-12">
                        
                            <?php
                                include 'db/connection.php';

                                $stmt = mysqli_query($conn, "SELECT * FROM orders WHERE reference_number!='' and payment_mode='Gcash' ORDER BY order_id DESC");

                                while($data = mysqli_fetch_assoc($stmt)){
                            ?>
                            
                        <div class="box card h-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 style="color:#007DFE" class="textSearch"><strong>E-wallet</strong></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                        <?php if ($data['screenshot'] != "") { ?>
                                    <a href="db/<?php echo $data['screenshot']; ?>"  target="_blank" class="h-auto w-50">
                                        <img src="db/<?php echo $data['screenshot']; ?>" alt="">
                                    </a>
                                        <?php }else{ ?>
                                        <img class="form-control" src="" alt="No Screenshot">
                                        <?php } ?>
                                        <br>
                                </div>
                                <div class="col-md-6">
                                        <div class="container text-center">
                                            <button type="button" class="btn btn-primary w-100" onclick="showClientInfo('<?php echo $data['cust_id']; ?>')" data-bs-toggle="modal" data-bs-target="#clientDetail"><i class="fas fa-user"></i></button>
                                        </div>
                                        <br>
                                    <p class="textSearch"><?php echo $data['tran_id']; ?></p>   
                                    <p class="textSearch"><?php echo $data['customerName']; ?></p>
                                    <p class="textSearch"><?php echo $data['reference_number']; ?></p>
                                    <p class="textSearch"><h5><span class="badge <?php 
                                                                            
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
                                        default:
                                            echo "bg-primary";
                                    }

                                    ?>"><?php echo $data['status']; ?></span></h5></p>


                                </div>
                            </div>
                        </div>
                            <?php
                            }
                            ?>

                    </div>


<!-- SHOW MORE INFO MODAL -->
<div class="modal fade" id="vanDetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Show All Requirements</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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



<!-- SHOW MORE INFO MODAL -->
<div class="modal fade" id="clientDetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Client Details</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <div id="showClientInfo">

                </div>
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

        function showReq(docuID, tran_id){
            $("#showReq").load("db/ajaxShowRequirements.php", {
                docu_id : docuID,
                tran_id : tran_id
            });
        }

        function showClientInfo(cust_id){
            $("#showClientInfo").load("db/ajaxShowClientProfile.php", {
                clientInfo : cust_id
            });
        }

        $(document).ready(function(){
            // Attach an event listener to the input field
            $("#table-filter").on("keyup", function () {
                var searchText = $(this).val().toLowerCase(); // Get the input value and convert it to lowercase

                // Loop through each .box card element
                $(".card-container .box.card").each(function () {
                    var rowData = $(this).find(".textSearch").text().toLowerCase(); // Get the text content within the .box card and convert it to lowercase
                    
                    // Check if the .box card contains the search text
                    if (rowData.indexOf(searchText) === -1) {
                        // If not, hide the .box card
                        $(this).hide();
                    } else {
                        // If yes, show the .box card
                        $(this).show();
                    }
                });
            });
        });




    </script>
</body>

</html>