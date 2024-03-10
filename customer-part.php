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
    <link rel="stylesheet" type="text/css" href="css/acustomer.css">
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
        .mainDetails{
            font-weight: bold;
            font-size: 20px;
        }
        .mainLabel{
            color: gray;
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
                                <h4 class="mb-sm-0">Spare parts and Accessories</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
                                        <li class="breadcrumb-item active">Spare Parts and Accessories</li>
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

                            $stmt = mysqli_query($conn, "SELECT * FROM spareparts_accessories WHERE quantity > 0 AND (status IS NULL OR status != 'archived') ORDER BY sparepart_id DESC");

                            while($data = mysqli_fetch_assoc($stmt)){
                        ?>
                <div class="box card">
                    <img src="db/<?php echo $data['img']; ?>" alt="" data-value-1="<?php echo $data['details']; ?>" onclick="preview(
                        '<?php echo $data['sparepart_id']; ?>',
                        '<?php echo $data['img']; ?>',
                        '<?php echo $data['product']; ?>',
                        '<?php echo $data['quantity']; ?>',
                        '<?php echo number_format($data['price'], 2); ?>',
                        this.getAttribute('data-value-1')
                        )">
                    <h2 class="text-dark textSearch"><?php echo $data['product']; ?></h2>
                    <span class="textSearch">₱ <?php echo number_format($data['price'], 2); ?> <span style="color:#6c757d; font-size: 12px;"> <?php echo $data['quantity']; ?> available</span></span>
                    <p class="textSearch">Little Panay, Panabo City</p>

                    <div class="row">
                        <div class="col-md-10">
                            <button class="btn btn-primary w-100" value="<?php echo $data['details']; ?>" onclick="preview(
                        '<?php echo $data['sparepart_id']; ?>',
                        '<?php echo $data['img']; ?>',
                        '<?php echo $data['product']; ?>',
                        '<?php echo $data['quantity']; ?>',
                        '<?php echo number_format($data['price'], 2); ?>',
                        this.value
                        )"><center>PREVIEW</center></button>
                        </div>
                        
                        <div class="col-md-2 showdetailsign" data-value-1="<?php echo $data['details']; ?>" onclick="showdetails(this.getAttribute('data-value-1'))">
                            <h4><i class="fas fa-info-circle fa-lg mt-2"></i></h4>
                        </div>
                    </div>

                </div>
                        <?php
                            }
                        ?>
            </div>




	<!-- First Modal -->
	<div class="modal fade zoomIn" id="showpartDetails" tabindex="-1" aria-labelledby="firstModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="firstModalLabel">Description</h5>
					<button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
                    <textarea class="form-control" id="sdetails"  style="resize:none;overflow:auto" cols="30" rows="15" disabled></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger">CLOSE</button>
                    </div>	
				</div>
			</div>
		</div>
	</div>
    
	<div class="modal fade zoomIn" id="showpartDetails2" tabindex="-1" aria-labelledby="firstModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Description</h5>
					<button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
                <div class="modal-body">
                    <textarea class="form-control" id="sdetails2" style="resize:none; overflow:auto" cols="30" rows="15" disabled></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#prevModal" class="btn btn-danger">BACK</button>
                </div>
			</div>
		</div>
	</div>



<!-- Modal -->
<div class="modal fade" id="prevModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Product Preview</h1>
        <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
        <div class="container-fluid">
            <div class="carForm row">
                            <h4 style="display:none" id="prodId"></h4>
                            <input type="hidden" name="qProd" id="qProd">
                <div class="formImg col-md-6">
                    <img src="" id="prodImgprev" alt="Product Image">
                </div>
                <div class="formInput col-md-6">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="mainLabel form-label">Product Name</label>
                            <h4 class="mainDetails" id="prodName"></h4>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="mainLabel form-label">Product Price</label>
                            <h4 class="mainDetails">&#8369; <span id="prodPrice"></span></h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <button  id="prodDetails" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#showpartDetails2">Show Description</button>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <label for="name" class="mainLabel form-label">Quantity</label>
                            <div class="row">
                                <div class="d-flex" style="place-items:center;">
                                    <button class="quantity-button btn btn-light font-weight-bold" id="minusButton">-</button>
                                    <input class="quantity-input form-control" style="width:50px" type="number" id="prodQuantity" value="1">
                                    <button class="quantity-button btn btn-light font-weight-bold" id="plusButton">+</button>
                                </div>


                            </div>
                                <label for="name" class="mainLabel form-label float-start" id="leftQuantity"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addtoCart()" <?php // if ($_SESSION['userStatus'] === 'Pending') { echo 'disabled'; } ?>>Add to Cart</button>
      </div>
    </div>
  </div>
</div>




    
<!-- FOOTER -->

