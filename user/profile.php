<?php  
include 'header.php';

$msg = "";
$err = "";
$err_verify = "";

if ($verify == "0") {
    $err_verify = 'Please Upload verification documents';
}

$firstname = $lastname = $uemail = $uphone = $ugender = $ucountry = "";

if (isset($_POST['update'])) {
	if(empty(text_input($_POST['firstname']))){
		$firstname = $fname;
	}else{
		$firstname = text_input($_POST['firstname']);
	}

	if(empty(text_input($_POST['lastname']))){
		$lastname = $lname;
	}else{
		$lastname = text_input($_POST['lastname']);
	}

	if(empty(text_input($_POST['phone']))){
		$uphone = $phone;
	}else{
		$uphone = text_input($_POST['phone']);
	}

	if(empty(text_input($_POST['country']))){
		$ucountry = $country;
	}else{
		$ucountry = text_input($_POST['country']);
	}

	if (!empty($firstname) && !empty($lastname) && !empty($uphone) && !empty($ucountry)) {
		$ugender = text_input($_POST['gender']);
		$update = mysqli_query($link, "UPDATE users SET fname = '$firstname', lname = '$lastname', phone = '$uphone', country = '$ucountry', gender = '$ugender' WHERE id = '$userId' ");
		if ($update) {
			$msg = "Profile updated succesfully";
		}else{
			
		}
	}
}


if (isset($_POST['verify'])) {
	$type = text_input($_POST['type']);
	if (!isset($_FILES["image"])) {
         $err = "No file to upload.";
    }else{
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $imgname = uniqid().".png";
        $folder = "verify/".$imgname;
        $check = @getimagesize($tempname);
        if ($check === false) {
            $err = "Please Select an Image";   
        }else{
        	$update = mysqli_query($link, "UPDATE users SET id_type = '$type', id_image = '$imgname', verify = '2' WHERE email = '$email' ");
        	if ($update) {
        		move_uploaded_file($tempname, $folder);
        		$msg = "Your verification documents has been submitted";
        	}else{
        		$err = "Error Occurred, try again";
        	}
        }
    }
}
?>

<div class="content-wrapper bg-dark">

<?php  
if ($msg != "") {
	echo userAlert("success", $msg);
	echo pageRedirect("3", "profile.php");
}

if ($err != "") {
	echo userAlert("error", $err);
}
?>

<?php
    if ($err_verify != "") {
        echo "<script>
	Notiflix.Report.failure(
	  'Unverified Account',
	  '" . $err_verify . "',
	  'OK',
	);
</script>";
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
                                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp; Profile
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <img src="images/userIcon2.png" alt="img" style="width: 100px;"><br><br>
                                        <p><b><?php echo ucwords($name) ?></b></p>
                                        <div
                                            style="font-size: 20px; display: inline-block; padding: 8px 20px; background-color:rgba(34, 92, 124, 0.544); border-radius: 6px;">
                                            <i class="fa fa-wallet"></i>&nbsp; $<?php echo number_format($balance,2) ?>
                                        </div>
                                    </center>
                                </div>
                            </div><br>

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Profile</h4>
                                    <p class="card-description">
                                        Enter profile information
                                    </p>
                                    <form class="forms-sample" method="POST" action="profile.php">
                                        <div class="form-group">
                                            <label for="firstname">Firstname</label>
                                            <input type="text" required="" name="firstname" class="form-control" value="<?php echo $fname ?>"
                                                id="firstname" placeholder="Firstname">
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Lastname</label>
                                            <input type="text" required="" name="lastname" class="form-control" value="<?php echo $lname ?>"
                                                id="lastname" placeholder="Lastname">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" required="" readonly class="form-control" value="<?php echo $email ?>"
                                                id="email" placeholder="Email" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" required="" name="phone" class="form-control" value="<?php echo $phone ?>"
                                                id="phone" placeholder="Phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select type="text"  name="gender" class="profile-select" id="gender"
                                                placeholder="gender">
                                                <option value="Male" <?php echo $gender == "Male" ? "selected" : "" ?>>Male</option>
                                                <option value="Female" <?php echo $gender == "Female" ? "selected" : "" ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" required="" name="country" class="form-control" value="<?php echo $country ?>"
                                                id="country" placeholder="Country">
                                        </div>
                                        <button type="submit" name="update" class="btn btn-primary me-2">Save</button>
                                    </form>
                                </div>
                            </div><br>
                        </div>

                        <div class="col-md-6 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <strong>Upload Verification Document</strong>
                                    <br><br>

                                    <?php  
                                    	if ($verify == 0) {
                                    ?>
                                    <div
                                        style="display:inline-block; font-weight:bold; border-radius: 10%; padding: 5px 10px; background-color:#eee; color:#000 !important; font-size:11px;">
                                        Not Verified
                                    </div>
                                <?php } ?>

                                <?php  
                                    	if ($verify == 1) {
                                    ?>
                                    <div
                                        style="display:inline-block; font-weight:bold; border-radius: 10%; padding: 5px 10px; background-color:green; color:#fff !important; font-size:11px;">
                                        Verified
                                    </div>
                                <?php } ?>

                                <?php  
                                    	if ($verify == 2) {
                                    ?>
                                    <div
                                        style="display:inline-block; font-weight:bold; border-radius: 10%; padding: 5px 10px; background-color:yellow; color:#000 !important; font-size:11px;">
                                        Pending
                                    </div>
                                <?php } ?>
                                    <br><br><br>


                                    <form action="profile.php" method="POST"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="_token"
                                            value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ"> <span>Tap the box below to
                                            choose file*</span>
                                        <input type="file" name="image" accept="image/*" class="form-control"
                                            style="background-color: #fff; color: #000;">
                                        <br><br>
                                        <div class="form-group">
                                            <label for="type">Method of Verification*</label>
                                            <select name="type" id="type" class="profile-select">
                                                <option value="Drivers License">Drivers License</option>
                                                <option value="International Passport">International Passport</option>
                                                <option value="National ID">National ID</option>
                                            </select>
                                        </div>
                                        <button type="submit" name="verify" class="btn btn-primary"
                                            style="float: left;">Upload</button>
                                    </form>

                                </div>
                            </div><br>



                        </div>

                    </div>






                </div>


<?php  
include 'footer.php';
?>