<nav id="navbar" class="navbar navbar-expand navbar-dark sticky-top">
    <div class="container-fluid w-100">
        <div class="float-left"><a id="btn-toggle-menu" href="#"><span class="fa fa-bars "></span></a></div>
 
        <div class="collapse navbar-collapse">
            <!-- Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- User Info - With Options (Right) -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="default-user-logo-light fas fa-user-circle fa-2x px-3 align-middle"></i>{{ Auth::user()->email }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            {{ __('Profile') }}
                        </a>
                        <a class="dropdown-item" href="">
                            {{ __('Change Password') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
     
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
