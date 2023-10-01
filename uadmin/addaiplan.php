<?php
include 'header.php';

$msg = "";
$err = "";

$pdname = "";
$pdamount = "";
$pdwinrate = "";
$pdduration = "";
$vid = "";

if (isset($_POST['Addpackage'])) {
    $pname = $link->real_escape_string($_POST['pname']);
    $amount = $link->real_escape_string($_POST['amount']);
    $winrate = $link->real_escape_string($_POST['winrate']);
    $duration = $link->real_escape_string($_POST['duration']);

    $sql = "INSERT INTO ai_plan (plan,amount,win_rate,duration) VALUES ('$pname','$amount','$winrate','$duration')";
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
    $winrate = $link->real_escape_string($_POST['winrate']);
    $duration = $link->real_escape_string($_POST['duration']);


    if (isset($_POST['mid']) && $_POST['mid'] != '') {
        $mid = $link->real_escape_string($_POST['mid']);

        $sql1 = "UPDATE ai_plan SET plan='$pname',amount='$amount',win_rate='$winrate',duration='$duration' WHERE id='$mid'";

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
            echo pageRedirect("2", "addaiplan.php");
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
            $sql1 = "SELECT * FROM ai_plan WHERE id = '$id'";
            $result1 = mysqli_query($link, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                $row = mysqli_fetch_assoc($result1);
                $plan = $row['plan'];
                $amount = $row['amount'];
                $winrate = $row['win_rate'];
                $duration = $row['duration'];
            }
        }

        ?>

        <form class="form-horizontal" action="addaiplan.php" method="POST">

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

            <div class="form-group">
                <label>Win Rate E.g 30 <span class="text-danger">*the rate is over 100 E.g 30/100*</span></label>
                <input type="text" name="winrate" placeholder="sub Amount" value="<?php if(isset($plan)){echo $winrate;} ?>" class="form-control">
            </div>

            <br>
            <!-- <br> -->

            <div class="form-group">
                <label> Package Duration (Days) E.g 3 days</label>
                <input type="text" name="duration" placeholder="# days or 5 days" value="<?php if(isset($duration)){echo $duration;} ?>" class="form-control">
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