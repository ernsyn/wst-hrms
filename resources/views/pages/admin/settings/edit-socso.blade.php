@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.socso.edit.post', ['id' => $socso->id]) }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                	<div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Category*</label>
                        <div class="col-md-4">
                        	<select class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }} " id="category" name="category" required> 
								<option value="">Please Select</option>
								@foreach ($category as $k=>$v )
									@if (old('category') == $k)
										<option value="{{ $k }}" selected>{{ $v }}</option>
									@elseif ($socso->category == $k)
										<option value="{{ $k }}" selected>{{ $v }}</option>
									@else
										<option value="{{ $k }}">{{ $v }}</option>
									@endif
								@endforeach
							</select>
							@if ($errors->has('category'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Salary*</label>
                        <div class="col-md-4">
                            <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" placeholder="0.00" name="salary" value="{{ $socso->salary }}" required>
                            @if ($errors->has('salary'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('salary') }}</strong>
                            </span>
							@endif
						</div>
                    </div>
                    <div class="form-group row w-100">
                        <label class="col-md-12 col-form-label">Employer Contribution*</label>
                        <div class="col-md-4">
                            <input id="employer" type="text" class="form-control{{ $errors->has('employer') ? ' is-invalid' : '' }}" placeholder="0.00" name="employer" value="{{ $socso->employer }}" required>
                            @if ($errors->has('employer'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('employer') }}</strong>
                            </span>
							@endif
						</div>
                    </div>
                    <div class="form-group row w-100">
                    	<div class="col-md-4">
                            <label class="col-md-12 col-form-label">Employee Contribution*</label>
                            <input id="employee" type="text" class="form-control{{ $errors->has('employee') ? ' is-invalid' : '' }}"
                                placeholder="0.00" name="employee" value="{{ $socso->employee }}" required>
                            @if ($errors->has('employee'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('employee') }}</strong>
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