<?php include 'admin-footer.php' ?>

<!-- END OF FOOTER -->


    <!-- JAVASCRIPT -->
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/acustomer.js"></script>
    
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

        $(document).ready(function(){
            // Attach an event listener to the input field
            $("#table-filter").on("keyup", function () {
                var searchText = $(this).val().toLowerCase(); // Get the input value and convert it to lowercase

                // Loop through each .box card element
                $(".box").each(function () {
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

            $('#prodDetails').click(function (){
                $('#sdetails2').val(this.value);
            });
        });

        
        const minusButton = document.getElementById('minusButton');
        const plusButton = document.getElementById('plusButton');
        const prodQuantity = document.getElementById('prodQuantity');
        const qProd = document.getElementById('qProd');

        minusButton.addEventListener('click', () => {
            decreaseQuantity();
        });

        plusButton.addEventListener('click', () => {
            increaseQuantity();
        });

        prodQuantity.addEventListener('input', () => {
            handleInputChange();
        });

        function decreaseQuantity() {
            let quantity = parseInt(prodQuantity.value);
            if (quantity > 1) {
                quantity--;
            }
            prodQuantity.value = quantity;
        }

        function increaseQuantity() {
            let quantity = parseInt(prodQuantity.value);
            let maxQuantity = parseInt(qProd.value);

            // Check if quantity is less than the maximum value
            if (quantity < maxQuantity) {
                quantity++;
                prodQuantity.value = quantity;
            }
        }

        function handleInputChange() {
            let quantity = parseInt(prodQuantity.value);
            let maxQuantity = parseInt(qProd.value);

            // Check if the input value exceeds the maximum value
            if (quantity > maxQuantity) {
                prodQuantity.value = maxQuantity;
            }

            // Allow clearing the input if the value is less than or equal to the maximum value
            if (quantity <= maxQuantity) {
                prodQuantity.value = quantity;
            }
        }
        
        function preview(id, img, product, quantity, price, details){
            var img = "db/" + img;
            var product = product;
            var quantity = quantity + " available";
            var price = price;
            var details = details;

            $("#prodImgprev").attr("src", img);
            $("#prodId").text(id);
            $("#qProd").val(quantity);
            $("#prodQuantity").val(1);
            $("#prodName").text(product);
            $("#leftQuantity").text(quantity);
            $("#prodPrice").text(price);
            details = details.replace(/\n/g, '<br>');
            $('#prodDetails').val(details.replace(/<br>/g, '\n'));
            // $("#prodDetails").text(details);

            $("#prevModal").modal("show");
        }

        function addtoCart() {
            var valid = true;
            var cust_id = "<?php echo $_SESSION['cust_id']; ?>";

            var prodimg = document.getElementById("prodImgprev").getAttribute("src");
            var modifiedprodimg = prodimg.replace("db/", "");

            var prodId = $("#prodId").text();
            var product = $("#prodName").text();
            var priceWithCommas = $("#prodPrice").text();
            var priceWithoutCommas = priceWithCommas.replace(",", "");
            var price = priceWithoutCommas.replace(".00", "");
            var quantity = $("#prodQuantity").val();

            var leftQ = $("#leftQuantity").text();
            var newleftQ = leftQ.replace(" left available", "");

            var details = $("#prodDetails").val();

            if(prodId == ""){
                valid = false;
                alert("Product ID empty");
            }

            if(cust_id == ""){
                valid = false;
                alert("SESSION ID empty");
            }

            if(modifiedprodimg == ""){
                valid = false;
                alert("No image source empty");
            }

            if(product == ""){
                valid = false;
                alert("Product empty");
            }
            
            if(price == ""){
                valid = false;
                alert("Total price empty");
            }
            
            if(quantity == "0"){
                valid = false;
                alert("No Quantity");
            }

            if(valid){
                var form_data = {
                    cust_id : cust_id,
                    prodId : prodId,
                    img : modifiedprodimg,
                    product : product,
                    price : price,
                    quantity : quantity,
                    newleftQ : newleftQ,
                    details : details
                }

                $.ajax({
                    url : "db/partAdd.php",
                    type : "POST",
                    data : form_data,
                    dataType: "json",
                    beforeSend: function () {
                        $('.dismissBtn').click();
                    },
                    success: function(response){
                        if(response['valid'] == false){
                        alert(response['msg']);
                        }else{
                            $('.messageText').text(response['msg']); // Change the confirmation text
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
        
        function showdetails(details){
		    var details = details;

            details = details.replace(/\n/g, '<br>');
            $('#sdetails').val(details.replace(/<br>/g, '\n'));
            // $("#sdetails").html(details);
            
            $("#showpartDetails").modal("show");
        }
        
    </script>

</body>

</html>