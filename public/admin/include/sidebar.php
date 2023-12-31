<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../../account/logout.php" class="nav-link">Logout</a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../template/admin/dist/img/admin.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="../main_page/index.php" class="d-block">
                    ADMIN
                </a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item "><!-- menu-open -->
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-building"></i>
                        <p>
                            Nhà Cung Cấp
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../supplier/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Nhà Cung Cấp</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../supplier/index_supplier.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Nhà Cung Cấp</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-warehouse"></i>
                        <p>
                            Nhập Kho
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../warehouse/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Hàng Hóa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../warehouse/index_warehouse.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Hàng Hóa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../warehouse/expired_date.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hàng Đã Hết Hạn</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item "><!-- menu-open -->
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p>
                            Danh Mục
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../category/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Danh Mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../category/index_category.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Danh Mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-carrot"></i>
                        <p>
                            Sản Phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../product/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Sản Phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../product/index_product.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Sản Phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-truck"></i>
                        <p>
                            Đơn Hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../order/index_order.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Đơn Hàng</p>
                            </a>
                            <a href="../order/success_order.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn Thành Công</p>
                            </a>
                            <a href="../order/fail_order.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn Đã Hủy</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <p>
                            Nhập Kho SP Đấu Giá
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../warehouse_bid/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Kho Đấu Giá</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../warehouse_bid/index_warehouse_bid.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Kho</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../warehouse_bid/expired_date.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Kho Hết Hạn</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-gavel"></i>
                        <p>
                            Đấu Giá
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../bid/index_bid.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Đấu Giá</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../bid/success_bid.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn Đấu Giá Thành Công</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        <p>
                            Quản Lý Người Dùng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../user_business/index_user.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Người Dùng</p>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../user_business/index_business.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Doanh Nghiệp</p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->