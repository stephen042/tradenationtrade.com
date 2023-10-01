<?php
include 'header.php';

if (isset($_GET['mid']) && $_GET['mid'] != '') {
    $mid = $link->real_escape_string($_GET['mid']);
    $delete_status =  "DELETE FROM ai_plan WHERE id = '$mid'";
    if (mysqli_query($link, $delete_status)) {
        echo "<script>
    alert('Plan Deleted Successfully!');
    window.location.href='aiplans.php';
    </script>
    ";
    }
}
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">

            <?php
            $sql = "SELECT * FROM ai_plan";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $row['plan'];
            ?>
                    <div class="col-xl-4 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="new-arrival-product">
                                    <form method="POST" action="aiplans.php">
                                        <div class="new-arrival-content text-center mt-0">

                                            <input type="hidden" name="pname" value="<?php echo $row['plane']; ?>">
                                            <h3 class="mb-4"><?php echo $row['plan'] ?></h3>
                                            <h4>Amount - $<?php echo $row['amount'] ?></h4>
                                            <p><i class="pe-7s-play"></i> Win RAte - <b><?php echo $row['win_rate']; ?>%</b></p>

                                            <p><i class="pe-7s-play"></i> Duration - <?php echo $row['duration']; ?> </p>

                                            <a href="addaiplan.php?id=<?php echo $row['id']; ?>" class="btn btn-success" style="margin-bottom: 2px;">Update</a>

                                            <a href="aiplans.php?mid=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this package');">Delete</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php }
            } ?>
        </div>
    </div>
</div>








<?php
include 'footer.php';
?>