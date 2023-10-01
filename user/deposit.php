<?php  
include 'header.php';

if ($verify == "0" ) {
    echo "<script>window.location.href = 'profile.php' </script>";
}

$err = $msg = "";

if (isset($_POST['deposit'])) {
	$amount = text_input($_POST['amount']);
	$to = text_input($_POST['to']);
	$account = text_input($_POST['account']);
	if (!empty($amount) && !empty($to) && isset($_FILES['proof'])) {
		$filename = $_FILES["proof"]["name"];
        $tempname = $_FILES["proof"]["tmp_name"];
        $imgname = uniqid().".png";
        $folder = "proof/".$imgname;
        $check = @getimagesize($tempname);
        $status = "Pending";
        $date = date('d M,Y');
        if ($check === false) {
            $err = "Please Select an Image";   
        }else{
        	$insert = mysqli_query($link, "INSERT INTO btc (`usd`, `method`, `email`, `status`, `proof`, `uto`, `date`) VALUES ('$amount', '$account', '$email', '$status', '$imgname', '$to', '$date' ) ");
        	if ($insert) {
        		move_uploaded_file($tempname, $folder);
        		$subject = $sitename." Deposit";
        		$body = "<h4> ".$name." Deposit </h4> <p> Your deposit of $ ".$amount." of ".$account." has has been submitted, your account will be credited once it is confirmed </p> ";
        		sendMail($email, $name, $subject, $body);
        		$msg = "Deposit has been submitted";
        	}
        }

	}
}
?>


 <div class="content-wrapper bg-dark">

<?php  
if ($msg != "") {
	echo userAlert("success", $msg);
	echo pageRedirect("3", "deposit.php");
}

