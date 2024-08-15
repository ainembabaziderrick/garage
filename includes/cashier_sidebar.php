<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">GARAGE MONITOR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="" class="img-circle elevation-2" alt="">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $_SESSION['login_name'] ?? "Not Logged In" ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="/garage/cashier_dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/garage/cashier_services.php" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>Services</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/garage/customar.php" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/garage/cashier_receive_payment.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaction</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/garage/cashier_track_sales.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sale List</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/garage/cashier_track_sales.php" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Sales</p>
                    </a>
                </li>
              
               
                <li class="nav-item">
                    <a href="/garage/logout.php" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>