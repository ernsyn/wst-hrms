@extends('layouts.admin-base')
@section('content')
<div class="main-content">
    <div id="alert-container"></div>   
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.employment-status.edit.post', ['id' => $employmentStatus->id]) }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                	<div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Code*</label>
                        <div class="col-md-4">
                            <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Code"
                                name="code" value="{{ $employmentStatus->code }}" required {{ $employmentStatus->can_delete == 0 ? 'readonly' : '' }}>
                            @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Name*</label>
                        <div class="col-md-4">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name"
                                name="name" value="{{ $employmentStatus->name }}" required>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ route('admin.settings.employment-status') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
