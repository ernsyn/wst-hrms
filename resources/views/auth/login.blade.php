@extends('layouts.app') 
@section('pageTitle', 'Login') 
@section('app-content')
<div id="page-login">
    <div class="d-flex justify-content-center">
        <div id="login-container">
            <header>
                <div id="logo">
                    <img src="{{asset('img/oppologo.png')}}" alt=""> {{--
                    <div id="img-container"> --}} {{-- </div> --}}
                </div>
                <div id="app-title">
                    <h4>HR Management System</h4>
                </div>
            </header>
            <div id="login-card" class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-12 col-form-label">{{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    required autofocus> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    required> @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                      
                            <div class="col-md-4 text-md-right">
                                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <footer>
                <span>{{ __('Copyright © - Oppo HRIS 2018') }}</span>
            </footer>
        </div>
    </div>
    {{--
    <div class="row h-100 bg-white">
        <div class="col-sm-5 col-md-7 p-0">
            <img class="bg-login" src="{{asset('img/bglogin.png')}}" alt="">
        </div>
        <div class="col-sm-7 col-md-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-md-10">
                    <div class="card border-0 text-muted">
                        <div class="card-header bg-white">
                            <div class="row">
                                <div class="col">
                                    <img class="w-100" src="{{asset('img/oppologo.png')}}" alt=""></div>
                                <div class="col">
                                    {{ __('HR SYSTEM') }}
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-sm-12 col-form-label">{{ __('EMAIL') }}</label>

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                            required autofocus> @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span> @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-12 col-form-label">{{ __('PASSWORD') }}</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                            required> @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8">
                                        <a class="btn btn-link px-0" href="{{ route('password.request') }}">{{ __('Forgot Password') }}</a>
                                    </div>
                                    <div class="col-md-4 text-md-right">
                                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer bg-white text-center">
                            <small>{{ __('Copyright © - Oppo HRIS 2018') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection