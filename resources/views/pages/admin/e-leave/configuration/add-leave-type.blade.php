@extends('layouts.admin-base') 
@section('content')
<div class="container">
        <div class="card">
                <form method="POST" action="{{ route('admin.settings.working-days.add.post') }}" id="form_validate" data-parsley-validate>
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="code"><strong>Code*</strong></label>
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="eg. ANNUAL"
                                    name="code" value="{{ old('code') }}" required>
                                @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-9">
                                <label for="name"><strong>Name*</strong></label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="eg. Annual Leave"
                                    name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <strong>Rules</strong>
                                <a role="button" id="add-leave-type-btn" class="float-right btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <strong>Entitled Days</strong>
                                <button class="btn btn-primary btn-sm float-right dropdown-toggle" type="button" id="entitled-mode-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span id="selected-text">All Employees</span>
                                    <span class="ml-2"><i class="fas fa-caret-down"></i></span>
                                    <input type="text" hidden id="entitled-mode" name="entitled-mode" value="entitled-mode-all">
                                </button>
                                <div id="entitled-mode-options" class="dropdown-menu" aria-labelledby="entitled-mode-dropdown">
                                    <button id="entitled-mode-all" class="dropdown-item" type="button">All Employees</button>
                                    <button id="entitled-mode-by-grade" class="dropdown-item" type="button">By Employee Grade</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="section-employee-mode-all" class="row">
                                    All
                                </div>
                                <div id="section-employee-mode-by-grade" hidden class="row">
                                    By Grade
                                </div>
                            </div>
                        </div>
                       {{--  <div class="row p-3">
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
                        </div>--}}
                    </div> 
                    
                    <div class="card-footer">
                        <button id="submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        <a role="button" class="btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
                    </div>
                </form>
            </div>
</div>
@endsection
 
@section('scripts') 
<script>
    $(function() {
        $("#entitled-mode-options button").click(function (e) {
            $('#entitled-mode-dropdown #selected-text').html(e.target.innerText);
            $('#entitled-mode-dropdown').dropdown('toggle');
            $('input[name="entitled-mode"]').attr('value', e.target.id);
            switch(e.target.id) {
                case 'entitled-mode-all':
                    $('#section-employee-mode-all').removeAttr('hidden');
                    $('#section-employee-mode-by-grade').attr('hidden', true);
                break;
                case 'entitled-mode-by-grade':
                    $('#section-employee-mode-all').attr('hidden', true);
                    $('#section-employee-mode-by-grade').removeAttr('hidden');
                break;
            }



            return false;
        });
    })
</script>
@append