
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background-color:slategrey">
                <!-- Dark Logo-->
                <a href="admin-dashboard.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="img/logo-light.png" alt="" height="40">
                    </span>
                    <span class="logo-lg">
                        <img src="img/logo-light.png" alt="" height="80">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="admin-dashboard.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="img/logo-light.png" alt="" height="40">
                    </span>
                    <span class="logo-lg">
                        <img src="img/logo-light.png" alt="" height="80">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

<div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="admin-dashboard.php">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarTransaction" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTransaction">
                                <i class="ri-mail-send-line"></i> <span data-key="t-dashboards">Transaction</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarTransaction">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="admin-tran-product.php" class="nav-link" data-key="t-analytics"> Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-tran-service.php" class="nav-link" data-key="t-crm"> Service</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="admin-tran-rent.php" class="nav-link" data-key="t-crm"> Rental</a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidestock" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidestock">
                                <i class="ri-stack-line"></i> <span data-key="t-dashboards">Stock</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidestock">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="admin-manage-cars.php" class="nav-link" data-key="t-analytics"> Car</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-manage-product.php" class="nav-link" data-key="t-analytics"> Sparepart & Accessory</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="admin-manage-rent.php" class="nav-link" data-key="t-analytics"> Rental Car</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="admin-manage-paint.php" class="nav-link" data-key="t-analytics"> Paint</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sideuser" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideuser">
                                <i class="ri-user-line"></i> <span data-key="t-dashboards">User</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sideuser">
                                <ul class="nav nav-sm flex-column">
                                    <!-- <li class="nav-item">
                                        <a href="admin-manage-mechanic.php" class="nav-link" data-key="t-level-2.1"> Mechanic </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="admin-manage-staff.php" class="nav-link" data-key="t-level-2.1"> Staff </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-manage-client.php" class="nav-link" data-key="t-level-2.1"> Client </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sideArchived" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideArchived">
                                <i class="ri-archive-line"></i> <span data-key="t-dashboards">Archive</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sideArchived">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="admin-manage-ewallet.php" class="nav-link" data-key="t-level-2.1"> E-wallet </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin-manage-carts.php" class="nav-link" data-key="t-level-2.1"> Cart </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#documentArchived" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="documentArchived" data-key="t-level-1.2"> Document</a>
                                        <div class="collapse menu-dropdown" id="documentArchived">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="admin-manage-document1.php" class="nav-link" data-key="t-level-2.1"> Car Documents </a>
                                                </li>
                                                <!-- <li class="nav-item">
                                                    <a href="admin-manage-document2.php" class="nav-link" data-key="t-level-2.1"> Rent Documents </a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidestock1" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidestock1" data-key="t-level-1.2"> User</a>
                                        <div class="collapse menu-dropdown" id="sidestock1">
                                            <ul class="nav nav-sm flex-column">
                                                <!-- <li class="nav-item">
                                                    <a href="admin-manage-mechanic-archived.php" class="nav-link" data-key="t-level-2.1"> Mechanic </a>
                                                </li> -->
                                                <li class="nav-item">
                                                    <a href="admin-manage-staff-archived.php" class="nav-link" data-key="t-level-2.1"> Staff </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="admin-manage-client-archived.php" class="nav-link" data-key="t-level-2.1"> Client </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidestock2" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidestock2" data-key="t-level-1.2"> Stock</a>
                                        <div class="collapse menu-dropdown" id="sidestock2">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="admin-deleted-cars.php" class="nav-link" data-key="t-level-2.1"> Car </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="admin-deleted-products.php" class="nav-link" data-key="t-level-2.1"> Sparepart & Accessory </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="admin-deleted-paints.php" class="nav-link" data-key="t-level-2.1"> Paint </a>
                                                </li>
                                                <!-- <li class="nav-item">
                                                    <a href="admin-manage-rent-archived.php" class="nav-link" data-key="t-level-2.1"> Rental Car </a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="admin-report.php">
                                <i class="ri-file-chart-line"></i> <span data-key="t-widgets"> Report</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="admin-utilities.php">
                                <i class="ri-hammer-line"></i> <span data-key="t-widgets"> Utilities</span>
                            </a>
                        </li>


                        




                    </ul>
                </div>
                


            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
