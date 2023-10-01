<?php 
include 'header.php';

if(isset($_GET['email'])){
	$email = $_GET['email'];
}else{
	$email = '';
}

$msg = "";
$err = "";

  $sql= "SELECT * FROM users WHERE email = '$email'";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
        
             }


    if(isset($_POST['edit'])){

        $password = $link->real_escape_string( $_POST['password']);
      $balance = $link->real_escape_string( $_POST['balance']);
      $demo_balance = $link->real_escape_string( $_POST['demo_balance']);
      $fname = $link->real_escape_string( $_POST['fname']);
      $lname = $link->real_escape_string( $_POST['lname']);
      $gender = $link->real_escape_string( $_POST['gender']);
      $country = $link->real_escape_string( $_POST['country']);
      $phone = $link->real_escape_string( $_POST['phone']);

      $sql1 = "UPDATE users SET demo_balance = '$demo_balance', fname ='$fname', lname = '$lname', password = '$password', phone = '$phone', gender ='$gender', country ='$country', balance = '$balance' WHERE email='$email'";
      
      if (mysqli_query($link, $sql1)) {
          $msg = "Account Details Edited Successfully!";
      } else {
          $err = "Cannot Edit Account! ";
      }
      }

?>


<div class="page-content">
    <div class="container-fluid">
<?php 
    if ($msg != "") {
        echo customAlert("success", $msg);
        echo pageRedirect("2", "user-edit.php?email=$email");
    }
    if ($err != "") {
        echo customAlert("error", $err);
    }

 ?>

 <br>
 <br>
 <br>
        <div class="row">
            <div class="col-xxl-12">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="fas fa-home"></i> Edit Info
                                </a>
                            </li>
                            

                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="user-edit.php?email=<?php echo $email ?>" method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstnameInput" placeholder="Enter your fullname" name="fname" value="<?php echo $row['fname'] ?>">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Last Name</label>
                                                <input type="text" name="lname" class="form-control" id="" placeholder="Enter your username"  value="<?php echo $row['lname'] ?>">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                <input type="number" class="form-control" id="phonenumberInput" placeholder="Enter  phone number" name="phone" value="<?php echo $row['phone'] ?>">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emailInput" readonly class="form-label">Email Address</label>
                                                <input type="email" name="email" class="form-control" id="emailInput" placeholder="Enter your email" value="<?php echo $row['email'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Live Balance</label>
                                                <input type="number" class="form-control" id="phonenumberInput" placeholder="Enter balance" name="balance" value="<?php echo $row['balance'] ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Demo Balance</label>
                                                <input type="number" class="form-control" id="phonenumberInput" max="50000" placeholder="Enter balance" name="demo_balance" value="<?php echo $row['demo_balance'] ?>">
                                            </div>
                                        </div>
                    
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Password</label>
                                                <input type="text" name="password" class="form-control" id="emailInput" placeholder="" value="<?php echo $row['password'] ;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Gender</label>
                                                <select name="gender" class="form-control">
                                                    <option value="Male" <?php echo $row['gender'] == "Male" ? "selected" : "" ?>>Male</option>
                                                    <option value="Female" <?php echo $row['gender'] == "Female" ? "selected" : "" ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                   		<div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="phonenumberInput" placeholder="" name="country" value="<?php echo $row['country'] ?>">
                                            </div>
                                        </div>
                                        
                                        

                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" name="edit" class="btn btn-primary">Update</button>
                                                
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            <!--end tab-pane-->


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