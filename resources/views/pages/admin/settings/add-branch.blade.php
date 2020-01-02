@extends('layouts.admin-base')
@section('content')
<div class="main-content">
    <div id="alert-container"></div>   
    <form method="POST" action="{{ route('admin.settings.branches.add.post') }}">
        <div class="card">
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <div class="col-md-12">
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""
                                    name="name" value="{{ old('name') }}" >
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
                                    placeholder="0x-xxxxxxxx" name="contact_no_primary" value="{{ old('contact_no_primary') }}"
                                    >
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
                                <input id="contact_no_secondary" type="text" class="form-control{{ $errors->has('contact_no_secondary') ? ' is-invalid' : '' }}"
                                    placeholder="0x-xxxxxxxx" name="contact_no_secondary" value="{{ old('contact_no_secondary') }}"
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
                                <input id="fax_no" type="text" class="form-control{{ $errors->has('fax_no') ? ' is-invalid' : '' }}" placeholder="0x-xxxxxxxx"
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
                                    >
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
                                    value="{{ old('zip_code') }}" >
                                    @if ($errors->has('zip_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-12 col-form-label">City*</label>
                            <div class="col-md-12">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}"
                                    >
                                    @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="col-md-12 col-form-label">State*</label>
                            <div class="col-md-12">
                                    <select class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" id="state" >
                                        <option value="{{ old('state') }}">{{ old('state') }}</option>
                                        @foreach(MalaysianStates::$all as $state)
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
                    <div class="form-group row w-100">
                    	<div class="col-md-3">
                            <label class="col-md-12 col-form-label">Latitude*</label>
                            <div class="col-md-12">
                                <input id="latitude" type="numeric" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude"
                                    value="{{ old('latitude') }}" >
                                    @if ($errors->has('latitude'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('latitude') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="col-md-12 col-form-label">Longitude*</label>
                            <div class="col-md-12">
                                <input id="longitude" type="numeric" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude"
                                    value="{{ old('longitude') }}" >
                                    @if ($errors->has('longitude'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('longitude') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="col-md-12 col-form-label">Area*</label>
                            <div class="col-md-12">
                                <select class="form-control{{ $errors->has('area_id') ? ' is-invalid' : '' }}" name="area_id" id="area_id">
                                    <option value="{{ old('area_id') }}">{{ old('area->name') }}</option>
                                    @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('area_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('area_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="col-md-12 col-form-label">State Holiday*</label>
                            <div class="col-md-12">
                                <select class="form-control{{ $errors->has('state_holiday') ? ' is-invalid' : '' }}" name="state_holiday" id="state_holiday" >
                                    <option value="{{ old('state_holiday') }}">{{ old('state_holiday') }}</option>
                                    @foreach(MalaysianStates::$all as $state_holiday)
                                    <option value="{{ $state_holiday }}">{{ $state_holiday }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state_holiday'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('state_holiday') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ route('admin.settings.branches') }}">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
