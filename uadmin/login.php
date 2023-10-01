<?php 
    session_start();
    include '../config/db.php';
    include '../config/config.php';
    include '../config/functions.php';


$msg = "";

$email_err = $password_err= ""; 
$email = $password= "";


    
    if (isset($_POST['signin'])) {
        
         if (empty($_POST["email"])) {
            $email_err = "Email is required";
          } else {
            $email = text_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $email_err = "Invalid email format"; 
            }
          }
          
          
          if (empty($_POST["password"])) {
            $password_err = "Password is required";
          } else {
            $password = text_input($_POST["password"]);
            // check if name only contains letters and whitespace
          }

        if($email == "" || $password == ""){
            $msg = "Email or Password fields cannot be empty!";
        }else{
            $sql = mysqli_query($link, "SELECT id, email, password FROM admin WHERE email='$email' AND password= '$password'");
            if(mysqli_num_rows($sql) > 0){
                $data = mysqli_fetch_assoc($sql);
                $_SESSION['adminemail'] = $data['email'];
                $_SESSION['adminid'] = $data['id'];

              
                echo "<script>window.location.href = 'index.php' </script>";
                // header("location: index.php");
            }else{
                $msg = "Invalid Email and Password";
            }
        }
    }



 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login | Admin</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="../assets/images/logo/favicon.png"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/css/util.css">
  <link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100" style="background-color: #00150F;">
        <form class="login100-form validate-form" method="post" action="login.php">
         
          <span class="login100-form-title p-b-48">
          <a class="navbar-brand" href="index.html">
            <img src="../assets/images/logo/logo.svg" alt="logo">
        </a>
          </span>
           <span class="login100-form-title p-b-26">
            Welcome
          </span>
          <div class="wrap-input100 validate-input" data-validate = "">
            <input class="input100" type="text" name="email">
            <span class="focus-input100" data-placeholder="Email"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="password">
            <span class="focus-input100" data-placeholder="Password"></span>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" type="submit" name="signin">
                Login
              </button>
            </div>
          </div>


        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="login/vendor/bootstrap/js/popper.js"></script>
  <script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="login/vendor/daterangepicker/moment.min.js"></script>
  <script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="login/js/main.js"></script>

</body>
</html>