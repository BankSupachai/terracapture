    <li class="menu-title"><i class="ri-more-fill"></i> <span class="text-white-50" data-key="t-MANAGEMENT">ADMIN MENU</span>
    </li>
    @if (@$menu->menu_admin_hospital)
    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'hospital') active @endif"
            href="{{ url('admin/hospital/self/edit') }}">
            <i class="ri-hospital-line"></i> <span data-key="t-MANAGEMENT">Hospital Setting</span>
        </a>
    </li>
    @endif
    @if (@$menu->menu_admin_procedure)
    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'procedure') active @endif"
            href="{{ url('admin/procedure') }}">
            <i class="bx bx-voicemail"></i> <span data-key="t-MANAGEMENT">Procedure Setting</span>
        </a>
    </li>
    @endif
    @if (@$menu->menu_admin_department)
    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'department') active @endif"
            href="{{ url("admin/department") }}">
            <i class="ri-dashboard-fill"></i> <span data-key="t-MANAGEMENT">Department
                Setting</span>
        </a>
    </li>
    @endif
    @if (@$menu->menu_admin_doctorbook)
    <li class="nav-item">
        <a class="nav-link menu-link cs-pointer " data-bs-toggle="modal"
                data-bs-target="#select_doctor_list">
            <i class="ri-service-fill"></i> <span data-key="t-MANAGEMENT">Doctor Setting (Book)</span>
        </a>
    </li>
    @endif
    @if (@$menu->menu_admin_department_book)
    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(2) == 'setting_department') active @endif"
                href="{{ url('book/setting_department/91') }}">
                <i class="ri-projector-fill"></i> <span data-key="t-MANAGEMENT">Department Setting (Book)</span>
         </a>
    </li>
    @endif
    @if (@$menu->menu_admin_collection)
    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'createcollection') active @endif"
                href="{{ url('createcollection') }}">
                <i class="ri-stock-line"></i>
                <span data-key="t-MANAGEMENT">Createcollection</span>
        </a>
    </li>
    @endif
    @if (@$menu->menu_admin_User)
    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'user') active @endif"
            href="{{ url("admin/user") }}">
            <i class="ri-account-circle-line"></i> <span data-key="t-MANAGEMENT">User Setting</span>
        </a>
    </li>
    @endif
    @if (@$menu->menu_admin_scope)
    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'scope') active @endif"
            href="{{ url("admin/scope") }}">
            <i class="ri-microscope-line"></i> <span data-key="t-MANAGEMENT">Scope Setting</span>
        </a>
    </li>
    @endif
    @if (@$menu->menu_admin_room)

    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'room') active @endif"
            href="{{ url("admin/room") }}">
            <i class="ri-home-line"></i> <span data-key="t-MANAGEMENT">Room Setting</span>
        </a>
    </li>
    @endif
    @if(@$menu->menu_admin_case)
    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'case') active @endif"
            href="{{ url("admin/case") }}">
            <i class="ri-file-list-line"></i> <span data-key="t-MANAGEMENT">Case Setting</span>
        </a>
    </li>
    @endif
    @if(@$menu->menu_admin_worklist)
    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'worklist') active @endif"
            href="{{ url("admin/worklist") }}">
            <i class="ri-list-settings-line"></i> <span data-key="t-MANAGEMENT">Worklist Procedure Setting</span>
        </a>
    </li>
    @endif
    @if (@$menu->menu_admin_treatment)

    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'createcollection') active @endif"
            href="{{ url("admin/treatment") }}">
            <i class="ri-align-justify"></i> <span data-key="t-MANAGEMENT"> Treatment
                Coverage</span>
        </a>
    </li>
    @endif
    @if (@$menu->menu_admin_wording)

    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'createcollection') active @endif"
            href="{{ url('createcollection') }}">
            <i class="ri-fullscreen-fill"></i> <span data-key="t-MANAGEMENT"> Wording</span>
        </a>
    </li>
@endif

@if (@$menu->menu_admin_migrate)

<li class="nav-item">
    <a class="nav-link menu-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'migrate') active @endif"
        href="{{ url('admin/migrate') }}">
        <i class="ri-database-fill"></i> <span data-key="t-MANAGEMENT"> Migrate</span>
    </a>
</li>
@endif

@if (@$menu->menu_admin_log)


    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(2) == 'log') active @endif" href="#sidebarMultilevel" data-bs-toggle="collapse"
            role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
            <i class="ri-record-mail-line"></i> <span data-key="t-multi-level">Log Data</span>
        </a>
        <div class="collapse menu-dropdown @if (Request::segment(2) == 'log') show @endif" id="sidebarMultilevel">
            @php
                $logs = ['photo', 'auth', 'upload', 'case', 'pdf', 'dicom', 'sendto', 'user', 'export'];
            @endphp
            <ul class="nav nav-sm flex-column">
                @foreach ($logs as $i)
                    <li class="nav-item">
                        <a href="{{url('admin')}}/log/{{@$i.""}}?page=1" class="nav-link @if (Request::segment(3) == $i) active @endif" data-key="t-level-1.1"> Log {{ucfirst($i)}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </li>
    @endif



    @if (@$menu->menu_aboutproject)

    <li class="nav-item">
        <a class="nav-link menu-link @if (Request::segment(1) == 'about') active @endif"
            href="{{ url('about') }}">
            <i class="ri-file-info-line"></i> <span data-key="t-MANAGEMENT"> About</span>
        </a>
    </li>
    @endif
