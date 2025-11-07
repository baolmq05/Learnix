<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <!-- Library -->
    <link rel="stylesheet" href="./Assets/Admin/css/bootstrap.css">

    <link rel="stylesheet" href="./Assets/Admin/vendors/iconly/bold.css">
    <link rel="stylesheet" href="./Assets/Admin/vendors/apexcharts/apexcharts.css">

    <link rel="stylesheet" href="./Assets/Admin/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="./Assets/Admin/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="./Assets/Admin/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="./Assets/Admin/css/app.css">
    <link rel="shortcut icon" href="./Assets/Admin/images/favicon.svg" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="./Assets/Admin/css/custom/order.css">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper d-flex flex-column justify-content-between align-items-stretch active">
                <div class="content">
                    <div class="sidebar-header">
                        <div class="d-flex justify-content-between">
                            <div class="logo">
                                <a href="admin.php"><img src="./Assets/Admin/images/logo/logo.png" alt="Logo" srcset=""></a>
                            </div>
                            <div class="toggler">
                                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-menu">
                        <ul class="menu">
                            <li class="sidebar-item active ">
                                <a href="admin.php" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Thống kê</span>
                                </a>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-stack"></i>
                                    <span>Chủ đề</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="?page=category">Quản lý chủ đề</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="?page=category&action=create">Thêm chủ đề</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="?page=course" class='sidebar-link'>
                                    <i class="bi bi-collection-fill"></i>
                                    <span>Khóa học</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="?page=course">Quản lý khóa học</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="?page=course&action=accept">Duyệt khóa học</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-hexagon-fill"></i>
                                    <span>Bình luận</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="?page=comment&action=index">Danh sách</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-hexagon-fill"></i>
                                    <span>Rút tiền</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="?page=withdraw">Quản lí rút tiền</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-file-earmark-medical-fill"></i>
                                    <span>Đơn hàng</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="admin.php?page=order">Danh sách</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-pen-fill"></i>
                                    <span>Người dùng</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="admin.php?page=user">Quản lý người dùng</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="admin.php?page=user&action=create">Thêm người dùng</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                </div>
                <div class="d-grid gap-2 mb-2">
                    <button class="btn btn-outline-danger mx-3">Đăng xuất</button>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card mb-0">
                        <div class="card-body d-flex justify-content-between">
                            <header class="mb-3">
                                <a href="#" class="burger-btn d-block d-xl-none d-flex align-items-start m-0 p-0">
                                    <i class="bi bi-justify fs-3"></i>
                                </a>
                            </header>
                            <a href="?page=profile">
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="name">
                                        <h5 class="font-bold fs-5 m-0 mx-3">John Duck</h5>
                                        <span class="text-muted fs-6 m-0 mx-3">Quản trị viên</span>
                                    </div>
                                    <div class="avatar avatar-xs">
                                        <img src="Assets/Admin/images/faces/1.jpg" alt="Face 1">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>