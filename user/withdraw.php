<?php  
include 'header.php';

if ($verify == "0" ) {
    echo "<script>window.location.href = 'profile.php' </script>";
}

$msg = $err = "";

if (isset($_POST['submit'])) {
	$add = text_input($_POST['to']);
	$amount = text_input($_POST['amount']);
	if (!empty($add) && !empty($amount)) {
        if ($verify == 0 || $verify == 2) {
            $err = "Your account needs to be verified before you can withdraw";
        }elseif($amount > $balance){
			$err = "Insufficienct Funds";
		}else{
			$status = "Pending";
			$date = date('d M,Y');
			$insert = mysqli_query($link, "INSERT INTO wbtc (`moni`, `email`, `status`, `wal`, `date`) VALUES ('$amount', '$email', '$status', '$add', '$date') ");
            if ($insert) {
                mysqli_query($link, "UPDATE users SET balance = balance - $amount WHERE email = '$email' ");
                $subject = " Withdrawal Request";
                $body = "<h4>Hello ".$name." Withdrawal Request </h4> <p> Your withdrawal request of $ ".$amount." has been sent, you wallet will be credited once it is approved </p> ";
                sendMail($email, $name, $subject, $body);
                $msg = "Withdrawal request has been sent";
            }
		}
		
	}
}
?>


<div class="content-wrapper bg-dark">

<?php  
if ($msg != "") {
    echo userAlert("success", $msg);
    echo pageRedirect("3", "withdraw.php");
}

if ($err != "") {
    echo userAlert("error", $err);
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
                                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Withdraw
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body" onc>
                                    <p><b>Withdraw Funds</b></p><br>
                                    <div style="font-size: 14px;" class="alert alert-secondary mb-4">Enter withdrawsl
                                        information correctly
                                    </div>

                                    <div>
                                        <form action="withdraw.php" method="POST">
                                            <input type="hidden" name="_token"
                                                value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ">
                                            <div class="form-group">
                                                <label for="address">Enter your BTC address</label>
                                                <input type="text" class="form-control" name="to" id="address"
                                                    aria-describedby="addressHelp" placeholder="Eg. bc1hju2893d....">
                                                <small id="addressHelp" class="form-text text-muted">Enter a valid BTC
                                                    address</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="amount">Enter amount</label>
                                                <input type="number" class="form-control" name="amount" id="amount"
                                                    aria-describedby="amountHelp" placeholder="Eg. 1000">
                                            </div><br>

                                            <div style="font-size: 12px;" class="mb-2">Note: Only enter a valid Bitcoin
                                                (BTC) address</div>
                                            <button type="submit" name="submit" class="btn btn-sm btn-primary txt-white w-100">Withdraw</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p>Withdrawal History</p>

                                    <div class="table-responsive" style="max-height: 400px;">
                                        <table class="table table-striped">
                                            <thead class="th-text-md">
                                                <tr>
                                                    <th><i class="fa fa-clock"></i></th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>To</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tb-text-md">
                                                <?php  
                                                $i = 0;
                                                    $with = mysqli_query($link, "SELECT * FROM wbtc WHERE email = '$email' ORDER BY id DESC " );
                                                    if (mysqli_num_rows($with) > 0) {
                                                        while ($data = mysqli_fetch_assoc($with)) {
                                                            $i++
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $data['moni'] ?></td>
                                                    <td><?php echo $data['status'] ?></td>
                                                    <td><?php echo $data['wal'] ?></td>
                                                    <td><?php echo $data['date'] ?></td>
                                                </tr>
                                            <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div >









                </div>

<script type="text/javascript">
	document.getElementById('').value
</script>
<?php  
include 'footer.php';
?>