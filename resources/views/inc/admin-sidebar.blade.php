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
                    <div class="row py-0" >
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
            @endhasrole 
            @hasrole('employee')
            <div class="option row col mx-0">
                <a href="{{ route('home') }}">
                    Employee
                </a>
            </div>
            @endhasrole
        </div>
    </div>
    @endhasanyrole

        <ul id="menu-container" class="list-unstyled">
            <li class="menu-section {{ request()->is('admin/employees*') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#employee-setup" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="fas fa-users"></i></div>
                        <div class="col-10">Employee</div>
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
            
            {{-- SECTION: Payroll --}}
            <li class="menu-section {{ request()->is('payroll') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#payrollSubmenu" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="fas fa-dollar-sign"></i></div>
                        <div class="col-10">Payroll</div>
                    </div>
                </a>
                <ul class="collapse list-unstyled {{ request()->is('payroll') ? 'show' : '' }}" id="payrollSubmenu">
                    <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                        <a href="{{ route('payroll') }}">Payroll</a>
                    </li>
                    <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                        <a href="{{ route('payroll/government_report') }}">Government Reports</a>
                    </li>
                    <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                        <a href="">Reports</a>
                    </li>
                    <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                        <a href="">Payroll Setup</a>
                    </li>
                </ul>
            </li>
            
            {{-- SECTION: E-Leave --}}
            <li class="menu-section {{ request()->is('admin.e-leave','admin.e-leave','','admin.e-leave','admin.e-leave') ? 'active' : '' }}">
                    <a class="info dropdown-toggle" href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false">
                        <div class="row">
                            <div class="col-1"><i class="far fa-calendar-alt"></i></div>
                            <div class="col-10">E-Leave</div>
                        </div>
                    </a>
                    <ul class="collapse list-unstyled {{ request()->is('admin.e-leave','admin.e-leave','','admin.e-leave','admin.e-leave') ? 'show' : '' }}"
                        id="leaveSubmenu">
                        {{-- OPTION: Leave Request --}}
                        {{-- <li class="menu-option {{ request()->is('admin.e-leave') ? 'active' : '' }}">
                            <a href="{{ route('admin.e-leave') }}">Leave Request</a>
                        </li> --}}
                        {{-- OPTION: PH Setup --}}
                        <li class="menu-option {{ request()->is('admin/e-leave/configuration/leaveholidays') ? 'active' : '' }}">
                            <a href="{{ route('admin.e-leave.configuration.leaveholidays') }}">PH Setup</a>
                        </li>

                        <li class="menu-option {{ request()->is('admin/e-leave/configuration/leavetypes') ? 'active' : '' }}">
                            <a href="{{ route('admin.e-leave.configuration.leavetypes') }}">Leave Type Setup</a>
                        </li>

                        <li class="menu-option {{ request()->is('admin/e-leave/configuration/leavebalances') ? 'active' : '' }}">
                            <a href="{{ route('admin.e-leave.configuration.leavebalances') }}">Leave Balance</a>
                        </li>

                        
                        <li class="menu-option {{ request()->is('admin/e-leave/configuration/leaverequest') ? 'active' : '' }}">
                            <a href="{{ route('admin.e-leave.configuration.leaverequests') }}">Leave Request</a>
                        </li>
                       
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
                <ul class="collapse list-unstyled {{ request()->is('admin/settings*') ? 'show' : '' }}"
                    id="setupSubmenu">
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
                                            
                    {{-- OPTION: General Information --}}
                    <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                        <a href="#">General Information</a>
                    </li>
                </ul>
            </li>

        </ul>
   
</nav>