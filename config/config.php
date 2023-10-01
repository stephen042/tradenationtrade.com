<?php 
include 'db.php';

	$select = mysqli_query($link, "SELECT * FROM settings WHERE id = '1' ");
	if (mysqli_num_rows($select) > 0) {
		$row = mysqli_fetch_assoc($select);

		$sitename = $row['sitename'];
		$sitemail = $row['sitemail'];
		$siteurl = $row['siteurl'];
	}

	$wallets = mysqli_query($link, "SELECT * FROM wallet WHERE id = '1' ");
	if (mysqli_num_rows($wallets) > 0) {
		$roww = mysqli_fetch_assoc($wallets);
		$btc = $roww['btc'];
		$eth = $roww['eth'];
		$bnb = $roww['bnb'];
		$ltc = $roww['ltc'];
		$usdt_erc = $roww['usdt_erc'];
		$usdt_trc = $roww['usdt_trc'];
	}

?>

