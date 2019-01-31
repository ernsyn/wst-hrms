@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div id="alert-container">
        </div>   
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.socso.edit.post', ['id' => $socso->id]) }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <div class="col-4">
                            <div class="col-md-12">
                                <label class="col-md-12 col-form-label">Salary*</label>
                                <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="salary" value="{{ $socso->salary }}" required>
                                @if ($errors->has('salary'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('salary') }}</strong>
                                </span>
								@endif
                                <label class="col-md-12 col-form-label">First Category Employer*</label>
                                <input id="first_category_employer" type="text" class="form-control{{ $errors->has('first_category_employer') ? ' is-invalid' : '' }}"
                                    placeholder="Name here" name="first_category_employer" value="{{ $socso->first_category_employer }}"
                                    required>
                                @if ($errors->has('first_category_employer'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_category_employer') }}</strong>
                                </span>
								@endif

                                <label class="col-md-12 col-form-label">First Category Employee*</label>
                                <input id="first_category_employee" type="text" class="form-control{{ $errors->has('first_category_employee') ? ' is-invalid' : '' }}"
                                    placeholder="Name here" name="first_category_employee" value="{{ $socso->first_category_employee }}"
                                    required>
                                @if ($errors->has('first_category_employee'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_category_employee') }}</strong>
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
