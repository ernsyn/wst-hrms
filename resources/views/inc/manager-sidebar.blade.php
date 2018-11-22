<nav id="sidebar">
    <div id="header-logo" class="sidebar-header text-center">
        <img src="{{asset('img/oppologo.png')}}">
    </div>

            {{-- SECTION: E-Leave --}}
            <li class="menu-section {{ request()->is('manager/e-leave*') ? 'active' : '' }}">
                <a class="info dropdown-toggle" href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false">
                    <div class="row">
                        <div class="col-1"><i class="far fa-calendar-alt"></i></div>
                        <div class="col-10">E-Leave</div>
                    </div>
                </a>
                <ul class="collapse list-unstyled {{ request()->is('manager/e-leave*') ? 'show' : '' }}"
                    id="leaveSubmenu">
                    {{-- OPTION: Leave Request --}}
                    <li class="menu-option {{ request()->is('manager.e-leave') ? 'active' : '' }}">
                        <a href="{{ route('manager.e-leave') }}">Leave Request</a>
                    </li>
                    {{-- OPTION: Leave Application On Behalf --}}
                    {{-- <li class="menu-option {{ request()->is('') ? 'active' : '' }}">
                        <a href="">Leave Application </a>
                    </li> --}}

                </ul>
            </li>
        </ul>
   
</nav>