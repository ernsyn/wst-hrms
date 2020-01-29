        <div id="employee-profile-details" class="card-body bg-primary text-white">
            <div class="d-flex align-items-stretch" id="reload-profile1">
                <div id="profile-pic-container" class="p-2 flex-grow-0 d-flex flex-column align-items-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-current="{{$employee->id}}" data-target="#edit-picture-popup">
                        @if ($employee->profile_media_id != null)
                            <img class="img-thumbnail rounded-circle" src="data:{{$userMedia->mimetype}};base64, {{$userMedia->data}}"  style="object-fit:cover; width:150px; height:150px">
                        @else
                        <i class="fas fa-user-circle fa-8x"></i>
                    <div class="pt-2 mt-auto">
                        <h6><strong>Profile Image</strong></h6>
                    </div>
                        @endif
                    </button>
                </div>
                <div id="basic-profile" class="px-2 ml-3 w-100">
                    <div class="header d-flex pb-3">
                        <h3 id="emp-name">{{$employee->user->name}}</h3>
                        <h3 id="emp-email">{{$employee->user->email}}</h3>
                    </div>
                    <div class="row mx-md-n5">
                      <div class="col px-md-3"><div class="p-1 ">Name</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{{$employee->user->name}}</div></div>
                      <div></div>
                      <div class="col px-md-3"><div class="p-1 ">Cost Centre</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{{$details->cost_centre}}</div></div>
                    </div>
                    <div class="row mx-md-n5">
                      <div class="col px-md-3"><div class="p-1 ">Employee ID</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{{$employee->code}}</div></div>
                      <div></div>
                      <div class="col px-md-3"><div class="p-1 ">Section</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{{$details->section}}</div></div>
                    </div>
                    <div class="row mx-md-n5">
                      <div class="col px-md-3"><div class="p-1 ">IC No</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{{$employee->ic_no}}</div></div>
                      <div></div>
                      <div class="col px-md-3"><div class="p-1 ">Department</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{{$details->department}}</div></div>
                    </div>
                    <div class="row mx-md-n5">
                      <div class="col px-md-3"><div class="p-1 ">DOB</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{{$employee->dob->format('d/m/Y')}}</div></div>
                      <div></div>
                      <div class="col px-md-3"><div class="p-1 ">Position</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{{$details->position}}</div></div>
                    </div>
                    <div class="row mx-md-n5">
                      <div class="col px-md-3"><div class="p-1 ">Gender</div></div>
                      <div class="col px-md-1"><div class="p-1 text-capitalize">{{$employee->gender}}</div></div>
                      <div></div>
                      <div class="col px-md-3"><div class="p-1 ">Area</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{{$details->area}}</div></div>
                    </div>
                    <div class="row mx-md-n5">
                      <div class="col px-md-3"><div class="p-1 ">Join Company Date</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{!! isset($employee->join_company_date)  ? \Carbon\Carbon::parse($employee->join_company_date)->format('d/m/Y')  : '<strong>(not set)</strong>' !!}</div></div>
                      <div></div>
                      <div class="col px-md-3"><div class="p-1 ">Branch</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{{$details->branch}}</div></div>
                    </div>
                    <div class="row mx-md-n5">
                      <div class="col px-md-3"><div class="p-1 ">Join Group Date</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{!! isset($employee->join_group_date)  ? \Carbon\Carbon::parse($employee->join_group_date)->format('d/m/Y')  : '<strong>(not set)</strong>' !!}</div></div>
                      <div></div>
                      <div class="col px-md-3"><div class="p-1 ">Confirmed Date</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{!! isset($employee->confirmed_date)  ? \Carbon\Carbon::parse($employee->confirmed_date)->format('d/m/Y')  : '<strong>(not set)</strong>' !!}</div></div>
                    </div>
                    <div class="row mx-md-n5">
                      <div class="col px-md-3"><div class="p-1 ">Service Year</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{!! isset($employee->serviceYear)  ? $employee->serviceYear : '<strong>(not set)</strong>' !!}</div></div>
                      <div></div>
                      <div class="col px-md-3"><div class="p-1 ">Resigned Date</div></div>
                      <div class="col px-md-1"><div class="p-1 ">{!! isset($employee->resignation_date)  ? \Carbon\Carbon::parse($employee->resignation_date)->format('d/m/Y')  : '<strong>(not set)</strong>' !!}</div></div>
                    </div>

                    </div>
                <div id="end-btn-group">
                	@can(PermissionConstant::ASSIGN_ROLE)
                    <button id="emp-roles-btn" data-toggle="modal" data-target="#roles-popup"  type="button" class="btn btn-sm text-white rounded">
                        Assign Role
                    </button>
					@endcan
					@can(PermissionConstant::RESET_PASSWORD)					
					<button id="emp-reset-password-btn" data-toggle="modal" data-target="#reset-password-popup" type="button" class="btn btn-sm text-white rounded">                        {{-- <i class="fas fa-pen"></i> --}}
                        Reset Password
                    </button>
                    @endcan
                </div>
            </div>

        </div>