
<div id="scrollbar">
    <div class="container-fluid">
        <div id="two-column-menu">
        </div>

        <ul class="navbar-nav " id="navbar-nav">
            <li class="menu-title">

                    <i class="ri-more-fill"></i>
                    <span data-key="t-OPERATION" class="text-white-50">Operation
                        MENU</span>

                </li>


            @if(@$menu->menu_booking)
                    <li class="nav-item ">

                        <a class="nav-link menu-link hide @if (Request::segment(1) == 'book' && Request::segment(2) == 'bookingview') active @endif"
                            href="{{ url('book/bookingview') }}" title="Booking List">
                            <i class="ri-calendar-check-fill  " ></i>
                            <span class="menu-hover">Booking List</span>
                        </a>
                    </li>
            @endif
            @if(@$menu->menu_caselist)

            <li class="nav-item" menu_title="Cases List">
                <a class="nav-link menu-link @if (Request::segment(1) == 'endo' || Request::segment(1) == 'home' || Request::segment(1) == '') active @endif"
                    href="{{ url('') }}" title="Cases List">
                    <i class="ri-list-check"></i>
                    <span class="menu-hover1">Cases List</span>
                </a>
            </li>
            @endif

            @if(@$menu->menu_followup)
            <li class="nav-item" menu_title="Follow Up">
                <a class="nav-link menu-link @if (Request::segment(2) == 'followup') active @endif"
                    href="{{ url('book/followup') }}" title="Follow Up">
                    <i class="ri-task-line"></i>
                    <span class="menu-hover">Follow Up</span>
                </a>
            </li>
            @endif
            @if(@$menu->menu_sendto)
            <li  li class="nav-item" menu_title="Send to">
                <a class="nav-link menu-link @if (Request::segment(1) == 'sendto') active @endif"
                    href="{{ url('sendto') }}" title="Send to">
                    <i class="ri-share-forward-line"></i>
                    <span class="menu-hover">Send to</span>
                </a>
            </li>
            @endif


            @if(@$menu->menu_viewer)
            <li class="nav-item" menu_title="Viewer History">
                <a class="nav-link menu-link" href="{{ url('terra/w-viewer') }}">
                    <i class="ri-folder-history-line" title="Viewer
                    History"></i>
                    <span class="menu-hover">Viewer History</span>
                </a>
            </li>
            @endif
            <li class="menu-title"><i class="ri-more-fill"></i>
                <span data-key="t-MANAGEMENT" class="text-white-50">MANAGEMENT
                    MENU</span></li>
                    @if(@$menu->menu_overall)

            <li class="nav-item" menu_title="Overall">
                <a class="nav-link menu-link @if (Request::segment(1) == 'overall') active @endif"
                    href="{{ url('overall') }}" title="Overall">
                    <i class="ri-dashboard-line"></i>
                     <span class="menu-hover">Overall</span>
                </a>
            </li>
            @endif
            @if(@$menu->menu_casecontrol)
            <li class="nav-item" menu_title="Case Control">
                <a class="nav-link menu-link @if (Request::segment(2) == 'control') active @endif"
                    href="{{ url('casemonitor/control') }}" title="Case Control">
                    <i class=" ri-list-settings-line"></i>
                    <span class="menu-hover">Case Control</span>
                </a>
            </li>
            @endif

            {{-- <li class="nav-item" menu_title="">
            <a class="nav-link menu-link @if (Request::segment(1) == 'queue_management') active @endif"
                    href="{{ url('queue_management') }}">
                    <i class="  ri-computer-line"></i> <span data-key="t-MANAGEMENT">Queue Management</span>
                </a>
            </li> --}}
            @if(@$menu->menu_scope)
            <li class="nav-item" menu_title="Scope Management">
                <a class="nav-link menu-link @if (Request::segment(1) == 'scopemanagement') active @endif"
                    href="{{ url('scopemanagement') }}" title="Scope Management">
                    <i class="ri-speaker-2-line"></i>
                    <span data-key="t-MANAGEMENT">Scope
                        Management</span>
                </a>
            </li>
            @endif
            @if(@$menu->menu_dataanalyze)
            <li class="nav-item" menu_title="Data Analyze">
                <a class="nav-link menu-link @if (Request::segment(1) == 'chdashboard') active @endif"
                    href="{{ url('chdashboard') }}" title="Data Analyze">
                    <i class="ri-bar-chart-box-line"></i>
                     <span class="menu-hover">Data Analyze</span>
                </a>
            </li>
            @endif
            @if(@$menu->menu_export)
            <li class="nav-item" menu_title="Export">
                <a class="nav-link menu-link @if (Request::segment(1) == 'exportindex') active @endif"
                    href="{{ url('exportdata') }}" title="Export">
                    <i class="ri-external-link-fill"></i>
                    <span class="menu-hover">Export</span>
                </a>
            </li>
            @endif
            <li class="menu-title"><i class="ri-more-fill"></i> <span class="text-white-50" data-key="t-MANAGEMENT">Monitor
                MENU</span></li>
            @if(@$menu->menu_case)
                <li class="nav-item" menu_title="Cases Monitor" >
                    <a class="nav-link menu-link @if (Request::segment(1) == 'casemonitor/display') active @endif"
                        href="{{ url('casemonitor') }}" title="Cases Monitor">
                        <i class="ri-computer-line"></i>
                        <span class="menu-hover">Cases Monitor</span>
                    </a>
                </li>
            @endif
            @if(@$menu->menu_patient)
                <li class="nav-item" menu_title="Patient Monitor">
                    <a class="nav-link menu-link @if (Request::segment(1) == 'casemonitor/patienttv') active @endif"
                        href="{{ url('casemonitor/patienttv') }}" title="Patient Monitor">
                        <i class="ri-contacts-fill"></i>
                        <span class="menu-hover">Patient Monitor</span>
                    </a>
                </li>
            @endif
            @if(@$menu->menu_store)
            <li class="nav-item" menu_title="Patient Monitor">
                <a class="nav-link menu-link @if (Request::segment(1) == 'storemanage') active @endif"
                    href="{{ url('storemanage') }}" title="Store manage">
                    <i class="ri-archive-drawer-line"></i>
                    <span class="menu-hover">Store Management</span>
                </a>
            </li>
            @endif

            {{-- @if(@$menu->menu_patient) --}}
            @if(@$menu->menu_incharge)
            <li class="nav-item" menu_title=Incharge Monitor">
                <a class="nav-link menu-link @if (Request::segment(1) == 'casemonitor/inchargemonitor') active @endif"
                    href="{{ url('casemonitor/inchargemonitor') }}" title="Incharge Monitor">
                    <i class=" ri-profile-line"></i>
                    <span class="menu-hover">Incharge Monitor</span>
                </a>
            </li>
            @endif
        {{-- @endif --}}
                {{-- <li class="nav-item" menu_title="">
                    <a class="nav-link menu-link @if (Request::segment(1) == 'nurse_monitor/patienttv') active @endif"
                        href="{{ url('mockup/livecase') }}">
                        <i class="ri-cast-line"></i> <span data-key="t-MANAGEMENT">Live Case</span>
                    </a>
                </li> --}}
                <li class="menu-title"><i class="ri-more-fill"></i>
                    <span data-key="t-MANAGEMENT" class="text-white-50">Admin Menu</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-admin-fill"></i> <span data-key="t-dashboards">Admin Menu</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarDashboards">
                            <ul class="nav nav-sm flex-column">
                                <a class="nav-link menu-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'user') active @endif"
                                href="{{ url("admin/user") }}">
                                <span data-key="t-MANAGEMENT">User Setting</span>
                            </a>

                            </ul>
                        </div>
                    </li>
            @if (@uget("user_type") == 'admin')
                @include('layouts.adminmenu')
            @endif
        </ul>
    </div>
</div>
<!-- Left Menu -->



