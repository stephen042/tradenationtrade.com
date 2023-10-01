<?php 
include 'header.php';
$msg ="";
$err = "";
if (isset($_POST['save'])) {
	$directions = trim($_POST['directions']);
	$symbol = trim($_POST['symbol']);
	$interval = trim($_POST['interval']);
	$unit = trim($_POST['unit']);
	$amount = trim($_POST['amount']);
	if (!empty($directions) && !empty($symbol) && !empty($interval) && !empty($unit) && !empty($amount) ) {
		$directions = strtolower($directions);
		$insert = mysqli_query($link, "INSERT INTO signals (`symbol`, `t_interval`, `unit`, `amount`, `directions`) VALUES ('$symbol', '$interval', '$unit', '$amount', '$directions') ");
		if ($insert) {
			$msg = "Signal has been created";
		}
		
	}
}

 ?>



<div class="page-content">
    <div class="container-fluid">
<?php 
  if ($msg != "") {
    echo customAlert("success", $msg);
    echo pageRedirect("2", "addsignals.php");
  }
  if ($err != "") {
    echo customAlert("error", $err);
  }

 ?>

      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div class="card-header">
                      <h4 class="card-title mb-0">Create Signal</h4>
                  </div>
                  <form method="post" action="addsignals.php">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Symbol(e.g EURUSD,BTCUSDT)</label>
                                        <input type="text" class="form-control" value="" name="symbol" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Interval(e.g 1 minute, 2 minutes)</label>
                                        <input type="text" class="form-control" value="" name="interval" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Unit(e.g 1,2,3)</label>
                                        <input type="text" class="form-control" value="" name="unit" id="basiInput">
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Amount($)</label>
                                        <input type="text" class="form-control" value="" name="amount" id="basiInput">
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Directions(Buy,Sell)</label>
                                        <input type="text" class="form-control" value="" name="directions" id="basiInput">
                                    </div>
                                </div>

                         
                                <div class="col-xxl-12 col-md-12">
                                    <div>
                                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


  </div>
</div>



 <?php 
  include 'footer.php';
 ?>