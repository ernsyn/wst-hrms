{{-- Table --}}
@can(PermissionConstant::VIEW_JOB)
<div class="tab-pane fade show p-3" id="nav-job" role="tabpanel" aria-labelledby="nav-job-tab">
    <div class="row pb-3" id="employee-job">
            {{-- <div class="col-auto mr-auto"></div>
            <div class="col-auto" id="show-resign-button">
            	@can(PermissionConstant::ADD_JOB)
                <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-job-popup">
                    Add Job
                </button>
                @endcan
                @if(App\EmployeeJob::where('emp_id', $id)->whereNull('end_date')->count() > 0)
                @can(PermissionConstant::RESIGN)
                <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#add-resign-popup">
                    Resign
                </button>
                @endcan
                @else
                <h5><span class="badge badge-danger">Resigned / Job Not Assigned</span></h5>
                @endif
            </div>         --}}    
            {{-- old code  --}}
        <div class="col-auto mr-auto"></div>
        <div class="col-auto" id="show-resign-button">            
            @can(PermissionConstant::ADD_JOB)
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-job-popup">
                Add Job
            </button>
            @endcan
            @can(PermissionConstant::RESIGN)
            @if(App\EmployeeJob::where('emp_id', $id)->whereNull('end_date')->count() > 0)
            <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#add-resign-popup">
                    Resign
            </button>
            @endif
            @if(App\Employee::where('id', $id)->whereNull('resignation_date')->count() == 0)
            <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#view-resign-popup">
					Resigned Details
			</button>
			@if(App\EmployeeAsset::where('emp_id',$id)->where('asset_status','1')->count() > 0)
			<a href="{{ route('admin.employees.assetid', ['id' => $id]) }}" class="btn btn-warning waves-effect" style="color:white">Asset on Hold</a>
           	@endif
           	@endif
			@endcan
		</div>
    </div>
    
    <table class="hrms-primary-data-table table w-100" id="employee-jobs-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Position</th>
                <th>Department</th>
                <th>Team</th>
                <th>Cost Centre</th>
                <th>Grade</th>
                <th>Section</th>
				<th>Company</th>
				<th>Area</th>
				<th>Branch</th>
                <th>Basic Salary</th>
                <th>Status</th>
                <th>Attachment</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endcan

@can(PermissionConstant::RESIGN)
<div class="modal fade" id="add-resign-popup" tabindex="-1" role="dialog" aria-labelledby="nav-job-tab" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nav-job-tab">Resignation Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-resign-form">
                <div class="modal-body">
                    @csrf
                    <div class="row form-group">
                        <label class="col-md-12 col-form-label"><strong>Date*</strong></label>
                        <div class="col-md-7">
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="date-resign" class="form-control datetimepicker-input"  placeholder="dd/mm/yyyy" data-target="#date-resign"/>
                                <div class="input-group-append" data-target="#date-resign" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="date-resign-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="blacklisted"><strong>Blacklisted*</strong></label>
                            <select class="form-control" id="add-blacklisted" name="blacklisted">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <div id="blacklisted-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="reason"><strong>Reason for leaving*</strong></label>
                            <textarea name="reason" class="form-control" placeholder="" value=""></textarea>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-resign-submit" type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

@can(PermissionConstant::RESIGN)
<div class="modal fade" id="view-resign-popup" tabindex="-1" role="dialog" aria-labelledby="nav-job-tab" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nav-job-tab">Resignation Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="col-md-12 col-form-label"><strong>Date:</strong></label>
                        <span class="col-md-12 col-form-label">{{date('d/m/Y', strtotime($employee->resignation_date))}}</span>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-12 col-form-label"><strong>Blacklisted:</strong></label>
                        @if(App\Employee::where('id', $id)->where('blacklisted','1')->count() > 0)
                        <span class="col-md-12 col-form-label">Yes</span>
                        @else
                        <span class="col-md-12 col-form-label">No</span>
                        @endif
                    </div>
                    <div class="row form-group">
                        <label class="col-md-12 col-form-label"><strong>Reason for leaving:</strong></label>
                        <span class="col-md-12 col-form-label">{{$employee->reason}}</span>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
        </div>
    </div>
</div>
@endcan

