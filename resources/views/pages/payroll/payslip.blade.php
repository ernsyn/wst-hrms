@extends('layouts.base') 
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
		
		<form method="POST" action="{{ route('payslip.download') }}" id="add_payroll">
			<div class="card-body">
				@csrf
				<div class="row p-3">
					<div class="form-group row w-100">
						<div class="col-4">
							<label class="col-md-12 col-form-label">Payroll Month*</label>
							<div class="col-md-12">
								<input id="year_month"  autocomplete="off" type="text" class="form-control{{ $errors->has('year_month') ? ' is-invalid' : '' }}" placeholder="YYYY-DD" name="year_month" value="{{ old('year_month') }}" required readonly> 
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
				<button type="submit" class="btn btn-primary">{{ __('Download') }}</button>
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
	  dateFormat: "yy-mm",
//	  showButtonPanel: true,
//	  currentText: "This Month",
	  onChangeMonthYear: function (year, month, inst) {
	    $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month - 1, 1)));
	  },
	  onClose: function(dateText, inst) {
	    var month = $(".ui-datepicker-month :selected").val();
	    var year = $(".ui-datepicker-year :selected").val();
	    $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month, 1)));
	  }
	}).focus(function () {
	  $(".ui-datepicker-calendar").hide();
	});
</script>
<style>
.ui-datepicker-calendar {
    display: none;
}
</style>
@append
