<nav id="sidebar">
    <div id="header-logo" class="sidebar-header text-center">
        <img src="{{asset('img/oppologo.png')}}">
    </div>
    <ul id="menu-container" class="list-unstyled">
        @hasanyrole('super-admin|admin')
        {{-- SECTION: Employee --}}
        <li class="menu-section {{ request()->is('admin/employee_list') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#employee-setup" data-toggle="collapse" aria-expanded="false" >
                <div class="row">
                    <div class="col-1"><i class="fas fa-users"></i></div>
                    <div class="col-10">Employee</div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('admin/employee_list') ? 'show' : '' }}" id="employee-setup">
                {{-- OPTION: Add Employee --}}
                <li class="menu-option {{ request()->is('admin/employee/add') ? 'active' : '' }}">
                    <a href="{{ route('employee/add') }}">Add Employee</a>
                </li>

                {{-- OPTION: Employee List --}}
                <li class="menu-option {{ request()->is('admin/user-list') ? 'active' : '' }}">
                    <a href="{{ route('admin/user_list') }}">User List</a>
                </li>
            </ul>
        </li>

        {{-- SECTION: Setup --}}
        <li class="menu-section {{ request()->is('setup/company','setup/cost-centre','setup/department','setup/branch','setup/team','setup/position','setup/grade') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#setupSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1"><i class="fas fa-cog"></i></div>
                    <div class="col-10">Setup</div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('setup/company','setup/cost-centre','setup/department','setup/branch','setup/team','setup/position','setup/grade') ? 'show' : '' }}"
                id="setupSubmenu">
                {{-- OPTION: Company --}}
                <li class="menu-option {{ request()->is('setup/company') ? 'active' : '' }}">
                    <a href="/setup/company">Company</a>
                </li>
                {{-- OPTION: Cost Centre --}}
                <li class="menu-option {{ request()->is('setup/cost-centre') ? 'active' : '' }}">
                    <a href="/setup/cost-centre">Cost Centre</a>
                </li>
                {{-- OPTION: Department --}}
                <li class="menu-option {{ request()->is('setup/department') ? 'active' : '' }}">
                    <a href="/setup/department">Department</a>
                </li>
                {{-- OPTION: Branch --}}
                <li class="menu-option {{ request()->is('setup/branch') ? 'active' : '' }}">
                    <a href="/setup/branch">Branch</a>
                </li>
                {{-- OPTION: Team --}}
                <li class="menu-option {{ request()->is('setup/team') ? 'active' : '' }}">
                    <a href="/setup/team">Team</a>
                </li>
                {{-- OPTION: Position --}}
                <li class="menu-option {{ request()->is('setup/position') ? 'active' : '' }}">
                    <a href="/setup/position">Position</a>
                </li>
                {{-- OPTION: Grade --}}
                <li class="menu-option {{ request()->is('setup/grade') ? 'active' : '' }}">
                    <a href="/setup/grade">Grade</a>
                </li>
                {{-- OPTION: General Information --}}
                <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                    <a href="#">General Information</a>
                </li>
            </ul>
        </li>
        {{-- SECTION: E-Leave --}}
        <li class="menu-section {{ request()->is('admin/leaverequest','admin/leaveholiday','','admin/leavebalance','admin/leavetype') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1"><i class="far fa-calendar-alt"></i></div>
                    <div class="col-10">E-Leave</div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('admin/leaverequest','admin/leaveholiday','','admin/leavebalance','admin/leavetype') ? 'show' : '' }}"
                id="leaveSubmenu">
                {{-- OPTION: Leave Request --}}
                <li class="menu-option {{ request()->is('admin/leaverequest') ? 'active' : '' }}">
                    <a href="{{ route('admin/leaverequest') }}">Leave Request</a>
                </li>
                {{-- OPTION: PH Setup --}}
                <li class="menu-option {{ request()->is('admin/leaveholiday') ? 'active' : '' }}">
                    <a href="{{ route('admin/leaveholiday') }}">PH Setup</a>
                </li>
                {{-- OPTION: Leave Application On Behalf --}}
                <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                    <a href="">Leave Application On Behalf</a>
                </li>
                {{-- OPTION: Leave Balance --}}
                <li class="menu-option {{ request()->is('admin/leavebalance') ? 'active' : '' }}">
                    <a href="{{ route('admin/leavebalance') }}">Leave Balance</a>
                </li>
                {{-- OPTION: Leave Type --}}
                <li class="menu-option {{ request()->is('admin/leavetype') ? 'active' : '' }}">
                    <a href="{{ route('admin/leavetype') }}">Leave Type</a>
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
    @endif
</nav>
