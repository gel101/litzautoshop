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
        .card{
            padding:10px;
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
                                <h4 class="mb-sm-0">DASHBOARD</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="d-flex flex-column h-100">


                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="card card-animate">
                                            <div class="card-body table-responsive">
                                                <a href="admin-tran-product.php">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-muted mb-0">All Orders</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="
                                                                <?php 
                                                                    include 'db/connection.php';

                                                                    $sql = "SELECT COUNT(order_id) FROM orders WHERE status!='canceled' ";
                                                                    $stmt = mysqli_query($conn, $sql);
                                                                    $data = mysqli_fetch_assoc($stmt);
                                                                    echo $data['COUNT(order_id)'];

                                                                                                    ?>
                                                                                                    <?php 
                                                                    // include 'db/connection.php';

                                                                    // $sql = "SELECT SUM(quantity) AS total_quantity
                                                                    //         FROM (
                                                                    //             SELECT quantity FROM cars
                                                                    //             UNION ALL
                                                                    //             SELECT quantity FROM paints
                                                                    //             UNION ALL
                                                                    //             SELECT quantity FROM spareparts_accessories
                                                                    //         ) AS all_quantities";
                                                                    
                                                                    // $stmt = mysqli_query($conn, $sql);
                                                                    // $data = mysqli_fetch_assoc($stmt);
                                                                    // echo $data['total_quantity'];
                                                                ?>"
                                                                
                                                                >0</span></h2>
                                                                    </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                                    <i data-feather="package" class="text-info"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-xl-6">
                                        <div class="card card-animate">
                                            <div class="card-body table-responsive">
                                                <a href="admin-tran-service.php">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-muted mb-0">All Requests</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="
                                                            <?php 
                                        include 'db/connection.php';

                                        $sql = "SELECT COUNT(request_id) FROM request_services WHERE status!='canceled'";
                                        $stmt = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_assoc($stmt);
                                        echo $data['COUNT(request_id)'];

                                    ?>"
                                    >0</span></h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                                    <i data-feather="send" class="text-info"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-xl-6">
                                        <div class="card card-animate">
                                            <div class="card-body table-responsive">
                                                <a href="admin-tran-product-completed.php">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-muted mb-0">Completed Orders</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="
                                    <?php 
                                        include 'db/connection.php';

                                        $sql = "SELECT COUNT(order_id) FROM orders WHERE status='completed'";
                                        $stmt = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_assoc($stmt);
                                        echo $data['COUNT(order_id)'];

                                    ?>"
                                    >0</span></h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-success rounded-circle fs-2">
                                                                    <i data-feather="package" class="text-success"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-xl-6">
                                        <div class="card card-animate">
                                            <div class="card-body table-responsive">
                                                <a href="admin-tran-service-completed.php">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-muted mb-0">Completed Requests</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="
                                                            <?php
                                        include 'db/connection.php';

                                        $sql = "SELECT COUNT(request_id) FROM request_services WHERE status='request completed'";
                                        $stmt = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_assoc($stmt);
                                        echo $data['COUNT(request_id)'];
                                    ?>
                                                            
                                                            ">0</span></h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-success rounded-circle fs-2">
                                                                    <i data-feather="send" class="text-success"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row-->

                            </div>
                        </div> <!-- end col-->                        
                    </div>  <!-- end row -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card table-responsive">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <div class="col-md-6">
                                        <h4 class="card-title mb-0 flex-grow-1">Orders</h4>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="start_month">Start Month:</label>
                                        <input type="month" class="form-control" id="start_month" name="start_month">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="end_month">End Month:</label>
                                        <input type="month" class="form-control" id="end_month" name="end_month">
                                    </div>
                                </div>
                                <canvas id="productLineChart"></canvas>
                            </div><!-- end card -->

                            <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Users</h4>
                                    </div>
                                    <canvas id="stakeholderBarChart"></canvas>
                            </div><!-- end card -->

                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Spare Parts</h4>
                                </div>
                            <canvas id="stockPieChart2"></canvas>
                            </div><!-- end card -->
                        </div>

                        <div class="col-md-6">
                            <div class="card table-responsive">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <div class="col-md-6">
                                        <h4 class="card-title mb-0 flex-grow-1">Services</h4>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="start_month1">Start Month:</label>
                                        <input type="month" class="form-control" id="start_month1" name="start_month1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="end_month1">End Month:</label>
                                        <input type="month" class="form-control" id="end_month1" name="end_month1">
                                    </div>
                                </div>
                                <canvas id="servicesLineChart"></canvas>
                            </div><!-- end card -->
                            
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Car Models</h4>
                                </div>
                            <canvas id="stockPieChart"></canvas>
                            </div><!-- end card -->
                            
                        </div>
                    </div>


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


<!-- FOOTER -->

<?php include 'admin-footer.php' ?>

<!-- END FOOTER -->


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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
       
        stakeholderBarChart1();
        makePieChart1();
        makePieChart2();
        
        // Declare a global variable to store the current chart instance
        var productLineChart;

        // Add an event listener to detect changes in month inputs
        $('#start_month, #end_month').on('change', function() {
            makeBarChart1(); // Call the function when months are changed
        });

        // Modify your function to handle default behavior when no month is selected
        function makeBarChart1() {
            var startMonth = $('#start_month').val();
            var endMonth = $('#end_month').val();

            // Check if both start and end months are selected
            if (startMonth && endMonth) {
                // Destroy the existing chart instance if it exists
                if (productLineChart) {
                    productLineChart.destroy();
                }
            } else {
                // If no month range is selected, show default information or take appropriate action
                // You can add code here to handle default behavior
                console.log("No month range selected. Showing default information.");
            }

            $.ajax({
                url: "db/chart.php",
                method: "POST",
                data: { 
                    action: 'productLineChart',
                    start_month: startMonth,
                    end_month: endMonth
                },
                dataType: "JSON",
                success: function (data) {
                    var monthYear = [];
                    var total = [];
                    var color = [];

                    for (var count = 0; count < data.length; count++) {
                        monthYear.push(data[count].month_year);
                        total.push(data[count].total);
                        color.push(data[count].color);
                    }

                    // Create a new Chart instance
                    var chart_data = {
                        labels: monthYear,
                        datasets: [
                            {
                                label: 'Total Orders',
                                borderColor: color, // Use the color for line
                                backgroundColor: color, // This is set to 'rgba(54, 162, 235, 0.5)'
                                color: '#fff',
                                data: total
                            }
                        ]
                    };

                    var options = {
                        responsive: true,
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                ticks: {
                                    min: 0
                                }
                            }
                        }
                    };
                    
                    var group_chart3 = $('#productLineChart');
                    productLineChart = new Chart(group_chart3, {
                        type: 'bar',
                        data: chart_data,
                        options: options
                    });
                },
                error: function (xhr, status, error) {
                    alert(xhr + " " + status + " " + error);
                }
            });
        }


        // Declare a global variable to store the current chart instance
        var servicesLineChart;

        // Add an event listener to detect changes in month inputs
        $('#start_month1, #end_month1').on('change', function() {
            makeBarChart2(); // Call the function when months are changed
        });

        function makeBarChart2() {
            var startMonth = $('#start_month1').val();
            var endMonth = $('#end_month1').val();

            // Check if both start and end months are selected
            if (startMonth && endMonth) {
                // Destroy the existing chart instance if it exists
                if (servicesLineChart) {
                    servicesLineChart.destroy();
                }
            } else {
                // If no month range is selected, show default information or take appropriate action
                // You can add code here to handle default behavior
                console.log("No month range selected. Showing default information.");
            }

            $.ajax({
                url: "db/chart.php",
                method: "POST",
                data: { 
                    action: 'servicesLineChart',
                    start_month: startMonth,
                    end_month: endMonth
                },
                dataType: "JSON",
                success: function (data) {
                    var monthYear = [];
                    var total = [];
                    var color = [];

                    for (var count = 0; count < data.length; count++) {
                        monthYear.push(data[count].month_year);
                        total.push(data[count].total);
                        color.push(data[count].color);
                    }

                    var chart_data = {
                        labels: monthYear,
                        datasets: [
                            {
                                label: 'Total Services',
                                borderColor: color, // Use the color for line
                                backgroundColor: color, // This is set to 'rgba(54, 162, 235, 0.5)'
                                color: '#fff',
                                data: total
                            }
                        ]
                    };

                    var options = {
                        responsive: true,
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                ticks: {
                                    min: 0
                                }
                            }
                        }
                    };

                    var group_chart3 = $('#servicesLineChart');
                    servicesLineChart = new Chart(group_chart3, {
                        type: 'bar',
                        data: chart_data,
                        options: options
                    });
                },
                error: function (xhr, status, error) {
                    alert(xhr + " " + status + " " + error);
                }
            });
        }


    
        function makePieChart1() {
            $.ajax({
                url: "db/chart.php",
                method: "POST",
                data: { action: 'stockPieChart' },
                dataType: "JSON",
                success: function (data) {
                    var labels = [];
                    var values = [];
                    var colors = [];

                    for (var count = 0; count < data.length; count++) {
                        labels.push(data[count].label);
                        values.push(data[count].value);
                        colors.push(data[count].color);
                    }

                    var chart_data = {
                        labels: labels,
                        datasets: [
                            {
                                data: values,
                                backgroundColor: colors,
                            }
                        ]
                    };

                    var options = {
                        responsive: true,
                    };

                    var pieChartCanvas = $('#stockPieChart');

                    new Chart(pieChartCanvas, {
                        type: 'pie',
                        data: chart_data,
                        options: options
                    });
                },
                error: function (xhr, status, error) {
                    alert(xhr + " " + status + " " + error);
                }
            });
        }

        function makePieChart2() {
            $.ajax({
                url: "db/chart.php",
                method: "POST",
                data: { action: 'stockPieChart2' },
                dataType: "JSON",
                success: function (data) {
                    var labels = [];
                    var values = [];
                    var colors = [];

                    for (var count = 0; count < data.length; count++) {
                        labels.push(data[count].label);
                        values.push(data[count].value);
                        colors.push(data[count].color);
                    }

                    var chart_data = {
                        labels: labels,
                        datasets: [
                            {
                                data: values,
                                backgroundColor: colors,
                            }
                        ]
                    };

                    var options = {
                        responsive: true,
                    };

                    var pieChartCanvas = $('#stockPieChart2');

                    new Chart(pieChartCanvas, {
                        type: 'pie',
                        data: chart_data,
                        options: options
                    });
                },
                error: function (xhr, status, error) {
                    alert(xhr + " " + status + " " + error);
                }
            });
        }

        function stakeholderBarChart1(){
            $.ajax({
                url:"db/chart.php",
                method:"POST",
                data:{action:'stakeholderBarChart'},
                dataType:"JSON",
                success:function(data){

                    
                    // Inside the success callback function
                    var label = [];
                    var value = [];
                    var color = [];

                    for (var count = 0; count < data.length; count++) {
                        label.push(data[count].label);
                        value.push(data[count].value);
                        color.push(data[count].color);
                    }

                    var chart_data = {
                        labels: label,
                        datasets: [
                            {
                                label: 'Total Users',
                                backgroundColor: color, // This is set to 'rgba(54, 162, 235, 0.5)'
                                color: '#fff',
                                data: value
                            }
                        ]
                    };

                    var options = {
                        responsive:true,
                        scales:{
                            x: {
                            grid: {
                                display: false // Hide x-axis grid lines
                            }
                            },
                            yAxes:[{
                                ticks:{
                                    min:0
                                }
                            }]
                        }
                    };

                    var group_chart3 = $('#stakeholderBarChart');
                    var graph3 = new Chart(group_chart3, {
                        type:'bar',
                        data:chart_data,
                        options:options
                    });
                },
                error: function (xhr, status, error) {
                    alert(xhr + " "+ status + " "+error);
                }
            })
        }


        // Call the function on page load to create the initial chart
        $(document).ready(function() {
            makeBarChart1();
            makeBarChart2();
        });


    </script>
</body>


</html>