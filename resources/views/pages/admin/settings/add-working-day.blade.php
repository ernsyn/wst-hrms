@extends('layouts.admin-base')
@section('content')
<div class="container pb-5">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.working-days.add.post') }}" id="form_validate"
            data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Template Name*</label>
                        <div class="col-md-12">
                            <input id="template-name" type="text" class="form-control{{ $errors->has('template_name') ? ' is-invalid' : '' }}"
                                placeholder="" name="template_name" value="{{ old('template_name') }}" required>
                            @if ($errors->has('template_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('template_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Monday*</label>
                        <div class="col-md-12">
                            <select id="monday" class="form-control{{ $errors->has('monday') ? ' is-invalid' : '' }}"
                                placeholder="" name="monday" required>
                                <option value="0" {{ old('monday') == 0 ? 'selected' : '' }}>0 - Rest Day</option>
                                <option value="0" {{ old('monday') == 0 ? 'selected' : '' }}>0 - Off Day</option>
                                <option value="0.5" {{ old('monday') == 0.5 ? 'selected' : '' }}>0.5 - Half Day</option>
                                <option value="1" {{ old('monday') == 1 ? 'selected' : '' }}>1 - Full Day</option>
                            </select>
                            @if ($errors->has('monday'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('monday') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Tuesday*</label>
                        <div class="col-md-12">
                            <select id="tuesday" class="form-control{{ $errors->has('tuesday') ? ' is-invalid' : '' }}"
                                placeholder="" name="tuesday" required>
                                <option value="0" {{ old('tuesday') == 0 ? 'selected' : '' }}>0 - Rest Day</option>
                                <option value="0" {{ old('tuesday') == 0 ? 'selected' : '' }}>0 - Off Day</option>
                                <option value="0.5" {{ old('tuesday') == 0.5 ? 'selected' : '' }}>0.5 - Half Day</option>
                                <option value="1" {{ old('tuesday') == 1 ? 'selected' : '' }}>1 - Full Day</option>
                            </select>
                            @if ($errors->has('tuesday'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tuesday') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Wednesday*</label>
                        <div class="col-md-12">
                            <select id="wednesday" class="form-control{{ $errors->has('wednesday') ? ' is-invalid' : '' }}"
                                placeholder="" name="wednesday" required>
                                <option value="0" {{ old('wednesday') == 0 ? 'selected' : '' }}>0 - Rest Day</option>
                                <option value="0" {{ old('wednesday') == 0 ? 'selected' : '' }}>0 - Off Day</option>
                                <option value="0.5" {{ old('wednesday') == 0.5 ? 'selected' : '' }}>0.5 - Half Day</option>
                                <option value="1" {{ old('wednesday') == 1 ? 'selected' : '' }}>1 - Full Day</option>
                            </select>
                            @if ($errors->has('wednesday'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('wednesday') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Thursday*</label>
                        <div class="col-md-12">
                            <select id="thursday" class="form-control{{ $errors->has('thursday') ? ' is-invalid' : '' }}"
                                placeholder="" name="thursday" required>
                                <option value="0" {{ old('thursday') == 0 ? 'selected' : '' }}>0 - Rest Day</option>
                                <option value="0" {{ old('thursday') == 0 ? 'selected' : '' }}>0 - Off Day</option>
                                <option value="0.5" {{ old('thursday') == 0.5 ? 'selected' : '' }}>0.5 - Half Day</option>
                                <option value="1" {{ old('thursday') == 1 ? 'selected' : '' }}>1 - Full Day</option>
                            </select>
                            @if ($errors->has('thursday'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('thursday') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Friday*</label>
                        <div class="col-md-12">
                            <select id="friday" class="form-control{{ $errors->has('friday') ? ' is-invalid' : '' }}"
                                placeholder="" name="friday" required>
                                <option value="0" {{ old('friday') == 0 ? 'selected' : '' }}>0 - Rest Day</option>
                                <option value="0" {{ old('friday') == 0 ? 'selected' : '' }}>0 - Off Day</option>
                                <option value="0.5" {{ old('friday') == 0.5 ? 'selected' : '' }}>0.5 - Half Day</option>
                                <option value="1" {{ old('friday') == 1 ? 'selected' : '' }}>1 - Full Day</option>
                            </select>
                            @if ($errors->has('friday'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('friday') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Saturday*</label>
                        <div class="col-md-12">
                            <select id="saturday" class="form-control{{ $errors->has('saturday') ? ' is-invalid' : '' }}"
                                placeholder="" name="saturday" required>
                                <option value="0" {{ old('saturday') == 0 ? 'selected' : '' }}>0 - Rest Day</option>
                                <option value="0" {{ old('saturday') == 0 ? 'selected' : '' }}>0 - Off Day</option>
                                <option value="0.5" {{ old('saturday') == 0.5 ? 'selected' : '' }}>0.5 - Half Day</option>
                                <option value="1" {{ old('saturday') == 1 ? 'selected' : '' }}>1 - Full Day</option>
                            </select>
                            @if ($errors->has('saturday'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('saturday') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Sunday*</label>
                        <div class="col-md-12">
                            <select id="sunday" class="form-control{{ $errors->has('sunday') ? ' is-invalid' : '' }}"
                                placeholder="" name="sunday" required>
                                <option value="0" {{ old('sunday') == 0 ? 'selected' : '' }}>0 - Rest Day</option>
                                <option value="0" {{ old('sunday') == 0 ? 'selected' : '' }}>0 - Off Day</option>
                                <option value="0.5" {{ old('sunday') == 0.5 ? 'selected' : '' }}>0.5 - Half Day</option>
                                <option value="1" {{ old('sunday') == 1 ? 'selected' : '' }}>1 - Full Day</option>
                            </select>
                            @if ($errors->has('sunday'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sunday') }}</strong>
                            </span>
                            @endif
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
@endsection
