<?php 
include 'header.php';

if(isset($_GET['mid']) && $_GET['mid'] !=''){
  $mid = $link->real_escape_string($_GET['mid']);
  $delete_status =  "DELETE FROM package1 WHERE id = '$mid'";
  if(mysqli_query($link,$delete_status)){
    echo "<script>
    alert('Plan Deleted Successfully!');
    window.location.href='plans.php';
    </script>
    ";
  }
}
 ?>

<div class="page-content">
    <div class="container-fluid">
    	<div class="row">

<?php 
	$sql = "SELECT * FROM package1";
	$result = mysqli_query($link,$sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){  
           $row['pname'];
?>
            <div class="col-xl-4 col-lg-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="new-arrival-product">
                            <form method="POST" action="">
	                            <div class="new-arrival-content text-center mt-0">
	                            	
	                                <input type="hidden" name="pname" value="<?php echo $row['pname'];?>">
	                            	<h3 class="mb-4"><?php echo $row['pname'] ?></h3>
	                                <h4>Increase - <?php echo $row['increase']?>%</h4>
	                                <p><i class="pe-7s-play"></i> Minimum deposit - <b>$<?php echo $row['froms'];?></b></p>
	                                <p><i class="pe-7s-play"></i> Maximum deposit - <b>$<?php echo $row['tos'];?></b></p>
	                                <p><i class="pe-7s-play"></i> Duration - <?php echo $row['duration'];?> days</p>
	                                
	                                <a href="addpackages.php?id=<?php echo $row['id'];?>"  class="btn btn-success" style="margin-bottom: 2px;">Update</a>

	                                <a href="plans.php?mid=<?php echo $row['id'];?>"  class="btn btn-danger" onclick="return confirm('Do you really want to delete this package');">Delete</a>
	                            </div>
	                        </form>
                        </div>
                    </div>
                </div>
            </div>

<?php }} ?>
        </div>
    </div>
</div>








 <?php 
include 'footer.php';
  ?>