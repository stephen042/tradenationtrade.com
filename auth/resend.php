<?php  
session_start();

include '../config/db.php';
include '../config/config.php';
include '../config/functions.php';

$err = "";

if (isset($_POST['resend'])) {
	$email = $_POST['email'];
	$code = "0123456789";
    $fa2_code = str_shuffle($code);
    $fa2_code = substr($fa2_code, 0, 6);
	$update = mysqli_query($link, "UPDATE users SET 2fa_code = '$fa2_code' WHERE email = '$email' ");
	if ($update) {
		$qq = mysqli_query($link, "SELECT * FROM users WHERE email = '$email' ");
	    if (mysqli_num_rows($qq) > 0) {
	        $data = mysqli_fetch_assoc($qq);
	        $fname = $data['fname'];
	        $lname = $data['lname'];
	        $fa2_code = $data['2fa_code'];
	        $email = $data['email'];
	    }

	    $_SESSION['2fa_login'] = $email;
        $name = $fname." ".$lname;
        $subject = "Auth OTP";
        $body = "<h5>Login OTP</h5> <p>Hi ".$fname."</p> <p>A login attempt was made on your account. use the code below to complete sign in.</p> <h5> <strong>".$fa2_code."</strong> </h5> <p>Contact us as soon as possible if you didnt make this attempt.</p> <p>Thanks,</p> <p>".$sitename."</p> ";
        $send = sendMail($email, $name, $subject, $body);
        if ($send) {
            // echo "<script>window.location.href = '2fa.php' </script>";
        }
        echo "<script>window.location.href = '2fa.php?resend' </script>";
	}
	
}else{
	echo "<script>window.location.href = 'login.php' </script>";
}


?>