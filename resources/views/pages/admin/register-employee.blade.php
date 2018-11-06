@extends('layouts.app') 
@section('pageTitle', 'Employee Registration') 
@section('content')
<div class="row">
    <nav class="col-6 pr-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-weight-bold" aria-current="page">{{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Fallback Title' }}</li>
        </ol>
    </nav>
    <nav class="col-6 pl-0 justify-end">
        {{ Breadcrumbs::render('employee/add') }}
    </nav>
</div>



<div class="p-4">
    <div class="card py-4 shadow-sm">
        <div class="card-body">
            <div class="container-fluid">
                <form method="POST" action="{{ route('register_employee') }}" id="register_employee">
                    @csrf
                    <div class="row">
                        <div class="col-xl-2 d-flex justify-content-center">
                            <i class="fas fa-user-circle fa-10x text-info"></i>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} form-control-lg font-weight-bold"
                                        placeholder="Name" name="name" value="{{ old('name') }}" required>                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email@example.com"
                                        name="email" value="{{ old('email') }}" required>                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span> @endif
                                </div>
                                <label class="col-md-2 col-form-label">Mobile No</label>
                                <div class="col-md-10">
                                    <input id="contact_no" type="text" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" placeholder="012-34567890"
                                        name="contact_no" value="{{ old('contact_no') }}" required>                                    @if ($errors->has('contact_no'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_no') }}</strong>
                                </span> @endif
                                </div>
                                <label class="col-md-2 col-form-label">Address</label>
                                <div class="col-md-10">
                                    <textarea id="address" type="Address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                                        value="{{ old('address') }}" required>
                                </textarea> @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span> @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Profile --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">IC No:</label>
                                    <div class="col-md-7">
                                        <input id="ic_no" type="text" class="form-control{{ $errors->has('ic_no') ? ' is-invalid' : '' }}" placeholder="9012104332102"
                                            name="ic_no" value="{{ old('ic_no') }}" required>                                        @if ($errors->has('ic_no'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ic_no') }}</strong>
                                            </span> @endif
                                    </div>
                                    <label class="col-md-5 col-form-label">Gender:</label>
                                    <div class="col-md-7">
                                        <select name="gender" id="gender" class="form-control">
                                                {{-- <option {{ $Gender->type == 'Male' ? 'selected':'' }}>Male</option> --}}
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                           </select>
                                    </div>
                                    <label class="col-md-5 col-form-label">Date of Birth:</label>
                                    <div class="col-md-7">
                                        <input name="dobDate" id="dobDate" type="text" class="form-control" readonly>
                                    </div>
                                    <label class="col-md-5 col-form-label">Marital Status:</label>
                                    <div class="col-md-7">
                                        <select class="form-control" id="marital_status" name="marital_status">
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                                <option value="widowed">Widowed</option>
                                                <option value="divorced">Divorced</option>
                                           </select>
                                    </div>
                                    <label class="col-md-5 col-form-label">Race:</label>
                                    <div class="col-md-7">
                                        <input id="race" type="text" class="form-control{{ $errors->has('race') ? ' is-invalid' : '' }}" name="race" value="{{ old('race') }}"
                                            required> @if ($errors->has('race'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('race') }}</strong>
                                            </span> @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Nationality:</label>
                                    <div class="col-md-7">
                                        <select class="form-control{{ $errors->has('countries') ? ' is-invalid' : '' }}" name="countries" id="countries">
                                              @foreach($countries as $item)
                                              <option value="{{ $item->id }}">{{ $item->citizenship }}</option>
                                              @endforeach
                                            </select> @if ($errors->has('countries'))
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('countries') }}</strong>
                                                </span> @endif
                                    </div>
                                    <label class="col-md-5 col-form-label">Number of Child:</label>
                                    <div class="col-md-7">
                                        <input id="total_child" type="text" class="form-control{{ $errors->has('total_child') ? ' is-invalid' : '' }}" placeholder="0"
                                            name="total_child" value="{{ old('total_child') }}" required>
                                    </div>
                                    <label class="col-md-5 col-form-label">Driver License No:</label>
                                    <div class="col-md-7">
                                        <input id="driver_license_number" type="text" class="form-control{{ $errors->has('driver_license_number') ? ' is-invalid' : '' }}"
                                            placeholder="3213213555" name="driver_license_number" value="{{ old('driver_license_number') }}"
                                            required>
                                    </div>
                                    <label class="col-md-5 col-form-label">License Expiry Date:</label>
                                    <div class="col-md-7">
                                        <input name="licenseExpiryDate" id="licenseExpiryDate" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Company --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Roles:</label>
                                <div class="col-md-7">
                                    <select class="form-control{{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles" id="roles">
                                                @foreach($roles as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                              </select> @if ($errors->has('roles'))
                                    <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('roles') }}</strong>
                                                  </span> @endif
                                </div>
                                <label class="col-md-5 col-form-label">EPF No:</label>
                                <div class="col-md-7">
                                    <input id="epf_no" type="text" class="form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" placeholder="012-34567890"
                                        name="epf_no" value="{{ old('epf_no') }}" required>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Tax No:</label>
                                <div class="col-md-7">
                                    <input id="tax_no" type="text" class="form-control{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" placeholder="123123"
                                        name="tax_no" value="{{ old('tax_no') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.
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