<?php  
include 'header.php';

if ($verify == "0" ) {
    echo "<script>window.location.href = 'profile.php' </script>";
}

?>

<div class="content-wrapper bg-dark">

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
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp; Trade History
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Trade history</h4>

                    <div class="table-responsive" style="max-height: 650px;">
                        <table class="table table-striped table-custom">
                            <thead class="th-text-md">
                                <tr>
                                    <th><i class="fa fa-clock"></i></th>
                                    <th><span>Trade Type</span></th>
                                    <th><span>Amount</span></th>
                                    <th><span>Symbol</span></th>
                                    <th><span>Units</span></th>
                                    <th><span>Trade Interval</span></th>
                                    <th><span>Market</span></th>
                                    <th><span>Trade Profit</span></th>
                                    <th><span>Status</span></th>
                                </tr>
                            </thead>
                            <tbody class="tb-text-md">
                                <?php  
// status = 1; trade on going
// status = 2; trade loss
// status = 3; trade win
                                    $qq = mysqli_query($link, "SELECT * FROM trade WHERE email = '$email' ORDER BY id DESC ");
                                    if (mysqli_num_rows($qq) > 0) {
                                        while ($tr = mysqli_fetch_assoc($qq)) {
                                            $status = $tr['status'];
                                            $trade_type = $tr['trade_type'];
                                            $amount = $tr['amount'];
                                            $symbol = $tr['symbol'];
                                            $units = $tr['units'];
                                            $trade_interval = $tr['trade_interval'];
                                            $market = $tr['market'];
                                            $profit = $tr['profit'];
                                            $trade_exp = $tr['trade_exp'];
                                            $trade_set = $tr['trade_set'];
                                            $win_loss = $tr['win_loss'];
                                            $tid = $tr['id'];
                                            $credited = $tr['credited'];

                                            $current_time = date('Y-m-d H:i:s');

                                            if ($trade_exp == $current_time || $current_time >= $trade_exp) {
                                                //the status
                                                if ($win_loss == 1) {
                                                    $status = 3;
                                                }elseif ($win_loss == 0) {
                                                    $status = 2;
                                                }
                                                //profit
                                                if ($win_loss == 1) {
                                                    $profit = (90/100)*$amount;
                                                    $uprofit = ((90/100)*$amount) + $amount;
                                                }elseif ($win_loss == 0) {
                                                    $profit = 0;
                                                    $uprofit = 0;
                                                }
                                                $update = mysqli_query($link, "UPDATE trade SET status = '$status', profit = '$profit', credited = 1 WHERE id = '$tid' ");
                                                //credit user profit
                                                if ($update && $credited == 0) {
                                                    switch ($account_type) {
                                                        case 'live':
                                                            $col = 'balance';
                                                            break;
                                                        case 'demo':
                                                            $col = 'demo_balance';
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                    $upuser = mysqli_query($link, "UPDATE users SET $col = $col + '$uprofit' WHERE email = '$email' " );
                                                    echo "<script>window.location.href = 'dashboard.php' </script>";
                                                }
                                            }else{

                                            }


                                    switch ($status) {
                                        case '1':
                                            $t_txtcolor = 'warning';
                                            $p_txtcolor = 'warning';
                                            $s_txtcolor = 'warning';
                                            break;
                                        case '2':
                                            $t_txtcolor = 'danger';
                                            $p_txtcolor = 'danger';
                                            $s_txtcolor = 'danger';
                                            break;
                                        case '3':
                                            $t_txtcolor = 'success';
                                            $p_txtcolor = 'success';
                                            $s_txtcolor = 'success';
                                            break;
                                        default:
                                            break;
                                    }

                                      
                                ?>

                                <tr>
                                    <td>
                                        <span class='text-<?php echo $t_txtcolor ?>'><?php echo $trade_set ?></span>
                                    </td>
                                    <td>
                                        <?php echo $trade_type ?>
                                        <?php  
                                            if ($status == 1) {
                                        ?>
                                        <i class="fa fa-spin fa-spinner"></i>
                                    <?php } ?>
                                    </td>
                                    <td class="text-success">$<?php echo $amount ?></td>
                                    <td><?php echo $symbol ?></td>
                                    <td><?php echo $units ?></td>
                                    <td><?php echo $market ?></td>
                                    <td><?php echo $trade_interval ?></td>
                                    <td>
                                        <span class='text-<?php echo $p_txtcolor ?>'>
                                            <?php  
                                                if ($status == 1) {
                                            ?>
                                            Trade Ongoing
                                             <?php } ?>

                                             <?php  
                                                if ($status == 2) {
                                                    echo "+".$profit;
                                                }
                                             ?>

                                             <?php  
                                                if ($status == 3) {
                                                    echo "+".$profit;
                                                }
                                             ?>

                                        </span>
                                    </td>

                                    <td>
                                        <span class='text-<?php echo $s_txtcolor ?>'>
                                            <?php  
                                                if ($status == 1) {
                                            ?>
                                            Trade Ongoing
                                             <?php } ?>

                                             <?php  
                                                if ($status == 2) {
                                                    echo "Loss";
                                                }
                                             ?>

                                             <?php  
                                                if ($status == 3) {
                                                    echo "Win";
                                                }
                                             ?>
                                        </span>
                                    </td>
                                </tr>
                                
      
                                
                                <?php 
                                      }
                                  }
                                 ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>




</div>

<?php  
include 'footer.php';
?>