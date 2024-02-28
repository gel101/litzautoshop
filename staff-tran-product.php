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
        .bg-gray{
            background-color: whitesmoke;
            color:black;
        }
        .bg-gray:hover{
            background-color: gray;
            color: whitesmoke;
        }

        .cartButton{
            position: absolute;
            right: 10px;
            bottom: 10px;
        }
        .cartName{
            bottom: 10px;
            height: 40px;
            padding: 0;
            margin: 0;
        }
        .formLayout{
            padding: 0;
            margin: 0;
        }
        .modal{
            overflow: auto;
        }
        /* *{
            border: 1px solid red;
        } */

        .referenceNo{
            display: none;
        }

        .referenceNo1{
            display: none;
        }
        
        .ereferenceNo{
            display: none;
        }
        
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
        .showDetails{
            resize: none;
            overflow: auto;
        }
        .receiptDiv, .receiptDiv2{
            display: none;
        }
        
    </style>

</head>

<body onload="checkClientStatus()">

    <!-- Begin page -->
    <div id="layout-wrapper">

<!-- HEADER -->
<?php include 'staff-header.php' ?>
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
        <?php include 'staff-sidebar.php' ?>

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
                                <h4 class="mb-sm-0">Order</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(o);">Staff</a></li>
                                        <li class="breadcrumb-item active">Current Order</li>
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
                                        <div class="col-md-2 col-sm-12">
                                            <!-- <button class="btn btn-primary" id="newOrderBtn" data-bs-toggle="modal" data-bs-target="#addNewOrder">New Order</button> -->
                                        </div>
                                        <div class="col-md-6 col-sm-12">
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
                                                <th scope="col">Customer Name</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Payment Status</th>
                                                <th scope="col">Official Receipt</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Transaction Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include 'db/connection.php';

                                            $stmt = mysqli_query($conn, "SELECT * FROM orders WHERE status!='canceled' ORDER BY order_id DESC");

                                            while($data = mysqli_fetch_assoc($stmt)){
                                            ?>
                                            <tr>
                                                <td><?php echo $data['tran_id']; ?></td>
                                                <td><?php echo $data['customerName']; ?></td>
                                                <td>&#8369; <?php echo number_format($data['totalprice'], 2); ?></td>
                                                <td><h6><?php 
                                                    if($data['payment_term'] == "Fully Paid") { ?>
                                                        <span class="badge bg-success"><?php echo $data['payment_term'];?></span>
                                                <?php }elseif($data['payment_term'] == "For Finance") { ?>
                                                        <span class="badge bg-success"><?php echo "For Finance";?></span>
                                                <?php }elseif($data['payment_term'] == "" && $data['status'] == "Declined") { ?>
                                                        <span class="badge bg-danger">Declined</span>
                                                <?php }else { ?>
                                                        <span class="badge bg-warning">Pending</span>
                                                <?php } ?></h6></td>
                                                <td><?php if($data['receipt'] == ""){echo "---";}else{ echo $data['receipt']; } ?></td>
                                                <td><?php $date = new DateTime($data['date']); $formattedDate = $date->format('m-d-Y'); echo $formattedDate; ?></td>
                                                <td><h5><span class="badge <?php 
                                                
                                                    $status = $data['status'];

                                                    if ($status === "Pending") {
                                                        echo "bg-warning";
                                                    } elseif ($status === "Accepted") {
                                                        echo "bg-info";
                                                    } elseif ($status === "Requirements Complete" || $status === "Order Preparing") {
                                                        echo "bg-secondary";
                                                    } elseif ($status === "Ready to Pick Up" || $status === "Completed") {
                                                        echo "bg-success";
                                                    } elseif ($status === "Declined" || $status === "Canceled") {
                                                        echo "bg-danger";
                                                    } else {
                                                        echo "bg-primary";
                                                    }

                                                ?>"><?php echo $data['status']; ?></span></h5></td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center"> <!-- Wrap buttons in a flex container -->
                                                        <button type="button" class="btn btn-warning me-1" onclick="showOrder(
                                                            '<?php echo $data['order_id']; ?>',
                                                            '<?php echo $data['cust_id']; ?>', 
                                                            '<?php echo $data['tran_id']; ?>', 
                                                            '<?php echo $data['status']; ?>', 
                                                            '<?php echo number_format($data['totalprice'], 2); ?>', 
                                                            '<?php echo $data['transaction_type']; ?>')" data-bs-toggle="modal" data-bs-target="#vanDetail"><i class="fas fa-eye"></i></button>
                                                        <button type="button" class="btn btn-primary" onclick="showClientInfo('<?php echo $data['cust_id']; ?>')" data-bs-toggle="modal" data-bs-target="#clientDetail"><i class="fas fa-user"></i></button>
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





