<?php 
session_start();

include '../config/db.php';
include '../config/config.php';
include '../config/functions.php';

if (isset($_SESSION['adminid'])) {
        $email = $_SESSION['adminemail'];
        $query = mysqli_query($link, "SELECT * FROM admin WHERE email = '$email' ");
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);

            $aemail = $row['email'];
            $apass = $row['password'];
            $aname = $row['name'];
            $id = $row['id'];
        }
    }else{
        // header("location: login.php");
        echo "<script>window.location.href = 'login.php' </script>";
    }




 ?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">


<!-- Mirrored from themesbrand.com/velzon/html/default/dashboard-nft.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Jul 2022 13:17:38 GMT -->
<head>

    <meta charset="utf-8" />
    <title> Dashboard | <?php echo $aname ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png">

    <link rel="stylesheet" href="../public/assets/libs/gridjs/theme/mermaid.min.css">

    <!--Swiper slider css-->
    <link href="../public/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- jsvectormap css -->
    <link href="../public/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="../public/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="../public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../public/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="../public/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

     <!--datatable css-->
    <link rel="stylesheet" href="../public/cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="../public/cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="../public/cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.php" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="../assets/images/logo/favicon.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="../assets/images/logo/logo.svg" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.php" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="../assets/images/logo/favicon.png" alt="" height="60">
                            <h4><?php echo $name ?></h4>
                        </span>
                        <span class="logo-lg">
                            <img src="../assets/images/logo/logo.svg" alt="" height="60">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <!-- <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
 -->                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



                


                
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo ucfirst($aname) ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome <?php echo ucfirst($aname) ?>!</h6>
                        <a class="dropdown-item" href="account.php"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Profile</span></a>

              <!--           <a class="dropdown-item" href="contact.php"><i
                                class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Help</span></a>
 -->                        <div class="dropdown-divider"></div>
                        

                        
                        <a class="dropdown-item" href="logout.php"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu" style="background:url('login/auth.jpg')">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="../assets/images/logo/favicon.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="../assets/images/logo/logo.svg" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="../assets/images/logo/favicon.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="../assets/images/logo/logo.svg" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <?php include 'sidebar.php'; ?>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <div class="main-content">