<?php 
include 'header.php';
?>

<?php 
$fname = $countryy = $email = "";
$msg = "";
$err = "";

	if (isset($_POST['update'])) {
		if(empty(text_input($_POST['name']))){
			$fname = $name;
		}else{
			$fname = text_input($_POST['name']);
		}

		if(empty(text_input($_POST['email']))){
			$email = $aemail;
		}else{
			$email = text_input($_POST['email']);
		}
		if (!empty($fname) && !empty($email)) {
			$sql = mysqli_query($link, "UPDATE admin SET name = '$fname', email = '$email' WHERE email = '$aemail' ");
			if($sql){
				$msg = "Account has been updated successfully";
			}
		}
	}

	if (isset($_POST['change'])) {
	 	
	 	if (empty(text_input($_POST['oldpass']))) {
	 		$err = "Enter Current Password";
	 	}else{
	 		$oldpass = text_input($_POST['oldpass']);
	 	}

	 	if (empty(text_input($_POST['newpass']))) {
	 		$err = "Enter New Password";
	 	}elseif(text_input($_POST['newpass']) != text_input($_POST['newpass2'])) {
	 		$err = "Password Confirmation do not match";
	 	}elseif(strlen(text_input($_POST["newpass"])) < 6){
          $err = "New Password must have atleast 6 characters.";
	     }else{
		 		$newpass = text_input($_POST['newpass']);
		 }

	 	if (empty($err)) {
	 		if ($password != $oldpass) {
	 			$err = "Current Password didn`t match!";
	 		}else{
	 			$update = mysqli_query($link, "UPDATE admin SET password = '$newpass' WHERE email = '$aemail' ");
	 			if ($update) {
	 				$msg = "Password was updated successfully";
	 			}
	 		}
	 	}

	 }

?>

<div class="page-content">
    <div class="container-fluid">
<?php 
	if ($msg != "") {
		echo customAlert("success", $msg);
	}
	if ($err != "") {
		echo customAlert("error", $err);
	}

 ?>
 <br>
 <br>
 <br>
        <div class="row">
            <div class="col-xxl-9">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="fas fa-home"></i> Personal Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                    <i class="far fa-user"></i> Change Password
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="account.php" method="post">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Admin Name</label>
                                                <input type="text" class="form-control" name="name" data-provider="flatpickr" id=""  value="<?php echo $aname; ?>" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Admin Email</label>
                                                <input type="text" class="form-control" name="email" data-provider="flatpickr" id=""  value="<?php echo $aemail; ?>" placeholder="" />
                                            </div>
                                        </div>

                                        <!--end col-->
                                        

                                        
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn btn-soft-success">Cancel</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            <!--end tab-pane-->
                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                <form action="account.php" method="post">
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                <input type="password" class="form-control" id="oldpasswordInput" name="oldpass" placeholder="Enter current password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="newpasswordInput" class="form-label">New Password*</label>
                                                <input type="password" class="form-control" id="newpasswordInput" name="newpass" placeholder="Enter new password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                <input type="password" class="form-control" id="confirmpasswordInput" name="newpass2" placeholder="Confirm password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" name="change" class="btn btn-success">Change Password</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    <!-- container-fluid -->
</div><!-- End Page-content -->

<?php 
include 'footer.php';
?>