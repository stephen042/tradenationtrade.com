<?php  
include 'header.php';

if ($verify == "0" ) {
    echo "<script>window.location.href = 'profile.php' </script>";
}


$err = $msg = "";

if (isset($_POST['submit'])) {
    $currency = text_input($_POST['currency']);
    $amount = text_input($_POST['amount']);
    $duration = text_input($_POST['elapse']);
    $increase = text_input($_POST['roi']);

    if (!empty($amount) && !empty($duration)) {
        if ($account_type == 'demo') {
            $err = "You can only stake with a live account";
        }elseif ($amount > $balance) {
            $err = "Insufficient Funds";
        }else{
            $cdate = date('Y-m-d H:i:s');
            $end_date = date('Y-m-d H:i:s', strtotime($Date. ' + '.$duration.' days'));
            $sql22 = "INSERT INTO stakes (email,currency,increase,duration,pdate,activate,usd,payday,end_date) VALUES ('$email','$currency','$increase','$duration','$cdate','1','$amount','$cdate','$end_date')";
            $insert = mysqli_query($link, $sql22); 
            if ($insert) {
                mysqli_query($link, "UPDATE users SET balance = balance - $amount WHERE email = '$email' ");
                $subject = "Stake Placed";
                $body = "<p>Hi ".$name."</p> <p>A new stake as been registered successfully, below are the details<p> <center> <p><strong>Amount - ".$amount." </strong></p> <p><strong>Currency - ".$currency." </strong></p> <p><strong>duration - ".$duration." days </strong></p> <p><strong>ROI - ".$increase." </strong></p> <p><strong>date - ".$cdate." </strong></p> <p><strong>Edn date - ".$end_date." </strong></p>  </center> <p> Thanks,</p> <p>".$sitename."</p> ";
                $send = sendMail($email, $name, $subject, $body);
                $msg = "Stake has been placed";
            }
        }

        
    }
}












