@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.epf.edit.post', ['id' => $epf->id]) }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="name" value="{{ $epf->name }}" required>
								@if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
 	 	 	 	 	 	 	 	@endif
                                <label class="col-md-12 col-form-label">Category*</label>
                                <input id="category" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="category" value="{{ $epf->category }}" required>
								@if($errors->has('category'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
 	 	 	 	 	 	 	 	@endif

                                <label class="col-md-12 col-form-label">Salary*</label>
                                <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="salary" value="{{ $epf->salary }}" required>
								@if ($errors->has('salary'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('salary') }}</strong>
                                </span>
 	 	 	 	 	 	 	 	@endif

                                <label class="col-md-12 col-form-label">Employer Contribution*</label>
                                <input id="employer" type="text" class="form-control{{ $errors->has('employer') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="employer" value="{{ $epf->employer }}" required>
								@if($errors->has('employer'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('employer') }}</strong>
                                </span>
 	 	 	 	 	 	 	 	@endif
                                <label class="col-md-12 col-form-label">Employee Contribution*</label>
                                <input id="employee" type="text" class="form-control{{ $errors->has('employee') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="employee" value="{{ $epf->employee }}" required>
								@if($errors->has('employee'))
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
@endsection
