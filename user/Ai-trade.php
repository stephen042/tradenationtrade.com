<?php
include 'header.php';

if ($verify == "0" ) {
    echo "<script>window.location.href = 'profile.php' </script>";
}

$msg = "";
$err = "";

if (isset($_POST['sub'])) {
    if ($sub_balance < $_POST['amount']) {
        $err = "Insufficient balance: $" . $sub_balance . " <br> Please deposit more";
    }
    if ($err == "") {
        $email = $email;
        $plan = text_input($_POST['plan']);
        $amount = $_POST['amount'];
        $duration = $_POST['duration'];
        // $plan_for = text_input('1');
        $date = date('d M,Y H:i:s');

        $insert = mysqli_query($link, "INSERT INTO sub_transaction (`email`,`duration`, `plan`, `amount`, `plan_for`, `date`) VALUES ('$email','$duration','$plan', '$amount', '1', '$date') ");

        if ($insert) {
            $sub_bal = $sub_balance - $amount;
            $update = mysqli_query($link, "UPDATE `users` SET `sub_balance` = '$sub_bal' WHERE `users`.`email` = '$email' ");
            $subject = $sitename . " Ai-trade Subscription";
            $body = "<h4> " . $name . " Ai-trade Subscription </h4> <p> Your Ai-trade Subscription of $ " . $amount . " of " . $account . " has has been submitted, Your Ai-trade Subscription will last for " . $duration . " The win Rate of you is " . $win_rate ."/100  </p> ";
            sendMail($email, $name, $subject, $body);
            $msg = "Subscription Was successfully done";
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
	  '" . $msg . "',
	  'OK',
	  function cb() {
	   window.location.href = 'Ai-trade.php'
	  },
	);
</script>";
    }
    if ($err != "") {
        echo "<script>
	Notiflix.Report.failure(
	  'An error Occured',
	  '" . $err . "',
	  'OK',
	  function cb() {
	   window.location.href = 'Ai-trade.php'
	  },
	);
</script>";
    }
    ?>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class=" align-items-end flex-wrap">

                    <div class="d-flex">
                        <span style="color: rgba(180, 180, 180, 0.7)">Subscription Balance :</p>
                            <span style="color: rgba(180, 180, 180, 0.7);font-size: 23px"> <?php echo $sub_balance ?></p>

                                <button type="button" onclick="window.location.href='subdeposit.php'" class="btn btn-success btn-sm text-white"><i class="fa fa-money-bill"></i>
                                    Deposit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-secondary"><b>AI-TRADING Subscription :</b></div>

    <div class="row">
        <?php
        $ai_plan = mysqli_query($link, "SELECT * FROM ai_plan ");
        if (mysqli_num_rows($ai_plan) > 0) {
            while ($data = mysqli_fetch_assoc($ai_plan)) {
        ?>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="Ai-trade.php" method="POST">
                                <span style="font-size: 25px;"><?php echo strtoupper($data['plan']) ?></span><br>
                                <input type="hidden" value="<?php echo $data['plan'] ?>" name="plan" id="plan">
                                <hr>

                                <div style="text-align: left;">

                                    <p>
                                        <span style="color: rgba(180, 180, 180, 0.7)">Price</span> <br>
                                        <b>$<?php echo $data['amount'] ?></b>
                                        <input type="hidden" value="<?php echo $data['amount'] ?>" name="amount" id="amount">
                                    </p>

                                    <p>
                                        <span style="color: rgba(180, 180, 180, 0.7)">Trade Win Rate</span> <br>
                                        <b><?php echo $data['win_rate'] ?> 0f 100%</b>

                                    </p>

                                    <p>
                                        <span style="color: rgba(180, 180, 180, 0.7)">Duration</span> <br>
                                        <b><?= $data['duration'] ?></b>
                                        <input name="duration" id="duration" value="<?php echo $data['duration'] ?>" type="hidden">
                                    </p>

                                    <!-- <p>
                                    <input required type="number" class="form-control" value="" id="amount" name="amount" placeholder="10000">
                                </p> -->
                                    <!--<p><span style="color: rgba(180, 180, 180, 0.7)">Max Spread</span> <br>
                                            <b>1.1</b>
                                        </p><br> -->

                                    <!-- <p style="color: rgba(180, 180, 180, 0.856)">Demo Trading</p> -->

                                    <!-- <p style="color: rgba(180, 180, 180, 0.856)">Negative Balance Protection</p> -->
                                    <br>

                                    <p>

                                        <input type="submit" name="sub" class="btn btn-danger text-white" value="Subscribe">

                                    </p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
        <?php }
        } ?>


    </div>

</div>
<!-- <hr> -->

<table class="table table-striped table-dark">
    <?php
    $table_data =  mysqli_query($link, "SELECT * FROM sub_transaction WHERE email = '$email' and plan_for = 1 order by id desc");
    ?>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">plan</th>
            <th scope="col">Amount</th>
            <th scope="col">Duration</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($table_data) > 0) {
            // $date = "";
            while ($data = mysqli_fetch_assoc($table_data)) {
                $time = $data['Date'];
        ?>
                <tr>
                    <th scope="row"><?= $data['id'] ?></th>
                    <td><?= strtoupper($data['plan']) ?></td>
                    <td><?= $data['amount'] ?></td>
                    <td><?= $data['duration'] ?></td>
                    <td><?php echo $time ?></td>
                </tr>

        <?php
            }
        } ?>
    </tbody>
</table>



<?php
include 'footer.php';
?>