$sql= "SELECT * FROM stakes WHERE email='$email' ORDER BY id DESC ";
              $result = mysqli_query($link,$sql);
              if(mysqli_num_rows($result) > 0){
                  $is_yes = 1;
                  while($row = mysqli_fetch_assoc($result)){   
                      
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

            
            if(isset($row['pdate']) &&  $row['pdate'] != '0' && isset($row['duration'])  && isset($row['increase'])  && isset($row['usd']) ){
                
                if($row['activate'] == 0){
                    $endpackage = new DateTime($pdate);
          $endpackage->modify( '+ '.$duration. 'day');
 $Date2 = $endpackage->format('Y/m/d');
 $days=0;
                }else{
                    
                
         
          $endpackage = new DateTime($pdate);
          $endpackage->modify( '+ '.$duration. 'day');
 $Date2 = $endpackage->format('Y/m/d');
 $current=date("Y/m/d");

 $diff = abs(strtotime($Date2) - strtotime($current));
 $one = 1;

          $date3 = new DateTime($Date2);
           $date3->modify( '+'. $one.'day');
           $date4 = $date3->format('Y/m/d');

  $days=floor($diff / (60*60*24));
 
 
$daily = $duration - $days;

 $one = 1;
$f = date('Y-m-d', strtotime($Date2 . ' + '. $one.'day'));




if(isset($days) && $days == 0 || $Date2 == (date("Y/m/d")) || (date("Y/m/d")) >= $Date2  ){
    
    
    $percentage = ($increase/100) * $duration * $usd;
    $allprofit = $percentage - $lprofit;
       $pp =   $allprofit;   
       $ppr = $pp + $usd;
    
    $_SESSION['pprofit'] = $percentage;
     $sql = "UPDATE users SET balance = balance + $pp  WHERE email='$email'";
     
      $sql13 = "UPDATE stakes SET activate = '0', profit = '$percentage', payday = '$current'  WHERE email='$email' AND id = '$uid'";
     
     
  if(mysqli_query($link, $sql)){
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
}else{
    
    if($payday == $current){
        
    }else{
        
    $percentage = ($increase/100) * $daily * $usd;
    
    $allprofit = $percentage - $lprofit;
    
     $sql131 = "UPDATE stakes SET profit = '$percentage', payday = '$current', lprofit = '$percentage' WHERE email='$email' AND id = '$uid'";
      $sql21 = "UPDATE users SET balance = balance + $allprofit WHERE email='$email'";
     
     mysqli_query($link, $sql131);
     mysqli_query($link, $sql21);
    }
     

}





     
$add="days";
            }    
 }
}
}
?>

<div class="content-wrapper bg-dark">

<?php  
if ($msg != "") {
    echo userAlert("success", $msg);
    echo pageRedirect("3", "dashboard.php");
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
                                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Stake
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <span>Stake</span>
                                    <a href="#"
                                        style="display: inline-block !important; visibility: hidden; float: right;"
                                        id="showStakeModalBtn" class="text-warning" data-toggle="modal"
                                        data-target="#stakeModal"><i class="fa fa-plus"></i> Stake</a>

                                    <div class="row mt-4">
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:1,&quot;name&quot;:&quot;bitcoin&quot;,&quot;abbreviation&quot;:&quot;btc&quot;,&quot;roi&quot;:1.149999999999999911182158029987476766109466552734375,&quot;image&quot;:&quot;currency\/btc.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/btc.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Bitcoin</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                BTC</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                28.75%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Bitcoin</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:2,&quot;name&quot;:&quot;ethereum&quot;,&quot;abbreviation&quot;:&quot;eth&quot;,&quot;roi&quot;:1.1999999999999999555910790149937383830547332763671875,&quot;image&quot;:&quot;currency\/eth.svg&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/eth.svg"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Ethereum</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                ETH</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                30%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Ethereum</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:3,&quot;name&quot;:&quot;litecoin&quot;,&quot;abbreviation&quot;:&quot;ltc&quot;,&quot;roi&quot;:0.9899999999999999911182158029987476766109466552734375,&quot;image&quot;:&quot;currency\/ltc.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/ltc.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Litecoin</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                LTC</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                24.75%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Litecoin</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:4,&quot;name&quot;:&quot;bnb&quot;,&quot;abbreviation&quot;:&quot;bnb&quot;,&quot;roi&quot;:1.12000000000000010658141036401502788066864013671875,&quot;image&quot;:&quot;currency\/bnb.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/bnb.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Bnb</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                BNB</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                28%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Bnb</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:5,&quot;name&quot;:&quot;tether USD&quot;,&quot;abbreviation&quot;:&quot;usdt&quot;,&quot;roi&quot;:1.100000000000000088817841970012523233890533447265625,&quot;image&quot;:&quot;currency\/usdt.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/usdt.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Tether USD</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                USDT</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                27.5%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Tether USD</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:6,&quot;name&quot;:&quot;avalanche&quot;,&quot;abbreviation&quot;:&quot;avax&quot;,&quot;roi&quot;:1.020000000000000017763568394002504646778106689453125,&quot;image&quot;:&quot;currency\/avax.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/avax.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Avalanche</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                AVAX</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                25.5%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Avalanche</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:7,&quot;name&quot;:&quot;chain link&quot;,&quot;abbreviation&quot;:&quot;link&quot;,&quot;roi&quot;:0.90000000000000002220446049250313080847263336181640625,&quot;image&quot;:&quot;currency\/link.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/link.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Chain link</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                LINK</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                22.5%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Chain link</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:8,&quot;name&quot;:&quot;tron&quot;,&quot;abbreviation&quot;:&quot;trx&quot;,&quot;roi&quot;:0.8000000000000000444089209850062616169452667236328125,&quot;image&quot;:&quot;currency\/trx.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/trx.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Tron</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                TRX</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                20%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Tron</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:9,&quot;name&quot;:&quot;shiba inu&quot;,&quot;abbreviation&quot;:&quot;shib&quot;,&quot;roi&quot;:0.93000000000000004884981308350688777863979339599609375,&quot;image&quot;:&quot;currency\/shib.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/shib.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Shiba inu</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                SHIB</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                23.25%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Shiba inu</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:10,&quot;name&quot;:&quot;Polygon&quot;,&quot;abbreviation&quot;:&quot;matic&quot;,&quot;roi&quot;:1.0100000000000000088817841970012523233890533447265625,&quot;image&quot;:&quot;currency\/matic.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/matic.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Polygon</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                MATIC</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                25.25%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Polygon</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:11,&quot;name&quot;:&quot;cardano&quot;,&quot;abbreviation&quot;:&quot;ada&quot;,&quot;roi&quot;:1.100000000000000088817841970012523233890533447265625,&quot;image&quot;:&quot;currency\/ada.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/ada.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Cardano</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                ADA</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                27.5%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Cardano</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:12,&quot;name&quot;:&quot;busd&quot;,&quot;abbreviation&quot;:&quot;busd&quot;,&quot;roi&quot;:1,&quot;image&quot;:&quot;currency\/busd.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/busd.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Busd</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                BUSD</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                25%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Busd</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:13,&quot;name&quot;:&quot;dogecoin&quot;,&quot;abbreviation&quot;:&quot;doge&quot;,&quot;roi&quot;:1.0500000000000000444089209850062616169452667236328125,&quot;image&quot;:&quot;currency\/doge.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/doge.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Dogecoin</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                DOGE</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                26.25%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Dogecoin</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:14,&quot;name&quot;:&quot;solana&quot;,&quot;abbreviation&quot;:&quot;sol&quot;,&quot;roi&quot;:0.90000000000000002220446049250313080847263336181640625,&quot;image&quot;:&quot;currency\/sol.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/sol.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Solana</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                SOL</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                22.5%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Solana</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:15,&quot;name&quot;:&quot;Ripple&quot;,&quot;abbreviation&quot;:&quot;xrp&quot;,&quot;roi&quot;:0.90000000000000002220446049250313080847263336181640625,&quot;image&quot;:&quot;currency\/xrp.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/xrp.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Ripple</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                XRP</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                22.5%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Ripple</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:20,&quot;name&quot;:&quot;maker&quot;,&quot;abbreviation&quot;:&quot;mkr&quot;,&quot;roi&quot;:0.8000000000000000444089209850062616169452667236328125,&quot;image&quot;:&quot;currency\/mkr.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/mkr.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Maker</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                MKR</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                20%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Maker</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:21,&quot;name&quot;:&quot;decentraland&quot;,&quot;abbreviation&quot;:&quot;mana&quot;,&quot;roi&quot;:0.92000000000000003996802888650563545525074005126953125,&quot;image&quot;:&quot;currency\/mana.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/mana.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Decentraland</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                MANA</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                23%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Decentraland</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:22,&quot;name&quot;:&quot;aave&quot;,&quot;abbreviation&quot;:&quot;aave&quot;,&quot;roi&quot;:0.9499999999999999555910790149937383830547332763671875,&quot;image&quot;:&quot;currency\/aave.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/aave.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Aave</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                AAVE</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                23.75%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Aave</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:23,&quot;name&quot;:&quot;pancakeSwap&quot;,&quot;abbreviation&quot;:&quot;cake&quot;,&quot;roi&quot;:1.0100000000000000088817841970012523233890533447265625,&quot;image&quot;:&quot;currency\/cake.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/cake.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">PancakeSwap</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                CAKE</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                25.25%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake PancakeSwap</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card stakeCard" id="stakeCard"
                                                data-currency="{&quot;id&quot;:24,&quot;name&quot;:&quot;uniswap&quot;,&quot;abbreviation&quot;:&quot;uni&quot;,&quot;roi&quot;:1.0500000000000000444089209850062616169452667236328125,&quot;image&quot;:&quot;currency\/uni.png&quot;,&quot;created_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-02T12:02:56.000000Z&quot;}">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img style="width: 90%; aspect-ratio: 1/1;"
                                                                src="currency/uni.png"
                                                                alt="Icon">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="text-white">Uniswap</div>
                                                            <div class="text-white" style="font-size: 13px">
                                                                UNI</div>
                                                            <div class="text-success" style="font-size: 13px;">
                                                                <span style="font-size: 12px;">Minimum Roi</span>:
                                                                26.25%
                                                            </div>
                                                            <div
                                                                style="font-size: 12px; padding: 2px 5px; background-color: rgba(255,255,255,0.5); color: rgba(0,0,0,0.6); display: inline-block; border-radius: 5px; font-weight: bold;">
                                                                Stake Uniswap</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <p>Active Staking</p>

                                    <div class="table-responsive" style="max-height: 400px;">
                                        <table class="table table-striped">
                                            <thead class="th-text-md">
                                                <tr>
                                                    <th>Currency</th>
                                                    <th>Amount</th>
                                                    <th>Profit</th>
                                                    <th><i class="fa fa-clock"></i></th>
                                                    <th>Elapsed</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tb-text-md">
                                                <?php 
                                                    $stake_sql = mysqli_query($link, "SELECT * FROM stakes WHERE email = '$email' AND activate = 1 ORDER BY id DESC ");
                                                    if (mysqli_num_rows($stake_sql) > 0) {
                                                        while ($stake_row = mysqli_fetch_assoc($stake_sql)) {
                                                            
                                                ?>

                                                <tr>
                                                    <td><?php echo ucfirst($stake_row['currency']) ?></td>
                                                    <td>$<?php echo $stake_row['usd'] ?></td>
                                                    <td>$<?php echo $stake_row['increase'] ?></td>
                                                    <td><?php echo $stake_row['end_date'] ?></td>
                                                    <td><?php echo $stake_row['pdate'] ?></td>
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

                    <div class="modal fade" style="margin-top: -50px;" id="stakeModal" tabindex="-1" role="dialog"
                        aria-labelledby="stakeModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">New Staking</h5>
                                    <button type="button" class="btn btn-sm btn-secondary text-white"
                                        data-dismiss="modal" aria-label="Close">
                                        <span class="fa fa-times" style="font-size: 15px"></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">

                                            <div>
                                                <form action="stake.php" method="POST">
                                                    <input type="hidden" name="_token"
                                                        value="dB8QbQtUBrLHAkuRYxdPpMFfhJNSl6VWhyfNH9EJ">
                                                    <div class="form-group">
                                                        <label for="currency">Currency</label>
                                                        <input type="text" class="trade-input"
                                                            style="font-weight: bold;" id="currencyVal" disabled>
                                                        <small id="currencyHelp" class="form-text text-muted">You are
                                                            about to stake the
                                                            above currency</small>
                                                    </div>

                                                    <input type="hidden" name="currency" id="currency">
                                                    <input type="hidden" name="roiMul" id="roiMul" value="1">

                                                    <div class="form-group">
                                                        <label for="amount" style=" width: 100%;">
                                                            <span>Enter Amount In USD</span>
                                                            <div style="float: right; color:rgb(0, 200, 0); display: none;"
                                                                id="returnAmount">Profit: $1,509.50+</div>
                                                        </label>
                                                        <input type="number" min="5" class="trade-input" name="amount"
                                                            id="amount" aria-describedby="amountHelp"
                                                            placeholder="Eg. 1000" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="elapse" style=" width: 100%;">
                                                            <span>Select Elapse Date</span>
                                                            <div style="float: right; color:rgb(0, 200, 0); display: none;"
                                                                id="returnPercent">Roi: 0%</div>
                                                        </label>
                                                        <select class="trade-input" name="elapse" id="elapse"
                                                            aria-describedby="elapseHelp" required>
                                                            <option value="">SELECT</option>
                                                            <option value="3">3 days</option>
                                                            <option value="5">5 days</option>
                                                            <option value="7">7 days</option>
                                                            <option value="10">10 days</option>
                                                            <option value="14">14 days</option>
                                                        </select>

                                                    </div>

                                                    <div style="font-size: 12px;" class="mb-3 mt-4">Note: Staking
                                                        reward/profit depends on
                                                        amount staked and its duration. Select a higher elapse date to
                                                        get the most out of
                                                        staking </div>
                                                    <input type="hidden" name="roi" id="roi" value="0">
                                                    <button name="submit" type="submit" 
                                                        class="btn btn-sm btn-primary txt-white w-100">Stake</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function () {

                            $(document).on('click', '#stakeCard', function () {
                                var e_ = $(this)
                                var data_ = JSON.parse(JSON.stringify(e_.data('currency')))
                                // console.log(data_)
                                $('#currencyVal').val(`${data_.name}`.toUpperCase())
                                $('#currency').val(data_.name)
                                $('#roiMul').val(data_.roi)
                                $('#amount').val('')
                                $('#elapse').val('')
                                $('#roi').val(0)
                                $('#returnPercent').css('display', 'none')
                                $('#returnAmount').css('display', 'none')
                                $('#showStakeModalBtn').click()
                            })

                            // var _now = new Date();
                            // var now = `${_now.getFullYear()}-${_now.getMonth() + 1}-${_now.getDate()+7}`
                            // var now_ = new Date(`${_now.getFullYear()}-${_now.getMonth() + 1}-${_now.getDate()}`);

                            // $('#elapse').prop('min', now)

                            $(document).on('change', '#elapse', function () {
                                let el = $(this)
                                let am = $('#amount')
                                if (el.val() !== '' && am.val() !== '') {
                                    // let elps = new Date(el.val())
                                    // let milli_secs = elps.getTime() - now_.getTime()
                                    // var days = Math.round(milli_secs / (1000 * 3600 * 24));
                                    var days = el.val()

                                    if (days > 2) {
                                        var roi = 0
                                        if (days == 3) {
                                            roi = 7
                                        }else if(days == 5){
                                            roi = 12
                                        }else if(days == 7){
                                            roi = 12
                                        } else if(days == 10){
                                            roi = 22
                                        } else if (days == 14) {
                                            roi = 25
                                        } else if (days == 30) {
                                            roi = 55
                                        } else if (days == 60) {
                                            roi = 120
                                        } else if (days == 182) {
                                            roi = 400
                                        } else if (days == 365) {
                                            roi = 900
                                        } else {
                                            roi = 0
                                        }

                                        $('#returnPercent').html('Roi: ' + (roi * parseFloat($('#roiMul').val())).toFixed(2) + '%')
                                        $('#returnAmount').html('Profit: $' + ((((((roi * parseFloat($('#roiMul').val())).toFixed(2)) / 100) * $('#amount').val()).toFixed(
                                            2)).toLocaleString('en-US')) + '+')
                                        $('#roi').val((roi * parseFloat($('#roiMul').val())).toFixed(2))
                                        $('#returnPercent').css('display', 'inline-block')
                                        $('#returnAmount').css('display', 'inline-block')
                                    } else {
                                        $('#returnPercent').css('display', 'none')
                                        $('#returnAmount').css('display', 'none')
                                        $('#roi').val(0)
                                    }
                                } else {
                                    $('#roi').val(0)
                                    $('#returnPercent').css('display', 'none')
                                    $('#returnAmount').css('display', 'none')
                                }
                            })

                            $(document).on('input', '#amount', function () {
                                let el = $('#elapse')
                                let am = $(this)
                                if (el.val() !== '' && am.val() !== '') {
                                    // let elps = new Date(el.val())
                                    // let milli_secs = elps.getTime() - now_.getTime()
                                    // var days = Math.round(milli_secs / (1000 * 3600 * 24));

                                    var days = el.val()

                                    if (days > 6) {
                                        var roi = 0
                                        if (days == 14) {
                                            roi = 25
                                        } else if (days == 30) {
                                            roi = 55
                                        } else if (days == 60) {
                                            roi = 120
                                        } else if (days == 182) {
                                            roi = 400
                                        } else if (days == 365) {
                                            roi = 900
                                        } else {
                                            roi = 0
                                        }

                                        $('#returnPercent').html('Roi: ' + (roi * parseFloat($('#roiMul').val())).toFixed(2) + '%')
                                        $('#returnAmount').html('Profit: $' + ((((((roi * parseFloat($('#roiMul').val())).toFixed(2)) / 100) * $(this).val()).toFixed(2))
                                            .toLocaleString('en-US')) + '+')
                                        $('#roi').val((roi * parseFloat($('#roiMul').val())).toFixed(2))
                                        $('#returnPercent').css('display', 'inline-block')
                                        $('#returnAmount').css('display', 'inline-block')
                                    } else {
                                        $('#roi').val(0)
                                        $('#returnPercent').css('display', 'none')
                                        $('#returnAmount').css('display', 'none')
                                    }
                                } else {
                                    $('#roi').val(0)
                                    $('#returnPercent').css('display', 'none')
                                    $('#returnAmount').css('display', 'none')
                                }
                            })

                        })
                    </script>











                </div>

<?php  
include 'footer.php';
?>