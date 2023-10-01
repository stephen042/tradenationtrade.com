<?php  
include 'header.php';

if ($verify == "0" ) {
    echo "<script>window.location.href = 'profile.php' </script>";
}


$msg = "";
$err  = "";

if (isset($_POST['request'])) {

    $min = $_POST['plan_min'];

    if ($balance < $min) {
        $err = 'Insufficient Balance to place request';
    }else {
        $plan_id = $_POST['plan_id'];
	$dele = mysqli_query($link, "DELETE FROM package_request WHERE email = '$email' ");
	if ($dele) {
		$insert = mysqli_query($link, "INSERT INTO package_request (email, plan_id) VALUES ('$email', '$plan_id') ");
		if ($insert) {
			$msg = "Plan request sent. you will receive an email shortly";
		}
	}
    }

}
?>



<div class="content-wrapper bg-dark">
<?php  
if ($msg != "") {
	echo "<script>
	Notiflix.Report.success(
	  'Request Sent',
	  '".$msg."',
	  'OK',
	  function cb() {
	   window.location.href = 'plan.php'
	  },
	);
</script>";
}
?>
<?php
if ($err != "") {
    echo "<script>
Notiflix.Report.failure(
  'Insufficient Balance',
  '" . $err  . "',
  'OK',
);
</script>";
}
?>
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class=" align-items-end flex-wrap">

                                    <div class="d-flex">
                                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Plan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-secondary"><b>Packages</b></div>

                    <div class="row">
                    	<?php  
                    		$plan = mysqli_query($link, "SELECT * FROM package1 ");
                    		if (mysqli_num_rows($plan) > 0) {
                    			while ($pp = mysqli_fetch_assoc($plan)) {
                    	?>
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <span style="font-size: 25px;"><?php echo strtoupper($pp['pname']) ?></span><br>
                                    PACKAGE<br><br>
                                        <hr>
                                    <div style="text-align: left;">

                                        <p>
                                            <span style="color: rgba(180, 180, 180, 0.7)">Mininum deposit</span> <br>
                                            <b>$<?php echo number_format($pp['froms'],2) ?></b>
                                        </p>

                                        <p>
                                            <span style="color: rgba(180, 180, 180, 0.7)">Maximum deposit</span> <br>
                                            <b>$<?php echo number_format($pp['tos'],2) ?></b>
                                        </p>

                                        <!-- <p>
                                            <span style="color: rgba(180, 180, 180, 0.7)">Trades</span> <br> <b>5 per
                                                day</b>
                                        </p>

                                        <p><span style="color: rgba(180, 180, 180, 0.7)">Max Spread</span> <br>
                                            <b>1.1</b>
                                        </p><br> -->

                                        <!-- <p style="color: rgba(180, 180, 180, 0.856)">Demo Trading</p> -->

                                        <p style="color: rgba(180, 180, 180, 0.856)">Positive Balance Protection</p>
                                        <br>

                                        <p>
                                        <form action="plan.php" method="POST">
                                             <input type="hidden" name="plan_id" value="<?php echo $pp['id'] ?>">
                                             <input type="hidden" name="plan_min" value="<?php echo $pp['froms'] ?>">
                                         <?php  
                                         $planId = $pp['id'];
                                         	$reqch = mysqli_query($link, "SELECT * FROM package_request WHERE email = '$email' AND plan_id = '$planId' ");
                                         	if (mysqli_num_rows($reqch) == 1) {
                                         ?>
                                         	 <button type="submit" class="btn btn-sm btn-warning" disabled>Requested</button>
                                            <?php
                                             }else{
                                             ?>
                                             	<button type="submit" name="request" class="btn btn-sm btn-danger" style="color:white;">Request
                                                Plan</button>

                                             <?php
                                             }
                                            ?>

                                            
                                        </form>
                                        </p>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <?php }
                    		} ?>
                        

                    </div>








                </div>



<?php  
include 'footer.php';
?>