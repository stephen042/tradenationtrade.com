<?php  
include 'session.php';

if ($verify == "0" ) {
    echo "<script>window.location.href = 'profile.php' </script>";
}


if (isset($_POST['amount']) && isset($_POST['units']) && isset($_POST['interval']) && isset($_POST['symbol']) && isset($_POST['direction'])) {
	
	$amount = text_input($_POST['amount']);
	$units = text_input($_POST['units']);
	$interval = text_input($_POST['interval']);
	$direction = text_input($_POST['direction']);
	$symbol = text_input($_POST['symbol']);
	
	$trade_type = $account_type;
	$trade_set = date('Y-m-d H:i:s');
	$trade_exp = date('Y-m-d H:i:s', strtotime($trade_set. ' +'.$interval.''));
	// $code = "01";
	// $win_loss = str_shuffle($code);
 //    $win_loss = substr($win_loss, 0, 1);
    $status = '1'; //Trade on going
    $getsignal = mysqli_query($link, "SELECT * FROM signals WHERE symbol = '$symbol' AND directions = '$direction' ");
    if (mysqli_num_rows($getsignal) > 0) {
    	$win_loss = "1";
    }else{
    	$win_loss = "0";
    }
	$insert = mysqli_query($link, "INSERT INTO trade (`email`, `trade_type`, `amount`, `symbol`, `units`, `trade_interval`, `market`, `status`, `trade_exp`, `trade_set`, `win_loss`) VALUES ('$email', '$trade_type', '$amount', '$symbol', '$units', '$interval', '$direction', '1', '$trade_exp', '$trade_set', '$win_loss' ) ");
	if ($insert) {
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
		mysqli_query($link, "UPDATE users SET $col = $col - '$amount' WHERE email = '$email' ");

		$subject = $sitename . " Your Order Has been executed";
		$body = "Your order was executed on: " . $trade_set . ". Here are the details of your matched trade :<br> <br>
		Contract: " . $symbol . " <br> 
		Expiration: " . $trade_exp . " <br>
		Direction: " . $direction . " <br>
		Quantity: " . $units . " <br>
		Price: " . $amount . " <br> <br>
		Your positions and balance have been updated. <br> <br>
		if you have any questions please contact customer service at customerservice@nadex.online. <br> <br>
		Best regards, <br> <br>
		The ".$sitename." Team <br>
		Email: " . $sitemail . " <br>
		website: " . $siteurl.". <br>";
		sendMail($email, $name, $subject, $body);
		echo "Trade placed successfully !";
	}
}


// status = 1; trade on going
// status = 2; trade loss
// status = 3; trade win

?>