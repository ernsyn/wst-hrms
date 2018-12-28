@extends('layouts.admin-base')
@section('content')
<div class="container pb-5">
    <div class="card">
        <form method="POST" action="{{ route('admin.employees.add') }}" id="add-profile-form">
            <div class="card-body">
                @csrf {{-- Basic --}}
                <div class="row">
                    <div class="col-lg-12 p-3">
                        <h3>Basic Details</h3>
                    </div>
                    <div class="col-sm-4 d-flex justify-content-center">
                        <div class="form-group row d-flex justify-content-center">
                            <i class="default-user-logo-dark fas fa-user-circle fa-10x"></i>
                            <img src="" id="profile-img-tag" class="img-thumbnail rounded-circle" style="position: absolute; object-fit:cover; display:none; width:150px; height:150px">
                            <div class="col-lg-12 text-center">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="attachment" class="custom-file-input{{ $errors->has('attach') ? ' is-invalid' : '' }}" id="profile-img">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control{{ $errors->has('attach') ? ' is-invalid' : '' }}" id="attach" name="attach" value="{{ old('attach') }}">

                                @if ($errors->has('attach'))
                                <span id="picture-error" class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('attach') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right text-lg-right">Name*</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">
								@if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right">Email*</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
								@if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right">Password*</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-lg-right">Confirm Password*</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" name="confirm_password" data-parsley-equalto="#password">
								@if ($errors->has('confirm_password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-3 col-form-label text-lg-right">Contact No*</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" name="contact_no" value="{{ old('contact_no') }}">
                                @if ($errors->has('contact_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_no') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-3 col-form-label text-lg-right">Address Line 1*</label>
                            <div class="col-lg-7 mb-2">
                                <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}">
								@if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span> @endif
                            </div>
                            <label class="col-lg-3 col-form-label text-lg-right">Address Line 2</label>
                            <div class="col-lg-7 mb-2">
                                <input type="text" class="form-control{{ $errors->has('address2') ? ' is-invalid' : '' }}" name="address2" value="{{ old('address2') }}">
                                @if ($errors->has('address2'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address2') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-lg-3 col-form-label text-lg-right">Address Line 3</label>
                            <div class="col-lg-7 mb-2">
                                <input type="text" class="form-control{{ $errors->has('address3') ? ' is-invalid' : '' }}" name="address3" value="{{ old('address3') }}">
                                @if ($errors->has('address3'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address3') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-lg-3 col-form-label text-lg-right">Postcode*</label>
                            <div class="col-lg-7 mb-2">
                                <input type="text" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}" name="postcode" value="{{ old('postcode') }}">
                                @if ($errors->has('postcode'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('postcode') }}</strong>
                                </span>
                                @endif
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
                            <label class="col-lg-4 col-form-label text-lg-right">ID No*</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}">
								@if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">IC No*</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('ic_no') ? ' is-invalid' : '' }}" name="ic_no" value="{{ old('ic_no') }}">
								@if ($errors->has('ic_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ic_no') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Gender*</label>
                            <div class="col-lg-6">
                                <select name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : ''}}>Female</option>
                                </select>
                                @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Date of Birth*</label>
                            <div class="col-md-6">
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" id="dob-date" name="dob" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" data-target="#dob-date"
                                    value="{{ old('dob') }}">
                                    <div class="input-group-append" data-target="#dob-date" data-toggle="datetimepicker">
                                        <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                    @if ($errors->has('dob'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Marital Status*</label>
                            <div class="col-lg-6">
                                <select class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}" name="marital_status">
                                    <option value="">Select Marital Status</option>
                                    <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : ''}}>Single</option>
                                    <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : ''}}>Married</option>
                                </select>
                                @if ($errors->has('marital_status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Race*</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('race') ? ' is-invalid' : '' }}" name="race" value="{{ old('race') }}">
								@if ($errors->has('race'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('race') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Nationality*</label>
                            <div class="col-lg-6">
                                <select class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" name="nationality">
                                    <option value="">Select Nationality</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('nationality') == $country->id ? 'selected' : ''}}>{{ $country->citizenship }}</option>
                                    @endforeach
                                </select> @if ($errors->has('nationality'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">PCB Group*</label>
                            <div class="col-lg-6">
                                <select class="form-control{{ $errors->has('pcb_group') ? ' is-invalid' : '' }}" name="pcb_group">
                                    <option value="">Select PCB Group</option>
                                    <option value="1" {{ old('pcb_group') == 1 ? 'selected' : ''}}>Single Person</option>
                                    <option value="2" {{ old('pcb_group') == 2 ? 'selected' : ''}}>Spouse not working</option>
                                    <option value="3" {{ old('pcb_group') == 3 ? 'selected' : ''}}>Spouse working</option>
                                </select>
                                @if ($errors->has('pcb_group'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pcb_group') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Number of Children*</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('total_children') ? ' is-invalid' : '' }}" name="total_children"
                                    value="{{ old('total_children') }}">
                                @if ($errors->has('total_children'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('total_children') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Driver License No</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('driver_license_no') ? ' is-invalid' : '' }}"
                                    name="driver_license_no" value="{{ old('driver_license_no') }}">
								@if ($errors->has('driver_license_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('driver_license_no') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">License Expiry Date</label>
                            <div class="col-lg-6">
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" id="license-expiry-date" name="driver_license_expiry_date" class="form-control{{ $errors->has('driver_license_expiry_date') ? ' is-invalid' : '' }}" data-target="#license-expiry-date"
                                    value="{{ old('driver_license_expiry_date') }}">
                                    <div class="input-group-append" data-target="#license-expiry-date" data-toggle="datetimepicker">
                                        <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                    @if ($errors->has('driver_license_expiry_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('driver_license_expiry_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
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
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Company*</label>
                            <div class="col-lg-6">
                                <select class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" name="company_id" id="company_id">
                                    <option value=""></option>
                                    @foreach(App\Company::all() as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : ''}}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('company_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company_id') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">EPF No*</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" name="epf_no" value="{{ old('epf_no') }}">
								@if ($errors->has('epf_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('epf_no') }}</strong>
                                </span>
								@endif

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Tax No*</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" name="tax_no" value="{{ old('tax_no') }}">
								@if ($errors->has('tax_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tax_no') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">EIS No*</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control{{ $errors->has('eis_no') ? ' is-invalid' : '' }}" name="eis_no" value="{{ old('eis_no') }}">
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
                                <input type="text" class="form-control{{ $errors->has('socso_no') ? ' is-invalid' : '' }}" name="socso_no" value="{{ old('socso_no') }}">
                                @if ($errors->has('socso_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('socso_no') }}</strong>
                                </span>
								@endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Main Security Group*</label>
                            <div class="col-lg-6">
                                <select class="form-control{{ $errors->has('main_security_group_id') ? ' is-invalid' : '' }}" name="main_security_group_id" id="main_security_group_id">
                                    <option value=""></option>
                                    @foreach(App\SecurityGroup::all() as $main_security_group)
                                    <option value="{{ $main_security_group->id }}">{{ $main_security_group->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('main_security_group_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('main_security_group_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
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
    $('#dob-date').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#license-expiry-date').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    function readURL(input, onLoad) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            console.log("input files size",input.files[0].size);
            if(input.files[0].size<=2000000) {
                reader.onload = function(e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                    reader.result;
                    $('#attach').val(reader.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#add-profile-form input[name=attach]').addClass('is-invalid');
                $('#add-profile-form #picture-error').html('<strong>The file size may not be greater than 2MB.</strong>');
            }
        }
    }

    $("#profile-img").change(function() {
        readURL(this);
        $('#profile-img-tag').show();
    });

</script>
@append
