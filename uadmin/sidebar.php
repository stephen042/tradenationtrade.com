                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="index.php">
                                <i class=" ri-home-line"></i> <span data-key="t-widgets">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-team-fill"></i> <span data-key="t-dashboards">Users Management</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="users.php" class="nav-link" data-key="t-analytics">All Users</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="verify.php" class="nav-link" data-key="t-analytics">Verify Users</a>
                                    </li>

                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->

                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarsignal" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarsignal">
                                <i class="ri-bar-chart-line"></i> <span data-key="t-dashboards">Signals</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarsignal">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="addsignals.php" class="nav-link" data-key="t-analytics">Add Signal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="signals.php" class="nav-link" data-key="t-analytics">View Signal</a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="all_trades.php">
                                <i class="ri-arrow-left-down-line "></i> <span data-key="t-widgets">All Trades</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarwallet" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarwallet">
                                <i class="ri-wallet-fill "></i> <span data-key="t-dashboards">Wallet Management</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarwallet">
                                <ul class="nav nav-sm flex-column">
                                    <!-- <li class="nav-item">
                                        <a href="addwallet.php" class="nav-link" data-key="t-analytics">Add Wallet</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="wallets.php" class="nav-link" data-key="t-analytics">View Wallets</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="plan_request.php">
                                <i class="ri-arrow-left-down-line "></i> <span data-key="t-widgets">Plan Request</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="sub_request.php">
                                <i class="ri-arrow-left-down-line "></i> <span data-key="t-widgets">Paid Subscriptions </span>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="Ai_trading.php">
                                <i class="ri-bar-chart-box-fill"></i> <span data-key="t-widgets">Ai_trading</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarstakes" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarstakes">
                                <i class="ri-bar-chart-line"></i> <span data-key="t-dashboards">Stakes Management</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarstakes">
                                <ul class="nav nav-sm flex-column">
                                    <!-- <li class="nav-item">
                                        <a href="addwallet.php" class="nav-link" data-key="t-analytics">Add Wallet</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="active-stakes.php" class="nav-link" data-key="t-analytics">Active Stakes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="stakes-history.php" class="nav-link" data-key="t-analytics">Stake History</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="deposit.php">
                                <i class="ri-arrow-left-down-line "></i> <span data-key="t-widgets">Deposits Request</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="subdeposit.php">
                                <i class="ri-arrow-left-down-line "></i> <span data-key="t-widgets">Subscription Deposits Request</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="withdraw.php">
                                <i class="ri-arrow-right-up-fill"></i> <span data-key="t-widgets">Withdrawal Request</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarplans" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarplans">
                                <i class=" ri-file-paper-2-line "></i> <span data-key="t-dashboards">Manage Plans</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarplans">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="addpackages.php" class="nav-link" data-key="t-analytics">Add Plan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="plans.php" class="nav-link" data-key="t-analytics">All Plans</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarplansAi" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarplansAi">
                                <i class=" ri-file-paper-2-line "></i> <span data-key="t-dashboards">Manage -Ai-trading Plans</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarplansAi">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="addaiplan.php" class="nav-link" data-key="t-analytics">Add Ai-trading Plan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="aiplans.php" class="nav-link" data-key="t-analytics">All Ai-trading Plans</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarplansSig" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarplansSig">
                                <i class=" ri-file-paper-2-line "></i> <span data-key="t-dashboards">Manage signal Plans</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarplansSig">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="addsignalplan.php" class="nav-link" data-key="t-analytics">Add signal trading Plan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="signalplan.php" class="nav-link" data-key="t-analytics">All Signal Plans</a>
                                    </li>

                                </ul>
                            </div>
                        </li> -->
                        <!-- end Dashboard Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarmail" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarmail">
                                <i class="ri-mail-fill"></i> <span data-key="t-dashboards">Send Mail</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarmail">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="sendmail.php" class="nav-link" data-key="t-analytics">Send Mail to all Users</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="mailuser.php" class="nav-link" data-key="t-analytics">Send Mail to a User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="viewmail.php" class="nav-link" data-key="t-analytics">View messages</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="settings.php">
                                <i class="ri-settings-2-fill"></i> <span data-key="t-widgets">Settings</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="account.php">
                                <i class="ri-account-circle-line"></i> <span data-key="t-widgets">Account</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="logout.php">
                                <i class="ri-logout-circle-line"></i> <span data-key="t-widgets">Logout</span>
                            </a>
                        </li>


                    </ul>
                </div>