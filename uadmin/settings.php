<?php 
  include 'header.php';
  $msg ="";
  $err = "";

  if (isset($_POST['save'])) {
    $sname = text_input($_POST['sname']);
    $bname = text_input($_POST['bname']);
    $semail = text_input($_POST['email']);
    
    if(!empty($sname) && !empty($bname) && !empty($semail) ){
        $save = mysqli_query($link, "UPDATE settings SET siteurl = '$sname', sitename = '$sname', sitemail = '$semail' WHERE id = '1' ");
        if ($save) {
          $msg = "Settings Updated successfully";
        }else{
          $err = mysqli_error($link);
        }
    }

    
    
}

 ?>



<div class="page-content">
    <div class="container-fluid">
<?php 
  if ($msg != "") {
    echo customAlert("success", $msg);
    echo pageRedirect("2", "settings.php");
  }
  if ($err != "") {
    echo customAlert("error", $err);
  }

 ?>

      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div class="card-header">
                      <h4 class="card-title mb-0">Settings</h4>
                  </div>
                  <form method="post" action="settings.php">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Domain</label>
                                        <input type="text" class="form-control" value="<?php echo $siteurl ?>" name="sname" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Site Name</label>
                                        <input type="text" class="form-control" value="<?php echo $sitename ?>" name="bname" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Email</label>
                                        <input type="text" class="form-control" value="<?php echo $sitemail ?>" name="email" id="basiInput">
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



 <?php 
  include 'footer.php';
 ?>