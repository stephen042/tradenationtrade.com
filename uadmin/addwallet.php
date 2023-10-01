<?php include 'header.php'; ?>

<?php 
$msg = "";
$err = "";
    if (isset($_POST['save'])) {
        $wname = text_input($_POST['wname']);
        $add = text_input($_POST['add']);
        
        if (!empty($wname) && !empty($add) ) {
            $qq = mysqli_query($link, "INSERT INTO wallet (`name`, `address`) VALUES ('$wname', '$add') ");
            if ($qq) {
                $msg = "Wallet added successfully";
            }
        }
    }
?>

<div class="page-content">
    <div class="container-fluid">
<?php 
    if ($msg != "") {
        echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";
        echo pageRedirect("2", "wallets.php");
    }
    if ($err != "") {
        echo customNoti("error", $err);
    }

 ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add wallet for payment</h4>
                        </div>
                        <form method="post" action="addwallet.php">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Wallet Name</label>
                                        <input type="text" class="form-control" name="wname" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Wallet Address</label>
                                        <input type="text" class="form-control" name="add" id="basiInput">
                                    </div>
                                </div>

                               
                                
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<?php include 'footer.php'; ?>