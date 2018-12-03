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
        <li class="menu-section {{ request()->is('profile*') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#profileSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1">
                            <i class="far fa-address-card"></i>
                    </div>
                    <div class="col-10">
                        Employee Profile
                    </div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('profile*','') ? 'show' : '' }}" id="profileSubmenu">
                <li class="menu-option {{ request()->is('employee/profile') ? 'active' : '' }}">
                    <a href="{{ route('employee.profile') }}">View My Profile</a>
                </li>
            </ul>
            

        </li>
        <li class="menu-section {{ request()->is('profile*') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#leave-submenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="col-10">
                        E-Leave
                    </div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('e-leave*','') ? 'show' : '' }}" id="leave-submenu">
                <li class="menu-option {{ request()->is('leaveapplication') ? 'active' : '' }}">
                    <a href="{{ route('leaveapplication') }}">Leave Application</a>
                </li>
                <li class="menu-option {{ request()->is('leaverequest') ? 'active' : '' }}">
                    <a href="{{ route('leaverequest') }}">Leave Approval</a>
                </li>

                <li class="menu-option {{ request()->is('leavehistory') ? 'active' : '' }}">
                    <a href="{{ route('leavehistory') }}">Leave Requests</a>
                </li>
            </ul>
        </li>


       
        {{-- <li class="menu-section {{ request()->is('leave*') ? 'active' : '' }}">
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
            <ul class="collapse list-unstyled {{ request()->is('leave*','') ? 'show' : '' }}" id="leaveSubmenu">
                <li class="menu-option {{ request()->is('employee/leaveapplication') ? 'active' : '' }}">
                    <a href="{{ route('employee/leaveapplication') }}">Leave Application</a>
                </li>
                <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                    <a href="{{ route('employee/leaverequest') }}">Leave History</a>
                </li>
            </ul>

        </li> --}}
        @if(PayrollHelper::isKpiProposer())
        <li class="menu-section {{ request()->is('payroll') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#payrollSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="col-10">
                        Payroll
                    </div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('payroll') ? 'show' : '' }}" id="payrollSubmenu">
                <li class="menu-option {{ request()->is('payroll') ? 'active' : '' }}">
                    <a href="{{ route('payroll') }}">Payroll</a>
                </li>
            </ul>

        </li>
        @endif
        
        @hasrole('hr-exec')
        <li class="menu-section {{ request()->is('payroll') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#payrollSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="col-10">
                        Payroll
                    </div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('payroll') ? 'show' : '' }}" id="payrollSubmenu">
                <li class="menu-option {{ request()->is('payroll') ? 'active' : '' }}">
                    <a href="{{ route('payroll') }}">Payroll</a>
                </li>
            </ul>

        </li>
        @endhasrole
        
        <li class="menu-section {{ request()->is('payslip.show') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#payslipSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="col-10">
                        Payslip
                    </div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('payslip.show') ? 'show' : '' }}" id="payslipSubmenu">
                <li class="menu-option {{ request()->is('payslip.show') ? 'active' : '' }}">
                    <a href="{{ route('payslip.show') }}">Download Payslip</a>
                </li>
            </ul>

        </li>
    </ul>
</nav>
