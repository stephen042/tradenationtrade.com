<?php
include 'header.php';

$msg = "";
$err = "";

$pdname = "";
$pdamount = "";
$pdduration = "";
$vid = "";

if (isset($_POST['Addpackage'])) {
    $pname = $link->real_escape_string($_POST['pname']);
    $amount = $link->real_escape_string($_POST['amount']);
    $duration = $link->real_escape_string($_POST['duration']);

    $sql = "INSERT INTO signal_plan (plan,amount,duration) VALUES ('$pname','$amount','$duration')";
    if (mysqli_query($link, $sql)) {
        $msg = " Package has been successfully added";
    } else {
        $err = "Package was not added";
    }
}



if (isset($_POST['package11'])) {

    // $email = $link->real_escape_string($_POST['email']);
    $pname = $link->real_escape_string($_POST['pname']);
    $amount = $link->real_escape_string($_POST['amount']);
    $duration = $link->real_escape_string($_POST['duration']);


    if (isset($_POST['mid']) && $_POST['mid'] != '') {
        $mid = $link->real_escape_string($_POST['mid']);

        $sql1 = "UPDATE signal_plan SET plan='$pname',amount='$amount',duration='$duration' WHERE id='$mid'";

        if (mysqli_query($link, $sql1)) {

            $msg = " Package updated successfully!";
        } else {
            $err = mysqli_error($link);
            // $err = "Package not updated ";
        }
    }
}
?>

<div class="page-content">
    <div class="container-fluid">
        <?php
        if ($msg != "") {
            echo customAlert("success", $msg);
            echo pageRedirect("2", "addsignalplan.php");
        }
        if ($err != "") {
            echo customAlert("error", $err);
        }

        ?>
        <h4 align="center"><i class="fa fa-gears"></i> PLANS MANAGEMENT</h4>
        </br>

        <?php

        if (isset($_GET['id']) && $_GET['id'] != '') {
            $vid = "yes";
            $id = $link->real_escape_string($_GET['id']);
            $sql1 = "SELECT * FROM signal_plan WHERE id = '$id'";
            $result1 = mysqli_query($link, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                $row = mysqli_fetch_assoc($result1);
                $plan = $row['plan'];
                $amount = $row['amount'];
                $duration = $row['duration'];
            }
        }

        ?>

        <form class="form-horizontal" action="addsignalplan.php" method="POST">

            <legend>Package</legend>


            <input type="hidden" name="email" value="<?php  echo $_SESSION['email']; ?>" class="form-control">

            <div class="form-group">
                <label> Package Name </label>
                <input type="text" name="pname" placeholder="Package Name" value="<?php if(isset($plan)){echo $plan; } ?>" class="form-control">
            </div>

            <br>

            <div class="form-group">
                <label>Amount E.g 5000 </label>
                <input type="text" name="amount" placeholder="sub Amount" value="<?php if(isset($plan)){echo $amount;} ?>" class="form-control">
            </div>

            <br>
            <!-- <br> -->

            <div class="form-group">
                <label> Package Duration (Days) E.g 3 days</label>
                <input type="text" name="duration" placeholder="3 days or 5 days" value="<?php if(isset($duration)){echo $duration;} ?>" class="form-control">
            </div>

            <br>
            <?php if ($vid == "") {
            ?>
                <button type="submit" class="btn btn-info" name="Addpackage">Add Package</button>
            <?php } else { ?>
                <input type="hidden" name="mid" value="<?php echo $id; ?>" class="form-control">
                <button type="submit" class="btn btn-info" name="package11">Update Package </button>
            <?php } ?>


        </form>
    </div>
</div>

<?php
include 'footer.php';
?>