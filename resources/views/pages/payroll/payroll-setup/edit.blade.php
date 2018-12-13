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
		
		<form method="post" action="{{ route('payroll-setup.update', $payrollSetup->id) }}">
			<div class="card-body">
				@method('PATCH')
				@csrf
				<div class="row p-3">
					@if(AccessControllHelper::hasSuperadminRole())
    					<div class="form-group row w-100">
    						<div class="col-4">
    							<label class="col-md-12 col-form-label">Company *</label>
    							<div class="col-md-12">
    								<select class="form-control" id="company" name="company"> 
    									@foreach ($company as $row )
    										@if($payrollSetup->company->company_id == $row->id)
    											<option value="{{ $row->id }}" selected>{{ $row->name }}</option>
    										@else
    											<option value="{{ $row->id }}">{{ $row->name }}</option>
    										@endif
    									@endforeach
    								</select>
    							</div>
    						</div>
    					</div>
					@else
						<input type="hidden" id="company" name="company" value="{{ $payrollSetup->company_id }}">					
					@endif
					
					<div class="form-group row w-100">
						<div class="col-4">
							<label class="col-md-12 col-form-label">Key *</label>
							<div class="col-md-12">
								<input id="key" type="text" class="form-control{{ $errors->has('key') ? ' is-invalid' : '' }}" name="key" value="{{ $payrollSetup->key }}" required @if(!AccessControllHelper::hasSuperadminRole()) readonly @endif> 
								@if ($errors->has('key')) 
									<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('key') }}</strong></span>
								@endif
							</div>
						</div>
					</div>
					<div class="form-group row w-100">
						<div class="col-4">
							<label class="col-md-12 col-form-label">Value *</label>
							<div class="col-md-12">
								<input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" value="{{ $payrollSetup->value }}" required > 
								@if ($errors->has('value')) 
									<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('value') }}</strong></span>
								@endif
							</div>
						</div>
					</div>
					
					<div class="form-group row w-100">
						<div class="col-4">
                            <label class="col-md-12 col-form-label">Remark *</label>
                            <div class="col-md-12">
                                <textarea id="remark" class="form-control{{ $errors->has('remark') ? ' is-invalid' : '' }} text-left" name="remark" required>{{ $payrollSetup->remark }}</textarea>
    							@if ($errors->has('remark'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('remark') }}</strong>
                                </span>
    							@endif
                            </div>
                        </div>
                    </div>
                    
                    @if(AccessControllHelper::hasSuperadminRole())
                    <div class="form-group row w-100">
						<div class="col-4">
							<label class="col-md-12 col-form-label">Status *</label>
							<div class="col-md-12">
								<select class="form-control" id="status" name="status"> 
									<option>Select Status</option>
									<option value="0" {{ $payrollSetup->status == 0 ? 'selected' : '' }}>Inactive</option>
									<option value="1" {{ $payrollSetup->status == 1 ? 'selected' : '' }}>Active</option>
								</select>
							</div>
						</div>
					</div>
					@else
						<input type="hidden" name="status" value="{{ $payrollSetup->status }}">	
					@endif
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
