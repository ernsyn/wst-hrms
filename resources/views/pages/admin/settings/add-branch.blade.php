@extends('layouts.admin-base')
@section('content')
{{-- @foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach --}}
<div class="container">
    <form method="POST" action="{{ route('admin.settings.branches.add.post') }}" id="form_validate">
        <div class="card">
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <div class="col-md-12">
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""
                                    name="name" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <div class="col-md-4">
                            <label class="col-md-12 col-form-label">Contact (Primary)*</label>
                            <div class="col-md-12">
                                <input id="contact_no_primary" type="text" class="form-control{{ $errors->has('contact_no_primary') ? ' is-invalid' : '' }}"
                                    placeholder="" name="contact_no_primary" value="{{ old('contact_no_primary') }}"
                                    required>
                                    @if ($errors->has('contact_no_primary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_no_primary') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-12 col-form-label">Contact (Secondary)</label>
                            <div class="col-md-12">
                                <input id="contact_no_secondary" type="text" class="form-control{{ $errors->has('concontact_no_secondarytact_no_primary') ? ' is-invalid' : '' }}"
                                    placeholder="" name="contact_no_secondary" value="{{ old('contact_no_secondary') }}"
                                    >
                                    @if ($errors->has('contact_no_secondary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_no_secondary') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-12 col-form-label">Contact (Fax)</label>
                            <div class="col-md-12">
                                <input id="fax_no" type="text" class="form-control{{ $errors->has('fax_no') ? ' is-invalid' : '' }}" placeholder=""
                                    name="fax_no" value="{{ old('fax_no') }}" >
                                    @if ($errors->has('fax_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fax_no') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <div class="col-12">
                            <label class="col-md-12 col-form-label">Address Line 1*</label>
                            <div class="col-md-12">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}"
                                    required>
                                    @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <div class="col-12">
                            <label class="col-md-12 col-form-label">Address Line 2</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control{{ $errors->has('address2') ? ' is-invalid' : '' }}" name="address2" value="{{ old('address2') }}">
                                @if ($errors->has('address2'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address2') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <div class="col-12">
                            <label class="col-md-12 col-form-label">Address Line 3</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control{{ $errors->has('address3') ? ' is-invalid' : '' }}" name="address3" value="{{ old('address3') }}">
                                @if ($errors->has('address3'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address3') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <div class="col-md-3">
                            <label class="col-md-12 col-form-label">Zip Code*</label>
                            <div class="col-md-12">
                                <input id="zip_code" type="text" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" name="zip_code"
                                    value="{{ old('zip_code') }}" required>
                                    @if ($errors->has('zip_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="col-md-12 col-form-label">City*</label>
                            <div class="col-md-12">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}"
                                    required>
                                    @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-12 col-form-label">State*</label>
                            <div class="col-md-12">
                                    <select class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" id="state" required>
                                        <option value=""></option>
                                        @foreach(App\Constants\MalaysianStates::$all as $state)
                                        <option value="{{ $state }}">{{ $state }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
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
