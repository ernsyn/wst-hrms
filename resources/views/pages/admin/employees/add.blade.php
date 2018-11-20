@extends('layouts.admin-base') 
@section('content')
<div class="container pb-5">
    <div class="card">
        <form method="POST" action="{{ route('admin.employees.add') }}" id="register_employee">
            <div class="card-body">
                @csrf {{-- Basic --}}
                <div class="row">
                    <div class="col-sm-12 p-3">
                        <h3>Basic Details</h3>
                    </div>
                    <div class="col-sm-4 d-flex justify-content-center">
                        <i class="default-user-logo-dark fas fa-user-circle fa-10x"></i>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label text-right text-right">Name</label>
                            <div class="col-lg-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required> 
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label text-right">Email</label>
                            <div class="col-lg-6">
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    required> 
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-2 col-form-label text-right">Password</label>
                            <div class="col-lg-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    value="{{ old('password') }}" required> 
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-2 col-form-label text-right">Mobile No</label>
                            <div class="col-lg-6">
                                <input id="contact_no" type="text" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" name="contact_no"
                                    value="{{ old('contact_no') }}" required> 
                                @if ($errors->has('contact_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_no') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-2 col-form-label text-right">Address</label>
                            <div class="col-lg-6">
                                <textarea id="address" type="Address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }} text-left" name="address"
                                    value="{{ old('address') }}" required></textarea> 
                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Personal --}}
                <hr>
                <div class="row">
                    <div class="col-sm-12 p-3">
                        <h3>Personal Details</h3>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-right">IC No:</label>
                            <div class="col-lg-6">
                                <input id="ic_no" type="text" class="form-control{{ $errors->has('ic_no') ? ' is-invalid' : '' }}" name="ic_no" value="{{ old('ic_no') }}"
                                    required> 
                                @if ($errors->has('ic_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ic_no') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-right">Gender:</label>
                            <div class="col-lg-6">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Date of Birth:</label>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input id="dob-date" type="text" class="form-control" placeholder="Date of Birth" aria-label="Date of Birth" aria-describedby="dob-icon" name="dob" readonly>
                                    <input id="alt-dob-date" type="text" class="form-control" name="dob" hidden>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="dob-icon"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                                
                                {{-- @if ($errors->has('dob')) --}}
                                <span class="invalid-feedback" role="alert">
                                    {{-- <strong>{{ $errors->first('dob') }}</strong> --}}
                                    <strong>error dob</strong>
                                </span> 
                                {{-- @endif --}}
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Marital Status:</label>
                            <div class="col-md-6">
                                <select class="form-control" id="marital_status" name="marital_status">
                                    <option selected disabled>Select Marital Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                </select>
                                @if ($errors->has('marital_status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-right">Race:</label>
                            <div class="col-lg-6">
                                <input id="race" type="text" class="form-control{{ $errors->has('race') ? ' is-invalid' : '' }}" name="race" value="{{ old('race') }}"
                                    required> 
                                    @if ($errors->has('race'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('race') }}</strong>
                                    </span> 
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">Nationality:</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" name="nationality" id="nationality">
                                    <option selected disabled>Select Nationality</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->citizenship }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('nationality'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Number of Children:</label>
                            <div class="col-md-6">
                                <input id="total_children" type="text" class="form-control{{ $errors->has('total_children') ? ' is-invalid' : '' }}" name="total_children"
                                    value="{{ old('total_children') }}" required>
                                @if ($errors->has('total_children'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('total_children') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-right">Driver License No:</label>
                            <div class="col-lg-6">
                                <input id="driver_license_number" type="text" class="form-control{{ $errors->has('driver_license_number') ? ' is-invalid' : '' }}"
                                    name="driver_license_number" value="{{ old('driver_license_number') }}" required>
                                    @if ($errors->has('driver_license_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_children') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">License Expiry Date:</label>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input id="license-expiry-date" type="text" class="form-control" placeholder="License Expiry Date" aria-label="License Expiry Date" aria-describedby="license-expiry-date-icon" name="driver_license_expiry_date" readonly>
                                    <input id="alt-license-expiry-date" type="text" class="form-control" name="dob" hidden>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="license-expiry-date-icon"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('driver_license_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('total_children') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Company --}}
                <hr>
                <div class="row">
                    <div class="col-sm-12 p-3">
                        <h3>Company Details</h3>
                    </div>
                    <div class="col-lg-12">
                        {{-- <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">Employee ID:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">Department:</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('departments') ? ' is-invalid' : '' }}" name="departments" id="departments">
                                    @foreach(App\Department::all() as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select> 
                                @if ($errors->has('departments'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('departments') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">Company:</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" name="company_id" id="company_id">
                                    @foreach(App\Company::all() as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select> @if ($errors->has('company_id'))
                                <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $errors->first('company_id') }}</strong>
                                                      </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-right">EPF No:</label>
                            <div class="col-lg-6">
                                <input id="epf_no" type="text" class="form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" name="epf_no" value="{{ old('epf_no') }}"
                                    required>

                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-right">Confirmation Date:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-right">Basic Salary:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" readonly>

                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-right">Position:</label>
                            <div class="col-lg-6">
                                <select id="position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="dropdown">
                                    @foreach(App\EmployeePosition::all() as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select> 
                                @if ($errors->has('position'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('position') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">Tax No:</label>
                            <div class="col-md-6">
                                <input id="tax_no" type="text" class="form-control{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" name="tax_no" value="{{ old('tax_no') }}"
                                    required>
                                @if ($errors->has('tax_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tax_no') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-right">Joined Date:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-right">Resignation Date:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts') 
<script>
    $('#license-expiry-date').datepicker({
        altField: "#alt-license-expiry-date",
        altFormat: 'yy-mm-dd',
        format: 'dd/mm/yy'
    });

    $('#dob-date').datepicker({
        altField: "#alt-dob-date",
        altFormat: 'yy-mm-dd',
        format: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-80:+0"
    });
</script>
@append