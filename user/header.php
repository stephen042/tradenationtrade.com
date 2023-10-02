<?php
include 'session.php';

if (isset($_GET['switch'])) {
    if ($account_type == 'live') {
        $sw = 'demo';
    } else {
        $sw = 'live';
    }
    $switch = mysqli_query($link, "UPDATE users SET account_type = '$sw' WHERE email = '$email' ");
    if ($switch) {
        echo "<script>window.location.href = 'dashboard.php' </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ" />
    <title> Dashboard - <?php echo $sitename ?>
    </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/vendor.bundle.base.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="vendors/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="dash/css/style.css">
    <link rel="stylesheet" href="dash/css/user-custom.css">
    <script src="dash/notiflix-aio-3.2.5.min.js"></script>
    <!-- endinject -->
    <link rel="shortcut icon" type="image/png" href="../assets/images/logo/favicon.png">
    <!-- <link rel="shortcut icon" href="../img/logo.png" /> -->

    <script src="js/jquery-3.2.1.min.js"></script>


    <style>
        .tb-text-sm tr td {
            font-size: 12px !important;
        }

        .th-text-sm tr th {
            font-size: 12px !important;
        }
    </style>
    
    <!-- crisp Live Chat -->
    <script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "7aea3e6a-97a4-4565-b8ec-619ccaff5a45";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>

</head>

<body>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" style="color: rgba(255, 255, 255, 0.805)" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                    <button type="button" class="close btn-sm btn btn-danger text-white" id="modalHide" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert">
                        <h6>Welcome</h6>
                        <p>Hello <?php echo ucfirst($name) ?>, Welcome to <?php echo $sitename ?> Select a trading plan that fits your budget.
                            Deposit and start trading.</p>
                        <span style="font-size: 10px;">2022-12-20 19:54:30 <?php echo date('Y-m-d H:i:s') ?> </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="activityModalLabel" style="color: rgba(255, 255, 255, 0.805)" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activityModalLabel">Activities</h5>
                    <button type="button" class="close btn-sm btn btn-danger text-white" id="activityModalHide" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert" style="background-color: rgba(0, 0, 0, 0.5); color: rgba(255, 255, 255, 0.809);">
                        <p>Recent login on Windows 10.0, Opera(105.112.213.119)</p>
                        <span style="font-size: 10px;">2022-12-25 00:37:51</span>
                    </div>
                    <div class="alert" style="background-color: rgba(0, 0, 0, 0.5); color: rgba(255, 255, 255, 0.809);">
                        <p>Recent login on Windows 10.0, Firefox(105.112.213.119)</p>
                        <span style="font-size: 10px;">2022-12-25 00:28:34</span>
                    </div>
                    <div class="alert" style="background-color: rgba(0, 0, 0, 0.5); color: rgba(255, 255, 255, 0.809);">
                        <p>Recent login on Windows 10.0, Firefox(105.112.209.48)</p>
                        <span style="font-size: 10px;">2022-12-24 20:13:07</span>
                    </div>
                    <div class="alert" style="background-color: rgba(0, 0, 0, 0.5); color: rgba(255, 255, 255, 0.809);">
                        <p>Recent login on Windows 10.0, Firefox(105.112.109.53)</p>
                        <span style="font-size: 10px;">2022-12-20 19:54:31</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="index.php"><img src="../assets/images/logo/logo.svg" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.php"><img src="../assets/images/logo/favicon.png" alt="logo" /></a>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="fa fa-sort"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

                <ul class="navbar-nav navbar-nav-right">
                    <?php
                    if ($account_type == 'live') {
                    ?>
                        <li class="nav-item dropdown me-3">
                            <button class="btn btn-sm" data-toggle="dropdown" id="balanceDropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold; font-size: 15px; background-color: rgba(35, 67, 67, 0.716); color:rgba(255, 255, 255, 0.827);">
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                $<?php echo number_format($balance, 2) ?>
                            </button>


                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown p-3" aria-labelledby="balanceDropdown" style="background-color: rgba(230, 230, 230, 0.987);">

                                <div class="mb-3 p-3" style="border-left: solid 5px rgb(35, 60, 115);">
                                    <div>Main Balance</div>
                                    <div style="font-size: 21px; margin-top: -10px;">
                                        $<?php echo number_format($balance, 2) ?></div>
                                </div>

                                <div class="mb-1">
                                    <div>Demo Balance</div>
                                    <div style="font-size: 20px; margin-top: -10px;">
                                        $<?php echo number_format($demo_balance, 2) ?></div>
                                    <div style="font-size: 13px; margin-top: -5px;">
                                        <a href="?switch" style="text-decoration: none;">Switch to
                                            demo</a>
                                    </div>
                                </div>
                                <div class="mb-1 mt-3 p-3 text-white" style="background-color: rgb(18, 53, 81);">
                                    <div style="font-size: 12px">Active Stakings</div>
                                    <div style="font-size: 16px; margin-top: -5px;">
                                        $0.00
                                    </div>
                                    <div class="text-success" style="font-size: 13px; margin-top: -5px;">
                                        Profit:
                                        +$0
                                        (<i class="fa fa-angle-up"></i>0%)

                                    </div>
                                </div>

                            </div>

                        </li>
                    <?php } ?>
                    <?php
                    if ($account_type == 'demo') {
                    ?>
                        <li class="nav-item dropdown me-3">
                            <button class="btn btn-sm" data-toggle="dropdown" id="balanceDropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold; font-size: 15px; background-color: rgba(35, 67, 67, 0.716); color:rgba(255, 255, 255, 0.827);">
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                Demo: $<?php echo number_format($demo_balance, 2) ?>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown p-3" aria-labelledby="balanceDropdown" style="background-color: rgba(230, 230, 230, 0.987);">
                                <div class="mb-3 p-3" style="border-left: solid 5px rgb(35, 60, 115);">
                                    <div>Demo Balance</div>
                                    <div style="font-size: 20px; margin-top: -10px;">
                                        $<?php echo number_format($demo_balance, 2) ?></div>
                                </div>

                                <div class="mb-1">
                                    <div>Main Balance</div>
                                    <div style="font-size: 20px; margin-top: -10px;">
                                        $<?php echo number_format($balance, 2) ?></div>
                                    <div style="font-size: 13px; margin-top: -5px;">
                                        <a href="?switch" style="text-decoration: none;">Switch to
                                            main</a>
                                    </div>
                                </div>
                                <div class="mb-1 mt-3 p-3 text-white" style="background-color: rgb(18, 53, 81);">
                                    <div style="font-size: 12px">Active Stakings</div>
                                    <div style="font-size: 16px; margin-top: -5px;">
                                        $0.00
                                    </div>
                                    <div class="text-success" style="font-size: 13px; margin-top: -5px;">
                                        Profit:
                                        +$0
                                        (<i class="fa fa-angle-up"></i>0%)

                                    </div>
                                </div>

                            </div>
                        </li>

                    <?php } ?>

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="images/userIcon2.png" alt="profile" />
                            <span class="nav-profile-name"><?php echo ucfirst($name) ?></span>
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="profile.php">
                                <i class="fa fa-cog text-primary"></i>
                                profile
                            </a>
                            <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown" id="notificationBtn">
                                <i class="fa fa-bell text-primary"></i>
                                Notifications
                            </a>
                            <a class="dropdown-item " href="#" data-toggle="dropdown" id="activityBtn">
                                <i class="fa fa-bars text-primary"></i>
                                Activities
                            </a>
                            <a class="dropdown-item" id="logoutBtn" href="logout.php">
                                <i class="fa fa-sign-out text-primary"></i>
                                Logout
                            </a>
                            <!-- <form action="" method="POST" id="logoutForm"><input
                                    type="hidden" name="_token" value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ"></form> -->
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="fa fa-bars"></span>

                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fa fa-home menu-icon"></i>
                            <span class="menu-title">Markets +</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="plan.php">
                            <i class="fa fa-cube  menu-icon"></i>
                            <span class="menu-title">Trading Packages</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="Ai-trade.php">
                            <i class="fa fa-cube  menu-icon"></i>
                            <span class="menu-title">-Ai-Trading Subscription</span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="signal.php">
                            <i class="fa fa-cubes menu-icon"></i>
                            <span class="menu-title">Signal Subscription</span>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="chart.php">
                            <i class="fa fa-signal  menu-icon"></i>
                            <span class="menu-title">Chart</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trade-history.php">
                            <i class="fa fa-signal menu-icon"></i>
                            <span class="menu-title">P/L records</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stake.php">
                            <i class="fa fa-cubes menu-icon"></i>
                            <span class="menu-title">Stake</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="staking-history.php">
                            <i class="fa fa-signal menu-icon"></i>
                            <span class="menu-title">Stake History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deposit.php">
                            <i class="fa fa-money-bill menu-icon"></i>
                            <span class="menu-title">Deposit</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="transactions.php">
                            <i class="fa fa-bars menu-icon"></i>
                            <span class="menu-title">Transactions</span>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="withdraw.php">
                            <i class="fa fa-money-bill menu-icon"></i>
                            <span class="menu-title">Withdraw</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">
                            <i class="fa fa-user menu-icon"></i>
                            <span class="menu-title">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="security.php">
                            <i class="fa fa-lock menu-icon"></i>
                            <span class="menu-title">Security</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="support.php">
                            <i class="fa fa-comment menu-icon"></i>
                            <span class="menu-title">Support</span>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">