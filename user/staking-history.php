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
                                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp; Staking History
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <span>Active Stakings</span>
                                    <?php  
                                        $stake_sql = mysqli_query($link, "SELECT * FROM stakes WHERE email = '$email' AND activate = 1 ORDER BY id DESC ");
                                        if (mysqli_num_rows($stake_sql) > 0) {
                                    ?>
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
                                                
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php  
                                        }else{
                                    ?>
                                    <div style="text-align: center; padding: 150px 50px; color:rgb(180, 180, 180);">
                                        <p class="mb-3" style="font-size: 28px;"><i
                                                class="fa fa-exclamation-circle"></i></p>
                                        <p>No Investments</p>

                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <span>Staking History</span>

                                    <?php  
                                        $stake_sql = mysqli_query($link, "SELECT * FROM stakes WHERE email = '$email' AND activate = 0 ORDER BY id DESC ");
                                        if (mysqli_num_rows($stake_sql) > 0) {
                                    ?>
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
                                                
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php  
                                        }else{
                                    ?>
                                    <div style="text-align: center; padding: 150px 50px; color:rgb(180, 180, 180);">
                                        <p class="mb-3" style="font-size: 28px;"><i
                                                class="fa fa-exclamation-circle"></i></p>
                                        <p>No Investments</p>

                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>






                    <script>
        // $(document).ready(function() {
        //     $('#btcBtn').click(function() {
        //         $('#btcDiv').css('display', 'block');
        //         $('#ethDiv').css('display', 'none');
        //         $('.type-btn').removeClass('type-active');
        //         $('#btcBtn').addClass('type-active');
        //     });

        //     $('#ethBtn').click(function() {
        //         $('#btcDiv').css('display', 'none');
        //         $('#ethDiv').css('display', 'block');
        //         $('.type-btn').removeClass('type-active');
        //         $('#ethBtn').addClass('type-active');
        //     });
        // });

        // function copyFunction() {
        //     var r = document.createRange();
        //     r.selectNode(document.getElementById('addressCopy'));
        //     window.getSelection().removeAllRanges();
        //     window.getSelection().addRange(r);
        //     document.execCommand('copy');
        //     window.getSelection().removeAllRanges();

        //     alert('copied');
        // }
                    </script>




                </div>

<?php  
include 'footer.php';
?>