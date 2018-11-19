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
            <li class="menu-section {{ request()->is('admin.employees') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#employee-setup" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="fas fa-users"></i></div>
                        <div class="col-10">Employee</div>
                    </div>
                </a>
                <ul class="collapse list-unstyled {{ request()->is('admin.employees') ? 'show' : '' }}" id="employee-setup">
                    {{-- OPTION: Add Employee --}}
                    <li class="menu-option {{ request()->is('admin.employees.add') ? 'active' : '' }}">
                        <a href="{{ route('admin.employees.add') }}">Add Employee</a>
                    </li>
    
                    {{-- OPTION: Employee List --}}
                    <li class="menu-option {{ request()->is('admin/user-list') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.company') }}">Employee List</a>
                    </li>
                </ul>
            </li>
            
            
    
            {{-- SECTION: Setup --}}
            <li class="menu-section {{ request()->is('admin.settings.company','admin.settings.cost-centre') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#setupSubmenu" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="fas fa-cog"></i></div>
                        <div class="col-10">Setup</div>
                    </div>
                </a>
                <ul class="collapse list-unstyled {{ request()->is('admin.settings.grade') ? 'show' : '' }}"
                    id="setupSubmenu">
                    {{-- OPTION: Company --}}
                    
                    <li class="menu-option {{ request()->is('admin.settings.company') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.company')}}">Company</a>
                    </li>

                    {{-- OPTION: Cost Centre --}}
                    <li class="menu-option {{ request()->is('admin.settings.cost-centre') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.cost-centre')}}">Cost Centre</a>
                 
                    </li>
                    {{-- OPTION: Department --}}
                    <li class="menu-option {{ request()->is('admin.settings.department') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.department')}}">Department</a>
                    </li>
                    {{-- OPTION: Branch --}}
                    <li class="menu-option {{ request()->is('admin.settings.branch') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.branch')}}">Branch</a>
                    </li>
                    {{-- OPTION: Team --}}
                    <li class="menu-option {{ request()->is('admin.settings.team') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.team')}}">Team</a>
                    </li>
                    {{-- OPTION: Position --}}
                    <li class="menu-option {{ request()->is('admin.settings.position') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.position')}}">Position</a>
                    </li>
                    {{-- OPTION: Grade --}}
                    <li class="menu-option {{ request()->is('admin.settings.grade') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.grade')}}">Grade</a>
                    </li>
                    {{-- OPTION: General Information --}}
                    <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                        <a href="#">General Information</a>
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
                    <li class="menu-option {{ request()->is('admin.e-leave') ? 'active' : '' }}">
                        <a href="{{ route('admin.e-leave') }}">Leave Balance</a>
                    </li>
                    {{-- OPTION: Leave Type --}}
                    <li class="menu-option {{ request()->is('admin.e-leave') ? 'active' : '' }}">
                        <a href="{{ route('admin.e-leave') }}">Leave Type</a>
                    </li>
                </ul>
            </li>
        </ul>
   
</nav>