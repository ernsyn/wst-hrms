@extends('layouts.admin-base') 
@section('content')
<div class="container">
    <div class="card">
        <form method="POST" action="{{ route('admin.settings.eis.edit.post', ['id' => $eis->id]) }}" id="form_validate" data-parsley-validate>
            <div class="card-body">
                @csrf
                <div class="row p-3">
                    <div class="form-group row w-100">
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Salary*</label>
                            <div class="col-md-12">
                                <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="salary" value="{{ $eis->salary }}" required>
                                    @if ($errors->has('salary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span> 
                                    @endif                                            
                                    <label class="col-md-12 col-form-label">Employer*</label>
                                            <input id="employer" type="text" class="form-control{{ $errors->has('employer') ? ' is-invalid' : '' }}" placeholder="Name here"
                                            name="employer" value="{{ $eis->employer }}" required>
                                            @if ($errors->has('employer'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('employer') }}</strong>
                                            </span> 
                                            @endif      
                                            
                                            <label class="col-md-12 col-form-label">Employee**</label>
                                            <input id="employee" type="text" class="form-control{{ $errors->has('employee') ? ' is-invalid' : '' }}" placeholder="Name here"
                                            name="employee" value="{{ $eis->employee }}" required>
                                            @if ($errors->has('employee'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('employee') }}</strong>
                                            </span> 
                                            @endif                                                  
            
 

                          
                        </div>

                    </div>

                    {{--
                    <div class="form-group row w-100">
                    </div> --}}
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                            </button>
                <a role="button" class="btn btn-secondary" href="{{ URL::previous() }}">Close</a>
            </div>
        </form>
    </div>
</div>
@endsection