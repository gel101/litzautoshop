<?php
// Set session cookie to expire after 12 hours (43200 seconds)
$sessionExpiration = 86400 + 86400 + 86400;
session_set_cookie_params($sessionExpiration);
session_start();

include 'db/connection.php';


?>


<!-- html code after this line -->

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
    
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
        .carousel-inner .carousel-item {
            transition-duration: 0.1s;
        }
        .card-container {
            flex-wrap: wrap;
            display: flex;
        }

        .card {
            position: relative; /* Ensure the position context for absolute positioning */
            overflow: hidden;
            object-fit: contain;
            object-position: center;
            margin: 10px;
            width: 316px;
            border-radius: 0.5rem;
        }

        .cardImage {
            width: 100%;
            height: 300px;
            object-fit: fill;
            object-position: center;
            transition: transform 0.1s ease-in-out;
        }

        .card h3 {
            position: absolute;
            bottom: -10px;
            width: 100%;
            background-color: rgba(169, 169, 169, 0.5); /* Gray background with half opacity */
            padding: 5px;
            text-align: center;
            transition: bottom 0.1s ease-in-out; /* Transition for the 'bottom' property */
        }

        .card:hover .cardImage {
            transform: scale(1.1);
            cursor: pointer;
        }

        .card:hover h3 {
            bottom: -38px; /* Adjust the value for the lowered position */
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
                                <h4 class="mb-sm-0">Rentable Minivan Available</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
                                        <li class="breadcrumb-item active">Rent</li>
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
                            $stmt = mysqli_query($conn, "SELECT * FROM car_rental WHERE status != 'archived' ORDER BY rentalcar_id DESC");
                            while ($data = mysqli_fetch_assoc($stmt)) {
                                ?>
                                <div class="card" data-value-1="<?php echo $data['details']; ?>" onclick="prevCar(
                                            '<?php echo $data['rentalcar_id']; ?>',
                                            '<?php echo $data['car_img']; ?>',
                                            '<?php echo $data['img1']; ?>',
                                            '<?php echo $data['img2']; ?>',
                                            '<?php echo $data['img3']; ?>',
                                            '<?php echo $data['img4']; ?>',
                                            '<?php echo $data['car_type']; ?>',
                                            '<?php echo $data['name']; ?>',
                                            '<?php echo $data['model']; ?>',
                                            '<?php echo $data['engine']; ?>',
                                            '<?php echo $data['used']; ?>',
                                            '<?php echo $data['status']; ?>',
                                            this.getAttribute('data-value-1')
                                        )">
                                    <img class="cardImage" src="db/<?php echo $data['car_img']; ?>">
                                    <h3 class="textSearch text-center text-light"><?php echo $data['status']; ?></h3>
                                </div>
                                <?php
                            }
                            ?>
                        </div>




<!-- Modal -->
<div class="modal fade" id="prevModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Car Preview</h1>
        <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="carForm row">
                    <h4 style="display:none" id="rentalcar_id"></h4>
                    <div class="formImg col-md-6">
                        <img src="" id="carImagePrev" alt="No Image Available" class="img-fluid">
                        <img src="" id="carImagePrevOrig" alt="No Image Available" class="d-none">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                <li data-target="#myCarousel" data-slide-to="3"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="" class="d-block w-100" alt="Image 1">
                                </div>
                                <div class="carousel-item">
                                <img src="" class="d-block w-100" alt="Image 2">
                                </div>
                                <div class="carousel-item">
                                <img src="" class="d-block w-100" alt="Image 3">
                                </div>
                                <div class="carousel-item">
                                <img src="" class="d-block w-100" alt="Image 4">
                                </div>
                                <div class="carousel-item">
                                <img src="" class="d-block w-100" alt="Image 5">
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>



                    </div>
                    <div class="formInput col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name" class="mainLabel form-label">Name</label>
                                <h4 class="mainDetails" id="carName"></h4>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="mainLabel form-label">Car Type</label>
                                <h4 class="mainDetails" id="carType"></h4>
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="mainLabel form-label">Model</label>
                                <h4 class="mainDetails" id="carModel"></h4>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="mainLabel form-label">Car Engine</label>
                                <h4 class="mainDetails" id="carEngine"></h4>
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="mainLabel form-label">Other Details</label>
                                <button class="btn btn-info form-control" id="prodDetails" data-bs-target="#showpartDetails2" data-bs-toggle="modal">Show</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="rentDate" class="form-label">Rent Date</label>
                                <input type="date" class="form-control" name="rentDate" id="rentDate">
                            </div>
                        </div>
                        <br>
                        <div class="row setHour">
                            <label for="name" class="mainLabel form-label">Input Rent Duration <span class="text-danger">*Maximum of 7 days</span></label>
                            <div class="col-md-6">
                                <select class="form-select" name="rentTimeType" id="rentTimeType">
                                    <option value="Hour/s">Hour/s</option>
                                    <option value="Day/s">Day/s</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="number" id="rentTime" name="rentTime" class="form-control" placeholder="Number of Hour/Day">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button><!-- Assuming you have a PHP variable $userStatus that contains the user's status -->
        <button type="button" id="addCartBtn" onclick="rentCar()" class="btn btn-primary" <?php if ($_SESSION['userStatus'] === 'Pending') { echo 'disabled'; } ?>>Rent This Car</button>
      </div>
    </div>
  </div>
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
                <textarea class="form-control" style="resize:none;overflow:auto" id="sdetails" cols="30" rows="20" disabled></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">BACK</button>
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
                <textarea class="form-control" id="sdetails2" style="resize:none;overflow:auto" cols="30" rows="20" disabled></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#prevModal">BACK</button>
            </div>
        </div>
    </div>