<!-- ADD -->
@can(PermissionConstant::ADD_JOB)
<div class="modal fade" id="add-job-popup" tabindex="-1" role="dialog" aria-labelledby="nav-job-tab" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nav-job-tab">Add Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" id="add-job-form" name="add-job-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="basic-salary"><strong>New Basic Salary*</strong></label>
                            <input name="basic_salary" type="number" class="form-control" placeholder="" value="" >
                            <div id="basic-salary-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="cost-centre"><strong>Cost Centre</strong></label>
                            <select class="form-control" name="cost_centre_id" >
                                <option value="">Please Select</option>
                                @foreach(App\CostCentre::all() as $cost_centre)
                                <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                @endforeach
                            </select>
                            <div id="cost-centre-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="department"><strong>Department</strong></label>
                            <select class="form-control" name="department_id" >
                                <option value="">Please Select</option>
                                @foreach(App\Department::all() as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <div id="department-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="team"><strong>Team*</strong></label>
                            <select class="form-control" name="team_id" >
                                <option value="">Please Select</option>
                                @foreach(App\Team::all() as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            <div id="team-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="main-position"><strong>Position</strong></label>
                            <select class="form-control" name="main_position_id" >
                                <option value="">Please Select</option>
                                @foreach(App\EmployeePosition::all() as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            <div id="main-position-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="grade"><strong>Grade*</strong></label>
                            <select class="form-control" name="emp_grade_id" >
                                <option value="">Please Select</option>
                                @foreach(App\EmployeeGrade::all() as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                            <div id="grade-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="section"><strong>Section</strong></label>
                            <select class="form-control" name="section_id" >
                                <option value="">Please Select</option>
                                @foreach(App\Section::all() as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                            <div id="section-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="jobcompany"><strong>Company*</strong></label>
                            <select class="form-control" name="job_comp_id" >
                                <option value="">Please Select</option>
                                @foreach(App\JobCompany::all() as $jobcompany)
                                <option value="{{ $jobcompany->id }}">{{ $jobcompany->company_name }}</option>
                                @endforeach
                            </select>
                            <div id="jobcompany-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="branch"><strong>Branch*</strong></label>
                            <select class="form-control" name="branch_id" >
                                <option value="">Please Select</option>
                                @foreach(App\Branch::all() as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                            <div id="branch-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-12 col-form-label"><strong>Date*</strong></label>
                        <div class="col-md-7">
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="date-job" name="start_date" class="form-control datetimepicker-input"  placeholder="dd/mm/yyyy" data-target="#date-job" autocomplete="off"/>
                                <div class="input-group-append" data-target="#date-job" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="date-job-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="employment-status"><strong>Employment Status*</strong></label>
                            <select multiple class="form-control" id="add-employment-status" name="status[]" placeholder="Please Select">
								@foreach(App\EmploymentStatus::all() as $status)
                                	<option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            <div id="employment-status-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="remarks"><strong>Remarks</strong></label>
                            <textarea name="remarks" type="number" class="form-control" placeholder="" value=""></textarea>
                            <div id="remarks-error" class="invalid-feedback">
							</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Attachment</strong></label>
                            <input name="job_attach[]" id="add-job-attach" type="file" class="form-control" multiple>
                            <div id="job-attach-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-job-submit" type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

{{-- DELETE --}}
@can(PermissionConstant::DELETE_JOB)
<div class="modal fade" id="confirm-delete-job-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                    <strong>Warning: *All Leave Allocations, Leave Request and Leave Request Approval under this job will be deleted*</strong>
                    <p>Are you sure you want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-job-submit">Delete</button>
            </div>
        </div>
    </div>
</div>
@endcan

@section('scripts')
<script>
    var jobsTable = $('#employee-jobs-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "scrollX":	true,
        "order": [[ 0, "desc" ]],
        "ajax": "{{ route('admin.employees.dt.jobs', ['id' => $id]) }}",
        "columnDefs": [ {
            "targets": [-1,-2,-3],
            "orderable": false
        } ],
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "start_date"
            },
            {
                "data": "end_date"
            },
            {
                "data": "main_position_name"                
            },
            {
                "data": "department_name"
            },
            {
                "data": "team.name"
            },
            {
                "data": "cost_centre_name"
            },
            {
                "data": "grade.name"
            },
            {
                "data": "section_name"
            },
            {
                "data": "jobcompany.company_name"
            },
            {
                "data": "area"
            },
            {
                "data": "branch.name"
            },
            {
                "data": "basic_salary"
            },
            {
                "data": "status[<br>]"
            },
            {
                "data": "attach[]",
                "render": function(data, type, row, meta){
                    var attach = '';
                    if(type === 'display'){
                        for(var i=0; i< data.length; i++) {
                        	attach += '<a target="_blank" href="/storage/emp_id_' + row.emp_id + '/job/' + data[i] + '">' + data[i] + '</a><br>';
                        }
                    }
                    return attach;
                 }
            },
            {
                "data": null, // can be null or undefined
                render: function (data, type, row, meta) {
//                     var button = null;
//                     if(row.end_date == null){
//                         button = null;
//                     }else{
                        button = `
                        @can(PermissionConstant::DELETE_JOB)
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-job-modal"><i class="far fa-trash-alt"></i></button>
    					@endcan
                        `;
//                     }                        
                    return button;
                }
            }
        ]
    });

</script>
<script type="text/javascript">
    $(function () {
        $('#add-job-form select[name=cost_centre_id]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        $('#add-job-form select[name=department_id]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        $('#add-job-form select[name=team_id]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        $('#add-job-form select[name=main_position_id]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        $('#add-job-form select[name=emp_grade_id]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        $('#add-job-form select[name=section_id]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        $('#add-job-form select[name=job_comp_id]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        $('#add-job-form select[name=branch_id]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        var empStatusSelectizeOptions = {
                valueField: 'id',
                labelField: 'name',
                searchField: ['name'],
                options: [],
                create: false,
//                 plugins: ['remove_button'],
                render: {
                    option: function(item, escape) {
                        return '<div class="option">' + item.name +
                        '</div>';
                    }
                },
                
            };

            $('#add-employment-status').selectize(empStatusSelectizeOptions);
 
        $('#date-job').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        //enable keyboard input & hide caret
        //$('#date-job').keydown(false);
        $('#date-job').css('caret-color', 'transparent');

        // ADD
        $('#add-job-popup').on('show.bs.modal', function (event) {
            clearJobError('#add-job-form');
        });

        $('#add-job-form #add-job-submit').click(function (e) {
            $(e.target).attr('disabled', 'disabled');
            e.preventDefault();
            var form = document.forms.namedItem("add-job-form");
            var formdata = new FormData(form);
            clearJobError('#add-job-form');
            $.ajax({
                url: "{{ route('admin.employees.jobs.post', ['id' => $id]) }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data:formdata,
//                 data: {
//                     _token: '{{ csrf_token() }}',
//                     basic_salary: $('#add-job-form input[name=basic-salary]').val(),
//                     cost_centre_id: $('#add-job-form select[name=cost-centre]').val(),
//                     department_id: $('#add-job-form select[name=department]').val(),
//                     team_id: $('#add-job-form select[name=team]').val(),
//                     emp_mainposition_id: $('#add-job-form select[name=main-position]').val(),
//                     emp_grade_id: $('#add-job-form select[name=grade]').val(),
//                     section_id: $('#add-job-form select[name=section]').val(),
//                     job_comp_id: $('#add-job-form select[name=jobcompany]').val(),
//                     branch_id: $('#add-job-form select[name=branch]').val(),
//                     start_date: $('#add-job-form #date-job').val(),
//                     status: $('#add-employment-status').val(),
//                     remarks: $('#add-job-form textarea[name=remarks]').val(),
//                     job_attach: $('#add-job-attach').val()
//                 },
                success: function (data) {

                    location.reload(true);
                    $(e.target).removeAttr('disabled');
                    showAlert(data.success);
                    $("#show-job-button").load(" #show-job-button");
                    jobsTable.ajax.reload();
                    $('#employee-profile-details').load(' #reload-profile1');
                    $('#nav-profile').load(' #reload-profile2');
                    $('#nav-job').load(' #employee-job');
                    $('#nav-job').load(' #employee-jobs-table');
                    $('#add-job-popup').modal('toggle');
                    clearJobModal('#add-job-form');
                },
                error: function (xhr) {
                    $(e.target).removeAttr('disabled');

                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch (errorField) {
                                    case 'basic_salary':
                                        $('#add-job-form input[name=basic_salary]').addClass(
                                            'is-invalid');
                                        $('#add-job-form #basic-salary-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'cost_centre_id':
                                        $('#add-job-form select[name=cost_centre_id]').addClass(
                                            'is-invalid');
                                        $('#add-job-form #cost-centre-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'department_id':
                                        $('#add-job-form select[name=department_id]').addClass(
                                            'is-invalid');
                                        $('#add-job-form #department-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'team_id':
                                        $('#add-job-form select[name=team_id]').addClass('is-invalid');
                                        $('#add-job-form #team-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                        break;
                                    case 'emp_mainposition_id':
                                        $('#add-job-form select[name=main_position_id]').addClass(
                                            'is-invalid');
                                        $('#add-job-form #main-position-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'emp_grade_id':
                                        $('#add-job-form select[name=emp_grade_id]').addClass('is-invalid');
                                        $('#add-job-form #grade-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                        break;
                                    case 'section_id':
                                        $('#add-job-form select[name=section_id]').addClass('is-invalid');
                                        $('#add-job-form #section-error').html('<strong>' +
                                            errors[errorField][0] + "</strong>");
                                        break;
                                    case 'job_comp_id':
                                        $('#add-job-form select[name=job_comp_id]').addClass('is-invalid');
                                        $('#add-job-form #jobcompany-error').html('<strong>' +
                                            errors[errorField][0] + "</strong>");
                                        break;
                                    case 'branch_id':
                                        $('#add-job-form select[name=branch_id]').addClass('is-invalid');
                                        $('#add-job-form #branch-error').html('<strong>' +
                                            errors[errorField][0] + "</strong>");
                                        break;
                                    case 'start_date':
                                        $('#add-job-form #date-job').addClass('is-invalid');
                                        $('#add-job-form #date-job-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                        break;
                                    case 'status':
                                        $('#add-employment-status').addClass(
                                            'is-invalid');
                                        $('#add-job-form #employment-status-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'remarks':
                                        $('#add-job-form textarea[name=remarks]').addClass(
                                            'is-invalid');
                                        $('#add-job-form #remarks-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'job_attach':
                                        $('#add-job-attach]').addClass('is-invalid');
                                        $('#add-job-form #job_attach-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    	break;
                                }
                            }
                        }
                    }
                }
            });
        });

         // DELETE
        var deleteJobId = null;
        $('#confirm-delete-job-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var currentData = JSON.parse(decodeURI(button.data('current')))
            console.log('Data: ', currentData)
            deleteJobId = currentData.id;
        });

 		var deleteJobRouteTemplate = "{{ route('admin.employees.jobs.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-job-submit').click(function(e){
            var deleteJobRoute = deleteJobRouteTemplate.replace(encodeURI('<<id>>'), deleteJobId);
            e.preventDefault();
            $.ajax({
                url: deleteJobRoute,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: deleteJobId
                },
                success: function(data) {
                    location.reload(true);
                    showAlert(data.success);
                    jobsTable.ajax.reload();
                    $('#confirm-delete-job-modal').modal('toggle');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error 422: ", xhr);
                    }
                    console.log("Error: ", xhr);
                }
            });
        });

    // GENERAL FUNCTIONS
    function clearJobModal(htmlId) {
        $(htmlId + ' input[name=basic_salary]').val('');
        $(htmlId + ' select[name=cost_centre_id]')[0].selectize.clear();
        $(htmlId + ' select[name=department_id]')[0].selectize.clear();
        $(htmlId + ' select[name=team_id]')[0].selectize.clear();
        $(htmlId + ' select[name=main_position_id]')[0].selectize.clear();
        $(htmlId + ' select[name=emp_grade_id]')[0].selectize.clear();
        $(htmlId + ' select[name=section_id]')[0].selectize.clear();
        $(htmlId + ' select[name=job_comp_id]')[0].selectize.clear();
        $(htmlId + ' select[name=branch_id]')[0].selectize.clear();
        $(htmlId + ' #date-job').val('');
        $(htmlId + ' #date-job-edit').val('');
        $(htmlId + ' select[name=-status]').selectize.clear();
        $(htmlId + ' textarea[name=remarks]').val('');
        $(htmlId + ' input[name=job_attach]').val('');

        $(htmlId + ' input[name=basic_salary]').removeClass('is-invalid');
        $(htmlId + ' select[name=cost_centre_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=department_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=team_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=main_position_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=emp_grade_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=section_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=job_comp_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=branch_id]').removeClass('is-invalid');
        $(htmlId + ' #date-job').removeClass('is-invalid');
        $(htmlId + ' #date-job-edit').removeClass('is-invalid');
        $(htmlId + ' select[name=status]').removeClass('is-invalid');
        $(htmlId + ' textarea[name=remarks]').removeClass('is-invalid');
        $(htmlId + ' input[name=job_attach]').removeClass('is-invalid');
    }

    function clearJobError(htmlId) {
    	$(htmlId + ' input[name=basic_salary]').removeClass('is-invalid');
        $(htmlId + ' select[name=cost_centre_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=department_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=team_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=main_position_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=emp_grade_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=section_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=job_comp_id]').removeClass('is-invalid');
        $(htmlId + ' select[name=branch_id]').removeClass('is-invalid');
        $(htmlId + ' #date-job').removeClass('is-invalid');
        $(htmlId + ' #date-job-edit').removeClass('is-invalid');
        $(htmlId + ' select[name=status]').removeClass('is-invalid');
        $(htmlId + ' textarea[name=remarks]').removeClass('is-invalid');
        $(htmlId + ' input[name=job_attach]').removeClass('is-invalid');
    }

    function showAlert(message) {
        $('#alert-container').html(
            `<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`
        )
    }
    });

</script>
<script type="text/javascript">
    $(function () {

        $('#date-resign').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#date-resign-edit').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        // ADD
        $('#add-resign-form').on('show.bs.modal', function (event) {
            clearResignError('#add-resign-form');
        });

        $('#add-resign-form select[name=blacklisted]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        $('#add-resign-form #add-resign-submit').click(function (e) {
            $(e.target).attr('disabled', 'disabled');
            e.preventDefault();
            clearResignError('#add-resign-form');
            $.ajax({
                url: "{{ route('admin.employees.id.action.resign', ['id' => $id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    resignation_date: $('#add-resign-form #date-resign').val(),
                    blacklisted: $('#add-resign-form select[name=blacklisted]').val(),
                    reason: $('#add-resign-form textarea[name=reason]').val()
                },
                success: function (data) {
                    
                    location.reload(true);
                    $(e.target).removeAttr('disabled');
                    showAlert(data.success);
                    $("#show-resign-button").load(" #show-resign-button");
                    jobsTable.ajax.reload();
                    $('#add-resign-popup').modal('toggle');
                    clearResignModal('#add-resign-form');
                    $('#nav-job').load(' #employee-job');
                    $('#nav-job').load(' #employee-jobs-table');
                },
                error: function (xhr) {
                    $(e.target).removeAttr('disabled');
                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch (errorField) {
                                    case 'resignation_date':
                                        $('#add-resign-form #date-resign').addClass('is-invalid');
                                        $('#add-resign-form #date-resign-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                    break;
                                    case 'kpi_proposer':
                                        $('#add-resign-form select[name=blacklistedd]').addClass('is-invalid');
                                        $('#add-resign-form #blacklisted-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        function clearResignModal(htmlId) {
        $(htmlId + ' #date-resign').val('');
        $(htmlId + ' #date-resign').removeClass('is-invalid');
        $(htmlId + ' select[name=blacklisted]')[0].selectize.clear();
        $(htmlId + ' input[name=reason]').val('');
    }

    function clearResignError(htmlId) {
        $(htmlId + ' #date-resign').removeClass('is-invalid');
        $(htmlId + ' select[name=blacklisted]').removeClass('is-invalid');
        $(htmlId + ' input[name=reason]').removeClass('is-invalid');
    }

    function showAlert(message) {
        $('#alert-container').html(
            `<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`
        )
    }
    });

         // DELETE
</script>
@append
