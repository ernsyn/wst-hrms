@extends('layouts.admin-base')
@section('content') @foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="container">
    <form method="POST" action="{{ route('admin.settings.branches.add.post') }}" id="form_validate">
        <div class="card">
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <div class="col-md-12">
                                <label class="col-md-12 col-form-label">Name*</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter name"
                                        name="name" value="{{ old('name') }}" required>
                                </div>
                            </div>

                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Contact (Primary)*</label>
                                <div class="col-md-12">
                                    <input id="contact_no_primary" type="text" class="form-control{{ $errors->has('contact_no_primary') ? ' is-invalid' : '' }}"
                                        placeholder="Enter primary contact number" name="contact_no_primary" value="{{ old('contact_no_primary') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Contact (Secondary)*</label>
                                <div class="col-md-12">
                                    <input id="contact_no_secondary" type="text" class="form-control{{ $errors->has('concontact_no_secondarytact_no_primary') ? ' is-invalid' : '' }}"
                                        placeholder="Enter Secondary contact number" name="contact_no_secondary" value="{{ old('contact_no_secondary') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Contact (Fax)*</label>
                                <div class="col-md-12">
                                    <input id="fax_no" type="text" class="form-control{{ $errors->has('fax_no') ? ' is-invalid' : '' }}" placeholder="Enter Fax number"
                                        name="fax_no" value="{{ old('fax_no') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-12">
                                <label class="col-md-12 col-form-label">Address*</label>
                                <div class="col-md-12">
                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">State*</label>
                                <div class="col-md-12">
                                    <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">City*</label>
                                <div class="col-md-12">
                                    <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">Zip Code*</label>
                                <div class="col-md-7">
                                    <input id="zip_code" type="text" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" name="zip_code"
                                        value="{{ old('zip_code') }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">Country Code*</label>
                                <div class="col-md-12">
                                    <input id="country_code" type="text" class="form-control{{ $errors->has('country_code') ? ' is-invalid' : '' }}" name="country_code"
                                        value="{{ old('country_code') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
