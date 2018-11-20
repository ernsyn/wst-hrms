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
                            Super Admin
                        </div>
                        <div class="col-3 px-0 py-0">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
            </div>
        </div>
        <div id="mode-options" class="collapse">
            @hasrole('super-admin|admin')
            <div class="option row col mx-0">
                <a href="{{ route('admin.dashboard') }}">
                    Admin
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
    </ul>
</nav>