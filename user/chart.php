<?php
include 'header.php';

if ($verify == "0" ) {
    echo "<script>window.location.href = 'index.php' </script>";

}

?>



<div class="content-wrapper bg-dark">
    <div class="row">
        <div class="col-md-12 col-sm-12 grid-margin overflow-auto">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container" style="width: 100%;height:100%;">
                <div id="tradingview_ffe20"></div>
                <div class="tradingview-widget-copyright"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                <script type="text/javascript">
                    new TradingView.widget({
                        //   "autosize": true,
                        "symbol": "NASDAQ:AAPL",
                        "interval": "30",
                        "timezone": "Etc/UTC",
                        "theme": "dark",
                        "style": "1",
                        "locale": "en",
                        "toolbar_bg": "#f1f3f6",
                        "enable_publishing": false,
                        "allow_symbol_change": true,
                        "container_id": "tradingview_ffe20"
                    });
                </script>
            </div>
            <!-- TradingView Widget END -->
        <!-- </div> -->
    </div>
</div>

<?php
include 'footer.php';
?>