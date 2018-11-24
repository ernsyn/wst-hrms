@extends('layouts.admin-base')
@section('content')
{{-- @foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach --}}
<div class="container pb-5">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.branches.edit.post', ['id' => $branch->id])  }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <div class="col-md-12">
                                <label class="col-md-12 col-form-label">Name*</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                        name="name" value="{{ $branch->name }}" required>                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Contact (Primary)*</label>
                                <div class="col-md-12">
                                    <input id="contact_no_primary" type="text" class="form-control{{ $errors->has('contact_no_primary') ? ' is-invalid' : '' }}"
                                        placeholder="Contact No here" name="contact_no_primary" value="{{ $branch->contact_no_primary }}"
                                        required> @if ($errors->has('contact_no_primary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_no_primary') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Contact (Secondary)*</label>
                                <div class="col-md-12">
                                    <input id="contact_no_secondary" type="text" class="form-control{{ $errors->has('contact_no_secondary') ? ' is-invalid' : '' }}"
                                        name="contact_no_secondary" value="{{ $branch->contact_no_secondary }}" required>                                    @if ($errors->has('contact_no_secondary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_no_secondary') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Contact (Fax)*</label>
                                <div class="col-md-12">
                                    <input id="fax_no" type="text" class="form-control{{ $errors->has('fax_no') ? ' is-invalid' : '' }}" name="fax_no" value="{{ $branch->fax_no }}"
                                        required> @if ($errors->has('fax_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fax_no') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-12">
                                <label class="col-md-12 col-form-label">Address*</label>
                                <div class="col-md-12">
                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $branch->address }}"
                                        required> @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span> @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">State*</label>
                                <div class="col-md-12">
                                    <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ $branch->state }}"
                                        required> @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span> @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">City*</label>
                                <div class="col-md-12">
                                    <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $branch->city }}"
                                        required> @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span> @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">Zip Code*</label>
                                <div class="col-md-7">
                                    <input id="zip_code" type="text" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" name="zip_code"
                                        value="{{ $branch->city }}" required> @if ($errors->has('zip_code'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('zip_code') }}</strong>
                                        </span> @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">Country Code*</label>
                                <div class="col-md-7">
                                    <input id="country_code" type="text" class="form-control{{ $errors->has('country_code') ? ' is-invalid' : '' }}" name="country_code"
                                        value="{{ $branch->country_code }}" required> @if ($errors->has('country_code'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country_code') }}</strong>
                                        </span> @endif
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
        </form>
    </div>
</div>
</div>
@endsection
