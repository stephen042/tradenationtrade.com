<?php
session_start();

include '../config/db.php';
include '../config/config.php';
include '../config/functions.php';

$err = $msg = "";

if (isset($_SESSION['2fa_login'])) {
    $login_email = $_SESSION['2fa_login'];
    $qq = mysqli_query($link, "SELECT * FROM users WHERE email = '$login_email' ");
    if (mysqli_num_rows($qq) > 0) {
        $data = mysqli_fetch_assoc($qq);
        $fname = $data['fname'];
        $fa2_code = $data['2fa_code'];
        $email = $data['email'];
    }
} else {
    echo pageRedirect("0", "login.php");
}

if (isset($_POST['submit'])) {
    $otp = text_input($_POST['otp']);
    if ($otp == $fa2_code) {
        $_SESSION['user_mail'] = $login_email;
        echo "<script>window.location.href = '../user/dashboard.php' </script>";
    } else {
        $err = "Invalid OTP";
    }
}

?>
<!doctype html>
<html lang="en">


<!-- Mirrored from www.indonez.com/html-demo/Cirro/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2022 18:41:08 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="Trade">
    <meta name="author" content="Peter Parker">
    <meta name="theme-color" content="#2E89EA" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <!-- Touch icon -->
    <link rel="apple-touch-icon-precomposed" href="../assets/images/logo/favicon.png">
    <title>Auth OTP - Trade Nation</title>

    <script src="../dash/js/jquery-3.2.1.min.js"></script>
    <script src="../dash/notiflix-Notiflix-dfaf93f/dist/notiflix-aio-3.2.5.min.js"></script>
    <link rel="stylesheet" href="user/dash/css/style.css">
    <link rel="stylesheet" href="user/dash/css/user-custom.css">
    <script src="user/dash/notiflix-aio-3.2.5.min.js"></script>
    <script src="user/js/jquery-3.2.1.min.js"></script>

</head>

<body>
    <!-- page loader begin -->
    <div class="page-loader w-100 h-100 bg-white d-flex justify-content-center align-items-center position-fixed overflow-hidden">
        <div class="spinner-grow spinner-grow-sm text-primary"></div>
        <div class="spinner-grow spinner-grow-sm text-primary"></div>
        <div class="spinner-grow spinner-grow-sm text-primary"></div>
    </div>
    <!-- page loader end -->
    <main style="background-color: #00150F;">
        <form action="../user/logout.php" method="post" id="logoutForm"></form>
        <form action="resend.php" method="post" id="otpResendForm">
            <input type="hidden" name="resend">
            <input type="hidden" name="email" value="<?php echo $email ?>">
        </form>
        <!-- section content begin -->
        <section>
            <div class="container-fluid overflow-hidden">
                <div class="row vh-100">

                    <div class="col-md-12 col-lg-6 d-flex align-items-center">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6">
                                <div class="text-center">
                                    <a class="navbar-brand" href="../index.html">
                                        <img src="../assets/images/logo/logo.svg" alt="logo">
                                    </a>
                                    <p class="lead mt-1 mb-3">Welcome back <?php echo ucfirst($fname) ?>!</p>
                                    <?php
                                    if (isset($_GET['resend'])) {
                                    ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            One time password has been resent to your mail
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php } ?>
                                    <h6 class="font-weight-bold mt-4">Two Factor Authentication</h6>
                                    <p class="mb-4" style="font-size: 13px;">A one time password has been sent to
                                        <?php echo $login_email ?>.
                                        Kindly input OTP below. </p>

                                    <?php
                                    if ($msg != "") {
                                        echo userAlert("success", $msg);
                                    }

                                    if ($err != "") {
                                        echo userAlert("error", $err);
                                    }
                                    ?>
                                    <!-- login form begin -->
                                    <form class="mb-2" method="POST" action="2fa.php">
                                        <div class="row g-1">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="text" name="otp" class="form-control" placeholder="OTP" aria-label="OTP">
                                                    <span class="input-group-text"><i class="fas fa-lock fa-xs text-muted"></i></span>
                                                </div>
                                            </div>

                                            <br><br><br>

                                            <small class="text-muted">Did not receive OTP ? <a href="javascript:void()" id="otpResendBtn" class="link-primary text-decoration-none">Resend</a></small>

                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary" name="submit">Authenticate</button>
                                            </div>
                                        </div>
                                    </form>

                                    <small class="text-muted"><a href="javascript:void()" id="logoutBtn" class="link-primary text-decoration-none">Logout</a></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 bg-light shadow-lg d-none d-lg-block" style="background-image: url(..//img/back.jfif); background-size: cover;"></div>
                </div>
            </div>
        </section>
        <!-- section content end -->
    </main>




    <script>
        // $(document).ready(function() {
        //     alert('hello9')
        // })

        $(document).on('click', '#logoutBtn', function() {
            $('#logoutForm').submit();
        })

        $(document).on('click', '#otpResendBtn', function() {
            $('#otpResendForm').submit();
        })
    </script>
    <!-- javascript -->
    <script src="../js/vendors/bootstrap.min.js"></script>
    <script src="../js/utilities.min.js"></script>
    <script src="../js/config-theme.js"></script>


    <!-- GetButton.io widget -->
    <script type="text/javascript">
        (function() {
            var options = {
                whatsapp: "+1 (623) 352-5942", // WhatsApp number
                call_to_action: "Message Us", // Call to action
                position: "left", // Position may be 'right' or 'left'
            };
            var proto = document.location.protocol,
                host = "getbutton.io",
                url = proto + "//static." + host;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = url + '/widget-send-button/js/init.js';
            s.onload = function() {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })();
    </script>
    <!-- /GetButton.io widget -->
</body>


<!-- Mirrored from www.indonez.com/html-demo/Cirro/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2022 18:41:08 GMT -->

</html>