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

<div id="decisionModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close dismissBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon 
                        src="https://cdn.lordicon.com/wzrwaorf.json"
                        trigger="loop"
                        colors="primary:#b4b4b4,secondary:#08a88a"
                        style="width:250px;height:250px">
                    </lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <!-- <h4 id="errormessageText">You Don't Have an Account</h4> -->
                    </div>
                    <div class="row">
                        <div class="center">
                            <button class="btn btn-lg btn-info" onclick="goto('customer-signup.php')">Create an Account</button>
                            <button class="btn btn-lg btn-success" onclick="goto('customer-login.php')">Log In</button>
                        </div>
                    </div>
                    <br>
                    <p class="text-muted">You Don't Have an Account</p>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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
                    <button id="cartButton" type="button" data-bs-toggle="modal" data-bs-target="#decisionModal" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle">
                        <i class='bx bx-cart fs-22'></i>
                        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">
                            <span class="visually-hidden">unread messages</span></span>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span id="notifNum" class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">
                            <span class="visually-hidden">unread messages</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge badge-soft-light fs-13">0 New</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                                            All 
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content position-relative" id="notificationItemsTabContent">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">

                                </div>

                            </div>

                            <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">

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

                <div class="ms-1 header-item d-sm-flex">
                    <button type="button" class="btn btn-secondary me-2" onclick="goto('customer-signup.php')">Sign Up <i class="fas fa-user"></i></button>
                    <button type="button" class="btn btn-success me-2" onclick="goto('customer-login.php')">Log In <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>

<script src="js/jquery-3.6.3.min.js"></script>
<script>
    function goto(url) {
        window.location.href = url;
    }
</script>