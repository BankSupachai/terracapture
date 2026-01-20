            <!-- Left Menu -->
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-OPERATION">OPERATION
                                MENU</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(1) == 'book' && Request::segment(2) != 'followup') active @endif"
                                href="{{ url('book') }}">
                                <i class="ri-calendar-check-fill"></i> <span data-key="t-OPERATION">Booking List</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(1) == 'endo' || Request::segment(1) == 'home' || Request::segment(1) == '') active @endif"
                                href="{{ url('') }}">
                                <i class="ri-list-check"></i> <span data-key="t-OPERATION">Cases List</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(2) == 'followup') active @endif"
                                href="{{ url('book/followup') }}">
                                <i class="ri-task-line"></i> <span data-key="t-OPERATION">Follow Up</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(2) == 'showup') active @endif"
                                href="{{ url('showup') }}">
                                <i class="ri-share-forward-line"></i> <span data-key="t-OPERATION">Send to</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ url('terra/w-viewer') }}">
                                <i class="ri-folder-history-line"></i> <span data-key="t-OPERATION">Viewer History</span>
                            </a>
                        </li>
                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-MANAGEMENT">MANAGEMENT
                                MENU</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(1) == 'overall') active @endif"
                                href="{{ url('overall') }}">
                                <i class="ri-dashboard-line"></i> <span data-key="t-MANAGEMENT">Overall</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(2) == 'control') active @endif"
                                href="{{ url('casemonitor/control') }}">
                                <i class="ri-computer-line"></i> <span data-key="t-MANAGEMENT">Case Control</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(1) == 'queue_management') active @endif"
                                href="{{ url('queue_management') }}">
                                <i class="  ri-parent-line"></i> <span data-key="t-MANAGEMENT">Queue Manage</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(1) == 'equipment_management') active @endif"
                                href="{{ url('equipment_management') }}">
                                <i class="ri-camera-lens-line"></i> <span data-key="t-MANAGEMENT">Endoscope Manage</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(2) == 'display') active @endif"
                                href="{{ url('casemonitor') }}">
                                <i class="ri-honour-line"></i> <span data-key="t-MANAGEMENT">Case Monitor</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(1) == 'analytic') active @endif"
                                href="{{ url('chdashboard') }}">
                                <i class="ri-bar-chart-box-line"></i> <span data-key="t-MANAGEMENT">Data Analyze</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if (Request::segment(1) == 'exportindex') active @endif"
                                href="{{ url('exportindex') }}">
                                <i class="ri-external-link-fill"></i> <span data-key="t-MANAGEMENT">Export Data</span>
                            </a>
                        </li>
                        @if (@uget("user_type") == 'admin')
                            @include('layouts.adminmenu')
                        @endif
                    </ul>
                </div>
            </div>
            <!-- Left Menu -->
