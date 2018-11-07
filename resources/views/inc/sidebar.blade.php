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
            <li class="{{ request()->is('admin/employee_list') ? 'active' : '' }}">
            <a href="#employeeSetup" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="row">
                    <div class="col-1">
                            <i class="fas fa-users"></i>
                    </div>
                    <div class="col-10">
                        EMPLOYEE
                    </div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('admin/employee_list') ? 'show' : '' }}" id="employeeSetup">
            <li class="{{ request()->is('admin/employee_list') ? 'active' : '' }}">
            <a href="{{ route('admin/employee_list') }}">Employee List</a>
        </li>              
            </ul>
        </li>
        {{-- Admin Setup --}}
        <li class="{{ request()->is('setup/company','setup/cost-centre','setup/department','setup/branch','setup/team','setup/position','setup/grade') ? 'active' : '' }}">
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
            <ul class="collapse list-unstyled {{ request()->is('setup/company','setup/cost-centre','setup/department','setup/branch','setup/team','setup/position','setup/grade') ? 'show' : '' }}" id="setupSubmenu">
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
            </ul>
        </li>
        {{-- eleave --}}
        <li class="{{ request()->is('admin/leaverequest','admin/leaveholiday','','admin/leavebalance','admin/leavetype') ? 'active' : '' }}">
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
            <ul class="collapse list-unstyled {{ request()->is('admin/leaverequest','admin/leaveholiday','','admin/leavebalance','admin/leavetype') ? 'show' : '' }}" id="leaveSubmenu">
                <li class="{{ request()->is('admin/leaverequest') ? 'active' : '' }}">
                    <a href="{{ route('admin/leaverequest') }}">Leave Request</a>
                </li>
                <li class="{{ request()->is('admin/leaveholiday') ? 'active' : '' }}">
                    <a href="{{ route('admin/leaveholiday') }}">PH Setup</a>
                </li>
                <li class="{{ request()->is('') ? 'active' : '' }}">
                    <a href="">Leave Application On Behalf</a>
                </li>
                <li class="{{ request()->is('admin/leavebalance') ? 'active' : '' }}">
                    <a href="{{ route('admin/leavebalance') }}">Leave Balance</a>
                </li>
                <li class="{{ request()->is('admin/leavetype') ? 'active' : '' }}">
                    <a href="{{ route('admin/leavetype') }}">Leave Type</a>
                </li>
            </ul>
        </li>
    </ul>
        </li>
        @else

        <li class="{{ request()->is('admin/leaveapplication') ? 'active' : '' }}">
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
            <ul class="collapse list-unstyled {{ request()->is('admin/leaveapplication','') ? 'show' : '' }}" id="leaveSubmenu">
                <li class="{{ request()->is('admin/leaveapplication') ? 'active' : '' }}">
                    <a href="{{ route('admin/leaveapplication') }}">Leave Application</a>
                </li>
                <li class="{{ request()->is('') ? 'active' : '' }}">
                    <a href="{{ route('admin/leaveapplication') }}">Leave History</a>
                </li>
            </ul>
        </li>
@endif
</nav>