<!-- Bootstrap Modal -->
<div class="modal fade" id="addNewOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Order</h5>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">Customer Name</label><span class="err_name text-danger"></span>
                        <input type="text" class="form-control" id="addname" placeholder="Enter name">

                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Email</label><span class="err_email text-danger"></span>
                        <input type="email" class="form-control" id="addemail" placeholder="Enter email">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 d-grid">
                        <button onclick="sparepartBtn()" id="spartorderBtn" class="btn btn-primary btn-lg">Spareparts</button>
                    </div>
                    <div class="col-md-6 d-grid">
                        <button onclick="carBtn()" id="carorderBtn" class="btn btn-secondary btn-lg">Car</button>
                    </div>
                </div>
                <br>
                <div class="row productContainer">
                    <div class="col-md-6">
                        <label for="addOrders" class="form-label">Product Name</label><span class="err_request text-danger"></span>
                        <select class="form-select" id="addOrders" name="addOrders" required>
                                            
                        <option value="">Select Product</option>
                                            <?php
                                                $stmtpaintdelete = mysqli_query($conn, "SELECT * FROM spareparts_accessories WHERE status='' AND quantity>0 ORDER BY sparepart_id DESC");
                                                while($data = mysqli_fetch_assoc($stmtpaintdelete)){
                                            ?>
                                            <option data-value-1="<?php echo $data['product']; ?>" data-value-2="<?php echo number_format($data['price'], 2); ?>" data-value-3="<?php echo $data['quantity']; ?>" data-value-4="<?php echo $data['details']; ?>" data-value-5="<?php echo $data['img']; ?>" data-value-6="<?php echo $data['sparepart_id']; ?>"><?php echo $data['product']; ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="vehicleType" class="form-label">Quantity</label><span class="err_vehicle text-danger"></span>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="quantity-button btn btn-light font-weight-bold" id="minusButton">-</button>
                                </div>
                                <div class="col-md-6">
                                    <input class="quantity-input form-control" type="number" id="addquantity" value="0" min="1">
                                </div>
                                <div class="col-md-3">
                                    <button class="quantity-button btn btn-light font-weight-bold" id="plusButton">+</button>
                                </div>
                                <label for="" class="form-label float-end" id="showquantity"></label>
                            </div>
                    </div>
                </div>
                <br>
                <div class="row productContainer">
                    <div class="col-md-6">
                        <input type="hidden" name="" id="showproduct">
                        <input type="hidden" name="" id="showid">
                        <input type="hidden" name="" id="showimg">
                        <label class="form-label">Product Price</label>
                        <h3 class="text-primary">&#8369; <span id="showprice"></span></h3>
                        <br>
                        <textarea name="" class="form-control showDetails" id="showDetails" cols="30" rows="10" disabled></textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="addpaymentModee">
                            <label for="" class="form-label">Payment Mode</label>
                                <select class="form-select" name="" id="addpaymentMode">
                                    <option value="E-wallet">E-wallet</option>
                                    <option value="Cash">Cash</option>
                                </select>
                        </div>
                        <div class="addreferenceNo">
                            <br>
                            <label for="" class="form-label">Reference Number</label>
                            <input type="number" class="form-control" id="addreferenceInput" required>
                            <br>
                            <label for="" class="form-label">E-wallet Screenshot</label>
                            <input type="file" name="gcashScreenshot" class="form-control" id="addgcashScreenshot">
                        </div>
                    </div>
                </div>
                <div class="row carContainer">
                    <div class="col-md-6">
                        <label for="addCars" class="form-label">Car Name</label><span class="err_request text-danger"></span>
                        <select class="form-select" id="addCars" name="addCars" required>
                                            
                        <option value="">Select Car</option>
                                            <?php
                                                $stmtpaintdelete = mysqli_query($conn, "SELECT * FROM cars WHERE status='' AND quantity>0 ORDER BY car_id DESC");
                                                while($data = mysqli_fetch_assoc($stmtpaintdelete)){
                                            ?>
                                            <option data-value-1="<?php echo $data['name']; ?>" 
                                            data-value-2="<?php echo number_format($data['price'], 2); ?>"
                                            data-value-3="<?php echo $data['quantity']; ?>" 
                                            data-value-4="<?php echo $data['details']; ?>" 
                                            data-value-5="<?php echo $data['car_img']; ?>" 
                                            data-value-6="<?php echo $data['car_id']; ?>"
                                            data-value-7="<?php echo $data['car_type']; ?>"
                                            data-value-8="<?php echo $data['model']; ?>"
                                            data-value-9="<?php echo $data['engine']; ?>"
                                            
                                            ><?php echo $data['name']; ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="" id="showcar">
                        <input type="hidden" name="" id="showcarid">
                        <input type="hidden" name="" id="showcarimg">
                        <input type="hidden" name="" id="showcarquantity">
                        <label class="form-label">Car Price</label>
                        <h3 class="text-secondary">&#8369; <span class="text-secondary" style="font-size:20px" id="showcarprice"></span> <span class="text-danger" style="font-size:16px" id="addedcarprice"></span></h3>
                        <label for="" class="form-label" id="showcarquantityLeft"></label><Span> quantity available</Span>
                    </div>
                </div>
                <br>
                <div class="row carContainer">
                    <div class="col-md-6">
                        <textarea name="" class="form-control showDetails" id="showcarDetails" cols="30" rows="10" disabled></textarea>
                        <textarea name="" class="d-none" id="showcarDetailsHide" cols="30" rows="10" disabled></textarea>
                        <input type="hidden" id="cartype" value="">
                        <input type="hidden" id="carmodel" value="">
                        <input type="hidden" id="carengine" value="">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Select Color</label>
                        <select class="form-select" name="" id="addcolor">
                                <?php
                                    $stmtpaintdelete = mysqli_query($conn, "SELECT paint_color FROM paints WHERE status='' AND quantity>0 ORDER BY paint_id DESC");
                                    while($data = mysqli_fetch_assoc($stmtpaintdelete)){
                                ?>
                                <option value="<?php echo $data['paint_color']; ?>"><?php echo $data['paint_color']; ?></option>

                                <?php
                                }
                                ?>
                        </select>
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addOrderBtn" onclick="addOrders()">Confirm</button>
                <button type="button" class="btn btn-primary" id="addcarBtn" onclick="addCars()">Confirm</button>
            </div>
        </div>
    </div>
</div>





<!-- SHOW MORE INFO MODAL -->
<div class="modal fade zoomIn" id="vanDetail">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Client's Order</h3>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                
                <input type="hidden" id="tranID" value="">
                <input type="hidden" id="clientID" value="">
                <input type="hidden" id="clientInfo" value="">
                <input type="hidden" id="clientStatus" value="">
                <input type="hidden" id="tranType" value="">
			</div>
			<div class="modal-body">
                <div class="card  table-responsive">
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
            <div class="modal-footer d-flex justify-content-between">
                <div id="leftSideBtn">
                    <button class="btn btn-primary" onclick="showReq(document.getElementById('clientInfo').value)" data-bs-toggle="modal" data-bs-target="#showAllReq" id="showReqBtn">SHOW <i class="fas fa-file"></i></button>
                    <button type="button" onclick="uploadFile(document.getElementById('clientID').value, document.getElementById('clientInfo').value)" class="btn btn-info" id="uploadReqBtn" data-bs-dismiss="modal">UPLOAD <i class="fas fa-file-upload"></i></button>
                </div>
                <div id="rightSideBtn">
                    <!-- <button class="btn bg-gray" data-bs-target="#editTranModal" data-bs-toggle="modal" data-bs-dismiss="modal" id="editBtn">EDIT PAYMENT STATUS</button> -->
                    <button class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#putPlateNumber" id="completeBtn">ORDER COMPLETE <i class="fas fa-check-double"></i></button>


                    <button class="btn btn-info" onclick="processTran(document.getElementById('clientID').value, document.getElementById('tranID').value, document.getElementById('clientInfo').value)" id="processBtn">PREPARE ORDER</button>
                    <button class="btn btn-success" onclick="processedTran(document.getElementById('clientID').value, document.getElementById('tranID').value, document.getElementById('clientInfo').value)" id="processedBtn">READY TO PICK UP</button>


                    <button class="btn btn-secondary" onclick="acceptBtn(document.getElementById('clientID').value, document.getElementById('clientInfo').value, document.getElementById('tranType').value)" id="acceptBtn">ACCEPT <i class="fas fa-check"></i></button>
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" data-bs-dismiss="modal" id="paymentBtn">ADD PAYMENT <i class="fas fa-check-circle"></i></button>
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" id="confirmBtn">REQUIREMENTS COMPLETE <i class="fas fa-check-circle"></i></button>
                    <!-- <button type="button" class="btn btn-danger" onclick="declineBtn(document.getElementById('clientInfo').value, document.getElementById('clientID').value, document.getElementById('tranID').value, document.getElementById('clientStatus').value)" id="declineBtn">DECLINE <i class="fas fa-ban"></i></button> -->
                </div>
            </div>
		</div>
	</div>
</div>
<!-- END OF SHOW MORE INFO MODAL -->


<!-- SHOW MORE INFO MODAL -->
<div class="modal fade zoomIn" id="showAllReq">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Show All Requirements</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="showReq">
                
			</div>
            <div class="modal-footer">
                <button data-bs-toggle="modal" data-bs-target="#vanDetail" class="btn btn-danger">CLOSE</button>
            </div>
		</div>
	</div>
</div>
<!-- END OF SHOW MORE INFO MODAL -->


<!-- ADD PLATE NUMBER MODAL -->
<div class="modal fade zoomIn" id="putPlateNumber">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Add Detail on Completed Car</h3>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <label for="" class="form-label">Insert Car's Plate Number</label><span id="plate_err" class="text-danger"></span>
                <input type="text" id="plateNum" class="form-control" oninput="inputPlate(this)">
			</div>
            <div class="modal-footer">
                <button data-bs-toggle="modal" data-bs-target="#vanDetail" class="btn btn-danger">BACK</button>
                <button type="button" class="btn btn-success" onclick="completeBtn(document.getElementById('tranID').value, document.getElementById('clientID').value, document.getElementById('clientInfo').value, document.getElementById('plateNum').value)">INSERT</button>
            </div>
		</div>
	</div>
</div>
<!-- END OF SHOW MORE INFO MODAL -->

<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalToggleLabel2">Payment Status</h3>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="form-label">Transaction price</label>
                        <h3 for="" class="font-italic ">&#8369; <span class="text-secondary" style="font-size:16px" id="showtranPrice"></span> <span class="text-danger" style="font-size:16px" id="addedprice"></span></h3>
                    </div>
                </div>
                <br>
                <label for="" class="form-label">Payment Term</label>
                <select class="form-select" name="" id="paymentTerm">
                    <option value="Fully Paid">Fully Paid</option>
                    <option value="For Finance">For Finance</option>
                </select>
                <span class="text-danger" id="payment_err" style="display:none;"> +8,250 for Processing Fee*</span>
                <br>
                <div class="paymentModee">
                    <label for="" class="form-label">Payment Mode</label>
                        <select class="form-select" name="" id="paymentMode">
                            <option value="Cash">Cash</option>
                            <option value="E-wallet">E-wallet</option>
                            <!-- <option value="For Finance">For Finance</option> -->
                        </select>
                        <br>
                    <div class="row" style="text-align:right;">
                        <label for="" class="form-label text-primary" style="text-decoration:underline; cursor:pointer" onclick="showReceiptDiv()">Issue a Receipt</label>
                    </div>
                </div>
                <!-- <div class="fullpayment">
                    <br>
                    <label for="" class="form-label">Payment Received</label>
                    <input type="number" id="paymentReceived" class="form-control">
                </div> -->
                <div class="receiptDiv">
                    <label for="" class="form-label">Official Receipt Number</label>
                    <input type="text" class="form-control" name="receipt" id="receipt">
                </div>
                <div class="referenceNo">
                    <!-- <br>
                    <div class="row">
                        <img src="img/system/gcash.jpg" alt="E-wallet QR Code">
                    </div> -->
                    <br>
                    <label for="" class="form-label">Reference Number</label>
                    <input type="number" class="form-control" id="referenceInput" required>
                    <br>
                    <label for="" class="form-label">Screenshot of E-wallet Payment</label><span id="err_ss" class="text-danger"></span>
                    <input type="file" name="gcashScreenshot" class="form-control" id="gcashScreenshot">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="approveBtn(document.getElementById('clientID').value, document.getElementById('clientInfo').value, document.getElementById('paymentTerm').value, document.getElementById('paymentMode').value, document.getElementById('referenceInput').value,  document.getElementById('receipt').value)">CONFIRM</button>
                <button class="btn btn-danger" data-bs-target="#vanDetail" data-bs-toggle="modal" data-bs-dismiss="modal">BACK</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalToggleLabel3">Payment Status</h3>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="form-label">Transaction price</label>
                        <h3 for="" class="font-italic ">&#8369; <span class="text-secondary" style="font-size:16px" id="showtranPrice1"></span> <span class="text-danger" style="font-size:16px" id="addedprice1"></span></h3>
                    </div>
                </div>
                <br>
                <label for="" class="form-label">Payment Term</label>
                <select class="form-select" name="" id="paymentTerm1">
                    <option value="Fully Paid">Fully Paid</option>
                    <!-- <option value="For Finance">For Finance</option> -->
                </select>
                <span class="text-danger" id="payment_err1" style="display:none;"> +8,250 for Processing Fee*</span>
                <br>
                <div class="paymentModee1">
                    <label for="" class="form-label">Payment Mode</label>
                        <select class="form-select" name="" id="paymentMode1">
                            <option value="Cash">Cash</option>
                            <option value="E-wallet">E-wallet</option>
                            <!-- <option value="For Finance">For Finance</option> -->
                        </select>
                </div>
                <br>
                <div class="row" style="text-align:right;">
                    <label for="" class="form-label text-primary" style="text-decoration:underline; cursor:pointer" onclick="showReceiptDiv2()">Issue a Receipt</label>
                </div>
                <div class="receiptDiv2">
                    <label for="" class="form-label">Official Receipt Number</label>
                    <input type="text" class="form-control" name="receipt2" id="receipt2">
                </div>
                <!-- <div class="fullpayment">
                    <br>
                    <label for="" class="form-label">Payment Received</label>
                    <input type="number" id="paymentReceived" class="form-control">
                </div> -->
                <div class="referenceNo1">
                    <!-- <br>
                    <div class="row">
                        <img src="img/system/gcash.jpg" alt="E-wallet QR Code">
                    </div> -->
                    <br>
                    <label for="" class="form-label">Reference Number</label>
                    <input type="number" class="form-control" id="referenceInput1" required>
                    <br>
                    <label for="" class="form-label">Screenshot of E-wallet Payment</label><span id="err_ss1" class="text-danger"></span>
                    <input type="file" name="gcashScreenshot1" class="form-control" id="gcashScreenshot1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="approveBtnsparepart(document.getElementById('clientID').value, document.getElementById('clientInfo').value, document.getElementById('paymentTerm1').value, document.getElementById('paymentMode1').value, document.getElementById('referenceInput1').value, document.getElementById('receipt2').value)">CONFIRM</button>
                <button class="btn btn-danger" data-bs-target="#vanDetail" data-bs-toggle="modal" data-bs-dismiss="modal">BACK</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editTranModal" aria-hidden="true" aria-labelledby="editModalToggleLabel3" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="editModalToggleLabel3">Edit Payment Status</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="" class="form-label">Payment Term</label>
            <select class="form-select" name="" id="editpaymentTerm">
                <!-- <option value="No Pay Yet">No Pay Yet</option> -->
                <option value="Fully Paid">Fully Paid</option>
                <!-- <option value="Down Payment">Down Payment</option> -->
                <option value="For Finance">For Finance</option>
            </select>
            <br>
            <div class="epaymentModee">
                <label for="" class="form-label">Payment Mode</label>
                    <select class="form-select" name="" id="editpaymentMode">
                        <option value="Cash">Cash</option>
                        <option value="E-wallet">E-wallet</option>
                        <!-- <option value="For Finance">For Finance</option> -->
                    </select>
            </div>
            <!-- <div class="efullpayment">
                <br>
                <label for="" class="form-label">Payment Received</label>
                <input type="number" id="editpaymentReceived" class="form-control">
            </div> -->
            <div class="ereferenceNo">
                <br>
                <label for="" class="form-label">Reference Number</label>
                <input type="number" class="form-control" id="editreferenceInput" required>
                <br>
                <label for="" class="form-label">Screenshot of E-wallet Payment</label>
                <input type="file" name="editgcashScreenshot" class="form-control" id="editgcashScreenshot">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="editapproveBtn(document.getElementById('clientInfo').value, document.getElementById('editpaymentTerm').value, document.getElementById('editpaymentMode').value, document.getElementById('editreferenceInput').value)">APPROVE</button>
            <button class="btn btn-danger" data-bs-target="#vanDetail" data-bs-toggle="modal" data-bs-dismiss="modal">BACK</button>
        </div>
    </div>
  </div>
</div>




<!-- SHOW MORE INFO MODAL -->
<div class="modal fade zoomIn" id="clientDetail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="title">Client Details</h3>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
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




<!-- FILE IMAGE MODAL -->
<div class="modal fade" id="fileUploadModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
                <input type="hidden" name="cust_id" id="cust_id">
                <input type="hidden" name="tran_id" id="tran_id">
				<h3 id="title">Requirement Details</h3>
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
			</div>
			<div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row cntr">
                            <button style="height:70px" onclick="employeed()" id="btn1" class="btn button-transition btn-success w-75 justify-content-center"><span class="material-symbols-outlined">person_apron</span>EMPLOYED</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row cntr">
                            <button style="height:70px" onclick="Semployeed()" id="btn2" class="btn button-transition btn-secondary w-75 justify-content-center"><span class="material-symbols-outlined">badge</span>SELF-EMPLOYED</button>
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
                                <label for="" class="form-label">Wife / Spouse Valid ID</label><span class="text-danger"> *Optional</span>
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
                                <label for="" class="form-label">Wife / Spouse Valid ID</label><span class="text-danger"> *Optional</span>
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

        

		function inputPlate(input){
            // Define the regular expression pattern for the desired format
            var tempPlatePattern = /^[A-Z]{3}\s\d{4}$/;

            // Test if the tempPlate value matches the pattern
            if (!tempPlatePattern.test(input.value)) {
                $("#plate_err").html(" *Verify the Plate Number Format (e.g., ABC 1234)");
            }else{
                $("#plate_err").html(" ");
            }
        }

        function carBtn(){
            $('#spartorderBtn').css("opacity", "0.5");
            $('#carorderBtn').css("opacity", "1");
            $('.productContainer').hide();
            $('.carContainer').show();
            $('#addOrderBtn').hide();
            $('#addcarBtn').show();
        }
        
        function sparepartBtn(){
            $('#carorderBtn').css("opacity", "0.5");
            $('#spartorderBtn').css("opacity", "1");
            $('.productContainer').show();
            $('.carContainer').hide();
            $('#addOrderBtn').show();
            $('#addcarBtn').hide();
        }
        
        const minusButton = document.getElementById('minusButton');
        const plusButton = document.getElementById('plusButton');
        const addquantity = document.getElementById('addquantity');

        minusButton.addEventListener('click', () => {
            decreaseQuantity();
        });

        plusButton.addEventListener('click', () => {
            increaseQuantity();
        });

        function decreaseQuantity() {
            let quantity = parseInt(addquantity.value);
            if (quantity > 0) {
                quantity--;
            }
            addquantity.value = quantity;
        }

        function increaseQuantity() {
            let quantity = parseInt(addquantity.value);
            quantity++;
            addquantity.value = quantity;
        }

        
        function processTran(cust_id,order_id,tran_id){
            // alert(order_id);
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
            var day = currentDate.getDate().toString().padStart(2, '0');
            var formattedDate = year + '-' + month + '-' + day;

            if (confirm("Do you want to Prepare the Order?")) {
					var form_data = {
                        cust_id : cust_id,
                        order_id : order_id,
                        date : formattedDate,
                        tran_id : tran_id
					};

					$.ajax({
                        url : "db/transactionProcessing.php",
                        type : "POST",
                        data : form_data,
                        dataType: "json",
                        beforeSend: function () {
                            $('.dismissBtn').click();
                            $('#loadingModal').modal('show');
                        },
                        success: function(response){
                            if(response['valid'] == false){
                                alert(response['msg']);
                            }else{
                                // $('.messageText').text('Transaction Order Preparing!'); // Change the text
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

        function processedTran(cust_id, order_id, tran_id){
            // alert(order_id);
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
            var day = currentDate.getDate().toString().padStart(2, '0');
            var formattedDate = year + '-' + month + '-' + day;

            if (confirm("Is the Order ready for Pick Up?")) {
					var form_data = {
                        cust_id : cust_id,
                        order_id : order_id,
                        date : formattedDate,
                        tran_id : tran_id
					};

                    // Show the custom loading modal in beforeSend
                    $('#loadingModal').modal('show');

					$.ajax({
                        url : "db/transactionProcessed.php",
                        type : "POST",
                        data : form_data,
                        dataType: "json",
                        beforeSend: function () {
                            $('#loadingModal').modal('show');
                            $('.dismissBtn').click();
                        },
                        success: function(response){
                            if (response['valid'] == false) {
                                $('#loadingModal').modal('hide');
                                alert(response['msg']);
                                setTimeout(function () {
                                    location.reload();
                                },1000);
                            } else {
                    
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
                                    // },
                                    complete: function () {
                                        $('#successModal').modal('show');

                                        // Close successModal after 2 seconds and trigger redirection
                                        setTimeout(function () {
                                            $('#successModal').modal('hide');
                                            location.reload();
                                        },1000);
                                    }
                                });
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            $('#loadingModal').modal('hide'); // Hide the modal on error
                            alert("Error: " + errorThrown);
                        }
                    });

				}else {
			}
        }
        
        function showReq(tran_id){
            $("#showReq").load("db/ajaxShowRequirements.php", {
                tran_id : tran_id
            });
        }

        function checkClientStatus() {
            var clientStatus = $('#clientStatus').val();
            var tranType = $('#tranType').val();
            var uploadReqBtn = $('#uploadReqBtn');
            var showReqBtn = $('#showReqBtn');
            var acceptBtn = $('#acceptBtn');
            var editBtn = $('#editBtn');
            var confirmBtn = $('#confirmBtn');
            var paymentBtn = $('#paymentBtn');
            var processBtn = $('#processBtn');
            var processedBtn = $('#processedBtn');
            var declineBtn = $('#declineBtn');
            var completeBtn = $('#completeBtn');


            if (tranType == "car" && clientStatus == "Accepted" || clientStatus == "Requirements Complete" || clientStatus == "Order Preparing" || clientStatus == "Ready to Pick Up") {
                uploadReqBtn.show();
                showReqBtn.show();
                editBtn.show();
            } else {
                uploadReqBtn.hide();
                showReqBtn.hide();
                editBtn.hide();
            }

            if (clientStatus != "Pending") {
                acceptBtn.hide();
            } else {
                acceptBtn.show();
            }

            if (clientStatus == "Accepted" && tranType == "car") {
                confirmBtn.show();
            } else {
                confirmBtn.hide();
            }
            
            if (clientStatus == "Accepted" && tranType == "sparepart") {
                paymentBtn.show();
            } else {
                paymentBtn.hide();
            }

            if (clientStatus == "Pending" || clientStatus == "Accepted" ) {
                declineBtn.show();
            }else{
                declineBtn.hide();
            }

            if (clientStatus != "Requirements Complete") {
                processBtn.hide();
            }else{
                processBtn.show();
            }

            if (clientStatus != "Order Preparing") {
                processedBtn.hide();
            }else{
                
                processedBtn.show();
            }
            
            if (clientStatus != "Ready to Pick Up") {
                completeBtn.hide();
            } else {
                completeBtn.show();
            }

        }


        function showOrder(tranID, custId, id, status, price, transaction_type) {
            var tranID = tranID;
            var custID = custId;
            var tran_id = id;
            var status = status;

            $("#tranID").val(tranID);
            $("#clientID").val(custId);
            $("#clientInfo").val(id);
            $("#clientStatus").val(status);
            $("#tranType").val(transaction_type);
            $("#showtranPrice").text(price);
            $("#showtranPrice1").text(price);

            $("#clientsOrder").load("db/ajaxShowOrder.php", {
                // thecustomerID: custId,
                thetran_id: id,
                tranStatus: status
            }, function() {
                // Callback function after AJAX is completed
                checkClientStatus();
            });
        }


        function showClientInfo(cust_id){
            $("#showClientInfo").load("db/ajaxShowClientProfile.php", {
                clientInfo : cust_id
            });
        }

        function showReceiptDiv(){
            $('.receiptDiv').css("display", "block");
            $('#receipt').val("");
        }

        function showReceiptDiv2(){
            $('.receiptDiv2').css("display", "block");
            $('#receipt2').val("");
        }

        $(document).ready(function () {

            $('#newOrderBtn').click(function(){
                $('.productContainer').hide();
                $('.carContainer').hide();
                $('#addOrderBtn').hide();
                $('#addcarBtn').hide();
            })
            
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


            // Add event listener to the select element
            $('#addOrders').change(function () {
                // Get the selected option
                var selectedOption = $(this).find('option:selected');

                // Get the values from the data attributes
                var product = selectedOption.data('value-1');
                var price = selectedOption.data('value-2');
                var formattedPrice = price.toLocaleString();
                var quantity = selectedOption.data('value-3');
                var details = selectedOption.data('value-4');
                var img = selectedOption.data('value-5');
                var id = selectedOption.data('value-6');

                // Display the values in the input fields
                $('#showid').val(id);
                $('#showproduct').val(product);
                $('#showimg').val(img);
                $('#showprice').text(formattedPrice);
                details = details.replace(/\n/g, '<br>');
                $('#showDetails').val(details.replace(/<br>/g, '\n'));
                $('#showquantity').text(quantity + " quantity left");
            });
            
            // Add event listener to the select element
            $('#addCars').change(function () {
                // Get the selected option
                var selectedOption = $(this).find('option:selected');

                // Get the values from the data attributes
                var product = selectedOption.data('value-1');
                var price = selectedOption.data('value-2');
                var formattedPrice = price.toLocaleString();
                var quantity = selectedOption.data('value-3');
                var details = selectedOption.data('value-4');
                var img = selectedOption.data('value-5');
                var id = selectedOption.data('value-6');
                var cartype = selectedOption.data('value-7');
                var model = selectedOption.data('value-8');
                var engine = selectedOption.data('value-9');

                // Display the values in the input fields
                $('#showcarid').val(id);
                $('#showcar').val(product);
                $('#showcarimg').val(img);
                $('#showcarprice').text(formattedPrice);
                details = details.replace(/\n/g, '<br>');
                $('#showcarDetails').val("Car Type :" + cartype + "\nModel: " + model + "\nEngine: " + engine + "\n\nDetails: " + details.replace(/<br>/g, '\n'));
                $('#showcarDetailsHide').val(details.replace(/<br>/g, '\n'));
                $('#cartype').val(cartype);
                $('#carmodel').val(model);
                $('#carengine').val(engine);
                $('#showcarquantity').val(quantity);
                $('#showcarquantityLeft').text(quantity);
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
                            $('.dismissBtn').click();
                            var responseData = JSON.parse(response);
                            if(responseData.valid == false){
                                $('#loadingModal').modal('hide');
                                alert(responseData.msg);
                            } else {
                                $('#loadingModal').modal('hide');
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
                            $('.dismissBtn').click();
                            var responseData = JSON.parse(response);
                            if(responseData.valid == false){
                                alert(responseData.msg);
                                $('#loadingModal').modal('hide');
                            } else {
                                $('#loadingModal').modal('hide');
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


        });

    
        function addOrders(){
            var valid = true;
            var rawPrice = $('#showprice').text().replace(/[^\d.]/g, '');
            var rawQuantity = $('#showquantity').text().replace(/[^0-9]/g, '');

            var addname = $('#addname').val();
            var addemail = $('#addemail').val();
            var addid = $('#showid').val();
            var addproduct = $('#showproduct').val();
            var addimg = $('#showimg').val();
            // If you want to convert them to numbers
            var addprice = parseFloat(rawPrice);
            var addquantity = $('#addquantity').val();
            var adddetails = $('#showDetails').val();
            var addquantityleft = parseInt(rawQuantity, 10);

            var addscreenshot = $("#addgcashScreenshot").prop("files")[0]; // Get the file object
            var addpaymentTerm = "Fully Paid";
            var addpaymentMode = $('#addpaymentMode').val();
            var addreferenceInput = $('#addreferenceInput').val();
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
            var day = currentDate.getDate().toString().padStart(2, '0');
            var addformattedDate = year + '-' + month + '-' + day;


            if (addpaymentMode == "E-wallet") {
                if (addreferenceInput == "" || addreferenceInput == "e") {
                    var valid = false;
                    alert("Reference Number Invalid");
                }

                var addreferenceInput = "RN: " + addreferenceInput;
            }

            if (addscreenshot == "undefined") {
                var valid = false;
                alert("E-wallet Screenshot Empty!");
            }
        
            if (addname == "") {
                var valid = false;
                alert("Customer Name Invalid");
            }
            if (addemail == "") {
                var valid = false;
                alert("Customer Email Invalid");
            }
            if (addproduct == "") {
                var valid = false;
                alert("Product Invalid");
            }
            if (addprice == "") {
                var valid = false;
                alert("Price Invalid");
            }
            if (addquantity < 1) {
                var valid = false;
                alert("Quantity Invalid");
            }
            if (addquantityleft == "") {
                var valid = false;
                alert("Left Quantity Invalid");
            }

            if (valid && confirm("Continue the process?")) {
                var form_data = new FormData();
                form_data.append("addname", addname);
                form_data.append("addemail", addemail);
                form_data.append("addid", addid);
                form_data.append("addimg", addimg);
                form_data.append("addproduct", addproduct);
                form_data.append("addprice", addprice);
                form_data.append("addquantity", addquantity);
                form_data.append("addquantityleft", addquantityleft);
                form_data.append("adddetails", adddetails);
                form_data.append("addscreenshot", addscreenshot);
                form_data.append("addpaymentTerm", addpaymentTerm);
                form_data.append("addpaymentMode", addpaymentMode);
                form_data.append("addreferenceInput", addreferenceInput);
                form_data.append("adddate", addformattedDate);


                // Send the image data and other form data to PHP using AJAX
                $.ajax({
                    url: "db/transactionAddNew.php",
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
                    success: function (response) {
                        $('#loadingModal').modal('hide'); // Hide the modal on success
                        var responseData = JSON.parse(response);
                        if (responseData.valid == false) {
                            alert(responseData.msg);
                        $('#loadingModal').modal('hide');
                        } else {
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
            }
        }
        
        function addCars(){
            var valid = true;
            var rawPrice = $('#showcarprice').text().replace(/[^\d.]/g, '');
            // var rawQuantity = $('#showcarquantity').text().replace(/[^0-9]/g, '');

            var addname = $('#addname').val();
            var addemail = $('#addemail').val();
            var addid = $('#showcarid').val();
            var addproduct = $('#showcar').val();
            var addimg = $('#showcarimg').val();
            var addcartype = $('#cartype').val();
            var addcolor = $('#addcolor').val();
            var addmodel = $('#carmodel').val();
            var addengine = $('#carengine').val();
            // If you want to convert them to numbers
            var addprice = parseFloat(rawPrice);
            // alert(addprice);
            var addquantity = 1;
            var addquantityLeft = $('#showcarquantity').val();
            var adddetails = $('#showcarDetailshide').val();
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
            var day = currentDate.getDate().toString().padStart(2, '0');
            var addformattedDate = year + '-' + month + '-' + day;

            if (addname == "") {
                var valid = false;
                alert("Customer Name Invalid");
            }
            if (addemail == "") {
                var valid = false;
                alert("Customer Email Invalid");
            }
            if (addproduct == "") {
                var valid = false;
                alert("Car Name Invalid");
            }


            if (valid && confirm("Continue the process?")) {
                var form_data = new FormData();
                form_data.append("addname", addname);
                form_data.append("addemail", addemail);
                form_data.append("addid", addid);
                form_data.append("addimg", addimg);
                form_data.append("addproduct", addproduct);
                form_data.append("addcartype", addcartype);
                form_data.append("addcolor", addcolor);
                form_data.append("addmodel", addmodel);
                form_data.append("addengine", addengine);
                form_data.append("addprice", addprice);
                form_data.append("addquantity", addquantity);
                form_data.append("addquantityLeft", addquantityLeft);
                form_data.append("adddetails", adddetails);
                form_data.append("adddate", addformattedDate);


                // Send the image data and other form data to PHP using AJAX
                $.ajax({
                    url: "db/transactionAddNewCar.php",
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
                    success: function (response) {
                        $('#loadingModal').modal('hide'); // Hide the modal on success
                        var responseData = JSON.parse(response);
                        if (responseData.valid == false) {
                            alert(responseData.msg);
                        $('#loadingModal').modal('hide');
                        } else {
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
            }
        }


    function addAmount() {
        var showtranPriceElement = document.getElementById("showtranPrice");
        var addedpriceElement = document.getElementById("addedprice");
        
        var showcarPrice = document.getElementById("showcarprice");
        var addedcarprice = document.getElementById("addedcarprice");

        // Get the current value of showtranPrice and convert it to a number
        var currentAmount = parseFloat(showtranPriceElement.innerText.replace(',', ''));

        // Add 8250 to the current amount
        var newAmount = (currentAmount + 8250).toFixed(2);

        // Update the showtranPrice element with the new amount
        showtranPriceElement.innerText = formatCurrency(newAmount);

        // Update the addedprice element
        addedpriceElement.innerText = "+ 8,250.00";
        
        var currentAmount1 = parseFloat(showcarPrice.innerText.replace(',', ''));
        var newAmount1 = (currentAmount1 + 8250).toFixed(2);
        showcarPrice.innerText = formatCurrency(newAmount1);
        addedcarprice.innerText = "+8,250.00";
    }

    // Function to subtract 8250 from showtranPrice
    function subtractAmount() {
        var showtranPriceElement = document.getElementById("showtranPrice");
        var addedpriceElement = document.getElementById("addedprice");

        
        var showcarPrice = document.getElementById("showcarprice");
        var addedcarprice = document.getElementById("addedcarprice");

        // Get the current value of showtranPrice and convert it to a number
        var currentAmount = parseFloat(showtranPriceElement.innerText.replace(',', ''));

        // Subtract 8250 from the current amount
        var newAmount = (currentAmount - 8250).toFixed(2);

        // Update the showtranPrice element with the new amount
        showtranPriceElement.innerText = formatCurrency(newAmount);

        
        var currentAmount1 = parseFloat(showcarPrice.innerText.replace(',', ''));
        var newAmount1 = (currentAmount1 - 8250).toFixed(2);
        showcarPrice.innerText = formatCurrency(newAmount1);
        addedcarprice.innerText = "";
    }

    // Function to format the currency with commas
    function formatCurrency(amount) {
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
        
    const paymentTerm = document.getElementById('paymentTerm');
    const paymentMode = document.getElementById('paymentMode');
    const paymentMode1 = document.getElementById('paymentMode1');
    // const paymentReceived = document.getElementById('paymentReceived');
    const paymentModee = document.getElementsByClassName('paymentModee')[0];
    const paymentModee1 = document.getElementsByClassName('paymentModee1')[0];
    // const fullpayment = document.getElementsByClassName('fullpayment')[0];
    const referenceNo = document.getElementsByClassName('referenceNo')[0];
    const referenceNo1 = document.getElementsByClassName('referenceNo1')[0];
    const referenceInput = document.getElementById('referenceInput');
    const referenceInput1 = document.getElementById('referenceInput1');
    const gcashScreenshot = document.getElementById('gcashScreenshot');
    const gcashScreenshot1 = document.getElementById('gcashScreenshot1');
    const payment_err = document.getElementById('payment_err');
    const payment_err1 = document.getElementById('payment_err1');

    
    const addpaymentMode = document.getElementById('addpaymentMode');
    // const paymentReceived = document.getElementById('paymentReceived');
    const addpaymentModee = document.getElementsByClassName('addpaymentModee')[0];
    // const fullpayment = document.getElementsByClassName('fullpayment')[0];
    const addreferenceNo = document.getElementsByClassName('addreferenceNo')[0];
    const addreferenceInput = document.getElementById('addreferenceInput');
    const addgcashScreenshot = document.getElementById('addgcashScreenshot');
    


    paymentTerm.addEventListener('change', function() {
        if (paymentTerm.value === "For Finance") {
            // $('#addedprice').text('+8,250.00 for Processing Fee*');
            paymentModee.style.display = "none";
            payment_err.style.display = "block";
            // fullpayment.style.display = "none";
            referenceNo.style.display = "none";
            paymentMode.value = "";
            // paymentReceived.value = "";
            gcashScreenshot.value = "";
            referenceInput.value = "";
            $('.receiptDiv').css("display", "none");
            $('#receipt').val("");
            $('.receiptDiv2').css("display", "none");
            $('#receipt2').val("");
            addAmount();
        } else {
            paymentModee.style.display = "block";
            payment_err.style.display = "none";
            $('#addedprice').text('');
            paymentMode.value = "Cash";
            $('.receiptDiv').css("display", "none");
            $('#receipt').val("");
            $('.receiptDiv2').css("display", "none");
            $('#receipt2').val("");
            // fullpayment.style.display = "block";
            subtractAmount();
        }
    });
    
    paymentMode.addEventListener('change', function() {
        if (paymentMode.value === "E-wallet") {
            referenceNo.style.display = "block";
        } else {
            referenceNo.style.display = "none";
            referenceInput.value = "";
            gcashScreenshot.value = "";
        }
    });
    
    paymentMode1.addEventListener('change', function() {
        if (paymentMode1.value === "E-wallet") {
            referenceNo1.style.display = "block";
        } else {
            referenceNo1.style.display = "none";
            referenceInput1.value = "";
            gcashScreenshot1.value = "";
        }
    });

    addpaymentMode.addEventListener('change', function() {
        if (addpaymentMode.value === "E-wallet") {
            addreferenceNo.style.display = "block";
        } else {
            addreferenceNo.style.display = "none";
            addreferenceInput.value = "";
            gcashScreenshot.value = "";
        }
    });
    
    
    const epaymentTerm = document.getElementById('editpaymentTerm');
    const epaymentMode = document.getElementById('editpaymentMode');
    // const epaymentReceived = document.getElementById('editpaymentReceived');
    const epaymentModee = document.getElementsByClassName('epaymentModee')[0];
    // const efullpayment = document.getElementsByClassName('efullpayment')[0];
    const ereferenceNo = document.getElementsByClassName('ereferenceNo')[0];
    const ereferenceInput = document.getElementById('editreferenceInput');
    const egcashScreenshot = document.getElementById('editgcashScreenshot');

    epaymentTerm.addEventListener('change', function() {
        if (epaymentTerm.value === "For Finance") {
            epaymentModee.style.display = "none";
            // efullpayment.style.display = "none";
            ereferenceNo.style.display = "none";
            epaymentMode.value = "";
            // epaymentReceived.value = "";
            egcashScreenshot.value = "";
            ereferenceInput.value = "";
        } else {
            epaymentModee.style.display = "block";
            // efullpayment.style.display = "block";
        }
    });

    epaymentMode.addEventListener('change', function() {
        if (epaymentMode.value === "E-wallet") {
            ereferenceNo.style.display = "block";
        } else {
            ereferenceNo.style.display = "none";
            ereferenceInput.value = "";
            egcashScreenshot.value = "";
        }
    });
    

    function uploadFile(id, tran_id){
        var fileUploadModal = new bootstrap.Modal(document.getElementById("fileUploadModal"));
        fileUploadModal.show();
        $("#cust_id").val(id);
        $("#tran_id").val(tran_id);
    }
    
    const con1 = document.getElementById("con1");
        const con2 = document.getElementById("con2");
        const btn1 = document.getElementById("btn1");
        const btn2 = document.getElementById("btn2");


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
        

    function acceptBtn(cust_id, tran_id, transaction_type) {
        var valid = true;

        if (valid) {
            if (confirm('Accept the Order?')) {
                var form_data = {
                    cust_id: cust_id,
                    tran_id: tran_id,
                    transaction_type: transaction_type
                };

                $.ajax({
                    url: "db/transactionAccept.php",
                    type: "POST",
                    data: form_data,
                    dataType: "json",
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
                    success: function (response) {
                        if (response['valid'] == false) {
                            $('#loadingModal').modal('hide');
                            alert(response['msg']);
                            setTimeout(function () {
                                location.reload();
                            },1000);
                        } else {

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
                                // },
                                complete: function () {
                                        $('#successModal').modal('show');

                                        // Close successModal after 2 seconds and trigger redirection
                                        setTimeout(function () {
                                            $('#successModal').modal('hide');
                                            location.reload();
                                        },1000);
                                }
                            });

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Error: " + errorThrown);
                        $('#loadingModal').modal('hide'); // Hide the modal on error
                    }
                });
            } else {
                // Handle the case when the user selects "No"
            }
        }
    }


    function approveBtn(cust_id, tran_id, paymentTerm, paymentMode, referenceInput, receipt) {
        var valid = true;
        var screenshot = $("#gcashScreenshot").prop("files")[0]; // Get the file object

        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var day = currentDate.getDate().toString().padStart(2, '0');
        var formattedDate = year + '-' + month + '-' + day;

        if (paymentTerm == "Fully Paid") {
            if (paymentMode == "") {
                var valid = false;
                alert("Payment Mode Invalid");
            }
        }

        if (paymentMode == "E-wallet") {
            if (referenceInput == "" || referenceInput == "e") {
                var valid = false;
                alert("Reference Number Invalid");
            }

            var referenceInput = "RN: " + referenceInput;

            if (typeof screenshot === "undefined" || screenshot === null) {
                valid = false;
				$("#err_ss").html(" *Please add proof of payment");
            }
        }


        if (tran_id == "") {
            valid = false;
            alert("Customer ID Empty");
        }

        if (valid) {
            if (confirm('Is the Transaction Requirements Complete?')) {
                var form_data = new FormData();
                form_data.append("screenshot", screenshot);
                form_data.append("cust_id", cust_id);
                form_data.append("tran_id", tran_id);
                form_data.append("paymentTerm", paymentTerm);
                form_data.append("paymentMode", paymentMode);
                form_data.append("receipt", receipt);
                form_data.append("referenceInput", referenceInput);
                form_data.append("date", formattedDate);

                // Send the image data and other form data to PHP using AJAX
                $.ajax({
                    url: "db/transactionUpdate.php",
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
                    success: function (response) {
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
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#loadingModal').modal('hide'); // Hide the modal on error
                        alert("Error: " + errorThrown);
                    },
                    complete: function () {
                        $('#loadingModal').modal('hide');
                    }
                });
            }
        }
    }
    
    function approveBtnsparepart(cust_id, tran_id, paymentTerm, paymentMode, referenceInput, receipt) {
        var valid = true;
        var screenshot = $("#gcashScreenshot1").prop("files")[0]; // Get the file object

        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var day = currentDate.getDate().toString().padStart(2, '0');
        var formattedDate = year + '-' + month + '-' + day;

        if (paymentTerm == "Fully Paid") {
            if (paymentMode == "") {
                var valid = false;
                alert("Payment Mode Invalid");
            }
        }

        if (paymentMode == "E-wallet") {
            if (referenceInput == "" || referenceInput == "e") {
                var valid = false;
                alert("Reference Number Invalid");
            }

            var referenceInput = "RN: " + referenceInput;

            if (typeof screenshot === "undefined" || screenshot === null) {
                valid = false;
				$("#err_ss1").html(" *Please add proof of payment");
            }
        }


        if (tran_id == "") {
            valid = false;
            alert("Customer ID Empty");
        }

        if (valid) {
            if (confirm('Is the Order Complete?')) {
                var form_data = new FormData();
                form_data.append("screenshot", screenshot);
                form_data.append("cust_id", cust_id);
                form_data.append("tran_id", tran_id);
                form_data.append("paymentTerm", paymentTerm);
                form_data.append("paymentMode", paymentMode);
                form_data.append("receipt", receipt);
                form_data.append("referenceInput", referenceInput);
                form_data.append("date", formattedDate);

                // Send the image data and other form data to PHP using AJAX
                $.ajax({
                    url: "db/transactionUpdateSparepart.php",
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
                    success: function (response) {
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
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#loadingModal').modal('hide'); // Hide the modal on error
                        alert("Error: " + errorThrown);
                    },
                    complete: function () {
                        $('#loadingModal').modal('hide');
                    }
                });
            }
        }
    }

    
    function editapproveBtn(tran_id, paymentTerm, paymentMode,  referenceInput) {
        var valid = true;
        var screenshot = $("#editgcashScreenshot").prop("files")[0]; // Get the file object

        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var day = currentDate.getDate().toString().padStart(2, '0');
        var formattedDate = year + '-' + month + '-' + day;

        // if (paymentReceived != "") {
        //     var paymentReceived = " ₱" + Number(paymentReceived).toLocaleString();
        // }
        
        if (referenceInput != "") {
            var referenceInput = "RN: " + referenceInput;
        }

        if (screenshot == "undefined") {
            valid = false;
            alert("E-wallet Screenshot Empty!");
        }

        if (tran_id == "") {
            valid = false;
            alert("Customer ID is empty");
        }

        // alert(paymentReceived);
        if (valid) {
            if (confirm("Is the Transaction Requirements Complete?")) {
            var form_data = new FormData();
            form_data.append("screenshot", screenshot);
            form_data.append("tran_id", tran_id);
            form_data.append("paymentTerm", paymentTerm);
            form_data.append("paymentMode", paymentMode);
            // form_data.append("paymentReceived", paymentReceived);
            form_data.append("referenceInput", referenceInput);
            form_data.append("date", formattedDate);

				// Send the image data and other form data to PHP using AJAX
				$.ajax({
					url: "db/transactionEdit.php",
					type: "POST",
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response){
						var responseData = JSON.parse(response);
						if(responseData.valid == false){
							alert(responseData.msg);
						} else {
                            $('#successModal').modal('show');

                            // Close successModal after 2 seconds and trigger redirection
                            setTimeout(function () {
                                $('#successModal').modal('hide');
                                location.reload();
                            },1000);
						}
					}
				});
            }
        }
    }

    
    function completeBtn(order_id, cust_id, tran_id, plateNum) {
        var valid = true;

        if (plateNum == "") {
            valid = false;
            // alert("Insert Plate Number!");
            $('#plate_err').html(" *Required");
        }

        if (order_id == "") {
            valid = false;
            alert("Order ID is empty");
        }

        if (tran_id == "") {
            valid = false;
            alert("Transaction ID is empty");
        }


        if (valid) {
            if (confirm('Are you sure this Order has been completed?')) {
                var form_data = {
                    order_id : order_id,
                    cust_id : cust_id,
                    tran_id : tran_id,
                    plateNum : plateNum
                };

                $.ajax({
                    url : "db/transactionComplete.php",
                    type : "POST",
                    data : form_data,
                    dataType: "json",
                    beforeSend: function () {
                        $('#loadingModal').modal('show');
                        $('.dismissBtn').click();
                    },
                    success: function(response){
                        $('#loadingModal').modal('hide');
                        if(response['valid'] == false){
                            alert(response['msg']);
                            $('#loadingModal').modal('hide');
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


    

    
    function declineBtn(tran_id, cust_id, order_id, order_status){
        var valid = true;
        var tran_id = tran_id;

        
        if (tran_id == "") {
            valid = false;
            alert("Transaction ID empty");
        }
        if (valid) {
				if(confirm('Do you want to decline the Order?')){
					var form_data = {
						tran_id : tran_id,
						cust_id : cust_id,
						order_id : order_id,
						order_status : order_status
					};

					$.ajax({
                        url : "db/transactionDelete.php",
                        type : "POST",
                        data : form_data,
                        dataType: "json",
                        beforeSend: function () {
                            $('#loadingModal').modal('show');
                            $('.dismissBtn').click();
                        },
                        success: function(response){
                            $('#loadingModal').modal('hide');
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