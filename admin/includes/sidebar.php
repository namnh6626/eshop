<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="row mx-0">
        <a href="/admin" class="brand-link">
            <img src="/images/home//logo.png" alt="Logo" class="brand-image ">
        </a>

    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!-- <div class="image">
                <img src="/admin//dist//img//user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div> -->
            <div class="info">
                <a href="#" class="d-block"><?= $_SESSION['user_name'] ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item" id="">
                    <a href="/admin/" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="customer">
                    <a href="/admin/customer" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Customers
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="bill">
                    <a href="/admin/bill" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Bills
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="product">
                    <a href="/admin/product" class="nav-link">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="product-type">
                    <a href="/admin/product-type" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Product types
                        </p>
                    </a>
                </li>

                <li class="nav-item" id="user">
                    <a href="/admin/user" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>

                <li class="nav-item" id="supplier">
                    <a href="/admin/supplier" class="nav-link">
                        <i class="nav-icon fab fa-bandcamp"></i>
                        <p>
                            Suppliers
                        </p>
                    </a>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>