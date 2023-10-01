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
                                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp; Contact Support
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <img src="img/logo2.png" alt="Logo" width="100px" class="mb-5">
                                        <h4><?php echo $sitename ?> Support</h4><br>

                                        <span>
                                            For inquiries, suggestions or complains. Mail us at<br><br>

                                            <?php echo $sitemail ?>
                                        </span>
                                    </center>
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