</div>



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

        $(document).ready(function() {
            var img = $('#carImagePrev');
            var color = $('#carColor');

            color.on('change', function(event) {
                event.preventDefault();
                $('#myCarousel').css("display", "none");
                $('#carImagePrev').css("display", "block");

                if (this.value == "") {
                    $('#carImagePrev').css("display", "none");
                    $('#myCarousel').css("display", "block");
                }
                var selectedColor = color.val();

                $.ajax({
                url: 'db/changeCarColor.php',
                method: 'GET',
                data: { color: selectedColor },
                dataType: 'json',
                success: function(response) {
                    if (response.color === selectedColor) {
                    img.attr('src', response.imgSrc);
                    } else {
                    img.attr('alt', 'No Available Example Color');
                    }
                },
                error: function() {
                    // Handle error here
                }
                });
            });
        
            $('#prodDetails').click(function(){
                $('#sdetails2').val(this.value);
            });


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
        });


        function prevCar(car_id, car_img, img1, img2, img3, img4, car_type, name, model, engine, used, status, details){
            var car_imgorig = car_img;
            var car_img = "db/" + car_img;
            var car_type = car_type;
            var name = name;
            var model = model;
            var engine = engine;
            var quantity = quantity + " left available";
            var price = price;
            var details = details;

            if (status == "Occupied") {
                $('#rentDate').prop('disabled', true);
                $('#addCartBtn').prop('disabled', true);
                $('#rentTimeType').prop('disabled', true);
                $('#rentTime').prop('disabled', true);
            } else {
                $('#rentDate').prop('disabled', false);
                $('#addCartBtn').prop('disabled', false);
                $('#rentTimeType').prop('disabled', false);
                $('#rentTime').prop('disabled', false);
            }

            $("#rentalcar_id").text(car_id);
            $("#carType").text(car_type);
            $("#carName").text(name);
            $("#carModel").text(model);
            $("#carPrice").text(price);
            $("#carEngine").text(engine);
            details = details.replace(/\n/g, '<br>');
            $('#prodDetails').val(details.replace(/<br>/g, '\n'));
            // $("#prodDetails").text(details);
            $("#availableQuantity").text(quantity);
            $("#carImagePrev").attr("src", car_img);
            $("#carImagePrevOrig").attr("src", car_img);
            $("#carImagePrev").css("display", "none");
            $('#myCarousel').css("display", "block");

            setCarouselImages(car_imgorig, img1, img2, img3, img4);

            $("#prevModal").modal("show");
        }


        function setCarouselImages(car_imgorig, img1, img2, img3, img4) {
            var defaultImage = "img/system/noimage.jpg";
            
            // Set image sources for the carousel items
            $("#myCarousel .carousel-item:nth-child(1) img").attr("src", car_imgorig ? "db/" + car_imgorig : defaultImage);
            $("#myCarousel .carousel-item:nth-child(2) img").attr("src", img1 ? "db/" + img1 : defaultImage);
            $("#myCarousel .carousel-item:nth-child(3) img").attr("src", img2 ? "db/" + img2 : defaultImage);
            $("#myCarousel .carousel-item:nth-child(4) img").attr("src", img3 ? "db/" + img3 : defaultImage);
            $("#myCarousel .carousel-item:nth-child(5) img").attr("src", img4 ? "db/" + img4 : defaultImage);
        }



        function rentCar(){
                var valid = true;
                var cust_id = "<?php echo $_SESSION['cust_id']; ?>";
                var name = '<?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?>';
                var rentalcar_id = $("#rentalcar_id").text();
                var rentDate = $("#rentDate").val();
                var rentTimeType = $("#rentTimeType").val();
                var rentTime = $("#rentTime").val();

                
                if(rentDate == ""){
                    valid = false;
                    alert("Rent Date empty!");
                }

                if(rentalcar_id == ""){
                    valid = false;
                    alert("Car ID empty!");
                }
                
                if(rentTime == ""){
                    valid = false;
                    alert("Input Number of Hour/Day!");
                }

                if(valid){
                    if(confirm('Do you want to send a Rent Request?')){
                        var form_data = {
                            cust_id : cust_id,
                            name : name,
                            rentalcar_id : rentalcar_id,
                            rentDate : rentDate,
                            rentTimeType : rentTimeType,
                            rentTime : rentTime
                        }

                        $.ajax({
                            url : "db/rentAdd.php",
                            type : "POST",
                            data : form_data,
                            dataType: "json",
                            beforeSend: function () {
                                $('#loadingModal').modal('show');
                                $('.dismissBtn').click();
                            },
                            success: function(response){
                                if(response['valid'] == false){
                                    $('#loadingModal').modal('hide');
                                    $('#errormessageText').text(response['msg']); // Change the text
                                    $('#errorModal').modal('show');

                                    // Close errorModal after 2 seconds and trigger redirection
                                    setTimeout(function () {
                                        $('#errorModal').modal('hide');
                                        location.reload();
                                    }, 3000);
                                }else{
                                    $('.messageText').text('YOUR REQUEST WAS PLACED!'); // Change the text
                                    $('#successModal').modal('show');

                                    // Close successModal after 2 seconds and trigger redirection
                                    setTimeout(function () {
                                        $('#successModal').modal('hide');
                                        $('#loadingModal').modal('hide');
                                        location.reload();
                                    },1000);
                                }
                                $('#loadingModal').modal('hide');
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert("Check Internet Connection: " + errorThrown);
                                $('#loadingModal').modal('hide'); // Hide the modal on error
                            },
                            complete: function () {
                                $('#loadingModal').modal('hide');
                            }
                        });

                }else {
                    // window.location.href="customer-car.php";
                }}

        }

    </script>

</body>

</html>