@extends('layouts.admin-base') 
@section('content')
<div class="container">
	<div class="card">
		@if($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			{{$errors->first()}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif 
		
		@if(session()->get('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{ session()->get('success') }}
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
								<input id="year_month" type="text" class="form-control{{ $errors->has('year_month') ? ' is-invalid' : '' }}" placeholder="YYYY-DD" name="year_month" value="{{ old('year_month') }}" required> 
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
									<option value="{{ $k }}">{{ $v }}</option>
									 @endforeach
								</select>
							</div>
						</div>
					</div>
					{{--
					<div class="form-group row w-100"></div>
					--}}
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
@section('scripts')
<script>
    $('#year_month').datepicker({
    	changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm',

	    onClose: function(dateText, inst) {  
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
            $(this).datepicker('setDate', new Date(year, month, 1)); 
        }
    });
</script>
<style>
.ui-datepicker-calendar {
    display: none;
}
</style>
@append
