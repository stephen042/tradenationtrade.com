<?php 
include 'header.php';

$msg = "";
$err = "";

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

  if (isset($_POST['edit'])) {
      $pbtc = text_input($_POST['btc']);
      $peth = text_input($_POST['eth']);
      $pbnb = text_input($_POST['bnb']);
      $pltc = text_input($_POST['ltc']);
      $pusdt_erc = text_input($_POST['usdt_erc']);
      $pusdt_trc = text_input($_POST['usdt_trc']);
      if (!empty($pbtc) && !empty($peth) && !empty($pbnb) && !empty($pltc) && !empty($pusdt_erc) && !empty($pusdt_trc)) {
        $update = mysqli_query($link, "UPDATE wallet SET btc='$pbtc',eth='$peth',bnb='$pbnb',ltc='$pltc',usdt_erc='$pusdt_erc',usdt_trc='$pusdt_trc'  ");
        if ($update) {
          $msg = "Wallets updated successfully";
        }
      }
  }

?>


<div class="page-content">
    <div class="container-fluid">
<?php 
    if ($msg != "") {
        echo customAlert("success", $msg);
        echo pageRedirect("2", "wallets.php");
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
                                    <i class="fas fa-home"></i> Wallets
                                </a>
                            </li>
                            

                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="wallets.php" method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">BTC Wallet</label>
                                                <input required type="text" class="form-control" id="firstnameInput" placeholder="Enter your BTC Wallet Address" name="btc" value="<?php echo $btc ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">ETH Wallet</label>
                                                <input required type="text" class="form-control" id="firstnameInput" placeholder="Enter your ETH Wallet Address" name="eth" value="<?php echo $eth ?>">
                                            </div>
                                        </div>

                                         <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">BNB Wallet</label>
                                                <input required type="text" class="form-control" id="firstnameInput" placeholder="Enter your BNB Wallet Address" name="bnb" value="<?php echo $bnb ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">LTC Wallet</label>
                                                <input required type="text" class="form-control" id="firstnameInput" placeholder="Enter your LTC Wallet Address" name="ltc" value="<?php echo $ltc ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">USDT ERC Wallet</label>
                                                <input required type="text" class="form-control" id="firstnameInput" placeholder="Enter your USDT ERC Wallet Address" name="usdt_erc" value="<?php echo $usdt_erc ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">USDT TRC Wallet</label>
                                                <input required type="text" class="form-control" id="firstnameInput" placeholder="Enter your USDT TRC Wallet Address" name="usdt_trc" value="<?php echo $usdt_trc ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 ">
                                                <button type="submit" name="edit" class="btn btn-primary">Update</button>
                                                
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
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








<?php 
include 'footer.php';
?>