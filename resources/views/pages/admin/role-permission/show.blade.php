@extends('layouts.admin-base')
@section('content')
<div class="main-content">
    <div id="alert-container"></div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class=" col-form-label">Role Name</label>
                    <div class="">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $role->name }}" disabled>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label class=" col-form-label">Description</label>
                    <div class="">
                    	<textarea name="description" id="description" row="5" class="form-control" disabled>{{ $role->description }}</textarea>
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
    										<label for="all" class="form-check-label">{{$admin['module']}}</label>
  										</div>
									</li>
							@endif
									<li style="padding-left: 1.2rem">
										<div class="checkbox form-check">
                                            <input id="item-{{$admin['module']}}" type="checkbox" class="form-check-input" name="permissions[]" value="{{$admin['id']}}" {{ $checked }} disabled>
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
    										<label for="all" class="form-check-label">{{$employee['module']}}</label>
  										</div>
									</li>
								@endif
									<li style="padding-left: 1.2rem">
										<div class="checkbox form-check">
                                            <input id="item-{{$employee['module']}}" type="checkbox" class="form-check-input" name="permissions[]" value="{{$employee['id']}}" {{ $checked }} disabled>
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
            <a role="button" class="btn btn-secondary" href="{{ route('admin.role-permission') }}">Back</a>
        </div>
    </div>
</div>
@endsection
