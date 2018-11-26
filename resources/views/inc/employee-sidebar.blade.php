<nav id="sidebar">
    <div id="header-logo" class="sidebar-header text-center">
        <img src="{{asset('img/oppologo.png')}}">
    </div>
    <ul id="menu-container" class="list-unstyled">
    </ul>
    {{-- <li class="menu-section {{ request()->is('employee/leaveapplication') ? 'active' : '' }}">
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
                <a href="{{ route('employee.leaveapplication') }}">Leave Request History</a>
            </li>
        </ul>

    </li> --}}
</nav>