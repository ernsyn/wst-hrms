@extends('layouts.admin-base')
@section('content')
<div class="container pb-5">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.working-days.add.post') }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Template Name*</label>
                        <div class="col-md-12">
                            <input id="template-name" type="text" class="form-control{{ $errors->has('template_name') ? ' is-invalid' : '' }}" placeholder=""
                                name="template_name" value="{{ old('template_name') }}" required>
                            @if ($errors->has('template_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('template_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Monday*</label>
                            <div class="col-md-12">
                                <input id="monday" type="number" min="0" max="1" step="0.5" value="1" class="form-control{{ $errors->has('monday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="monday" value="{{ old('monday') }}" required>
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
                                <input id="tuesday" type="number" min="0" max="1" step="0.5" value="1" class="form-control{{ $errors->has('tuesday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="tuesday" value="{{ old('tuesday') }}" required>
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
                                <input id="wednesday" type="number" min="0" max="1" step="0.5" value="1" class="form-control{{ $errors->has('wednesday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="wednesday" value="{{ old('wednesday') }}" required>
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
                                <input id="thursday" type="number" min="0" max="1" step="0.5" value="1" class="form-control{{ $errors->has('thursday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="thursday" value="{{ old('thursday') }}" required>
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
                                <input id="friday" type="number" min="0" max="1" step="0.5" value="1" class="form-control{{ $errors->has('friday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="friday" value="{{ old('friday') }}" required>
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
                                <input id="saturday" type="number" min="0" max="1" step="0.5" value="0" class="form-control{{ $errors->has('saturday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="saturday" value="{{ old('saturday') }}" required>
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
                                <input id="sunday" type="number" min="0" max="1" step="0.5" value="0" class="form-control{{ $errors->has('sunday') ? ' is-invalid' : '' }}" placeholder=""
                                    name="sunday" value="{{ old('sunday') }}" required>
                                    @if ($errors->has('sunday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sunday') }}</strong>
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
        </form>
    </div>
</div>
@endsection
