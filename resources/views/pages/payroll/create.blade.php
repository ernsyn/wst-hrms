@extends('layouts.admin-base') 
@section('content')
<div class="container">
	<div class="card">
		
		@if(session()->get('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{ session()->get('success') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
		
		@if(session()->get('customMsg')) 
    	<div class="alert alert-danger alert-dismissible fade show" role="alert">
    		{{ session()->get('customMsg') }}
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
    		</button>
    	</div>
    	@endif
		
		<form method="POST" action="{{ route('payroll.store') }}" id="add_payroll">
			<div class="card-body">
				@csrf
				<div class="row p-3">
					<div class="form-group row w-100">
						<div class="col-4">
							<label class="col-md-12 col-form-label">Payroll Month*</label>
							<div class="col-md-12">
    							<div class="input-group date" data-target-input="nearest">
                                    <input type="text" id="year_month" class="form-control {{ $errors->has('year_month') ? ' is-invalid' : '' }} datetimepicker-input" data-target="#year_month" placeholder="YYYY-MM" name="year_month" 
                                    	value="{{ old('year_month', date('Y-m')) }}" />
                                    <div class="input-group-append" data-target="#year_month" data-toggle="datetimepicker">
                                        <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                    @if ($errors->has('year_month')) 
                                	<span class="invalid-feedback" role="alert"><strong>{{ $errors->first('year_month') }}</strong></span>
									@endif
                                </div>
                                <span id="old-payroll-month" style="display:none">{{ old('year_month', date('Y-m')) }}</span>
                            </div>
						</div>
						<div class="col-4">
							<label class="col-md-12 col-form-label">Period*</label>
							<div class="col-md-12">
								<select class="form-control {{ $errors->has('period') ? ' is-invalid' : '' }} " id="period" name="period"> 
									<option value="">Please Select</option>
									@foreach ($period as $k=>$v )
									<option value="{{ $k }}">{{ $v }}</option>
									 @endforeach
								</select>
								@if ($errors->has('period')) 
                                	<span class="invalid-feedback" role="alert"><strong>{{ $errors->first('period') }}</strong></span>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
				<a role="button" class="btn btn-secondary" href="{{ route('payroll') }}">Cancel</a>
			</div>
		</form>
	</div>
</div>
@endsection 
@section('scripts')
<script>

    $('#year_month').datetimepicker({
        format: 'YYYY-MM',
        useCurrent: false,
        maxDate: new Date()
    });
    $('#year_month').val($('#old-payroll-month').text());
    
</script>
@append
