@extends('layouts.admin-base')
@section('content')
<div class="container pb-5">
    <div class="card">
        <form method="POST" action="{{ route('admin.employees.add') }}" id="form_validate">
            <div class="card-body">
                @csrf {{-- Basic --}}
                <div class="row">
                    <div class="col-lg-12 p-3">
                        <h3>Basic Details</h3>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center">
                        <i class="default-user-logo-dark fas fa-user-circle fa-10x"></i>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right text-lg-right">Name*</label>
                            <div class="col-lg-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right">Email*</label>
                            <div class="col-lg-6">
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    required> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right">Password*</label>
                            <div class="col-lg-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    value="{{ old('password') }}" required> @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-lg-right">Confirm Password*</label>
                                <div class="col-lg-6">
                                    <input id="confirm-password" type="password" class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" name="confirm_password"
                                        required data-parsley-equalto="#password"> @if ($errors->has('confirm_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                        <div class="form-group row">

                            <label class="col-lg-3 col-form-label text-lg-right">Contact No*</label>
                            <div class="col-lg-6">
                                <input id="contact_no" type="text" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" name="contact_no"
                                    value="{{ old('contact_no') }}" required> @if ($errors->has('contact_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_no') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-3 col-form-label text-lg-right">Address*</label>
                            <div class="col-lg-6">
                                <textarea id="address" type="Address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }} text-left" name="address"
                                     required>{{ old('address') }}</textarea> @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Personal --}}
                <hr>
                <div class="row">
                    <div class="col-lg-12 p-3">
                        <h3>Personal Details</h3>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">IC No*</label>
                            <div class="col-lg-6">
                                <input id="ic_no" type="text" class="form-control{{ $errors->has('ic_no') ? ' is-invalid' : '' }}" name="ic_no" value="{{ old('ic_no') }}"
                                    required> @if ($errors->has('ic_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ic_no') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Gender*</label>
                            <div class="col-lg-6">
                                <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : ''}}>Female</option>
                                </select> @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Date of Birth*</label>
                            <div class="col-md-6">
                                <input id="dob-date" type="text" class="form-control" placeholder="Date of Birth" aria-label="Date of Birth" aria-describedby="dob-icon"
                                    name="dob" readonly required>
                                <input id="alt-dob-date" type="text" class="form-control" name="dob" hidden> @if ($errors->has('dob'))

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Marital Status*</label>
                            <div class="col-lg-6">
                                <select class="form-control" id="marital_status" name="marital_status" required>
                                    <option value="">Select Marital Status</option>
                                    <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : ''}}>Single</option>
                                    <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : ''}}>Married</option>
                                </select> @if ($errors->has('marital_status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Race*</label>
                            <div class="col-lg-6">
                                <input id="race" type="text" class="form-control{{ $errors->has('race') ? ' is-invalid' : '' }}" name="race" value="{{ old('race') }}"
                                    required> @if ($errors->has('race'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('race') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Nationality</label>
                            <div class="col-lg-6">
                                <select class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" name="nationality" id="nationality">
                                    <option value="">Select Nationality</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->citizenship }}" {{ old('nationality') == $country->citizenship ? 'selected' : ''}}>{{ $country->citizenship }}</option>
                                    @endforeach
                                </select> @if ($errors->has('nationality'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Number of Children</label>
                            <div class="col-lg-6">
                                <input id="total_children" type="text" class="form-control{{ $errors->has('total_children') ? ' is-invalid' : '' }}" name="total_children"
                                    value="{{ old('total_children') }}"> @if ($errors->has('total_children'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('total_children') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Driver License No</label>
                            <div class="col-lg-6">
                                <input id="driver_license_no" type="text" class="form-control{{ $errors->has('driver_license_no') ? ' is-invalid' : '' }}"
                                    name="driver_license_no" value="{{ old('driver_license_no') }}">                                @if ($errors->has('driver_license_no'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('driver_license_no') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">License Expiry Date</label>
                            <div class="col-lg-6">
                                <input id="license-expiry-date" type="text" class="form-control" placeholder="License Expiry Date" aria-label="License Expiry Date"
                                    aria-describedby="license-expiry-date-icon" readonly>
                                <input id="alt-license-expiry-date" type="text" class="form-control" name="driver_license_expiry_date" hidden>
                                @if ($errors->has('driver_license_expiry_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('driver_license_expiry_date') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Company --}}
                <hr>
                <div class="row">
                    <div class="col-lg-12 p-3">
                        <h3>Company Details</h3>
                    </div>
                    <div class="col-lg-12">
                        {{-- <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Employee ID</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Department</label>
                            <div class="col-lg-6">
                                <select class="form-control{{ $errors->has('departments') ? ' is-invalid' : '' }}" name="departments" id="departments">
                                    @foreach(App\Department::all() as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select> @if ($errors->has('departments'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('departments') }}</strong>
                                </span> @endif
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Company*</label>
                            <div class="col-lg-6">
                                <select class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" name="company_id" id="company_id" required>
                                    <option value=""></option>
                                    @foreach(App\Company::all() as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : ''}}>{{ $company->name }}</option>
                                    @endforeach
                                </select> @if ($errors->has('company_id'))
                                <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $errors->first('company_id') }}</strong>
                                                      </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">EPF No*</label>
                            <div class="col-lg-6">
                                <input id="epf_no" type="text" class="form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" name="epf_no" value="{{ old('epf_no') }}"
                                    required>

                            </div>
                        </div>
                        {{-- <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Confirmation Date</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Basic Salary</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" readonly>

                            </div>

                        </div> --}}
                        {{-- <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Position</label>
                            <div class="col-lg-6">
                                <select id="position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="dropdown">
                                    @foreach(App\EmployeePosition::all() as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select> @if ($errors->has('position'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('position') }}</strong>
                                </span> @endif
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Tax No*</label>
                            <div class="col-lg-6">
                                <input id="tax_no" type="text" class="form-control{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" name="tax_no" value="{{ old('tax_no') }}"
                                    required> @if ($errors->has('tax_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tax_no') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">EIS No*</label>
                            <div class="col-lg-6">
                                <input id="eis_no" type="text" class="form-control{{ $errors->has('eis_no') ? ' is-invalid' : '' }}" name="eis_no" value="{{ old('eis_no') }}"
                                    required>
                                @if ($errors->has('eis_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('eis_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">SOCSO No*</label>
                            <div class="col-lg-6">
                                <input id="socso_no" type="text" class="form-control{{ $errors->has('socso_no') ? ' is-invalid' : '' }}" name="socso_no" value="{{ old('socso_no') }}"
                                    required>
                                @if ($errors->has('socso_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('socso_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Joined Date</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Resignation Date</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div> --}}
                    </div>
                </div>

            </div>
            <div class="card-footer text-lg-right">
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
        format: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        onClose: function () {
            $(this).parsley().validate();
        }
    });

    $('#dob-date').datepicker({
        altField: "#alt-dob-date",
        altFormat: 'yy-mm-dd',
        format: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-80:+0",
        onClose: function () {
            $(this).parsley().validate();
        }
    });

</script>
@append
