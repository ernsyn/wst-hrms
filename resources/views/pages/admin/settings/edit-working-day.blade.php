@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div id="alert-container">
        </div>   
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.working-days.edit.post', ['id' => $working_day->id]) }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Template Name*</label>
                        <div class="col-md-12">
                            <input id="template-name" type="text" class="form-control{{ $errors->has('template_name') ? ' is-invalid' : '' }}" placeholder="template-name here"
                                name="template_name" value="{{ $working_day->template_name }}" required>
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
                                    <option value="full" {{ $working_day->monday == 'full' ? 'selected' : '' }}>Full Day</option>
                                    <option value="half" {{ $working_day->monday == 'half' ? 'selected' : '' }}>Half Day 1</option>
                                    <option value="half_2" {{ $working_day->monday == 'half_2' ? 'selected' : '' }}>Half Day 2</option>
                                    <option value="off" {{ $working_day->monday == 'off' ? 'selected' : '' }}>Off Day</option>
                                    <option value="rest" {{ $working_day->monday == 'rest' ? 'selected' : '' }}>Rest Day</option>
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
                                    <option value="full" {{ $working_day->tuesday == 'full' ? 'selected' : '' }}>Full Day</option>
                                    <option value="half" {{ $working_day->tuesday == 'half' ? 'selected' : '' }}>Half Day 1</option>
                                    <option value="half_2" {{ $working_day->tuesday == 'half_2' ? 'selected' : '' }}>Half Day 2</option>
                                    <option value="off" {{ $working_day->tuesday == 'off' ? 'selected' : '' }}>Off Day</option>
                                    <option value="rest" {{ $working_day->tuesday == 'rest' ? 'selected' : '' }}>Rest Day</option>
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
                                    <option value="full" {{ $working_day->wednesday == 'full' ? 'selected' : '' }}>Full Day</option>
                                    <option value="half" {{ $working_day->wednesday == 'half' ? 'selected' : '' }}>Half Day 1</option>
                                    <option value="half_2" {{ $working_day->wednesday == 'half_2' ? 'selected' : '' }}>Half Day 2</option>
                                    <option value="off" {{ $working_day->wednesday == 'off' ? 'selected' : '' }}>Off Day</option>
                                    <option value="rest" {{ $working_day->wednesday == 'rest' ? 'selected' : '' }}>Rest Day</option>
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
                                    <option value="full" {{ $working_day->thursday == 'full' ? 'selected' : '' }}>Full Day</option>
                                    <option value="half" {{ $working_day->thursday == 'half' ? 'selected' : '' }}>Half Day 1</option>
                                    <option value="half_2" {{ $working_day->thursday == 'half_2' ? 'selected' : '' }}>Half Day 2</option>
                                    <option value="off" {{ $working_day->thursday == 'off' ? 'selected' : '' }}>Off Day</option>
                                    <option value="rest" {{ $working_day->thursday == 'rest' ? 'selected' : '' }}>Rest Day</option>
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
                                    <option value="full" {{ $working_day->friday == 'full' ? 'selected' : '' }}>Full Day</option>
                                    <option value="half" {{ $working_day->friday == 'half' ? 'selected' : '' }}>Half Day 1</option>
                                    <option value="half_2" {{ $working_day->friday == 'half_2' ? 'selected' : '' }}>Half Day 2</option>
                                    <option value="off" {{ $working_day->friday == 'off' ? 'selected' : '' }}>Off Day</option>
                                    <option value="rest" {{ $working_day->friday == 'rest' ? 'selected' : '' }}>Rest Day</option>
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
                                    <option value="full" {{ $working_day->saturday == 'full' ? 'selected' : '' }}>Full Day</option>
                                    <option value="half" {{ $working_day->saturday == 'half' ? 'selected' : '' }}>Half Day 1</option>
                                    <option value="half_2" {{ $working_day->saturday == 'half_2' ? 'selected' : '' }}>Half Day 2</option>
                                    <option value="off" {{ $working_day->saturday == 'off' ? 'selected' : '' }}>Off Day</option>
                                    <option value="rest" {{ $working_day->saturday == 'rest' ? 'selected' : '' }}>Rest Day</option>
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
                                    <option value="full" {{ $working_day->sunday == 'full' ? 'selected' : '' }}>Full Day</option>
                                    <option value="half" {{ $working_day->sunday == 'half' ? 'selected' : '' }}>Half Day 1</option>
                                    <option value="half_2" {{ $working_day->sunday == 'half_2' ? 'selected' : '' }}>Half Day 2</option>
                                    <option value="off" {{ $working_day->sunday == 'off' ? 'selected' : '' }}>Off Day</option>
                                    <option value="rest" {{ $working_day->sunday == 'rest' ? 'selected' : '' }}>Rest Day</option>
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