if ($err != "") {
	echo userAlert("error", $err);
}
?>


                    <style>
                        .type-btn {
                            text-decoration: none;
                            color: rgb(100, 100, 100);
                            padding: 3px 10px 3px 10px;
                            background-color: #fff;
                            border: none;
                            cursor: pointer;
                            border-radius: 10px;
                        }

                        .type-active {
                            border-top: solid 7px rgb(16, 125, 98);
                            background-color: rgb(80, 80, 80);
                            color: #fff;
                            font-weight: bolder;
                            padding: 0px 10px 0px 10px;
                        }
                    </style>

                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class=" align-items-end flex-wrap">

                                    <div class="d-flex">
                                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Deposit
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-3"><b>Deposit Funds</b></p><br>
                                    <p class="mb-3">Select payment method</p>

                                    <div class="row">
                                        <div class="col-6">
                                            <div id="btcBtn" class="type-btn type-active p-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <img src="assets/images/btc.png" class="w-100" alt="" srcset="">
                                                    </div>
                                                    <div class="col-6 pt-1"> BTC</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div id="ethBtn" class="type-btn p-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <img src="assets/images/eth.svg" class="w-100" alt="" srcset="">
                                                    </div>
                                                    <div class="col-6 pt-1"> ETH</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-6">
                                            <div id="bnbBtn" class="type-btn p-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <img src="assets/images/bnb.png" class="w-100" alt="" srcset="">
                                                    </div>
                                                    <div class="col-6 pt-1"> BNB</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div id="ltcBtn" class="type-btn p-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <img src="assets/images/ltc.png" class="w-100" alt="" srcset="">
                                                    </div>
                                                    <div class="col-6 pt-1"> LTC</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-6">
                                            <div id="usdtErcBtn" class="type-btn p-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <img src="assets/images/usdt.png" class="w-100" alt=""
                                                            srcset="">
                                                    </div>
                                                    <div class="col-6 pt-2"> <span style="font-size: 10px;">Tether
                                                            USD</span> <br>ERC20
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div id="usdtTrcBtn" class="type-btn p-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <img src="assets/images/usdt.png" class="w-100" alt=""
                                                            srcset="">
                                                    </div>
                                                    <div class="col-6 pt-2"> <span style="font-size: 10px;">Tether
                                                            USD</span> <br>TRC20
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div style="width: 100%; height: auto;" id="btcDiv">
                                        <div class="row">
                                            <div class="alert alert-secondary col-md-6"><span
                                                    style="font-size: 13px;">Scan the Qr code
                                                    or copy
                                                    the
                                                    Bitcoin (BTC) address below. Enter amount sent in USD, upload proof
                                                    of payment.
                                                    Payment will be reviewed and processed.</span></div>
                                            <div style="text-align: center;" class="col-md-6">
                                                
                                            <img src="https://chart.googleapis.com/chart?chs=225x225&chld=L|2&cht=qr&chl=<?php echo $btc;?>" alt="" class="img-fluid">

                                            </div>
                                        </div>
                                        <br>

                                        <div class="alert alert-secondary">
                                            <span style="font-size: 14px;" id="addressCopy">
                                                <?php echo $btc ?>
                                            </span>
                                            <a href="javascript:void()" onclick="copyFunction()"><i
                                                    class="fa fa-copy"></i></a>
                                        </div>

                                        <form action="deposit.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="_token"
                                                value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ"> 
                                                <input type="hidden" name="account" value="bitcoin">
                                            <input type="hidden" name="to" value="<?php echo $btc ?>">
                                            <div class="form-group">
                                                <label for="amount">Enter amount sent</label>
                                                <input type="number" required="" class="form-control" name="amount" id="amount"
                                                    aria-describedby="amountHelp" placeholder="Eg. 1000">
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Upload payment proof</label>
                                                <input type="file" required="" class="form-control" style="color: rgb(0, 128, 81);"
                                                    name="proof" id="proof" aria-describedby="amountHelp"
                                                    placeholder="Eg. 1000">
                                            </div>
                                            <div style="font-size: 13px;" class="mb-2">Note: only click paid after
                                                making payment to
                                                the above
                                                address</div>
                                            <div>
                                                <button type="submit" name="deposit" class="btn btn-md btn-primary w-100 txt-white">Paid</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>


                                    <div style="width: 100%; height: auto; display: none;" id="ethDiv">
                                        <div class="row">
                                            <div class="alert alert-secondary col-md-6"><span
                                                    style="font-size: 13px;">Scan the Qr
                                                    code
                                                    or copy
                                                    the
                                                    Ethereum (ETH) address below. Enter amount sent in USD, upload proof
                                                    of payment.
                                                    Payment will be reviewed and processed.</span></div>
                                            <div style="text-align: center;" class="col-md-6">
                                                <img src="https://chart.googleapis.com/chart?chs=225x225&chld=L|2&cht=qr&chl=<?php echo $eth;?>" alt="" class="img-fluid">

                                            </div>
                                        </div>
                                        <br>

                                        <div class="alert alert-secondary">
                                            <span style="font-size: 14px;" id="addressCopy">
                                                <?php echo $eth ?>
                                            </span>
                                            <a href="javascript:void()" onclick="copyFunction()"><i
                                                    class="fa fa-copy"></i></a>
                                        </div>

                                        <form action="deposit.php" method="POST"
                                            enctype="multipart/form-data">
                                             <input type="hidden"
                                                name="account" value="Ethereum">
                                            <input type="hidden" name="to"
                                                value="<?php echo $eth ?>">
                                            <div class="form-group">
                                                <label for="amount">Enter amount sent</label>
                                                <input type="number" required="" class="form-control" name="amount" id="amount"
                                                    aria-describedby="amountHelp" placeholder="Eg. 1000">
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Upload payment proof</label>
                                                <input type="file" required class="form-control" style="color: rgb(0, 128, 81);"
                                                    name="proof" id="proof" aria-describedby="amountHelp"
                                                    placeholder="Eg. 1000">
                                            </div>
                                            <div style="font-size: 13px;" class="mb-2">Note: only click paid after
                                                making payment to
                                                the above
                                                address</div>
                                            <div>
                                                <button type="submit" name="deposit" class="btn btn-md btn-primary w-100 txt-white">Paid</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>


                                    <div style="width: 100%; height: auto; display: none;" id="bnbDiv">
                                        <div class="row">
                                            <div class="alert alert-secondary col-md-6"><span
                                                    style="font-size: 13px;">Scan the Qr
                                                    code
                                                    or copy
                                                    the
                                                    BNB (BNB) address below. Enter amount sent in USD, upload proof of
                                                    payment.
                                                    Payment will be reviewed and processed.</span></div>
                                            <div style="text-align: center;" class="col-md-6">
                                                <img src="https://chart.googleapis.com/chart?chs=225x225&chld=L|2&cht=qr&chl=<?php echo $bnb;?>" alt="" class="img-fluid">

                                            </div>
                                        </div>
                                        <br>

                                        <div class="alert alert-secondary">
                                            <span style="font-size: 14px;" id="addressCopy">
                                                <?php echo $bnb ?>
                                            </span>
                                            <a href="javascript:void()" onclick="copyFunction()"><i
                                                    class="fa fa-copy"></i></a>
                                        </div>

                                        <form action="deposit.php" method="POST"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="_token"
                                                value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ"> <input type="hidden"
                                                name="account" value="bnb">
                                            <input type="hidden" name="to"
                                                value="<?php echo $bnb ?>">
                                            <div class="form-group">
                                                <label for="amount">Enter amount sent</label>
                                                <input type="number" required class="form-control" name="amount" id="amount"
                                                    aria-describedby="amountHelp" placeholder="Eg. 1000">
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Upload payment proof</label>
                                                <input type="file" required class="form-control" style="color: rgb(0, 128, 81);"
                                                    name="proof" id="proof" aria-describedby="amountHelp"
                                                    placeholder="Eg. 1000">
                                            </div>
                                            <div style="font-size: 13px;" class="mb-2">Note: only click paid after
                                                making payment to
                                                the above
                                                address</div>
                                            <div>
                                                <button type="submit" name="deposit" class="btn btn-md btn-primary w-100 txt-white">Paid</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>


                                    <div style="width: 100%; height: auto; display: none;" id="ltcDiv">
                                        <div class="row">
                                            <div class="alert alert-secondary col-md-6"><span
                                                    style="font-size: 13px;">Scan the Qr
                                                    code
                                                    or copy
                                                    the
                                                    Litecoin (ltc) address below. Enter amount sent in USD, upload proof
                                                    of payment.
                                                    Payment will be reviewed and processed.</span></div>
                                            <div style="text-align: center;" class="col-md-6">
                                                <img src="https://chart.googleapis.com/chart?chs=225x225&chld=L|2&cht=qr&chl=<?php echo $ltc;?>" alt="" class="img-fluid">

                                            </div>
                                        </div>
                                        <br>

                                        <div class="alert alert-secondary">
                                            <span style="font-size: 14px;" id="addressCopy">
                                                <?php echo $ltc ?>
                                            </span>
                                            <a href="javascript:void()" onclick="copyFunction()"><i
                                                    class="fa fa-copy"></i></a>
                                        </div>

                                        <form action="deposit.php" method="POST"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="_token"
                                                value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ"> <input type="hidden"
                                                name="account" value="litecoin">
                                            <input type="hidden" name="to"
                                                value="<?php echo $ltc ?>">
                                            <div class="form-group">
                                                <label for="amount">Enter amount sent</label>
                                                <input type="number" required class="form-control" name="amount" id="amount"
                                                    aria-describedby="amountHelp" placeholder="Eg. 1000">
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Upload payment proof</label>
                                                <input type="file" required class="form-control" style="color: rgb(0, 128, 81);"
                                                    name="proof" id="proof" aria-describedby="amountHelp"
                                                    placeholder="Eg. 1000">
                                            </div>
                                            <div style="font-size: 13px;" class="mb-2">Note: only click paid after
                                                making payment to
                                                the above
                                                address</div>
                                            <div>
                                                <button type="submit" name="deposit" class="btn btn-md btn-primary w-100 txt-white">Paid</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>

                                    <div style="width: 100%; height: auto; display: none;" id="usdtercDiv">
                                        <div class="row">
                                            <div class="alert alert-secondary col-md-6"><span
                                                    style="font-size: 13px;">Scan the Qr
                                                    code
                                                    or copy
                                                    the
                                                    Tether USD (ERC20) address below. Enter amount sent in USD, upload
                                                    proof of payment.
                                                    Payment will be reviewed and processed.</span></div>
                                            <div style="text-align: center;" class="col-md-6">
                                                <img src="https://chart.googleapis.com/chart?chs=225x225&chld=L|2&cht=qr&chl=<?php echo $usdt_erc;?>" alt="" class="img-fluid">

                                            </div>
                                        </div>
                                        <br>

                                        <div class="alert alert-secondary">
                                            <span style="font-size: 14px;" id="addressCopy">
                                                <?php echo $usdt_erc ?>
                                            </span>
                                            <a href="javascript:void()" onclick="copyFunction()"><i
                                                    class="fa fa-copy"></i></a>
                                        </div>

                                        <form action="deposit.php" method="POST"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="_token"
                                                value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ"> <input type="hidden"
                                                name="account" value="usdterc">
                                            <input type="hidden" name="to" value="<?php echo $usdt_erc ?>">
                                            <div class="form-group">
                                                <label for="amount">Enter amount sent</label>
                                                <input type="number" required class="form-control" name="amount" id="amount"
                                                    aria-describedby="amountHelp" placeholder="Eg. 1000">
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Upload payment proof</label>
                                                <input type="file" required class="form-control" style="color: rgb(0, 128, 81);"
                                                    name="proof" id="proof" aria-describedby="amountHelp"
                                                    placeholder="Eg. 1000">
                                            </div>
                                            <div style="font-size: 13px;" class="mb-2">Note: only click paid after
                                                making payment to
                                                the above
                                                address</div>
                                            <div>
                                                <button type="submit" name="deposit" class="btn btn-md btn-primary w-100 txt-white">Paid</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>

                                    <div style="width: 100%; height: auto; display: none;" id="usdttrcDiv">
                                        <div class="row">
                                            <div class="alert alert-secondary col-md-6"><span
                                                    style="font-size: 13px;">Scan the Qr
                                                    code
                                                    or copy
                                                    the
                                                    Tether USD (TRC20) address below. Enter amount sent in USD, upload
                                                    proof of payment.
                                                    Payment will be reviewed and processed.</span></div>
                                            <div style="text-align: center;" class="col-md-6">
                                                <img src="https://chart.googleapis.com/chart?chs=225x225&chld=L|2&cht=qr&chl=<?php echo $usdt_trc;?>" alt="" class="img-fluid">

                                            </div>
                                        </div>
                                        <br>

                                        <div class="alert alert-secondary">
                                            <span style="font-size: 14px;" id="addressCopy">
                                                <?php echo $usdt_trc ?>
                                            </span>
                                            <a href="javascript:void()" onclick="copyFunction()"><i
                                                    class="fa fa-copy"></i></a>
                                        </div>

                                        <form action="deposit.php" method="POST"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="_token"
                                                value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ"> <input type="hidden"
                                                name="account" value="usdttrc">
                                            <input type="hidden" name="to" value="<?php echo $usdt_trc ?>">
                                            <div class="form-group">
                                                <label for="amount">Enter amount sent</label>
                                                <input type="number" required class="form-control" name="amount" id="amount"
                                                    aria-describedby="amountHelp" placeholder="Eg. 1000">
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Upload payment proof</label>
                                                <input type="file" required class="form-control" style="color: rgb(0, 128, 81);"
                                                    name="proof" id="proof" aria-describedby="amountHelp"
                                                    placeholder="Eg. 1000">
                                            </div>
                                            <div style="font-size: 13px;" class="mb-2">Note: only click paid after
                                                making payment to
                                                the above
                                                address</div>
                                            <div>
                                                <button type="submit" name="deposit" class="btn btn-md btn-primary w-100 txt-white">Paid</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p>Deposit History</p>

                                    <div class="table-responsive" style="max-height: 400px;">
                                        <table class="table table-striped">
                                            <thead class="th-text-md">
                                                <tr>
                                                    <th><i class="fa fa-clock"></i></th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>To</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tb-text-md">
                                            	<?php 
                                            		$qu = mysqli_query($link, "SELECT * FROM btc WHERE email = '$email' ORDER BY id DESC ");
                                            		if (mysqli_num_rows($qu) > 0) {
                                            			while ($rr2 = mysqli_fetch_assoc($qu)) {	
                                            	?>
                                            	 <tr>
                                            	 	<td><?php echo $rr2['date'] ?></td>
                                            	 	 <td><?php echo $rr2['usd'] ?></td>
                                            	 	 <td><?php echo $rr2['status'] ?></td>
                                            	 	 <td><?php echo $rr2['uto'] ?></td>
                                            	 </tr>

                                            	 <?php }
                                            		} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>







                    <script>
                        $(document).ready(function () {
                            $('#btcBtn').click(function () {
                                $('#btcDiv').css('display', 'block');
                                $('#ethDiv').css('display', 'none');
                                $('#ltcDiv').css('display', 'none');
                                $('#bnbDiv').css('display', 'none');
                                $('#usdttrcDiv').css('display', 'none');
                                $('#usdtercDiv').css('display', 'none');
                                $('.type-btn').removeClass('type-active');
                                $('#btcBtn').addClass('type-active');
                            });

                            $('#ethBtn').click(function () {
                                $('#btcDiv').css('display', 'none');
                                $('#ethDiv').css('display', 'block');
                                $('#ltcDiv').css('display', 'none');
                                $('#bnbDiv').css('display', 'none');
                                $('#usdttrcDiv').css('display', 'none');
                                $('#usdtercDiv').css('display', 'none');
                                $('.type-btn').removeClass('type-active');
                                $('#ethBtn').addClass('type-active');
                            });

                            $('#bnbBtn').click(function () {
                                $('#btcDiv').css('display', 'none');
                                $('#ethDiv').css('display', 'none');
                                $('#ltcDiv').css('display', 'none');
                                $('#bnbDiv').css('display', 'block');
                                $('#usdttrcDiv').css('display', 'none');
                                $('#usdtercDiv').css('display', 'none');
                                $('.type-btn').removeClass('type-active');
                                $('#bnbBtn').addClass('type-active');
                            });

                            $('#ltcBtn').click(function () {
                                $('#btcDiv').css('display', 'none');
                                $('#ethDiv').css('display', 'none');
                                $('#ltcDiv').css('display', 'block');
                                $('#bnbDiv').css('display', 'none');
                                $('#usdttrcDiv').css('display', 'none');
                                $('#usdtercDiv').css('display', 'none');
                                $('.type-btn').removeClass('type-active');
                                $('#ltcBtn').addClass('type-active');
                            });

                            $('#usdtTrcBtn').click(function () {
                                $('#btcDiv').css('display', 'none');
                                $('#ethDiv').css('display', 'none');
                                $('#ltcDiv').css('display', 'none');
                                $('#bnbDiv').css('display', 'none');
                                $('#usdttrcDiv').css('display', 'block');
                                $('#usdtercDiv').css('display', 'none');
                                $('.type-btn').removeClass('type-active');
                                $('#usdtTrcBtn').addClass('type-active');
                            });

                            $('#usdtErcBtn').click(function () {
                                $('#btcDiv').css('display', 'none');
                                $('#ethDiv').css('display', 'none');
                                $('#ltcDiv').css('display', 'none');
                                $('#bnbDiv').css('display', 'none');
                                $('#usdttrcDiv').css('display', 'none');
                                $('#usdtercDiv').css('display', 'block');
                                $('.type-btn').removeClass('type-active');
                                $('#usdtErcBtn').addClass('type-active');
                            });
                        });

                        function copyFunction() {
                            var r = document.createRange();
                            r.selectNode(document.getElementById('addressCopy'));
                            window.getSelection().removeAllRanges();
                            window.getSelection().addRange(r);
                            document.execCommand('copy');
                            window.getSelection().removeAllRanges();

                            alert('copied');
                        }
                    </script>




                </div>

<?php  
include 'footer.php';
?>