

<div class="offcanvas offcanvas-start m-0" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel" style="background: #222529; width: 23em;" >
    <div class="offcanvas-header">
        {{-- <h5 id="offcanvasLeftLabel">Offcanvas Left</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button> --}}
            <a href="{{ url('tablet/home') }}" class="">
                <span class="logo-lg">
                    <img src="{{ url('public/image/EndoINDEX white logo.png') }}" alt=""
                        height="50">
                </span>
            </a>

    </div>

    <div class="offcanvas-body m-0 ">
        <ul class="navbar-nav " id="navbar-nav">
            <li class="menu-title text-gray-ipad "><i class="ri-more-fill"></i><span data-key="t-OPERATION">Moblie
                MENU</span></li>

            <li class="nav-item">
                <a class="nav-link pd-leftmenu menu-link
                @if (Request::segment(2) == 'book') active @endif"

                    href="{{ url("tablet/book/") }}">
                    <i class="ri-calendar-check-fill ri-lg "></i>&ensp; &ensp; <span>Booking List</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link pd-leftmenu menu-link text-gray-ipad @if (Request::segment(2) == 'casemonitor') active @endif"
                    href="{{ url("tablet/casemonitor") }}">
                    <i class="ri-computer-line ri-lg "></i>&ensp; &ensp; <span>Cases control</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link pd-leftmenu menu-link text-gray-ipad  @if (Request::segment(2) == 'home') active @endif"
                    href="{{ url('tablet/home') }}">
                    <i class="ri-list-check ri-lg "></i> &ensp; &ensp; <span data-key="t-OPERATION">Cases List</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link pd-leftmenu menu-link text-gray-ipad @if (Request::segment(2) == 'viewerRegister') active @endif" href="{{ url('tablet/viewerRegister') }}">
                    <i class="ri-folder-history-line ri-lg"></i>&ensp; &ensp; <span data-key="t-OPERATION">Viewer
                        History</span>
                </a>
            </li>


            <hr>
            <li class="menu-title"><i class="ri-more-fill"></i> &ensp; &ensp; <span data-key="t-MANAGEMENT">MANAGEMENT
                    MENU</span></li>

         {{-- <li class="nav-item">
                <a class="nav-link pd-leftmenu menu-link text-gray-ipad @if (Request::segment(1) == 'overall') active @endif"
                    href="{{ url('overallIpad') }}">
                    <i class="ri-dashboard-line ri-lg"></i>&ensp; &ensp; <span data-key="t-MANAGEMENT">Overall</span>
                </a>
            </li> --}}

            <li class="nav-item ">
                <a class="nav-link pd-leftmenu menu-link text-gray-ipad  @if (Request::segment(1) == 'equipment_management') active @endif"
                    href="{{ url('tablet/scope') }}">
                    <i class="ri-speaker-2-line ri-lg"></i>  &ensp; &ensp;<span class="" data-key="t-MANAGEMENT">
                        Scope Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pd-leftmenu menu-link text-gray-ipad @if (Request::segment(1) == 'chdashboard') active @endif"
                    href="{{ url('chdashboard') }}">
                    <i class="ri-bar-chart-box-line ri-lg"></i> &ensp; &ensp; <span data-key="t-MANAGEMENT">Data Analyze</span>
                </a>
            </li>

             <li class="nav-item">
                <a class="nav-link pd-leftmenu menu-link text-gray-ipad" href="{{ route('logout') }}"
                    onclick="   event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class=" ri-logout-box-r-line ri-lg"></i> &ensp; &ensp; <span data-key="t-logout">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" name="userid" value="{{ @uid() }}">
                </form>
            </li>


            @if (@uget("user_type") == 'admin')
                @include('layouts.adminmenu')
            @endif
        </ul>
    </div>
</div>
