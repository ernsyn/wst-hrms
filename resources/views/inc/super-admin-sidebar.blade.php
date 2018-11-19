<nav id="sidebar">
    <div id="header-logo" class="sidebar-header text-center">
        <img src="{{asset('img/oppologo.png')}}">
    </div>
        <ul id="menu-container" class="list-unstyled">
            <li class="menu-section {{ request()->is('super-admin.employees') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#employee-setup" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="fas fa-users"></i></div>
                        <div class="col-10">Employee</div>
                    </div>
                </a>
                <ul class="collapse list-unstyled {{ request()->is('super-admin.employees') ? 'show' : '' }}" id="employee-setup">
                    {{-- OPTION: Add Employee --}}
                    <li class="menu-option {{ request()->is('super-admin.employees.add.post') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.employees.add.post') }}">Add Employee</a>
                    </li>
    
                    {{-- OPTION: Employee List --}}
                    <li class="menu-option {{ request()->is('super-admin/user-list') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.settings.company') }}">Employee List</a>
                    </li>
                </ul>
            </li>
            
            
    
            {{-- SECTION: Setup --}}
            <li class="menu-section {{ request()->is('super-admin.settings.company','super-admin.settings.cost-centre') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#setupSubmenu" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="fas fa-cog"></i></div>
                        <div class="col-10">Setup</div>
                    </div>
                </a>
                <ul class="collapse list-unstyled {{ request()->is('super-admin.settings.grade') ? 'show' : '' }}"
                    id="setupSubmenu">
                    {{-- OPTION: Company --}}
                    
                    <li class="menu-option {{ request()->is('super-admin.settings.company') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.settings.company')}}">Company</a>
                    </li>

                    {{-- OPTION: Cost Centre --}}
                    <li class="menu-option {{ request()->is('super-admin.settings.cost-centre') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.settings.cost-centre')}}">Cost Centre</a>
                 
                    </li>
                    {{-- OPTION: Department --}}
                    <li class="menu-option {{ request()->is('super-admin.settings.department') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.settings.department')}}">Department</a>
                    </li>
                    {{-- OPTION: Branch --}}
                    <li class="menu-option {{ request()->is('super-admin.settings.branch') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.settings.branch')}}">Branch</a>
                    </li>
                    {{-- OPTION: Team --}}
                    <li class="menu-option {{ request()->is('super-admin.settings.team') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.settings.team')}}">Team</a>
                    </li>
                    {{-- OPTION: Position --}}
                    <li class="menu-option {{ request()->is('super-admin.settings.position') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.settings.position')}}">Position</a>
                    </li>
                    {{-- OPTION: Grade --}}
                    <li class="menu-option {{ request()->is('super-admin.settings.grade') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.settings.grade')}}">Grade</a>
                    </li>
                    {{-- OPTION: General Information --}}
                    <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                        <a href="#">General Information</a>
                    </li>
                </ul>
            </li>
            {{-- SECTION: E-Leave --}}
            <li class="menu-section {{ request()->is('super-admin.e-leave','super-admin.e-leave','','super-admin.e-leave','super-admin.e-leave') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="far fa-calendar-alt"></i></div>
                        <div class="col-10">E-Leave</div>
                    </div>
                </a>
                <ul class="collapse list-unstyled {{ request()->is('super-admin.e-leave','super-admin.e-leave','','super-admin.e-leave','super-admin.e-leave') ? 'show' : '' }}"
                    id="leaveSubmenu">
                    {{-- OPTION: Leave Request --}}
                    <li class="menu-option {{ request()->is('super-admin.e-leave') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.e-leave') }}">Leave Request</a>
                    </li>
                    {{-- OPTION: PH Setup --}}
                    <li class="menu-option {{ request()->is('super-admin.e-leave.configuration.holidays') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.e-leave.configuration.holidays') }}">PH Setup</a>
                    </li>
                    {{-- OPTION: Leave Application On Behalf --}}
                    <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                        <a href="">Leave Application On Behalf</a>
                    </li>
                    {{-- OPTION: Leave Balance --}}
                    <li class="menu-option {{ request()->is('super-admin.e-leave') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.e-leave') }}">Leave Balance</a>
                    </li>
                    {{-- OPTION: Leave Type --}}
                    <li class="menu-option {{ request()->is('super-admin.e-leave') ? 'active' : '' }}">
                        <a href="{{ route('super-admin.e-leave') }}">Leave Type</a>
                    </li>
                </ul>
            </li>
        </ul>
   
</nav>