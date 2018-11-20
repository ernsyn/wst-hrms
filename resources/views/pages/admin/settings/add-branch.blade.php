@extends('layouts.admin-base') 
@section('content')
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.branches.add.post') }}" id="form_validate" data-parsley-validate>
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
                                    <input id="contact_no_primary" type="text" class="form-control{{ $errors->has('contact_no_primary') ? ' is-invalid' : '' }}" placeholder="Enter primary contact number"
                                        name="contact_no_primary" value="{{ old('contact_no_primary') }}" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Contact (Secondary)*</label>
                                <div class="col-md-12">
                                    <input id="contact_no_secondary" type="text" class="form-control{{ $errors->has('concontact_no_secondarytact_no_primary') ? ' is-invalid' : '' }}" placeholder="Enter Secondary contact number"
                                        name="contact_no_secondary" value="{{ old('contact_no_secondary') }}" required>
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
                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Address here"
                                        name="address" value="{{ old('address') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">State*</label>
                                <div class="col-md-12">
                                    <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" placeholder="State here"
                                        name="state" value="{{ old('state') }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">City*</label>
                                <div class="col-md-12">
                                    <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="City here"
                                        name="city" value="{{ old('city') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">Zip Code*</label>
                                <div class="col-md-7">
                                    <input id="zip_code" type="text" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" placeholder="Zip Code here"
                                        name="zip_code" value="{{ old('zip_code') }}" required>
                                </div>
                            </div>
                            <div class="col-6">                                
                                <label class="col-md-12 col-form-label">Country Code*</label>
                                <div class="col-md-12">
                                    <input id="country_code" type="text" class="form-control{{ $errors->has('country_code') ? ' is-invalid' : '' }}" placeholder="Code here"
                                        name="country_code" value="{{ old('country_code') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                            </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
@endsection



