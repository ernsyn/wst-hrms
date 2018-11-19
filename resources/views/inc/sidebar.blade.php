<nav id="sidebar">
    <div id="header-logo" class="sidebar-header text-center">
        <img src="{{asset('img/logo-oppo-white.png')}}">
    </div>
    @hasanyrole('super-admin|admin')
    <div id="hrms-mode-container">
        <div id="hrms-mode" class="row mx-0">
            <div id="label" class="col-4 text-center">
                Mode
            </div>
            <div id="value" class="col-8 text-center" data-toggle="collapse" href="#mode-options">
                <div class="row py-0">
                    <div class="col-9 pl-2 pr-0 py-0 text-center">
                        Employee
                    </div>
                    <div class="col-3 px-0 py-0">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>
            </div>
        </div>
        <div id="mode-options" class="collapse">
            @hasrole('super-admin')
            <div class="option row col mx-0">
                <a href="{{ route('super-admin.dashboard') }}">
                    Super Admin
                </a>
            </div>
            @endhasrole 
            @hasrole('admin')
            <div class="option row col mx-0">
                <a href="{{ route('admin.dashboard') }}">
                    Admin
                </a>
            </div>
            @endhasrole
        </div>
    </div>
    @endhasanyrole

    <ul id="menu-container" class="list-unstyled">
        @hasanyrole('super-admin|admin') {{-- SECTION: Employee --}}
        <li class="menu-section {{ request()->is('admin.employees') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#employee-setup" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1"><i class="fas fa-users"></i></div>
                    <div class="col-10">Employee</div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('admin.employees') ? 'show' : '' }}" id="employee-setup">
                {{-- OPTION: Add Employee --}}
                <li class="menu-option {{ request()->is('admin.employees.add.post') ? 'active' : '' }}">
                    <a href="{{ route('admin.employees.add.post') }}">Add Employee</a>
                </li>

                {{-- OPTION: Employee List --}}
                <li class="menu-option {{ request()->is('admin/user-list') ? 'active' : '' }}">
                    <a href="{{ route('admin.employees') }}">Employee List</a>
                </li>
            </ul>
        </li>

        {{-- SECTION: Setup --}}
        <li class="menu-section {{ request()->is('admin.settings.company','admin.settings.cost-centre','admin.settings.department','admin.settings.branch','admin.settings.team','admin.settings.position','admin.settings.grade') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#setupSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1"><i class="fas fa-cog"></i></div>
                    <div class="col-10">Setup</div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('admin.settings.company',
            'admin.settings.cost-centre','admin.settings.department','admin.settings.branch','admin.settings.team',
            'admin.settings.position','admin.settings.grade') ? 'show' : '' }}"
                id="setupSubmenu">
                {{-- OPTION: Company --}}
                <li class="menu-option {{ request()->is('admin.settings.company') ? 'active' : '' }}">
                    <a href="admin.settings.company">Company</a>
                </li>
                {{-- OPTION: Cost Centre --}}
                <li class="menu-option {{ request()->is('admin.settings.cost-centre') ? 'active' : '' }}">
                    <a href="admin.settings.cost-centre">Cost Centre</a>
                </li>
                {{-- OPTION: Department --}}
                <li class="menu-option {{ request()->is('admin.settings.department') ? 'active' : '' }}">
                    <a href="admin.settings.department">Department</a>
                </li>
                {{-- OPTION: Branch --}}
                <li class="menu-option {{ request()->is('admin.settings.branch') ? 'active' : '' }}">
                    <a href="admin.settings.branch">Branch</a>
                </li>
                {{-- OPTION: Team --}}
                <li class="menu-option {{ request()->is('admin.settings.team') ? 'active' : '' }}">
                    <a href="admin.settings.team">Team</a>
                </li>
                {{-- OPTION: Position --}}
                <li class="menu-option {{ request()->is('admin.settings.position') ? 'active' : '' }}">
                    <a href="admin.settings.position">Position</a>
                </li>
                {{-- OPTION: Grade --}}
                <li class="menu-option {{ request()->is('admin.settings.grade') ? 'active' : '' }}">
                    <a href="admin.settings.grade">Grade</a>
                </li>
                {{-- OPTION: General Information --}}
                <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                    <a href="#">General Information</a>
                </li>
            </ul>
        </li>
        {{-- SECTION: E-Leave --}}
        <li class="menu-section {{ request()->is('admin/e-leave*') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1"><i class="far fa-calendar-alt"></i></div>
                    <div class="col-10">E-Leave</div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('admin/e-leave*') ? 'show' : '' }}"
                id="leaveSubmenu">
                {{-- OPTION: Leave Request --}}
                <li class="menu-option {{ request()->is('admin.e-leave') ? 'active' : '' }}">
                    <a href="{{ route('admin.e-leave') }}">Leave Request</a>
                </li>
                {{-- OPTION: PH Setup --}}
                <li class="menu-option {{ request()->is('admin.e-leave.configuration.holidays') ? 'active' : '' }}">
                    <a href="{{ route('admin.e-leave.configuration.holidays') }}">PH Setup</a>
                </li>
                {{-- OPTION: Leave Application On Behalf --}}
                <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                    <a href="">Leave Application On Behalf</a>
                </li>
                {{-- OPTION: Leave Balance --}}
                <li class="menu-option {{ request()->is('admin/e-leave/configuration') ? 'active' : '' }}">
                    <a href="{{ route('admin.e-leave.configuration') }}">Leave Balance</a>
                </li>
                {{-- OPTION: Leave Type --}}
                <li class="menu-option {{ request()->is('admin.e-leave.configuration.leave-types') ? 'active' : '' }}">
                    <a href="{{ route('admin.e-leave.configuration.leave-types') }}">Leave Type</a>
                </li>
            </ul>
        </li>
    </ul>
    @else

    <li class="menu-section {{ request()->is('employee/leaveapplication') ? 'active' : '' }}">
        <a class="info dropdown-toggle" href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false">
            <div class="row">
                <div class="col-1">
                    <i class="far fa-calendar-alt"></i>
                </div>
                <div class="col-10">
                    E-Leave
                </div>
            </div>
        </a>
        <ul class="collapse list-unstyled {{ request()->is('employee/leaveapplication','') ? 'show' : '' }}" id="leaveSubmenu">
            <li class="menu-option {{ request()->is('employee/leaveapplication') ? 'active' : '' }}">
                <a href="{{ route('employee/leaveapplication') }}">Leave Application</a>
            </li>
            <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                <a href="{{ route('employee/leaveapplication') }}">Leave History</a>
            </li>
        </ul>

    </li>
    @endhasanyrole
</nav>