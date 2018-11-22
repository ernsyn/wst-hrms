@extends('layouts.admin-base')
@section('content') @foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.socso.add.post') }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Salary*</label>
                            <div class="col-md-12">
                                <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" placeholder="" name="salary"
                                    value="{{ old('salary') }}" required>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">First Category Employer*</label>
                            <div class="col-md-12">
                                <input id="first_category_employer" type="text" class="form-control{{ $errors->has('first_category_employer') ? ' is-invalid' : '' }}"
                                    placeholder="" name="first_category_employer" value="{{ old('first_category_employer') }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">First Category Employer**</label>
                            <div class="col-md-12">
                                <input id="first_category_employee" type="text" class="form-control{{ $errors->has('first_category_employee') ? ' is-invalid' : '' }}"
                                    placeholder="" name="first_category_employee" value="{{ old('first_category_employee') }}"
                                    required>
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
