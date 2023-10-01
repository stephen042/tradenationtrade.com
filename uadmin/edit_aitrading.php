<?php
include 'header.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    $email = '';
}

$msg = "";
$err = "";

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}


if (isset($_POST['placeTrade']) && isset($_POST['amount']) && isset($_POST['units']) && isset($_POST['interval']) && isset($_POST['symbol']) && isset($_POST['market'])) {

    $amount = text_input($_POST['amount']);
    $units = text_input($_POST['units']);
    $interval = text_input($_POST['interval']);
    $direction = text_input($_POST['market']);
    $symbol = text_input($_POST['symbol']);
    $status = text_input($_POST['status']);
    $win_loss = text_input($_POST['win_loss']);
    $profit = text_input($_POST['profit']);
    $email = $row['email'];

    $trade_type = text_input($_POST['trade_type']);
    $trade_set = date('Y-m-d H:i:s');
    $trade_exp = date('Y-m-d H:i:s', strtotime($trade_set . ' +' . $interval . ''));

    if ($amount > $row['balance']) {
        $err = "Insufficient Balance";
    } else{
        $insert = mysqli_query($link, "INSERT INTO trade (`email`, `trade_type`, `amount`, `symbol`, `units`, `trade_interval`, `market`, `status`, `trade_exp`, `trade_set`, `win_loss`, `credited`,`profit`) VALUES ('$email', '$trade_type', '$amount', '$symbol', '$units', '$interval', '$direction', '$status', '$trade_exp', '$trade_set', '$win_loss','1','$profit' ) ");
        if ($insert) {
            $col = 'balance';
            mysqli_query($link, "UPDATE users SET $col = $col - '$amount' WHERE email = '$email' ");
            if ($win_loss == 1) {
                $col = 'balance';
                $amount1 = $amount + $profit;
                mysqli_query($link, "UPDATE users SET $col = $col + '$amount1' WHERE email = '$email' ");
            }
        }

        $subject = $sitename . " Your Ai-Trading Order Has been executed";
		$body = "Your Ai order was executed on: " . $trade_set . ". Here are the details of your matched trade :<br><br>
		Contract: " . $symbol . " <br> 
		Expiration: " . $trade_exp . " <br>
		Direction: " . $direction . " <br>
		Quantity: " . $units . " <br>
		Price: " . $amount . " <br><br>
		Your positions and balance have been updated. <br> <br>
		if you have any questions please contact customer service at customerservice@nadex.online. <br> <br>
		Best regards, <br> <br>
		The ".$sitename." Team <br>
		Email: " . $sitemail . " <br>
		website: " . $siteurl.". <br>";
		sendMail($email, $name, $subject, $body);

        $msg = "Trade Successfully Placed!";
    };
}

?>


<div class="page-content">
    <div class="container-fluid">
        <?php
        if ($msg != "") {

            echo customAlert("success", $msg);
            echo ('<script>window.location.href="edit_aitrading.php?email=' . $email . '";</script>');
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
                                    <i class="fas fa-home"></i> Place Ai-Trade
                                </a>
                            </li>


                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="edit_aitrading.php?email=<?php echo $email ?>" method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">email</label>
                                                <input type="text" class="form-control" id="firstnameInput" name="email" value="<?php echo $row['email'] ?>" readonly required>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="trade_type" class="form-label">Trade type</label>
                                                <input type="text" required name="trade_type" class="form-control" value="live" readonly>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3" id="stakeborder">
                                                <label for="amount" class="form-label">Staking Amount $</label>
                                                <input type="number" id="stake" class="form-control" required name="amount" value="">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="symbol" class="form-label">Symbol e.g BTCUSD</label>
                                                <input type="text" id="symbol" name="symbol" class="form-control" placeholder="E.g or ETHUSD " value="" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Live Balance</label>
                                                <input type="number" id="livebal" class="form-control" value="<?php echo $row['balance'] ?>" readonly required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="units" class="form-label">Trade Units E.g 1</label>
                                                <select class="form-control" id="unit" name="units" id="buy-units" required>
                                                    <option value="" disabled selected hidden>select unit</option>
                                                    <option value='1'>1</option>
                                                    <option value='2'>2</option>
                                                    <option value='3'>3</option>
                                                    <option value='4'>4</option>
                                                    <option value='5'>5</option>
                                                    <option value='6'>6</option>
                                                    <option value='7'>7</option>
                                                    <option value='8'>8</option>
                                                    <option value='9'>9</option>
                                                    <option value='10'>10</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- <div class="col-lg-6"> -->
                                        <div class="mb-3 col-lg-6">
                                            <label for="interval" class="form-label">Time </label>
                                            <select class="form-control" name="interval" required>
                                                <option value="" disabled selected hidden>Select time</option>
                                                <option value="1 minute">1 minute</option>
                                                <option value="3 minutes">3 minutes</option>
                                                <option value="5 minutes">5 minutes</option>
                                                <option value="10 minutes">10 minutes</option>
                                                <option value="20 minutes">15 minutes</option>
                                                <option value="30 minutes">30 minutes</option>
                                                <option value="45 minutes">45 minutes</option>
                                                <option value="60 minutes">1 hour</option>
                                                <option value="120 minutes">2 hours</option>
                                                <option value="1440 minutes">1 day</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="market" class="form-label">Market</label>
                                                <select class="form-control" name="market" required>
                                                    <option value="" disabled selected hidden>Select Buy/Sell</option>
                                                    <option value="Buy">Buy</option>
                                                    <option value="Sell">Sell</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="win_loss" class="form-label">Win/Loss</label>
                                                <select class="form-control" name="win_loss" required>
                                                    <option value="" disabled selected hidden>Select Win/Loss</option>
                                                    <option value="1">Win</option>
                                                    <option value="0">Loss</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="status" class="form-label text-danger">Please Admin Confirm Win/Loss</label>
                                                <select id="win_loss" class="form-control bg-info" name="status" required>
                                                    <option value="" disabled selected hidden>Select Win/Loss</option>
                                                    <option value="3" class="bg-success">Win</option>
                                                    <option value="2" class="bg-danger">Loss</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="profit" class="form-label">Profit <span class="text-info">*Loss = 0$ and the stake$ is removed from main balance*</span></label>
                                                <input type="text" id="profitLoss" class="form-control" id="profit" placeholder="customer's trade profit" name="profit" value="" required readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-center">
                                                <button type="submit" id="placeTrade" name="placeTrade" class="btn btn-primary">Place Trade</button>

                                            </div>
                                        </div>
                                        <!--end col-->
                                        <!-- </div> -->
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

<script>
    $(document).ready(function() {
        $profitLoss = $('#profitLoss');
        $('#stake').keyup(function() {
            var amount = $(this).val();
            var profitLoss = eval(90 / 100 * amount);
            $profitLoss.val(profitLoss);
        });
    });
</script>






<?php
include 'footer.php';
?>