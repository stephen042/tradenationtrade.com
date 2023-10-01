<?php
include 'header.php';

if ($verify == "0" ) {
    echo "<script>window.location.href = 'profile.php' </script>";
}

$msg = "";
$err = "";


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
            } elseif ($win_loss == 0) {
                $status = 2;
            }
            //profit
            if ($win_loss == 1) {
                $profit = (90 / 100) * $amount;
            } elseif ($win_loss == 0) {
                $profit = 0;
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
                $upuser = mysqli_query($link, "UPDATE users SET $col = $col + '$profit' WHERE email = '$email' ");
            }
        } else {
        }
    }
}






$sql = "SELECT * FROM stakes WHERE email='$email' ORDER BY id DESC ";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    $is_yes = 1;
    while ($row = mysqli_fetch_assoc($result)) {

        $pdate = $row['pdate'];
        $duration = $row['duration'];
        $increase = $row['increase'];
        $usd = $row['usd'];
        $uid = $row['id'];

        $date = $row['pdate'];
        $payday = $row['payday'];
        $lprofit = $row['lprofit'];

        $paypackage = new DateTime($payday);
        $payday = $paypackage->format('Y/m/d');


        if (isset($row['pdate']) &&  $row['pdate'] != '0' && isset($row['duration'])  && isset($row['increase'])  && isset($row['usd'])) {

            if ($row['activate'] == 0) {
                $endpackage = new DateTime($pdate);
                $endpackage->modify('+ ' . $duration . 'day');
                $Date2 = $endpackage->format('Y/m/d');
                $days = 0;
            } else {



                $endpackage = new DateTime($pdate);
                $endpackage->modify('+ ' . $duration . 'day');
                $Date2 = $endpackage->format('Y/m/d');
                $current = date("Y/m/d");

                $diff = abs(strtotime($Date2) - strtotime($current));
                $one = 1;

                $date3 = new DateTime($Date2);
                $date3->modify('+' . $one . 'day');
                $date4 = $date3->format('Y/m/d');

                $days = floor($diff / (60 * 60 * 24));


                $daily = $duration - $days;

                $one = 1;
                $f = date('Y-m-d', strtotime($Date2 . ' + ' . $one . 'day'));




                if (isset($days) && $days == 0 || $Date2 == (date("Y/m/d")) || (date("Y/m/d")) >= $Date2) {


                    $percentage = ($increase / 100) * $duration * $usd;
                    $allprofit = $percentage - $lprofit;
                    $pp =   $allprofit;
                    $ppr = $pp + $usd;

                    $_SESSION['pprofit'] = $percentage;
                    $sql = "UPDATE users SET balance = balance + $pp  WHERE email='$email'";

                    $sql13 = "UPDATE stakes SET activate = '0', profit = '$percentage', payday = '$current'  WHERE email='$email' AND id = '$uid'";


                    if (mysqli_query($link, $sql)) {
                        mysqli_query($link, $sql13);

                        $percentage = $pp = 0;

                        $Date2 = 0;
                        $current = 0;
                        $duration = 0;

                        $days = 'package completed &nbsp;&nbsp;<i style="color:green; font-size:20px;" class="fa  fa-check" ></i>';
                        $days = 0;

                        $current = 0;
                        $duration = 0;
                    }
                } else {

                    if ($payday == $current) {
                    } else {

                        $percentage = ($increase / 100) * $daily * $usd;

                        $allprofit = $percentage - $lprofit;

                        $sql131 = "UPDATE stakes SET profit = '$percentage', payday = '$current', lprofit = '$percentage' WHERE email='$email' AND id = '$uid'";
                        $sql21 = "UPDATE users SET balance = balance + $allprofit WHERE email='$email'";

                        mysqli_query($link, $sql131);
                        mysqli_query($link, $sql21);
                    }
                }






                $add = "days";
            }
        }
    }
}


?>


