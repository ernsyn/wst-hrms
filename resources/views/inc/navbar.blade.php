<nav class="navbar navbar-expand navbar-dark navbar-laravel sticky-top">
        <div class="container-fluid mx-3 w-100">
            <a class="navbar-brand d-flex justify-content-start" href="{{ url('/') }}">
              {{ config('app.name') }}
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> @endif
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" v-pre>
                            <i class="fas fa-user-circle fa-2x text-info px-3 align-middle"></i>{{ Auth::user()->email }} 
                              {{-- <span class="caret"></span> --}}
                          </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="">
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="">
                                {{ __('Change Password') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                              </a>
                              {{-- <a class="dropdown-item" href="{{ route('profile') }}" onclick="event.preventDefault();
                                               document.getElementById('profile').submit();">
                                  {{ __('Profile') }}
                              </a> --}}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            {{-- <form id="profile" action="{{ route('profile') }}" method="POST" style="display: none;">
                                @csrf
                            </form> --}}
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>