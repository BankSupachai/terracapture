<style>
    [data-layout=horizontal] .navbar-menu .navbar-nav .nav-link.active {
        color: #495057;
    }
</style>
<div id="">
    <div class="card shadow-sm border-0" style="margin: 0; border-radius: 0;">
        <div class="card-body p-3" style="height: 58px; margin-top: -14px;">
            <ul class="navbar-nav d-flex flex-row" style="font-size: 15px;" id="navbar-nav">

                    <li class="nav-item me-3" style="margin-left: 50px;">
                        <a class="nav-link menu-link @if (Request::segment(1) == 'capture' && Request::segment(2) == 'home') active @endif"
                            href="home.php" title="Home">
                            <i class="bx bx-home" @if (Request::url() == url('home.php')) style="color:#192D4B" @endif></i>
                            <span class="menu-hover"
                                @if (Request::url() == url('home.php')) style="color:#192D4B" @endif>Home</span>
                        </a>
                    </li>

                    <li class="nav-item me-3" style="margin-left: 30px; margin-right: 30px; margin-top: -2px;" menu_title="Case History">
                        <a class="nav-link menu-link @if (Request::segment(1) == 'endo' || Request::segment(1) == 'home' || Request::segment(1) == '') active @endif"
                            href="casehistory.php" title="Case History">
                            <i class="ri-folder-history-line"
                                @if (Request::url() == url('casehistory')) style="color:#192D4B" @endif></i>
                            <span class="menu-hover1" @if (Request::url() == url('casehistory')) style="color:#192D4B" @endif>Case
                                History</span>
                        </a>
                    </li>


                    <!-- <li class="nav-item me-3" menu_title="Overall">
                        <a class="nav-link menu-link @if (Request::segment(1) == 'overall') active @endif"
                            href="{{ url('overall') }}" title="Overall">
                            <i class="ri-dashboard-line"></i>
                            <span class="menu-hover">Overall</span>
                        </a>
                    </li> -->


                    <li class="nav-item me-3" style="margin-left: 30px; margin-right: 30px; margin-top: -2px;" menu_title="Data Analyze">
                        <a class="nav-link menu-link @if (Request::segment(1) == 'chdashboard') active @endif"
                            href="analysis.php" title="Data Analyze">
                            <i
                                class="ri-bar-chart-box-line"@if (Request::url() == url('analysis')) style="color:#192D4B" @endif></i>
                            <span
                                class="menu-hover"@if (Request::url() == url('analysis')) style="color:#192D4B" @endif>Analysis</span>
                        </a>
                    </li>

                    <li class="nav-item" style="margin-left: 30px; margin-right: 30px; margin-top: -2px;" menu_title="Export">
                    <a class="nav-link menu-link @if (Request::segment(1) == 'exportindex') active @endif"
                        href="export.php" title="Export">
                        <i
                            class="ri-external-link-fill"@if (Request::url() == url('exportdata.php')) style="color:#192D4B" @endif></i>
                        <span class="menu-hover"@if (Request::url() == url('exportdata.php')) style="color:#192D4B" @endif>Export
                            Data</span>
                    </a>
                </li>
                <li class="nav-item" style="margin-left: 30px; margin-right: 30px; margin-top: -2px;" menu_title="Cases Monitor">
                    <a class="nav-link menu-link @if (Request::segment(1) == 'casemonitor') active @endif"
                        href="casemonitor.php" title="Cases Monitor">
                        <i class="ri-computer-line"
                            @if (Request::url() == url('casemonitor.php')) style="color:#192D4B" @endif></i>
                        <span class="menu-hover" @if (Request::url() == url('casemonitor.php')) style="color:#192D4B" @endif>Cases
                            Monitor</span>
                    </a>
                </li>
                <li class="nav-item" style="margin-left: 30px; margin-right: 30px; margin-top: -2px;" menu_title="EMR">
                    <a class="nav-link menu-link @if (Request::segment(1) == 'emr') active @endif"
                        href="emr.php" title="EMR">
                        <i class="ri-file-list-3-line"
                            @if (Request::url() == url('emr.php')) style="color:#192D4B" @endif></i>
                        <span class="menu-hover"
                            @if (Request::url() == url('emr.php')) style="color:#192D4B" @endif>EMR</span>
                    </a>
                </li>
                <li class="nav-item" style="margin-left: 30px; margin-right: 30px; margin-top: -3px;" menu_title="Storage Manager">
                <a class="nav-link menu-link @if (Request::segment(1) == 'storemanage') active @endif"
                    href="storemanage.php" title="Storage Manager">
                    <i class="ri-database-2-line"   
                        @if (Request::url() == url('storemanage.php')) style="color:#192D4B" @endif></i>
                    <span class="menu-hover"
                        @if (Request::url() == url('storemanage.php')) style="color:#192D4B" @endif>Storage Manager</span>
                </a>
            </li>

            </ul>
        </div>
    </div>
</div>
<!-- Left Menu -->
