@extends('layouts.admin-base')
@section('pageTitle', 'Add Employee')
@section('content')

<div class="p-4">
    <div class="card py-4 shadow-sm">
        <div class="card-body">
            <div class="container-fluid">
                <form method="POST" action="{{ route('admin.employees.add') }}" id="register_employee">
                    @csrf
                    <div class="row">
                        <div class="col-xl-2 d-flex justify-content-center">
                            <i class="fas fa-user-circle fa-10x text-info"></i>
                        </div>
                        <div class="col-xl-8">

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Name</label>
                                <div class="col-md-10">
                                    <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="Name" name="name" value="{{ old('name') }}" required>
                                    @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="email@example.com" name="email" value="{{ old('email') }}"
                                        required> @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-10">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="password" name="password" value="{{ old('password') }}" required>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                                </div>

                            </div>

                            {{-- <div class="form-group row">
                                <label class="col-md-2 col-form-label">Role</label>
                                <div class="col-md-7">
                                    <select class="form-control{{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles"
                                        id="roles">
                                        @foreach($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select> @if ($errors->has('roles'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span> @endif
                                </div>

                            </div> --}}
                        </div>
                    </div>


                    {{--
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
                        featured content or information.
                    </div> --}}

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
