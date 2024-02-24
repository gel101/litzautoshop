<head>
    <style>
        .image-container {
            max-width: 300px; /* Set a default maximum width */
            max-height: 400px; /* Set a default maximum height */
            width: 100%; /* Make the image container take full width of its parent */
            margin: 0 auto; /* Center the image container */
            overflow: hidden; /* Hide any overflow */
        }

        .responsive-image {
            width: 100%; /* Make the image take full width of its parent (image-container) */
            height: auto; /* Let the height adjust proportionally based on the width */
            display: block; /* Remove any inline spacing issues with the image */
        }

        .text-orange{
            color:#f04906;
        }

    </style>
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<?php
// Check if the session has expired
if (isset($_SESSION['customer_last_activity']) && (time() > ($_SESSION['customer_last_activity'] + 43200))) {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('hiddenButton').click();
    });
    </script>";
}

if (!isset($_SESSION['cust_id']) || $_SESSION["loggedin"] === false) {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('hiddenButton').click();
    });
    </script>";
}

if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == "Pending") {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('pendingBtn').click();
    });
    </script>";
}

if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == "Denied") {
    echo "<script>
            alert('Your Account has been Rejected!'); 
            window.location.href = 'customer-logout.php';
        </script>";
    exit;
}


// Update the last activity time
$_SESSION['customer_last_activity'] = time();

?>

<script>
    function closepage() {
        window.location.href = "customer-logout.php";
    }

    function redirectToAdminLogin() {
        // Add a check to ensure the clicked element is the modal itself (not its children)
        if (event.target.classList.contains('modal')) {
            closepage();
        }
    }
    
    $(document).ready(function () {
        $('#loadingModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });
</script>

<!-- removeNotificationModal -->
<div id="alertModal" onclick="redirectToAdminLogin()" class="modal fade zoomIn" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#e83a30" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Session Expired!</h4>
                        <p class="text-muted mx-4 mb-0 alertMessageModal">Please Login Again</p>
                    </div>
                </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" onclick="closepage()" data-dismiss="modal">RETURN</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- removeNotificationModal -->
<div id="pendingModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/kulwmpzs.json" trigger="loop" colors="primary:#2ed9a0" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>At the moment your account is at the process of validation</h4>
                        <p class="text-muted mx-4 mb-0">Please wait until the validation is completed, you can make an order if your account will be verified. Thank you for your understanding.</p>
                    </div>
                </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-lg btn-light" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- LoadingModal -->
<div id="loadingModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0.0);border-color: rgba(255, 255, 255, 0.0);">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon 
                        src="https://cdn.lordicon.com/xjovhxra.json"
                        trigger="loop"
                        colors="primary:#007bff,secondary:#08a88a"
                        style="width:250px;height:250px">
                    </lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <!-- <h4>Data Being Processed!</h4> -->
                        <!-- <p class="text-muted mx-4 mb-0">Please Wait.</p> -->
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="successModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon 
                        src="https://cdn.lordicon.com/oqdmuxru.json"
                        trigger="loop"
                        colors="primary:#30e849,secondary:#08a88a"
                        style="width:250px;height:250px">
                    </lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4 class="messageText">Success</h4>
                    </div>
                    <div class="row">
                        <div class="center">
                            <!-- <button id="confirmAction" class="btn btn-primary">Yes</button> -->
                            <!-- <button class="btn btn-danger" data-bs-dismiss="modal">No</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="errorModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon 
                        src="https://cdn.lordicon.com/ygvjgdmk.json"
                        trigger="loop"
                        state="hover-error-2"
                        colors="primary:#e83a30,secondary:#e83a30"
                        style="width:250px;height:250px">
                    </lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4 id="errormessageText">Error!</h4>
                    </div>
                    <div class="row">
                        <div class="center">
                            <!-- <button id="confirmAction" class="btn btn-primary">Yes</button> -->
                            <!-- <button class="btn btn-danger" data-bs-dismiss="modal">No</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Hidden button to trigger the modal -->
<button id="hiddenButton" style="display: none;" data-toggle="modal" data-target="#alertModal"></button>
<button id="pendingBtn" style="display: none;" data-toggle="modal" data-target="#pendingModal"></button>



<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="staff-dashboard.php" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="img/logo-light.png" alt="" height="40">
                        </span>
                        <span class="logo-lg">
                            <img src="img/logo-light.png" alt="" height="80">
                        </span>
                    </a>

                    <a href="staff-dashboard.php" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="img/logo-light.png" alt="" height="40">
                        </span>
                        <span class="logo-lg">
                            <img src="img/logo-light.png" alt="" height="80">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                
            </div>

            <div class="d-flex align-items-center">

                <!-- <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div> -->

                <div class="ms-1 header-item d-sm-flex">
                    <button id="cartButton" type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle">
                        <i class='bx bx-cart fs-22'></i>
                        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger <?php 
                        
                        if (isset($_SESSION['cust_id'])) {
                            $cust_id = $_SESSION['cust_id'];
                        }
                        
                        include 'db/connection.php';

                        $sqlll = "SELECT * FROM carts WHERE cust_id = '$cust_id' and status='on cart'; ";
                        $result = mysqli_query($conn, $sqlll);
                        if (mysqli_num_rows($result) < 1) {
                            echo "d-none";
                            }
                        ?>">
                            <?php 
                            if (isset($_SESSION['cust_id']) && !empty($_SESSION['cust_id'])) {


                                $sql = "SELECT COUNT(cart_id) FROM carts WHERE cust_id='$cust_id' and status='on cart';";
                                $stmt = mysqli_query($conn, $sql);
                                $data = mysqli_fetch_assoc($stmt);
                                echo $data['COUNT(cart_id)'];
                            }

                            ?>
                            <span class="visually-hidden">unread messages</span></span>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" onclick="sawStatusBtn('<?php if(isset($_SESSION['cust_id'])){echo $_SESSION['cust_id']; }?>')" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span id="notifNum" class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger <?php 
                        
                        $sql123 = "SELECT * FROM notifications WHERE cust_id = '$cust_id' and saw_status= 0; ";
                        $result123 = mysqli_query($conn, $sql123);
                        if (mysqli_num_rows($result123) > 0) {
                            }else {
                                echo "d-none";
                            }
                        ?>">
                            <?php 
                            if (isset($_SESSION['cust_id']) && !empty($_SESSION['cust_id'])) {
                                $cust_id = $_SESSION['cust_id'];
    
                                $sql = "SELECT COUNT(cust_id) FROM notifications WHERE cust_id='$cust_id' AND saw_status = 0;";
                                $stmt = mysqli_query($conn, $sql);
                                $data = mysqli_fetch_assoc($stmt);
                                echo $data['COUNT(cust_id)'];
                            }

                            ?><span class="visually-hidden">unread messages</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge badge-soft-light fs-13"> <?php 
                            $cust_id = $_SESSION['cust_id'];

                            $sql = "SELECT COUNT(cust_id) FROM notifications WHERE cust_id='$cust_id' and saw_status='0';";
                            $stmt = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_assoc($stmt);
                            echo $data['COUNT(cust_id)'];

                            ?> New</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                                            All (<?php 
                            $cust_id = $_SESSION['cust_id'];

                            $sql = "SELECT COUNT(cust_id) FROM notifications WHERE cust_id='$cust_id';";
                            $stmt = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_assoc($stmt);
                            echo $data['COUNT(cust_id)'];

                            ?>)
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab" aria-selected="false">
                                            Messages
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab" aria-selected="false">
                                            Alerts
                                        </a>
                                    </li> -->
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content position-relative" id="notificationItemsTabContent">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">

                                <?php 

                                $cust_id = $_SESSION['cust_id'];

                                $shownotif = mysqli_query($conn, "SELECT * FROM notifications WHERE cust_id ='$cust_id' ORDER BY notif_id DESC");

                                while($data = mysqli_fetch_assoc($shownotif)){
                                ?>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative <?php if($data['saw_status'] == 0){echo "bg-soft-info";} ?>">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-soft-<?php 
                                                    if($data['status'] == "Pending"){
                                                        echo "warning";
                                                    }if($data['status'] == "Accepted"){
                                                        echo "secondary";
                                                    }if($data['status'] == "Approved"){
                                                        echo "secondary";
                                                    }if($data['status'] == "Requirements Complete"){
                                                        echo "secondary";
                                                    }if($data['status'] == "Order Preparing"){
                                                        echo "warning";
                                                    }if($data['status'] == "Ready to Pick Up"){
                                                        echo "success";
                                                    }if($data['status'] == "Completed"){
                                                        echo "success";
                                                    }if($data['status'] == "Request Completed"){
                                                        echo "success";
                                                    }if($data['status'] == "Declined"){
                                                        echo "danger";
                                                    } ?> text-<?php
                                                    if($data['status'] == "Pending"){
                                                        echo "warning";
                                                    }if($data['status'] == "Accepted"){
                                                        echo "info";
                                                    }if($data['status'] == "Approved"){
                                                        echo "info";
                                                    }if($data['status'] == "Requirements Complete"){
                                                        echo "info";
                                                    }if($data['status'] == "Order Preparing"){
                                                        echo "orange";
                                                    }if($data['status'] == "Ready to Pick Up"){
                                                        echo "success";
                                                    }if($data['status'] == "Completed"){
                                                        echo "success";
                                                    }if($data['status'] == "Request Completed"){
                                                        echo "success";
                                                    }if($data['status'] == "Declined"){
                                                        echo "danger";
                                                    } ?> rounded-circle fs-16">
                                                    <i class="bx <?php if($data['transaction'] == "order"){echo "bx-package";}if($data['transaction'] == "service"){echo "bx-cog";} ?>"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <a href="<?php if($data['transaction'] == "order"){echo "customer-tran-product.php";}if($data['transaction'] == "service"){echo "customer-tran-request.php";} ?>" class="stretched-link">
                                                    <h6 class="mt-0 mb-2 lh-base">
                                                        <?php echo $data['message']; ?>
                                                    </h6>
                                                </a>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-calendar-outline"></i> DATE : <?php $date = new DateTime($data['date']); $formattedDate = $date->format('m/d/Y'); echo $formattedDate;  ?></span>
                                                </p>
                                            </div>
                                            <!-- <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check01">
                                                    <label class="form-check-label" for="all-notification-check01"></label>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>



                                <?php
                                    }
                                ?>



                                    <!-- <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-2.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                        graph 🔔.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 48 min ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-soft-danger text-danger rounded-circle fs-16">
                                                    <i class='bx bx-message-square-dots'></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-2 fs-13 lh-base">You have received <b class="text-success">20</b> new messages in the conversation
                                                    </h6>
                                                </a>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check03">
                                                    <label class="form-check-label" for="all-notification-check03"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-8.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 4 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check04">
                                                    <label class="form-check-label" for="all-notification-check04"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->



                                    
                                    <!-- <div class="my-3 text-center view-all">
                                        <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                            All Notifications <i class="ri-arrow-right-line align-middle"></i></button>
                                    </div> -->
                                </div>

                            </div>

                            <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    <!-- <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">James Lemire</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 30 min ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check01">
                                                    <label class="form-check-label" for="messages-notification-check01"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-2.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                        graph 🔔.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check02">
                                                    <label class="form-check-label" for="messages-notification-check02"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-6.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Kenneth Brown</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Mentionned you in his comment on 📃 invoice #12501.
                                                    </p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 10 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check03">
                                                    <label class="form-check-label" for="messages-notification-check03"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-8.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 3 days ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check04">
                                                    <label class="form-check-label" for="messages-notification-check04"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="my-3 text-center view-all">
                                        <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                            All Messages <i class="ri-arrow-right-line align-middle"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab"></div>

                            <div class="notification-actions" id="notification-actions">
                                <div class="d-flex text-muted justify-content-center">
                                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ms-1 header-item d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="db/<?php if(isset($_SESSION['userPic'])){ echo $_SESSION['userPic']; }?>" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php 
                                

                                try {
                                    if (isset($_SESSION['cust_id']) && !empty($_SESSION['cust_id'])) {
                                        $adminID = $_SESSION['cust_id'];
                                        
                                        $sql = mysqli_query($conn, "SELECT fname, lname FROM clientacc WHERE cust_id='$adminID'");
                                        
                                        if (!$sql) {
                                            throw new Exception("Query failed: " . mysqli_error($conn));
                                        }
                                        
                                        $data = mysqli_fetch_assoc($sql);
                                        
                                        if ($data) {
                                            echo $data['fname'] . " " . $data['lname'];
                                        } else {
                                            echo "Null";
                                        }
                                    } else {
                                        echo "Null";
                                    }
                                } catch (Exception $e) {
                                    echo "Null"; // Display a custom error message
                                }
                                
                                 ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">Account status : <?php 
                                
                                if (isset($_SESSION['userStatus'])) {
                                    $userStatus = $_SESSION['userStatus'];
                                    
                                    switch ($userStatus) {
                                        case 'Pending':
                                            echo "<span class='badge bg-warning'>" . $userStatus . "</span>";
                                            break;
                                        case 'Verified':
                                            echo "<span class='badge bg-success'>" . $userStatus . "</span>";
                                            break;
                                        default:
                                            echo "<span class='badge bg-danger'>" . "Denied" . "</span>";
                                            break;
                                    }
                                }
                                 ?></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <!-- <h6 class="dropdown-header">Option</h6> -->
                        <a class="dropdown-item" href="pages-profile.php"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                        <!-- <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                        <a class="dropdown-item" href="apps-tasks-kanban.html"><i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
                        <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$5971.67</b></span></a>
                        <a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-soft-success text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a> -->
                        <!-- <a class="dropdown-item" href="admin-lockscreen.php"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a> -->
                        <a class="dropdown-item" href="customer-logout.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script src="js/jquery-3.6.3.min.js"></script>
<script>
    
    document.getElementById("cartButton").addEventListener("click", function() {
            // Redirect to the next page
        window.location.href = "customer-cart.php";
    });

    function sawStatusBtn(cust_id){
			var form_data = {
                cust_notif : "cust_notif",
                cust_id : cust_id
			}

			$.ajax({
	        	url : "db/notificationUpdate.php",
	        	type : "POST",
	        	data : form_data,
	        	dataType: "json",
                success: function(response){
                    // location.reload();
                    $("#notifNum").addClass("d-none");
                }
	        });
    }

</script>