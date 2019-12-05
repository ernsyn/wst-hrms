@extends('layouts.admin-base')
@section('content')
<div class="main-content">
    <div id="alert-container"></div>

    <div class="card">
    <form method="POST" action="{{ route('admin.role-permission.update', $role->id) }}" id="form_validate" data-parsley-validate>
        <div class="card-body">
            @if ($errors->any())
            	<div class="alert alert-danger">
                	<ul>
                    	@foreach ($errors->all() as $error)
                      	<li>{{ $error }}</li>
                    	@endforeach
                	</ul>
              	</div><br />
            @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class=" col-form-label">Role Name *</label>
                        <div class="">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $role->name }}"
                                required>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class=" col-form-label">Description</label>
                        <div class="">
                        	<textarea name="description" id="description" row="5" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ $role->description }}</textarea>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-6 form-group">
  						<div class="card">
    						<div class="card-header">
  								Admin Permissions
    						</div>
  							<div class="card-body">
      							@php
									$modules = array();
								@endphp
    							
    							@foreach($adminPermissions as $admin)
    								@if($admin['module'] != end($modules))
										</ul>
									@endif
									
									@php
        								if(in_array($admin->id, $permissions)) {
        									$checked = 'checked';
        								} else {
        									$checked = '';
        								}
        							@endphp

									@if(current($modules) != $admin['module'])
    								<ul class="list-unstyled">
  										<li>
  											<div class="checkbox select-all font-weight-bold form-check ">
        										<input id="all-{{$admin['module']}}" type="checkbox" class="form-check-input"/>
        										<label for="all" class="form-check-label">{{$admin['module']}}</label>
      										</div>
  										</li>
									@endif
    									<li style="padding-left: 1.2rem">
    										<div class="checkbox form-check">
                                                <input id="item-{{$admin['module']}}" type="checkbox" class="form-check-input" name="permissions[]" value="{{$admin['id']}}" {{ $checked }}>
                                                <label class="form-check-label">{{$admin['name']}}</label>
                                            </div>
    									</li>
									@if(!in_array($admin['module'], $modules))
    								@php
    									array_push($modules, $admin['module']);
    								@endphp
    								@endif
                                @endforeach
                            </div>
						</div>
					</div>
      				<div class="col-md-6 form-group">
  						<div class="card">
    						<div class="card-header">
      							Employee Permissions
    						</div>
  							<div class="card-body">
  								@foreach($employeePermissions as $employee)
  									@if($employee['module'] != end($modules))
										</ul>
									@endif
									
									@php
    									if(in_array($employee->id, $permissions)) {
    										$checked = 'checked';
    									} else {
    										$checked = '';
    									}
    								@endphp
									
      								@if(current($modules) != $employee['module'])
    								<ul class="list-unstyled">
  										<li>
  											<div class="checkbox select-all font-weight-bold form-check ">
        										<input id="all-{{$employee['module']}}" type="checkbox" class="form-check-input"/>
        										<label for="all" class="form-check-label">{{$employee['module']}}</label>
      										</div>
  										</li>
									@endif
										<li style="padding-left: 1.2rem">
  											<div class="checkbox form-check">
                                                <input id="item-{{$employee['module']}}" type="checkbox" class="form-check-input" name="permissions[]" value="{{$employee['id']}}" {{ $checked }}>
                                                <label class="form-check-label">{{$employee['name']}}</label>
                                            </div>
  										</li>
  									@if(!in_array($admin['module'], $modules))
    								@php
    									array_push($modules, $admin['module']);
    								@endphp
    								@endif
                				@endforeach
  							</div>
    					</div>
                	</div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a role="button" class="btn btn-secondary" href="{{ route('admin.role-permission') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
	$('[id^="all-"]').on('click', function(e){
    	$this = this;  
    	$.each($(this).parents('ul').find('input'), function(i, item){
      		$(item).prop('checked', $this.checked);
    	});
  	});
});
</script>
@append
