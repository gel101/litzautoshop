<?php

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
        textarea{
            resize: none;
        }
    </style>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

<!-- HEADER -->
<?php include 'previewHeader.php' ?>
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
        <?php include 'previewSidebar.php' ?>

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
                                <h4 class="mb-sm-0">Request Services</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Preview</a></li>
                                        <li class="breadcrumb-item active">Request</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <!-- Main content -->
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="d-flex flex-column h-100">


                                <div class="card">
                                    <div class="container mt-4">
                                        <h4>Maintenance / Repair Service Request</h4>
                                        <br>
                                        <form id="serviceForm">
                                            <div class="row service-request">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="vehicleType" class="form-label">Type of Vehicle</label>
                                                        <select class="form-select" name="vehicleType[]" required>
                                                
                                                            <?php
                                                                $stmtpaintdelete = mysqli_query($conn, "SELECT * FROM vehicletype_service ORDER BY id ASC");
                                                                while($data = mysqli_fetch_assoc($stmtpaintdelete)){
                                                            ?>

                                                            <option class="<?php echo $data['id']; ?>" value="<?php echo $data['vehicleType']; ?>"><?php echo $data['vehicleType']; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Choose Date</label><span class="text-danger" id="err_date"></span>
                                                        <input type="date" class="form-control" name="dateSelected[]" required>
                                                    </div>
                                                    <div class="mb-3 d-none paintColor">
                                                        <label for="" class="form-label">Select Paint Color(For Repaint)</label><span class="text-danger" id="err_repaint"></span><span class="text-danger"><br>Initial Price: &#8369;20,000</span>
                                                        <select name="repaintColor[]" class="form-select">
                                                                
                                                            <option value="">Select Color</option>
                                                            <?php
                                                                $stmtpaintColor = mysqli_query($conn, "SELECT * FROM paints WHERE (status != 'archived' OR status IS NULL) ORDER BY paint_id DESC");
                                                                while($colorData = mysqli_fetch_assoc($stmtpaintColor)){
                                                            ?>
                                                            <option value="<?php echo $colorData['paint_color']; ?>"><?php echo $colorData['paint_color']; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 d-none tintColor">
                                                        <label for="" class="form-label">Select Tint Color(For Tint)</label><span class="text-danger" id="err_tint"></span><span class="text-danger"><br>Initial Price: &#8369;5,000</span>
                                                        <select name="retintColor[]" class="form-select">
                                                                
                                                            <option value="">Select Color</option>
                                                            <?php
                                                                $stmtpaintColor = mysqli_query($conn, "SELECT * FROM paints WHERE (status != 'archived' OR status IS NULL) ORDER BY paint_id DESC");
                                                                while($colorData = mysqli_fetch_assoc($stmtpaintColor)){
                                                            ?>
                                                            <option value="<?php echo $colorData['paint_color']; ?>"><?php echo $colorData['paint_color']; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="requestType" class="form-label">Service Request</label>
                                                    <div class="mb-3 form-control">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Suggestions/Comments/Reasons (Optional)</label>
                                                    <textarea name="requestDetails[]" class="form-control" cols="30" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </form>
                                        <br>
                                        <br>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary m-1" onclick="addField()">Add More Request</button>
                                            <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#decisionModal">Submit</button>
                                        </div>
                                        <br>
                                        <br>


                                    </div>
                                </div> <!-- end card-->


                            </div>
                        </div> <!-- end col-->                        
                    </div>  <!-- end row -->

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

        document.addEventListener('DOMContentLoaded', function() {
            // Call the function when the page is ready
            updateServiceOptions();

            // Add event listener for the change event on vehicleType select
            document.getElementById('serviceForm').addEventListener('change', function(event) {
                var target = event.target;

                if (target.name === 'vehicleType[]') {
                    updateServiceOptions(target);
                }
            });
        });
        
        function updateServiceOptions(selectedVehicleTypeElement) {
            var selectedVehicleTypeOption = selectedVehicleTypeElement ? selectedVehicleTypeElement.options[selectedVehicleTypeElement.selectedIndex] : document.querySelector('select[name="vehicleType[]"]').options[document.querySelector('select[name="vehicleType[]"]').selectedIndex];
            var selectedVehicleType = selectedVehicleTypeOption.className;

            // Fetch and update options for services based on the selected vehicleType
            fetch('db/utilitiesvehicle.php?vehicleType=' + selectedVehicleType)
                .then(response => response.json())
                .then(servicesData => {
                    // Get the parent container of the selected vehicleTypeElement
                    var parentContainer = selectedVehicleTypeElement ? selectedVehicleTypeElement.closest('.service-request') : document.querySelector('.service-request');

                    // Get the servicesCheckboxDiv within the parent container
                    var servicesCheckboxDiv = parentContainer.querySelector('.mb-3.form-control');

                    // Clear existing checkboxes in the specific service request field
                    servicesCheckboxDiv.innerHTML = '';

                    // Create and append checkboxes based on the fetched data
                    servicesData.forEach(service => {
                        var checkboxContainer = document.createElement('div');
                        checkboxContainer.classList.add('col-md-6'); // Adjust the column size based on your needs

                        var price = parseFloat(service.price).toFixed(2);
                        var formattedPrice = parseFloat(price).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                        var checkbox = document.createElement('div');
                        checkbox.innerHTML = `
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="requestType[]" value="${service.service}">
                                <label class="form-check-label">${service.service}<span class="text-danger">${(service.price === '0') ? "(Price may vary)" : "(₱" + formattedPrice + ")"}</span></label>
                            </div>
                        `;

                        checkboxContainer.appendChild(checkbox);
                        servicesCheckboxDiv.appendChild(checkboxContainer);
                    });
                });
        }


        function handleCheckboxChange(checkbox, relatedInput, relatedClass) {
            var isChecked = checkbox.checked;
            var inputField = checkbox.closest('.service-request').querySelector('select[name="' + relatedInput + '"]');
            var relatedDiv = checkbox.closest('.service-request').querySelector('.' + relatedClass);

            if (isChecked) {
                // If checkbox is checked, show the related input field
                relatedDiv.classList.remove('d-none');
            } else {
                // If checkbox is unchecked, hide the related input field and reset its value
                relatedDiv.classList.add('d-none');
                inputField.value = "";
            }
        }

        // Attach event listeners to the checkboxes
        document.addEventListener('DOMContentLoaded', function () {
            var serviceForm = document.getElementById('serviceForm');

            // Event delegation for dynamically added fields
            serviceForm.addEventListener('change', function (event) {
                var target = event.target;

                if (target.type === 'checkbox' && (target.value === 'Repaint' || target.value === 'Tint')) {
                    handleCheckboxChange(target, target.value === 'Repaint' ? 'repaintColor[]' : 'retintColor[]', target.value === 'Repaint' ? 'paintColor' : 'tintColor');
                }
            });
        });

        function addField() {
            // Create a new container div for the service request
            var newFieldContainer = document.createElement('div');
            newFieldContainer.classList.add('row', 'service-request'); // Add Bootstrap row class and custom class for styling

            // Add input fields for the service request
            newFieldContainer.innerHTML = `<hr class="text-light">
                                                <br>
                                                <br>
                                                <hr class="text-primary">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="vehicleType" class="form-label">Type of Vehicle</label>
                                                        <select class="form-select" name="vehicleType[]" required>
                                                
                                                            <?php
                                                                $stmtpaintdelete = mysqli_query($conn, "SELECT * FROM vehicletype_service ORDER BY id ASC");
                                                                while($data = mysqli_fetch_assoc($stmtpaintdelete)){
                                                            ?>

                                                            <option class="<?php echo $data['id']; ?>" value="<?php echo $data['vehicleType']; ?>"><?php echo $data['vehicleType']; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Choose Date</label><span class="text-danger" id="err_date"></span>
                                                        <input type="date" class="form-control" name="dateSelected[]" required>
                                                    </div>
                                                    <div class="mb-3 d-none paintColor">
                                                        <label for="" class="form-label">Select Paint Color(For Repaint)</label><span class="text-danger" id="err_repaint"></span><span class="text-danger"><br>Initial Price: &#8369;20,000</span>
                                                        <select name="repaintColor[]" class="form-select">
                                                                
                                                            <option value="">Select Color</option>
                                                            <?php
                                                                $stmtpaintColor = mysqli_query($conn, "SELECT * FROM paints WHERE (status != 'archived' OR status IS NULL) ORDER BY paint_id DESC");
                                                                while($colorData = mysqli_fetch_assoc($stmtpaintColor)){
                                                            ?>
                                                            <option value="<?php echo $colorData['paint_color']; ?>"><?php echo $colorData['paint_color']; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 d-none tintColor">
                                                        <label for="" class="form-label">Select Tint Color(For Tint)</label><span class="text-danger" id="err_tint"></span><span class="text-danger"><br>Initial Price: &#8369;5,000</span>
                                                        <select name="retintColor[]" class="form-select">
                                                                
                                                            <option value="">Select Color</option>
                                                            <?php
                                                                $stmtpaintColor = mysqli_query($conn, "SELECT * FROM paints WHERE (status != 'archived' OR status IS NULL) ORDER BY paint_id DESC");
                                                                while($colorData = mysqli_fetch_assoc($stmtpaintColor)){
                                                            ?>
                                                            <option value="<?php echo $colorData['paint_color']; ?>"><?php echo $colorData['paint_color']; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="requestType" class="form-label">Service Request</label>
                                                    <div class="mb-3 form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <label for="" class="form-label">Suggestions/Comments/Reasons (Optional)</label>
                                                        <textarea name="requestDetails[]" class="form-control" cols="30" rows="4"></textarea>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-lg float-end mt-5 btn-danger m-1" onclick="removeField(this)">Remove</button>
                                                    </div>
                                                </div>`;

            // Append the new container to the fieldsContainer
            document.getElementById('serviceForm').appendChild(newFieldContainer);

            // Attach event listener to the form for checkbox changes using event delegation
            document.getElementById('serviceForm').addEventListener('change', function (event) {
                var target = event.target;

                if (target.type === 'checkbox' && (target.value === 'Repaint' || target.value === 'Tint')) {
                    handleCheckboxChange(target, target.value === 'Repaint' ? 'repaintColor[]' : 'retintColor[]', target.value === 'Repaint' ? 'paintColor' : 'tintColor');
                }
            });
        }





            // Function to remove a dynamically added service request
            function removeField(button) {
                button.closest('.service-request').remove();
            }

    </script>
</body>

</html>