<?php
session_start();
include '../config/db.php';
include '../config/config.php';
include '../config/functions.php';

$msg = "";
$err = "";

$email_err = $password_err = "";
$email = $password = "";

if (isset($_POST['login_action'])) {

    if (empty($_POST["email"])) {
        $err = "Email is required";
    } else {
        $email = text_input($_POST["email"]);
    }

    if ($email == "") {
        $err = "Provide your email address";
    } else {
        $mail = text_input($_POST['email']);
        $s = mysqli_query($link, "SELECT * FROM users WHERE email = '$mail' ");
        if (mysqli_num_rows($s) > 0) {
            $row = mysqli_fetch_assoc($s);
            $pass = $row['password'];
            $name = $row['fname'] . " " . $row['lname'];
            $umail = $row['email'];
            $body = "<h4>Dear " . $name . " </h4> <p>We're sorry to hear that you've forgotten your password. We understand how important it is to keep your account secure, so we`ve helped you retrieve your password</p> <h4>Below are your account credentials</h4>  <p> Your Email Address is <b>" . $umail . "</b></p> <p> Your password is <b>" . $pass . "</b></p> ";
            $subject = "Forgotten Password";

            // sendMail($umail, $name, $subject, $body);

            $msg = "Check your mail for further instructions";
        } else {
            $err =  "Email account could not be found";
        }
    }
}


?>

<!doctype html>
<html lang="en">


<!-- Mirrored from www.indonez.com/html-demo/Cirro/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2022 18:41:08 GMT -->
<!-- Added by HTTrack -->
<!-- Mirrored from astromineoptions.com/login by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Dec 2022 00:21:06 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Peter Parker">
    <meta name="theme-color" content="#2E89EA" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <!-- Touch icon -->
    <link rel="apple-touch-icon-precomposed" href="../images/favicon.ico">
    <title>Sign in - Trade Nation</title>

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
        <div class="spinner-grow spinner-grow-sm text-success"></div>
        <div class="spinner-grow spinner-grow-sm text-success"></div>
        <div class="spinner-grow spinner-grow-sm text-success"></div>
    </div>
    <!-- page loader end -->
    <main>
        <!-- section content begin -->
        <section style="background-color: #00150F;">
            <div class="container-fluid overflow-hidden">
                <div class="row vh-100">

                    <div class="col-md-12 col-lg-6 d-flex align-items-center">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-12">
                                <div class="text-center">
                                    <a class="navbar-brand" href="../index.html">
                                        <img src="../assets/images/logo/logo.svg" alt="logo">
                                    </a>
                                    <p class="lead mt-1 mb-3">Get your password back</p>
                                    <!-- login form begin -->
                                    <?php
                                    if ($msg != "") {
                                        echo userAlert("success", $msg);
                                        echo pageRedirect("3", "forgot-password.php");
                                    }

                                    if ($err != "") {
                                        echo userAlert("error", $err);
                                    }
                                    ?>
                                    <form class="mb-2" method="POST" action="forgot-password.php">
                                        <div class="row g-1">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="email" name="email" required="" class="form-control" placeholder="Email" aria-label="Email">
                                                    <span class="input-group-text"><i class="fas fa-envelope fa-xs text-muted"></i></span>
                                                </div>
                                            </div>


                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-success" name="login_action">Proceed</button>
                                            </div>
                                        </div>
                                    </form>

                                    <small class="text-muted">Don't have an account? <a href="sign-up.php" class="link-success text-decoration-none">Register here</a></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 bg-light shadow-lg d-none d-lg-block" style="background-image: url(../img/back.jfif); background-size: cover;"></div>
                </div>
            </div>
        </section>
        <!-- section content end -->
    </main>



    <!-- javascript -->
    <script src="../js/vendors/bootstrap.min.js"></script>
    <script src="../js/utilities.min.js"></script>
    <script src="../js/config-theme.js"></script>
    
  <!-- GetButton.io widget -->
  <script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+1 (623) 352-5942", // WhatsApp number
            call_to_action: "Message Us", // Call to action
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
</body>


<!-- Mirrored from www.indonez.com/html-demo/Cirro/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2022 18:41:08 GMT -->

<!-- Mirrored from astromineoptions.com/login by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Dec 2022 00:21:07 GMT -->

</html>