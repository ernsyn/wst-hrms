{{ session(['mode' => 'employee']) }}
<nav id="sidebar">
    <div id="header-logo" class="sidebar-header text-center">
        <img src="{{asset('img/logo-oppo-white.png')}}">
    </div>
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
            @hasrole('Super Admin')
            <div class="option row col mx-0">
                <a href="{{ route('super-admin.dashboard') }}">
                    Super Admin
                </a>
            </div>
            @endhasrole
            @canany(AccessControllHelper::adminPermissions())
            <div class="option row col mx-0">
                <a href="{{ route('admin.dashboard') }}">
                    Admin
                </a>
            </div>
            @endcanany
        </div>
    </div>

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
                <li class="menu-option {{ request()->is('employee/assetid') ? 'active' : '' }}">
                    <a href="{{ route('employee.assetid', ['id' => $employee->id]) }}">View Asset</a>
                </li>
                 <li class="menu-option {{ request()->is('employee/index') ? 'active' : '' }}">
                    <a href="{{ route('employee.index') }}">Employee List</a>
                </li>
            </ul>
        </li>
        <li class="menu-section {{ request()->is('employee/e-leave*') ? 'active' : '' }}">
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
            <ul class="collapse list-unstyled {{ request()->is('employee/e-leave*') ? 'show' : '' }}" id="leave-submenu">
                <li class="menu-option {{ request()->is('leave-apply') ? 'active' : '' }}">
                    <a href="{{ route('employee.e-leave.leave-application') }}">Leave Application</a>
                </li>
                <li class="menu-option {{ request()->is('leave-request') ? 'active' : '' }}">
                    <a href="{{ route('employee.e-leave.request') }}">Leave Approval</a>
                </li>

                <li class="menu-option {{ request()->is('leave-history') ? 'active' : '' }}">
                    <a href="{{ route('employee.e-leave.history') }}">Leave Requests</a>
                </li>
            </ul>
        </li>

        <li class="menu-section {{ request()->is('payroll*') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#payrollSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="col-10">
                        Payroll
                    </div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('payroll*') ? 'show' : '' }}" id="payrollSubmenu">
                <li class="menu-option {{ request()->is('payroll') ? 'active' : '' }}">
                    <a href="{{ route('payroll') }}">Payroll</a>
                </li>
            </ul>

        </li>
        
        <li class="menu-section {{ request()->is('payslip.show') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#payslipSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1">
                        <i class="fas fa-file-invoice-dollar"></i>
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
