{{ session(['mode' => 'admin']) }}
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
                        Admin
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
            @canany(AccessControllHelper::employeePermissions())
            <div class="option row col mx-0">
                <a href="{{ route('employee.dashboard') }}">
                    Employee
                </a>
            </div>
            @endcanany
        </div>
	</div>
	
    <ul id="menu-container" class="list-unstyled">
    	@can(PermissionConstant::VIEW_ADMIN_DASHBOARD)
        <li id="dashboard-option" class="menu-section {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a class="info" href="{{ route('admin.dashboard') }}">
                <div class="row">
                    <div class="col-1"><i class="fas fa-grip-horizontal"></i></div>
                    <div class="col-10">Dashboard</div>
                </div>
            </a>
        </li>
        @endcan
        
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
                 {{-- OPTION: Employee Asset --}}
                <li class="menu-option {{ request()->is('admin/employees/test') ? 'active' : '' }}">
                    <a href="{{ route('admin.employees.test') }}">Employee Asset</a>
                </li>
            </ul>
        </li>
    
        {{-- SECTION: Payroll --}}
        <li class="menu-section {{ request()->is('payroll*','government_report', 'payroll-report') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#payrollSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1"><i class="fas fa-dollar-sign"></i></div>
                    <div class="col-10">Payroll</div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('payroll*','government_report', 'payroll-report') ? 'show' : '' }}" id="payrollSubmenu">
                <li class="menu-option {{ request()->is('payroll') ? 'active' : '' }}">
                    <a href="{{ route('payroll') }}">Payroll</a>
                </li>
                <li class="menu-option {{ request()->is('government_report') ? 'active' : '' }}">
                    <a href="{{ route('payroll/government_report') }}">Government Reports</a>
                </li>
                <li class="menu-option {{ request()->is('payroll-report') ? 'active' : '' }}">
                    <a href="{{ route('payroll.report.show') }}">Reports</a>
                </li>
                <li class="menu-option {{ request()->is('payroll-setup') ? 'active' : '' }}">
                    <a href="{{ route('payroll-setup.index') }}">Payroll Setup</a>
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
                <li class="menu-option {{ request()->is('admin/e-leave/configuration/leave-report') ? 'active' : '' }}">
                <a href="{{ route('admin.e-leave.leave-report') }}">Leave Report</a>
                </li>
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
                <li class="menu-option {{ request()->is('admin.attendance') ? 'active' : '' }}">
                	<a href="{{ route('admin.attendance.current-day') }}">Current Day</a>
                </li>
                {{-- OPTION: Attendance Report --}}
                <li class="menu-option {{ request()->is('admin.attendance') ? 'active' : '' }}">
                	<a href="{{ route('admin.attendance.report') }}">Attendance Report</a>
                </li>
            </ul>
        </li>

        {{-- SECTION: Settings --}}
        <li class="menu-section {{ request()->is('admin/audit') ? 'active' : '' }}">
            <a class="info dropdown-toggle" href="#setupSubmenu" data-toggle="collapse" aria-expanded="false">
                <div class="row">
                    <div class="col-1"><i class="fas fa-cog"></i></div>
                    <div class="col-10">Settings</div>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ request()->is('admin/settings*') ? 'show' : '' }}" id="setupSubmenu">
                {{-- Companies --}}
                @canany([PermissionConstant::VIEW_COMPANY, PermissionConstant::ADD_COMPANY, PermissionConstant::UPDATE_COMPANY, PermissionConstant::DELETE_COMPANY, 
                	PermissionConstant::VIEW_COMPANY_BANK, PermissionConstant::ADD_COMPANY_BANK, PermissionConstant::UPDATE_COMPANY_BANK, PermissionConstant::DELETE_COMPANY_BANK, 
                	PermissionConstant::VIEW_JOB_COMPANY, PermissionConstant::ADD_JOB_COMPANY, PermissionConstant::UPDATE_JOB_COMPANY, PermissionConstant::DELETE_JOB_COMPANY])
                <li class="menu-option {{ request()->is('admin/settings/companies') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.companies')}}">Companies</a>
                </li>
                @endcan
                
                {{-- Security Group --}}
                @canany([PermissionConstant::VIEW_SECURITY_GROUP, PermissionConstant::ADD_SECURITY_GROUP, PermissionConstant::UPDATE_SECURITY_GROUP, PermissionConstant::DELETE_SECURITY_GROUP])
                <li class="menu-option {{ request()->is('admin/settings/security-group') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.security-group')}}">Security Group</a>
                </li>
                @endcan
                
                {{-- OPTION: Cost Centres --}}
                <li class="menu-option {{ request()->is('admin/settings/cost-centres') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.cost-centres')}}">Cost Centres</a>
                </li>
                
                {{-- Departments --}}
                @canany([PermissionConstant::VIEW_DEPARTMENT, PermissionConstant::ADD_DEPARTMENT, PermissionConstant::UPDATE_DEPARTMENT, PermissionConstant::DELETE_DEPARTMENT])
                <li class="menu-option {{ request()->is('admin/settings/departments') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.departments')}}">Departments</a>
                </li>
                @endcan
                
                {{-- OPTION: Branches --}}
                @canany([PermissionConstant::VIEW_BRANCH, PermissionConstant::ADD_BRANCH, PermissionConstant::UPDATE_BRANCH, PermissionConstant::DELETE_BRANCH])
                <li class="menu-option {{ request()->is('admin/settings/branches') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.branches')}}">Branch</a>
                </li>
                @endcan
                
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
                
                {{-- Sections --}}
                @canany([PermissionConstant::VIEW_SECTION, PermissionConstant::ADD_SECTION, PermissionConstant::UPDATE_SECTION, PermissionConstant::DELETE_SECTION])
                <li class="menu-option {{ request()->is('admin/settings/sections') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.sections')}}">Sections</a>
                </li>
                @endcan
                
                {{-- Category --}}
                @canany([PermissionConstant::VIEW_CATEGORY, PermissionConstant::ADD_CATEGORY, PermissionConstant::UPDATE_CATEGORY, PermissionConstant::DELETE_CATEGORY])
                <li class="menu-option {{ request()->is('admin/settings/categories') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.categories')}}">Category</a>
                </li>
                @endcan
                
                {{-- Area --}}
                @canany([PermissionConstant::VIEW_AREA, PermissionConstant::ADD_AREA, PermissionConstant::UPDATE_AREA, PermissionConstant::DELETE_AREA])
                <li class="menu-option {{ request()->is('admin/settings/areas') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.areas')}}">Area</a>
                </li>
                @endcan
                
                {{-- Bank Code --}}
                @canany([PermissionConstant::VIEW_BANK_CODE, PermissionConstant::ADD_BANK_CODE, PermissionConstant::UPDATE_BANK_CODE, PermissionConstant::DELETE_BANK_CODE])
                <li class="menu-option {{ request()->is('admin/settings/bank-code') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.bank-code')}}">Bank Code</a>
                </li>
                @endcan
                
                {{-- Employment Status --}}
                @canany([PermissionConstant::VIEW_EMPLOYMENT_STATUS, PermissionConstant::ADD_EMPLOYMENT_STATUS, PermissionConstant::UPDATE_EMPLOYMENT_STATUS, PermissionConstant::DELETE_EMPLOYMENT_STATUS])
                <li class="menu-option {{ request()->is('admin/settings/employment-status') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.employment-status')}}">Employment Status</a>
                </li>
                @endcan
                
                {{-- Company Asset --}}
                @canany([PermissionConstant::VIEW_COMPANY_ASSET, PermissionConstant::ADD_COMPANY_ASSET, PermissionConstant::UPDATE_COMPANY_ASSET, PermissionConstant::DELETE_COMPANY_ASSET])
                <li class="menu-option {{ request()->is('admin/settings/company-asset') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.company-asset')}}">Company Asset</a>
                </li>
                @endcan
                
                {{-- OPTION: Working Days --}}
                <li class="menu-option {{ request()->is('admin/settings/working-days') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.working-days')}}">Working Days</a>
                </li>
                
                {{-- OPTION: EPF --}}
                @canany([PermissionConstant::VIEW_EPF, PermissionConstant::ADD_EPF, PermissionConstant::UPDATE_EPF, PermissionConstant::DELETE_EPF])
                <li class="menu-option {{ request()->is('admin/settings/epf') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.epf')}}">EPF</a>
                </li>
                @endcan
                
                {{-- OPTION: Eis --}}
                @canany([PermissionConstant::VIEW_EIS, PermissionConstant::ADD_EIS, PermissionConstant::UPDATE_EIS, PermissionConstant::DELETE_EIS])
                <li class="menu-option {{ request()->is('admin/settings/eis') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.eis')}}">EIS</a>
                </li>
                @endcan
                
                {{-- OPTION: Socso --}}
                @canany([PermissionConstant::VIEW_SOCSO, PermissionConstant::ADD_SOCSO, PermissionConstant::UPDATE_SOCSO, PermissionConstant::DELETE_SOCSO])
                <li class="menu-option {{ request()->is('admin/settings/socso') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.socso')}}">Socso</a>
                </li>
                @endcan
                
                {{-- OPTION: PCB --}}
                @canany([PermissionConstant::VIEW_PCB, PermissionConstant::ADD_PCB, PermissionConstant::UPDATE_PCB, PermissionConstant::DELETE_PCB])
                <li class="menu-option {{ request()->is('admin/settings/pcb') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.pcb')}}">PCB</a>
                </li>
                @endcan
            </ul>
        </li>
			       
        {{-- SECTION: Roles and Permissions --}}
        @canany([PermissionConstant::VIEW_ROLE_AND_PERMISSION, PermissionConstant::ADD_ROLE, PermissionConstant::UPDATE_ROLE, PermissionConstant::DELETE_ROLE, PermissionConstant::DUPLICATE_ROLE])
        <li class="menu-section {{ request()->is('admin/role-permission*') ? 'active' : '' }}">
            <a class="info" href="{{ route('admin.role-permission') }}">
                <div class="row">
                    <div class="col-1"><i class="fas fa-user-shield"></i></div>
                    <div class="col-10">Roles & Permissions</div>
                </div>
            </a>
        </li>
        @endcanany
        
        {{-- SECTION: Audit Trail --}}
        @can(PermissionConstant::VIEW_AUDIT_TRAIL)
        <li class="menu-section {{ request()->is('admin/audit-trail*') ? 'active' : '' }}">
            <a class="info" href="{{ route('admin.audit-trail') }}">
                <div class="row">
                    <div class="col-1"><i class="fa fa-history"></i></div>
                    <div class="col-10">Audit Trail</div>
                </div>
            </a>
        </li>
        @endcan
	</ul>
</nav>
