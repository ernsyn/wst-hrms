<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar-header text-center">
        <img src="{{asset('img/oppologo.png')}}" width="150px">
    </div>
    <ul class="list-unstyled components">
    @hasanyrole('super-admin|admin')
        {{-- eleave --}}
        {{-- <li class="{{ request()->is('leaveapplication') ? 'active' : '' }}"> --}}
        </li>
            <a href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="row">
                    <div class="col-1">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="col-10">
                        E-LEAVE
                    </div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('leaveapplication','') ? 'show' : '' }}" id="leaveSubmenu">
                <li class="{{ request()->is('leaveapplication') ? 'active' : '' }}">
                    <a href="{{ route('leaveapplication') }}">Leave Application</a>
                </li>
                <li class="{{ request()->is('') ? 'active' : '' }}">
                    <a href="{{ route('leaveapplication') }}">Leave History</a>
                </li>
            </ul>
        </li>
        @else

        {{-- setup --}}
        {{-- <li class="{{ request()->is('admin/employee_list') ? 'active' : '' }}"> --}}
        <li>
            <a href="#employeeSetup" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="row">
                    <div class="col-1">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="col-10">
                        EMPLOYEE
                    </div>
                </div>
            </a>
            {{-- <ul class="collapse list-unstyled {{ request()->is('admin/employee_list') ? 'show' : '' }}" id="employeeSetup">
                <li class="{{ request()->is('admin/employee_list') ? 'active' : '' }}">
                    <a href="{{ route('admin/employee_list') }}">Employee List</a>
                </li>              
            </ul> --}}
        </li>
        {{-- setup --}}
        {{-- <li class="{{ request()->is('setup/company','setup/job-configure','setup/branch','') ? 'active' : '' }}"> --}}
        <li>
            <a href="#setupSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="row">
                    <div class="col-1">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="col-10">
                        SETUP
                    </div>
                </div>
            </a>
            {{-- <ul class="collapse list-unstyled {{ request()->is('setup/company','setup/job-configure','setup/branch','') ? 'show' : '' }}" id="setupSubmenu">
                <li class="{{ request()->is('setup/company') ? 'active' : '' }}">
                    <a href="/setup/company">Company</a>
                </li>              
                <li class="{{ request()->is('setup/cost-centre') ? 'active' : '' }}">
                    <a href="/setup/cost-centre">Cost Centre</a>
                </li>
                <li class="{{ request()->is('setup/department') ? 'active' : '' }}">
                    <a href="/setup/department">Department</a>
                </li>
                <li class="{{ request()->is('setup/branch') ? 'active' : '' }}">
                    <a href="/setup/branch">Branch</a>
                </li>
                <li class="{{ request()->is('setup/team') ? 'active' : '' }}">
                    <a href="/setup/team">Team</a>
                </li>
                <li class="{{ request()->is('setup/position') ? 'active' : '' }}">
                    <a href="/setup/position">Position</a>
                </li>
                <li class="{{ request()->is('setup/grade') ? 'active' : '' }}">
                    <a href="/setup/grade">Grade</a>
                </li>
                <li class="{{ request()->is('') ? 'active' : '' }}">
                    <a href="#">General Information</a>
                </li>               
            </ul> --}}
        </li>
        {{-- setup --}}
        {{-- <li class="{{ request()->is('setup/company','setup/job-configure') ? 'active' : '' }}"> --}}
        <li>
            <a href="#setupSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="row">
                    <div class="col-1">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="col-10">
                        NEW EMPLOYEE
                    </div>
                </div>
            </a>
            {{-- <ul class="collapse list-unstyled {{ request()->is('setup/company','setup/job-configure') ? 'show' : '' }}" id="setupSubmenu">
                <li class="{{ request()->is('setup/company') ? 'active' : '' }}">
                    <a href="/setup/company">Company</a>
                </li>
                <li class="{{ request()->is('setup/job-configure') ? 'active' : '' }}">
                    <a href="/setup/job-configure">Job Configure</a>
                </li>
             
            </ul> --}}
        </li>        
        
        {{-- eleave --}}
        {{-- <li class="{{ request()->is('leaveapplication','admin/leavetype') ? 'active' : '' }}"> --}}
        <li>
            <a href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="row">
                    <div class="col-1">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="col-10">
                        E-LEAVE
                    </div>
                </div>
            </a>
            {{-- <ul class="collapse list-unstyled {{ request()->is('leaveapplication','admin/leavetype') ? 'show' : '' }}" id="leaveSubmenu">
                <li class="{{ request()->is('leaverequest') ? 'active' : '' }}">
                    <a href="{{ route('leaverequest') }}">Leave Request</a>
                </li>
                <li class="{{ request()->is('') ? 'active' : '' }}">
                    <a href="{{ route('leaveholiday') }}">PH Setup</a>
                </li>
                <li class="{{ request()->is('') ? 'active' : '' }}">
                    <a href="{{ route('leaveapplication') }}">Leave Application On Behalf</a>
                </li>
                <li class="{{ request()->is('') ? 'active' : '' }}">
                    <a href="{{ route('leavebalance') }}">Leave Balance</a>
                </li>
                <li class="{{ request()->is('') ? 'active' : '' }}">
                    <a href="{{ route('leavetype') }}">Leave Type</a>
                </li>
            </ul> --}}
        </li>
    </ul>
@endif
</nav>