@extends('layouts.app')
@section('content')
<div class="p-4">
    <div class="card py-4 shadow-sm">
        <div class="card-body">
            <div class="container-fluid">
                <form method="POST" action="{{ route('admin.settings.company.add.post') }}" id="form_validate"  data-parsley-validate>
                    @csrf
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Code*</label>
                                <div class="col-md-10">
                                    <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" required>                                     
                                </div>
                                <label class="col-md-2 col-form-label">Name*</label>
                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>                                     
                                </div>
                                <label class="col-md-2 col-form-label">Full URL*</label>
                                <div class="col-md-10">
                                    <input id="url" type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}"
                                        name="url" value="{{ old('url') }}" required>                                  
                                </div>
                                <label class="col-md-2 col-form-label">Registration Number*</label>
                                <div class="col-md-10">
                                    <input id="registration_number" type="text" class="form-control{{ $errors->has('registration_number') ? ' is-invalid' : '' }}"
                                        name="registration_number" value="{{ old('registration_number') }}" required>
                                </div>
                                <label class="col-md-2 col-form-label">Description*</label>
                                <div class="col-md-10">
                                    <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"
                                        value="{{ old('description') }}" required>
                                    </textarea> 
                                </div>
                                <label class="col-md-2 col-form-label">Address*</label>
                                <div class="col-md-10">
                                    <textarea id="address" type="Address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                                        value="{{ old('address') }}" required>
                                    </textarea>
                                <label class="col-md-2 col-form-label">Phone No*</label>
                                <div class="col-md-10">
                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        name="phone" value="{{ old('phone') }}" required>
                                </div>
                                <label class="col-md-2 col-form-label">TAX Number*</label>
                                <div class="col-md-10">
                                    <input id="tax_number" type="text" class="form-control{{ $errors->has('tax_number') ? ' is-invalid' : '' }}" 
                                        name="tax_number" value="{{ old('tax_number') }}" required>
                                </div>
                                <label class="col-md-2 col-form-label">EPF Number*</label>
                                <div class="col-md-10">
                                    <input id="epf_number" type="text" class="form-control{{ $errors->has('epf_number') ? ' is-invalid' : '' }}"
                                        name="epf_number" value="{{ old('epf_number') }}" required>
                                </div>
                                <label class="col-md-2 col-form-label">SOCSO Number*</label>
                                <div class="col-md-10">
                                    <input id="socso_number" type="text" class="form-control{{ $errors->has('socso_number') ? ' is-invalid' : '' }}"
                                        name="socso_number" value="{{ old('socso_number') }}" required>
                                </div>
                                <label class="col-md-2 col-form-label">EIS Number*</label>
                                <div class="col-md-10">
                                    <input id="eis_number" type="text" class="form-control{{ $errors->has('eis_number') ? ' is-invalid' : '' }}"
                                        name="eis_number" value="{{ old('eis_number') }}" required>
                                </div>
                                <label class="col-md-2 col-form-label">Status</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="status" name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
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