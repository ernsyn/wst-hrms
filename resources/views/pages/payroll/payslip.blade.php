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
							<label for="exampleFormPeriod">Payroll Month*</label>
                            <select class="form-control" id="payrollMonth" name="payrollMonth">
                                @foreach($period as $key => $value)
                                <option value="{{$value['yearmonth']}}">{{$value['yearmonth']}}</option>
                                @endforeach
                            </select>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">{{ __('Download') }}</button>
			</div>
		</form>
	</div>
</div>
@endsection 