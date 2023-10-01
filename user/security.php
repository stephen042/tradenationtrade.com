<?php  
include 'header.php';

if ($verify == "0" ) {
    echo "<script>window.location.href = 'profile.php' </script>";
}

$err = $msg = "";
if (isset($_POST['update-psw'])) {
	$current_password = text_input($_POST['current_password']);
	$new_password = text_input($_POST['new_password']);
	$con_new_password = text_input($_POST['con_new_password']);
	if (!empty($current_password) && !empty($new_password) && !empty($con_new_password)) {
		if ($current_password != $password) {
			$err = "Current Password do not match";
		}elseif (strlen($new_password) < 6) {
			$err = "Password should be more than 6 characters";
		} elseif ($new_password != $con_new_password) {
			$err = "New Passwords do not match";
		}else{
			$update = mysqli_query($link, "UPDATE users SET password = '$new_password' WHERE id = '$userId'");
			if ($update) {
				$msg = "Password has been changed successfully";
			}
		}
	}
}

if (isset($_POST['turnoff'])) {
	$update = mysqli_query($link, "UPDATE users SET 2fa = '0' WHERE id = '$userId' ");
	if ($update) {
		$msg = "2 Factor Authentication has been disabled";
	}
}

if (isset($_POST['turnon'])) {
	$update = mysqli_query($link, "UPDATE users SET 2fa = '1' WHERE id = '$userId' ");
	if ($update) {
		$msg = "2 Factor Authentication has been enabled";
	}
}
?>


<div class="content-wrapper bg-dark">

 <?php 
	if ($msg != "") {
		echo userAlert('success', $msg);
    	echo pageRedirect("3", 'security.php');
	}
 ?>

  <?php 
	if ($err != "") {
		echo userAlert('error', $err);
	}
 ?>


                    <style>
                        .type-btn {
                            text-decoration: none;
                            color: rgb(100, 100, 100);
                            padding: 3px 10px;
                            background-color: #fff;
                            border: none;
                        }

                        .type-btn:active {
                            border-bottom: solid 5px rgb(100, 0, 0);
                        }

                        .type-active {
                            border-bottom: solid 5px rgb(100, 0, 0);
                            background-color: rgb(240, 240, 240)
                        }
                    </style>

                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class=" align-items-end flex-wrap">

                                    <div class="d-flex">
                                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp; Security
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 grid-margin">

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Change Password</h4>
                                    <p class="card-description">
                                        Enter Password information
                                    </p>
                                    <form class="forms-sample" method="POST"
                                        action="security.php">
                                        <input type="hidden" name="_token"
                                            value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ">
                                        <div class="form-group">
                                            <label for="old">Old Passowrd</label>
                                            <input type="password" name="current_password" class="form-control"
                                                placeholder="Old Passowrd">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">New Passowrd</label>
                                            <input type="password" name="new_password" class="form-control"
                                                placeholder="New Passowrd">
                                        </div>
                                        <div class="form-group">
                                            <label for="new">Re-type new Passowrd</label>
                                            <input type="password" name="con_new_password" class="form-control"
                                                placeholder="New Passowrd">
                                        </div>

                                        <button type="submit" name="update-psw" class="btn btn-primary me-2">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <span style="font-size: 16px; font-weight:bold;"><i
                                            class="fa fa-circle text-success"></i> &nbsp;
                                        &nbsp; Two Factor Authentication is <?php echo $fa2 == 1 ? "Active" : "Inactive" ?> </span><br><br><br>
                                    <span style="font-size: 14px">
                                        Turn off Two Factor Authentication <br>(<span
                                            style="color: rgb(173, 39, 39)">Not
                                            Recommended</span>) click below<br><br>
                                        <form action="security.php" method="POST">
                                            <input type="hidden" name="_token"
                                                value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ"> 
                                                <?php  
                                                	if ($fa2 == 1) {
                                                ?>
                                                <button type="submit" name="turnoff" onclick="return confirm('Do you want to turn off 2 factor Authentication')" 
                                                class="btn btn-sm btn-danger"
                                                style="margin-top: 10px; color:#fff;">Turn Off &nbsp; <i
                                                    class="fa fa-power-off"></i></button>
                                                <?php } ?>

                                                <?php  
                                                	if ($fa2 == 0) {
                                                ?>
                                                <button type="submit" name="turnon" onclick="return confirm('Do you want to turn on 2 factor Authentication')" 
                                                class="btn btn-sm btn-success"
                                                style="margin-top: 10px; color:#fff;">Turn On &nbsp; <i
                                                    class="fa fa-power-on"></i></button>
                                                <?php } ?>

                                        </form>
                                    </span><br><br>
                                </div>
                            </div>
                        </div>

                    </div>








                </div>

<?php  
include 'footer.php';
?>