                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a
                                href="#" target="_blank"><?php echo $sitename ?> </a><?php echo date('Y') ?></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <script>
        $(document).ready(function () {
            $('#logoutBtn').click(function () {
                $('#logoutForm').submit();
            });

            $('#notificationBtn').click(function () {
                $('#notificationModal').modal('show');

                var href = $(this).data("href");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: href,
                    type: "get",
                    success: function (e) {
                        return e;
                    }
                });
            });

            $('#activityBtn').click(function () {
                $('#activityModal').modal('show');
            });

            $('#modalHide').click(function () {
                $('#notificationModal').modal('hide');
            });
            $('#activityModalHide').click(function () {
                $('#activityModal').modal('hide');
            });

        });

        // $(document).on('click', '#deleteWallet', function() {
        //     var href = $(this).data("href");

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         url: href,
        //         type: "get",
        //         success: function(e) {
        //             if (e.errors != null) {
        //                 for (i in e.errors) {
        //                     toastr.error(e.errors[i], "Error", {
        //                         timeOut: 5000
        //                     });
        //                 }
        //             } else {
        //                 toastr.success(e.message, "Success", {
        //                     timeOut: 5000
        //                 });
        //                 refreshWalletAddress();
        //             }
        //         }
        //     });
        // });
    </script>
    <!-- plugins:js -->
        <!-- GetButton.io widget -->
        <script type="text/javascript">
        (function () {
            var options = {
                whatsapp: "+1 (623) 352-5942", // WhatsApp number
                call_to_action: "Message Us", // Call to action
                position: "left", // Position may be 'right' or 'left'
            };
            var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
            s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
            var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
        })();
    </script>
    <!-- /GetButton.io widget -->
    <!-- <script src="../code.tidio.co_443/rwpdkxm3bm88ant1lstsbi4ixq78uhau.js" async></script> -->

    <!-- endinject -->
    <!-- Plugin js for this page-->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendors/Chart.min.js"></script>
    <script src="vendors/jquery.dataTables.js"></script>
    <script src="vendors/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="dash/js/off-canvas.js"></script>
    <script src="dash/js/hoverable-collapse.js"></script>
    <script src="dash/js/template.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="dash/js/dashboard.js"></script> 
    <script src="dash/js/data-table.js"></script>
    <script src="dash/js/jquery.dataTables.js"></script>
    <script src="dash/js/dataTables.bootstrap4.js"></script>
    <!-- End custom js for this page-->

    <script src="dash/js/jquery.cookie.js" type="text/javascript"></script>
    
    
</body>

</html>