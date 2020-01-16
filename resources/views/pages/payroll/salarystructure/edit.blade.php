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
		<form method="post" action="{{ route('payroll.salarystructure.update.post', ['id' => $salaryStructures->id]) }}">
			<div class="card-body">
				{{ csrf_field() }}
				<div class="row p-3">
					<div class="form-group row w-100">
    						<div class="col-4">
    							<label class="col-md-12 col-form-label">Team *</label>
    							<div class="col-md-12">
    								<select class="form-control" id="team_id" name="team_id"> 
    									@foreach ($teams as $row )
    										@if($salaryStructures->team->id == $row->id)
    											<option value="{{ $row->id }}" selected>{{ $row->name }}</option>
    										@else
    											<option value="{{ $row->id }}">{{ $row->name }}</option>
    										@endif
    									@endforeach
    								</select>
    							</div>
    						</div>
    					</div>
    					<div class="form-group row w-100">
    						<div class="col-4">
    							<label class="col-md-12 col-form-label">Grade *</label>
    							<div class="col-md-12">
    								<select class="form-control" id="grade_id" name="grade_id"> 
    									@foreach ($grades as $row )
    										@if($salaryStructures->grade->id == $row->id)
    											<option value="{{ $row->id }}" selected>{{ $row->name }}</option>
    										@else
    											<option value="{{ $row->id }}">{{ $row->name }}</option>
    										@endif
    									@endforeach
    								</select>
    							</div>
    						</div>
    					</div>
    					<div class="form-group row w-100">
    						<div class="col-4">
    							<label class="col-md-12 col-form-label">Category *</label>
    							<div class="col-md-12">
    								<select class="form-control" id="categories_id" name="categories_id"> 
    									@foreach ($categories as $row )
    										@if($salaryStructures->category->id == $row->id)
    											<option value="{{ $row->id }}" selected>{{ $row->name }}</option>
    										@else
    											<option value="{{ $row->id }}">{{ $row->name }}</option>
    										@endif
    									@endforeach
    								</select>
    							</div>
    						</div>
    					</div>
    				<div class="form-group row w-100">
						<div class="col-4">
							<label class="col-md-12 col-form-label">Basic Salary *</label>
							<div class="col-md-12">
								<input id="basic_salary" type="text" class="form-control{{ $errors->has('basic_salary') ? ' is-invalid' : '' }}" name="basic_salary" value="{{ $salaryStructures->basic_salary }}" required > 
								@if ($errors->has('basic_salary')) 
									<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('basic_salary') }}</strong></span>
								@endif
							</div>
						</div>
					</div>
					<div class="form-group row w-100">
						<div class="col-4">
							<label class="col-md-12 col-form-label">KPI *</label>
							<div class="col-md-12">
								<input id="KPI" type="text" class="form-control{{ $errors->has('KPI') ? ' is-invalid' : '' }}" name="KPI" value="{{ $salaryStructures->KPI }}" required > 
								@if ($errors->has('KPI')) 
									<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('KPI') }}</strong></span>
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
@section('scripts')
<script>

</script>
@append
