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
                            Admin
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
                @endhasrole @hasrole('employee')
                <div class="option row col mx-0">
                    <a href="{{ route('employee.dashboard') }}">
                        Employee
                    </a>
                </div>
                @endhasrole
            </div>
        </div>
        @endhasanyrole
    
        <ul id="menu-container" class="list-unstyled">
            <li id="dashboard-option" class="menu-section {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a class="info" href="{{ route('admin.dashboard') }}">
                    <div class="row">
                        <div class="col-1"><i class="fas fa-grip-horizontal"></i></div>
                        <div class="col-10">Dashboard</div>
                    </div>
                </a>
            </li>
            {{-- SECTION: Employees --}}
            <li class="menu-section {{ request()->is('admin/employees*') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#employee-setup" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="fas fa-users"></i></div>
                        <div class="col-10">Employees</div>
                    </div>
                </a>
                <ul class="collapse list-unstyled {{ request()->is('admin/employees*') ? 'show' : '' }}" id="employee-setup">
                    {{-- OPTION: Add Employee --}}
                    <li class="menu-option {{ request()->is('admin/employees/add') ? 'active' : '' }}">
                        <a href="{{ route('admin.employees.add') }}">Add Employee</a>
                    </li>
                    {{-- OPTION: Employee List --}}
                    <li class="menu-option {{ request()->is('admin/employees') ? 'active' : '' }}">
                        <a href="{{ route('admin.employees') }}">Employee List</a>
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
                <ul class="collapse list-unstyled {{ request()->is('admin/e-leave*') ? 'show' : '' }}" id="leaveSubmenu">
                    {{-- OPTION: Leave Request --}}
                    <li class="menu-option {{ request()->is('admin.e-leave') ? 'active' : '' }}">
                        <a href="{{ route('admin.e-leave.configuration') }}">Configuration</a>
                    </li>
                    {{-- OPTION: PH Setup --}}
                    <li class="menu-option {{ request()->is('admin/e-leave/configuration/leaveholidays') ? 'active' : '' }}">
                        <a href="{{ route('admin.e-leave.configuration.leave-holidays') }}">Holidays Setup</a>
                    </li>
                    <li class="menu-option {{ request()->is('admin/e-leave/configuration/leave-requests') ? 'active' : '' }}">
                        <a href="{{ route('admin.e-leave.configuration.leave-requests') }}">Leave Requests</a>
                    </li>
                    <li class="menu-option {{ request()->is('admin/e-leave/configuration/leave-application') ? 'active' : '' }}">
                        <a href="{{ route('admin.e-leave.leave-application') }}">Leave Application</a>
                    </li>
                    {{-- <li class="menu-option {{ request()->is('admin/e-leave/configuration/leave-report') ? 'active' : '' }}">
                        <a href="{{ route('admin.e-leave.leave-report') }}">Leave Report</a>
                    </li> --}}
                </ul>
            </li>
    
            {{-- SECTION: Attendance --}}
            <li class="menu-section {{ request()->is('admin/attendance*') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#attendanceSubmenu" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="far fa-clock"></i></div>
                        <div class="col-10">Attendance</div>
                    </div>
                </a>
                <ul class="collapse list-unstyled {{ request()->is('admin/attendance*') ? 'show' : '' }}" id="attendanceSubmenu">
                    {{-- OPTION: Current Day Attendance --}}
                    {{-- <li class="menu-option {{ request()->is('admin.attendance') ? 'active' : '' }}">
                        <a href="{{ route('admin.attendance.current-day') }}">Current Day</a>
                    </li> --}}
                    {{-- OPTION: Attendance Report --}}
                    {{-- <li class="menu-option {{ request()->is('admin.attendance') ? 'active' : '' }}">
                        <a href="{{ route('admin.attendance.report') }}">Attendance Report</a>
                    </li> --}}
                </ul>
            </li>
    
            {{-- SECTION: Settings --}}
            <li class="menu-section {{ request()->is('admin/settings*') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#setupSubmenu" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="fas fa-cog"></i></div>
                        <div class="col-10">Settings</div>
                    </div>
                </a>
                <ul class="collapse list-unstyled {{ request()->is('admin/settings*') ? 'show' : '' }}" id="setupSubmenu">
                    {{-- OPTION: Companies --}}
                    <li class="menu-option {{ request()->is('admin/settings/companies') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.companies')}}">Companies</a>
                    </li>
                    {{-- OPTION: Cost Centres --}}
                    <li class="menu-option {{ request()->is('admin/settings/cost-centres') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.cost-centres')}}">Cost Centres</a>
                    </li>
                    {{-- OPTION: Departments --}}
                    <li class="menu-option {{ request()->is('admin/settings/departments') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.departments')}}">Departments</a>
                    </li>
                    {{-- OPTION: Branches --}}
                    <li class="menu-option {{ request()->is('admin/settings/branches') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.branches')}}">Branches</a>
                    </li>
                    {{-- OPTION: Teams --}}
                    <li class="menu-option {{ request()->is('admin/settings/teams') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.teams')}}">Teams</a>
                    </li>
                    {{-- OPTION: Positions --}}
                    <li class="menu-option {{ request()->is('admin/settings/positions') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.positions')}}">Positions</a>
                    </li>
                    {{-- OPTION: Grades --}}
                    <li class="menu-option {{ request()->is('admin/settings/grades') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.grades')}}">Grades</a>
                    </li>
                    {{-- OPTION: Working Days --}}
                    <li class="menu-option {{ request()->is('admin/settings/working-days') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.working-days')}}">Working Days</a>
                    </li>
                    {{-- OPTION: EPF --}}
                    <li class="menu-option {{ request()->is('admin/settings/epf') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.epf')}}">EPF</a>
                    </li>
                    {{-- OPTION: Eis --}}
                    <li class="menu-option {{ request()->is('admin/settings/eis') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.eis')}}">EIS</a>
                    </li>
                    {{-- OPTION: Socso --}}
                    <li class="menu-option {{ request()->is('admin/settings/socso') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.socso')}}">Socso</a>
                    </li>
                    {{-- OPTION: Eis --}}
                    <li class="menu-option {{ request()->is('admin/settings/pcb') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.pcb')}}">PCB</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    