@extends('layouts.admin-base')
@section('content')
<div class="main-content">
    <div id="alert-container"></div>   
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.bank-code.edit.post', ['id' => $bankCode->id]) }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                	<div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Bank Name*</label>
                        <div class="col-md-4">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Bank Name"
                                name="name" value="{{ $bankCode->name }}" required>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">BIC Code*</label>
                        <div class="col-md-4">
                            <input id="bic_code" type="text" class="form-control{{ $errors->has('bic_code') ? ' is-invalid' : '' }}" placeholder="BIC Code"
                                name="bic_code" value="{{ $bankCode->bic_code }}" required>
                            @if ($errors->has('bic_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bic_code') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ route('admin.settings.bank-code') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