<div class="content-wrapper bg-dark">





    <style>
        .overview-div {
            border-left: solid 1px rgba(100, 100, 100, 0.2);
            padding: 10px;
        }

        .icon-big {
            font-size: 30px;
        }

        .card-category {
            color: rgba(160, 160, 160, 0.91)
        }
    </style>

    
    <div style="background-color: rgba(0, 0, 0, 0.311); width:100%; height:auto;" class="mb-4">
        <div style="width: 100%; height: auto; padding:10px 20px 0px 20px; margin-top:0px; background-color: rgba(0,0,0,0); z-index: 2;">
            <br>
            <div class="tradingview-widget-container" style="margin-top: -30px;">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                    {
                        "symbols": [{
                                "proName": "FOREXCOM:SPXUSD",
                                "title": "S&P 500"
                            },
                            {
                                "proName": "FOREXCOM:NSXUSD",
                                "title": "Nasdaq 100"
                            },
                            {
                                "proName": "FX_IDC:EURUSD",
                                "title": "EUR/USD"
                            },
                            {
                                "proName": "BITSTAMP:BTCUSD",
                                "title": "BTC/USD"
                            },
                            {
                                "proName": "BITSTAMP:ETHUSD",
                                "title": "ETH/USD"
                            }
                        ],
                        "colorTheme": "dark",
                        "isTransparent": true,
                        "displayMode": "regular",
                        "locale": "en"
                    }
                </script>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class=" align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <span style="font-size:22px">Welcome, <?php echo ucfirst($fname) ?>!</span>

                    </div>
                    <div class="d-flex">
                        <i class="fa fa-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <button type="button" onclick="window.location='profile.php'" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                        <!-- <i class="mdi mdi-account "></i> -->
                        <i class="fa fa-user text-muted"></i>
                    </button>
                    <button type="button" onclick="window.location='transactions.php'" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                        <!-- <i class="mdi mdi-clock-outline text-muted"></i> -->
                        <i class="fas fa-clock text-muted"></i>
                    </button>
                    <button class="btn btn-primary mt-2 mt-xl-0" onclick="window.location='deposit.php'">Deposit</button>
                </div>
            </div>
        </div>
    </div>



    <section class="row" style="display: block;">
        
        <div class="col col-xm-12 col-md-8 m-1 alert alert-secondary  text-light" 
        style="height: 5rem;background-color:black;border-left: solid 3px #6175C4;border-top: 6px solid white;border-right: solid 1px white;border-bottom: 6px solid white" 
        >        
            <p style="font-size:12px;margin:0; color:#F4A733;">AVAILABLE BALANCE</p>
            <span>$<?php echo number_format($balance, 2) ?></span>
        </div>
        
        <div class="col col-xm-12 col-md-8 m-1 alert alert-secondary  text-light" 
        style="height: 5rem;background-color:black;border-left: solid 3px #EBBA59;border-top: 6px solid white;border-right: solid 1px white;border-bottom: 6px solid white" 
        >        
            <p style="font-size:12px;margin:0;color:#F4A733;">BTC EQUIVALENT</p>
            <span><?php echo file_get_contents("https://blockchain.info/tobtc?currency=USD&value=$balance") ?></span>
        </div>
        
        <div class="col col-xm-12 col-md-8 m-1 alert alert-secondary  text-light" 
        style="height: 5rem;background-color:black;border-left: solid 3px #4DB990;border-top: 6px solid white;border-right: solid 1px white;border-bottom: 6px solid white" 
        >        
            <p style="font-size:12px;margin:0;color:#4DB990;">INVESTED</p>
            <span>$
                <?php $total_invested = $total_invested != 0 ? $total_invested : 0;  
                echo $total_invested ?>            
            </span>
        </div>
        
        <div class="col col-xm-12 col-md-8 m-1 alert alert-secondary  text-light" 
        style="height: 5rem;background-color:black;border-left: solid 3px #419CB8;border-top: 6px solid white;border-right: solid 1px white;border-bottom: 6px solid white" 
        >        
            <p style="font-size:12px;margin:0;color:#419CB8;">ACCOUNT TYPE</p>
            <span>
                <?php 
                    if ($account_type == 'live') {
                        echo 'LIVE'; //use live balance
                    }else{
                        echo 'DEMO <small>
                <a href="?switch" style="text-decoration: none;color:#419Cc9;">Switch to
                main</a>
            </small>'; //use demo balance
                    }
                ?>
            </span>
             
        </div>
        
        <div class="col col-xm-12 col-md-8 m-1 alert alert-secondary text-light border-warning" style="height: 6rem;background-color:#2F333E;">  
        <p>
            Trade In Progress
        </p>      
        <p class="text-warning">
            <?=$progress_bar?>% completed
        </p>      
            <div class="progress mt-1">
                <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: <?=$progress_bar?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>

    </section>
    <hr>
    <section class="row">
        <div class="col col-md-12" style="height: 30rem;">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
                    {
                        "width": "100%",
                        "height": "100%",
                        "defaultColumn": "overview",
                        "defaultScreen": "general",
                        "market": "forex",
                        "showToolbar": true,
                        "colorTheme": "dark",
                        "locale": "en"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </section>
</div>


<?php
include 'footer.php';
?>