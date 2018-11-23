@extends('layouts.admin-base')
@section('content')
{{-- @foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach --}}
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.eis.add.post') }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Salary*</label>
                            <div class="col-md-12">
                                <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" placeholder="" name="salary"
                                    value="{{ old('salary') }}" required>
                                    @if ($errors->has('salary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Employer Contribution*</label>
                            <div class="col-md-12">
                                <input id="employer" type="text" class="form-control{{ $errors->has('employer') ? ' is-invalid' : '' }}" placeholder="" name="employer"
                                    value="{{ old('employer') }}" required>
                                    @if ($errors->has('employer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('employer') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Employee Contribution*</label>
                            <div class="col-md-12">
                                <input id="employee" type="text" class="form-control{{ $errors->has('employee') ? ' is-invalid' : '' }}" placeholder="" name="employee"
                                    value="{{ old('employee') }}" required>
                                    @if ($errors->has('employee'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('employee') }}</strong>
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
</div>
@endsection
