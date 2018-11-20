@extends('layouts.admin-base') 
@section('content')
<div class="container">
    <div class="card">

                <form method="POST" action="{{ route('payroll.store') }}" id="add_payroll">
                    <div class="card-body">
                    @csrf
                    <div class="row p-3">
                    <div class="form-group row w-100">
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Payroll Month*</label>
                            <div class="col-md-12">
                                    <input id="year_month" type="text" class="form-control{{ $errors->has('year_month') ? ' is-invalid' : '' }}"
					placeholder="YYYY-DD" name="year_month" value="{{ old('year_month') }}" required> 
				@if ($errors->has('year_month')) 
					<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('year_month') }}</strong></span> 
				@endif
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-md-12 col-form-label">Period*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="period" name="period">
					@foreach ($period as $k=>$v )
                        <option value="{{ $k }}" >{{ $v }}</option>
                    @endforeach
				</select>
                            </div> 
                                                         
                                                      
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
                </form>
            </div>
</div>
@endsection