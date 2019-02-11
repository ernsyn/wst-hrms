{{-- Table --}}
<div class="tab-pane fade show p-3" id="nav-job" role="tabpanel" aria-labelledby="nav-job-tab">
    <div class="row pb-3">
            {{-- <div class="col-auto mr-auto"></div>
            <div class="col-auto" id="show-resign-button">
                <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-job-popup">
                    Add Job
                </button>
                @if(App\EmployeeJob::where('emp_id', $id)->whereNull('end_date')->count() > 0)
                <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#add-resign-popup">
                    Add Resign
                </button>
                @else
                <h5><span class="badge badge-danger">Resigned / Job Not Assigned</span></h5>
                @endif
            </div>         --}}    
            {{-- old code  --}}
        <div class="col-auto mr-auto"></div>
        <div class="col-auto" id="show-resign-button">
            @if(App\Employee::where('id', $id)->whereNull('resignation_date')->count() > 0)
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-job-popup">
                Add Job
            </button>
            <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#add-resign-popup">
                    Add Resign
                </button>
            @else
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-job-popup">
            Re-Employ
            </button> 
            <h5><span class="badge badge-danger">Resigned</span></h5>
            @endif

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
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<div class="modal fade" id="add-resign-popup" tabindex="-1" role="dialog" aria-labelledby="nav-job-tab" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nav-job-tab">Add Resignation Date</h5>
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
                                <input type="text" id="date-resign" class="form-control datetimepicker-input" data-target="#date-resign"/>
                                <div class="input-group-append" data-target="#date-resign" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="date-resign-error" class="invalid-feedback">
                                </div>
                            </div>
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
<!-- ADD -->
<div class="modal fade" id="add-job-popup" tabindex="-1" role="dialog" aria-labelledby="nav-job-tab" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nav-job-tab">Add Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-job-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="basic-salary"><strong>New Basic Salary*</strong></label>
                            <input name="basic-salary" type="number" class="form-control" placeholder="" value="" >
                            <div id="basic-salary-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="cost-centre"><strong>Cost Centre*</strong></label>
                            <select class="form-control" name="cost-centre" >
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
                            <label for="department"><strong>Department*</strong></label>
                            <select class="form-control" name="department" >
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
                            <select class="form-control" name="team" >
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
                            <label for="main-position"><strong>Position*</strong></label>
                            <select class="form-control" name="main-position" >
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
                            <select class="form-control" name="grade" >
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
                            <label for="branch"><strong>Branch*</strong></label>
                            <select class="form-control" name="branch" >
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
                                <input type="text" id="date-job" class="form-control datetimepicker-input" data-target="#date-job" autocomplete="off"/>
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
                            <select class="form-control" name="employment-status" >
                                <option value="">Please Select</option>
                                <option value="confirmed-employment">Confirmed Employment</option>
                                <option value="confirmed-promotion">Confirmed Promotion</option>
                                <option value="transferred">Transferred</option>
                                <option value="probationer">Probationer</option>
                            </select>
                            <div id="employment-status-error" class="invalid-feedback"></div>
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

<!-- UPDATE -->
<div class="modal fade" id="edit-job-popup" tabindex="-1" role="dialog" aria-labelledby="edit-job-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-job-label">Edit Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-job-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="basic-salary"><strong>New Basic Salary*</strong></label>
                            <input name="basic-salary" type="number" class="form-control" placeholder="" value="" readonly>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="cost-centre"><strong>Cost Centre*</strong></label>
                            <select class="form-control" name="cost-centre" disabled >
                                <option value="">Please Select</option>
                                @foreach(App\CostCentre::all() as $cost_centre)
                                <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                @endforeach
                            </select>
                            <div id="cost-centre-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="department"><strong>Department*</strong></label>
                            <select class="form-control" name="department" disabled >
                                <option value="">Please Select</option>
                                @foreach(App\Department::all() as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <div id="department-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="team"><strong>Team*</strong></label>
                            <select class="form-control" name="team" disabled >
                                <option value="">Please Select</option>
                                @foreach(App\Team::all() as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            <div id="team-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="main-position"><strong>Main Position*</strong></label>
                            <select class="form-control" name="main-position" disabled >
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
                            <select class="form-control" name="grade" disabled>
                                <option value="">Please Select</option>
                                @foreach(App\EmployeeGrade::all() as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                            <div id="grade-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="branch"><strong>Branch*</strong></label>
                            <select class="form-control" name="branch" disabled>
                                <option value="">Please Select</option>
                                @foreach(App\Branch::all() as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                            <div id="branch-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-12 col-form-label"><strong>Date*</strong></label>
                        <div class="col-md-7">
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="date-job-edit" class="form-control datetimepicker-input" data-target="#date-job-edit" disabled autocomplete="off"/>
                                <div class="input-group-append" data-target="#date-job-edit" data-toggle="datetimepicker" disabled>
                                    
                                </div>
                                <div id="date-job-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="employment-status"><strong>Employment Status*</strong></label>
                            <select class="form-control" name="employment-status">
                                <option value="">Please Select</option>
                                <option value="confirmed-employment">Confirmed Employment</option>
                                <option value="confirmed-promotion">Confirmed Promotion</option>
                                <option value="transferred">Transferred</option>
                                <option value="probationer">Probationer</option>
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
                </div>
                <div class="modal-footer">
                    <button id="edit-job-submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    var jobsTable = $('#employee-jobs-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('admin.employees.dt.jobs', ['id' => $id]) }}",
        "columnDefs": [ {
            "targets": 8,
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
                "data": "main_position.name"
            },
            {
                "data": "department.name"
            },
            {
                "data": "team.name"
            },
            {
                "data": "cost_centre.name"
            },
            {
                "data": "grade.name"
            },

            {
                "data": "status",
                render: function (data, type, row, meta) {
                    switch (data) {
                        case 'transferred':
                            return "{!! App\Constants\EmploymentStatusNaming::get('transferred') !!}";
                        case 'confirmed-employment':
                            return "{!! App\Constants\EmploymentStatusNaming::get('confirmed-employment') !!}";
                        case 'confirmed-promotion':
                            return "{!! App\Constants\EmploymentStatusNaming::get('confirmed-promotion') !!}";
                        case 'probationer':
                            return "{!! App\Constants\EmploymentStatusNaming::get('probationer') !!}";
                    }

                    return data;
                }
            },
            {
                "data": null, // can be null or undefined
                render: function (data, type, row, meta) {
                    return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-job-popup"><i class="far fa-edit"></i></button>`;
                }
            }
        ]
    });

</script>
<script type="text/javascript">
    $(function () {
        $('#add-job-form select[name=cost-centre]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        var editCostCentre = $('#edit-job-form select[name=cost-centre]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        $('#add-job-form select[name=department]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        var editDepartment = $('#edit-job-form select[name=department]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        $('#add-job-form select[name=team]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        var editTeam = $('#edit-job-form select[name=team]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        $('#add-job-form select[name=main-position]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        var editMainPosition = $('#edit-job-form select[name=main-position]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        $('#add-job-form select[name=grade]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        var editGrade = $('#edit-job-form select[name=grade]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        $('#add-job-form select[name=branch]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        var editBranch = $('#edit-job-form select[name=branch]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        $('#add-job-form select[name=employment-status]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        var editEmpStatus = $('#edit-job-form select[name=employment-status]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });

        $('#date-job').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        //disable keyboard input & hide caret
        $('#date-job').keydown(false);
        $('#date-job').css('caret-color', 'transparent');

        $('#date-job-edit').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        //disable keyboard input & hide caret
        $('#date-job-edit').keydown(false);
        $('#date-job-edit').css('caret-color', 'transparent');

        // ADD
        $('#add-job-popup').on('show.bs.modal', function (event) {
            clearJobError('#add-job-form');
        });

        $('#add-job-form #add-job-submit').click(function (e) {
            $(e.target).attr('disabled', 'disabled');
            e.preventDefault();
            clearJobError('#add-job-form');
            $.ajax({
                url: "{{ route('admin.employees.jobs.post', ['id' => $id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    basic_salary: $('#add-job-form input[name=basic-salary]').val(),
                    cost_centre_id: $('#add-job-form select[name=cost-centre]').val(),
                    department_id: $('#add-job-form select[name=department]').val(),
                    team_id: $('#add-job-form select[name=team]').val(),
                    emp_mainposition_id: $('#add-job-form select[name=main-position]').val(),
                    emp_grade_id: $('#add-job-form select[name=grade]').val(),
                    branch_id: $('#add-job-form select[name=branch]').val(),
                    start_date: $('#add-job-form #date-job').val(),
                    status: $('#add-job-form select[name=employment-status]').val(),
                    remarks: $('#add-job-form textarea[name=remarks]').val()
                },
                success: function (data) {

                    $(e.target).removeAttr('disabled');
                    showAlert(data.success);
                    $("#show-job-button").load(" #show-job-button");
                    jobsTable.ajax.reload();
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
                                        $('#add-job-form input[name=basic-salary]').addClass(
                                            'is-invalid');
                                        $('#add-job-form #basic-salary-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'cost_centre_id':
                                        $('#add-job-form select[name=cost-centre]').addClass(
                                            'is-invalid');
                                        $('#add-job-form #cost-centre-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'department_id':
                                        $('#add-job-form select[name=department]').addClass(
                                            'is-invalid');
                                        $('#add-job-form #department-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'team_id':
                                        $('#add-job-form select[name=team]').addClass('is-invalid');
                                        $('#add-job-form #team-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                        break;
                                    case 'emp_mainposition_id':
                                        $('#add-job-form select[name=main-position]').addClass(
                                            'is-invalid');
                                        $('#add-job-form #main-position-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'emp_grade_id':
                                        $('#add-job-form select[name=grade]').addClass('is-invalid');
                                        $('#add-job-form #grade-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                        break;
                                    case 'branch_id':
                                        $('#add-job-form select[name=branch]').addClass('is-invalid');
                                        $('#add-job-form #branch-error').html('<strong>' +
                                            errors[errorField][0] + "</strong>");
                                        break;
                                    case 'start_date':
                                        $('#add-job-form #date-job').addClass('is-invalid');
                                        $('#add-job-form #date-job-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                        break;
                                    case 'status':
                                        $('#add-job-form select[name=employment-status]').addClass(
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
                                    case 'status':
                                        $('#add-job-form #status').addClass('is-invalid');
                                        $('#add-job-form #status-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                        break;
                                }
                            }
                        }
                    }
                }
            });
        });


        // EDIT
        var editId = null;
        // Function: On Modal Clicked Handler
        $('#edit-job-popup').on('show.bs.modal', function (event) {
            clearJobError('#edit-job-form');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editId = currentData.id;
            $('#edit-job-form input[name=basic-salary]').val(currentData.basic_salary);
            editCostCentre[0].selectize.setValue(currentData.cost_centre_id);
            editDepartment[0].selectize.setValue(currentData.department_id);
            editTeam[0].selectize.setValue(currentData.team_id);
            editMainPosition[0].selectize.setValue(currentData.emp_mainposition_id);
            editGrade[0].selectize.setValue(currentData.emp_grade_id);
            editBranch[0].selectize.setValue(currentData.branch_id);
            $('#edit-job-form #date-job-edit').val(currentData.start_date);
            editEmpStatus[0].selectize.setValue(currentData.status);
            $('#edit-job-form textarea[name=remarks]').val(currentData.remarks);
        });

        var editRouteTemplate =
            "{{ route('admin.employees.jobs.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-job-form #edit-job-submit').click(function (e) {
            var editRoute = editRouteTemplate.replace(encodeURI('<<id>>'), editId);

            e.preventDefault();
            $.ajax({
                url: editRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    basic_salary: $('#edit-job-form input[name=basic-salary]').val(),
                    cost_centre_id: $('#edit-job-form select[name=cost-centre]').val(),
                    department_id: $('#edit-job-form select[name=department]').val(),
                    team_id: $('#edit-job-form select[name=team]').val(),
                    emp_mainposition_id: $('#edit-job-form select[name=main-position]').val(),
                    emp_grade_id: $('#edit-job-form select[name=grade]').val(),
                    branch_id: $('#edit-job-form select[name=branch]').val(),
                    start_date: $('#edit-job-form #date-job-edit').val(),
                    status: $('#edit-job-form select[name=employment-status]').val(),
                    remarks: $('#edit-job-form textarea[name=remarks]').val()
                },
                success: function (data) {
                    showAlert(data.success);
                    jobsTable.ajax.reload();
                    $('#edit-job-popup').modal('toggle');
                    clearJobModal('#edit-job-form');
                },
                error: function (xhr) {
                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch (errorField) {
                                    case 'basic_salary':
                                        $('#edit-job-form input[name=basic-salary]').addClass(
                                            'is-invalid');
                                        $('#edit-job-form #basic-salary-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'cost_centre_id':
                                        $('#edit-job-form select[name=cost-centre]').addClass(
                                            'is-invalid');
                                        $('#edit-job-form #cost-centre-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'department_id':
                                        $('#edit-job-form select[name=department]').addClass(
                                            'is-invalid');
                                        $('#edit-job-form #department-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'team_id':
                                        $('#edit-job-form select[name=team]').addClass('is-invalid');
                                        $('#edit-job-form #team-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                        break;
                                    case 'emp_mainposition_id':
                                        $('#edit-job-form select[name=main-position]').addClass(
                                            'is-invalid');
                                        $('#edit-job-form #main-position-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'emp_grade_id':
                                        $('#edit-job-form select[name=grade]').addClass('is-invalid');
                                        $('#edit-job-form #grade-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                        break;
                                    case 'branch_id':
                                        $('#edit-job-form select[name=branch]').addClass('is-invalid');
                                        $('#edit-job-form #branch-error').html('<strong>' +
                                            errors[errorField][0] + "</strong>");
                                        break;
                                    case 'start_date':
                                        $('#edit-job-form #date-job-edit').addClass(
                                            'is-invalid');
                                        $('#edit-job-form #date-job-error').html('<strong>' +
                                            errors[errorField][0] + '</strong>');
                                        break;
                                    case 'status':
                                        $('#edit-job-form select[name=employment-status]').addClass(
                                            'is-invalid');
                                        $('#edit-job-form #employment-status-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                    case 'remarks':
                                        $('#edit-job-form textarea[name=remarks]').addClass(
                                            'is-invalid');
                                        $('#edit-job-form #remarks-error').html(
                                            '<strong>' + errors[errorField][0] +
                                            '</strong>');
                                        break;
                                }
                            }
                        }
                    }
                }
            });
        });

         // DELETE

    // GENERAL FUNCTIONS
    function clearJobModal(htmlId) {
        $(htmlId + ' input[name=basic-salary]').val('');
        $(htmlId + ' select[name=cost-centre]')[0].selectize.clear();
        $(htmlId + ' select[name=department]')[0].selectize.clear();
        $(htmlId + ' select[name=team]')[0].selectize.clear();
        $(htmlId + ' select[name=main-position]')[0].selectize.clear();
        $(htmlId + ' select[name=grade]')[0].selectize.clear();
        $(htmlId + ' select[name=branch]')[0].selectize.clear();
        $(htmlId + ' #date-job').val('');
        $(htmlId + ' #date-job-edit').val('');
        $(htmlId + ' select[name=employment-status]')[0].selectize.clear();
        $(htmlId + ' textarea[name=remarks]').val('');

        $(htmlId + ' input[name=basic-salary]').removeClass('is-invalid');
        $(htmlId + ' select[name=cost-centre]').removeClass('is-invalid');
        $(htmlId + ' select[name=department]').removeClass('is-invalid');
        $(htmlId + ' select[name=team]').removeClass('is-invalid');
        $(htmlId + ' select[name=main-position]').removeClass('is-invalid');
        $(htmlId + ' select[name=grade]').removeClass('is-invalid');
        $(htmlId + ' select[name=branch]').removeClass('is-invalid');
        $(htmlId + ' #date-job').removeClass('is-invalid');
        $(htmlId + ' #date-job-edit').removeClass('is-invalid');
        $(htmlId + ' select[name=employment-status]').removeClass('is-invalid');
        $(htmlId + ' textarea[name=remarks]').removeClass('is-invalid');
    }

    function clearJobError(htmlId) {
        $(htmlId + ' input[name=basic-salary]').removeClass('is-invalid');
        $(htmlId + ' select[name=cost-centre]').removeClass('is-invalid');
        $(htmlId + ' select[name=department]').removeClass('is-invalid');
        $(htmlId + ' select[name=team]').removeClass('is-invalid');
        $(htmlId + ' select[name=main-position]').removeClass('is-invalid');
        $(htmlId + ' select[name=grade]').removeClass('is-invalid');
        $(htmlId + ' select[name=branch]').removeClass('is-invalid');
        $(htmlId + ' #date-job').removeClass('is-invalid');
        $(htmlId + ' #date-job-edit').removeClass('is-invalid');
        $(htmlId + ' select[name=employment-status]').removeClass('is-invalid');
        $(htmlId + ' textarea[name=remarks]').removeClass('is-invalid');
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
        $('#add-resign-popup').on('show.bs.modal', function (event) {
            clearResignError('#add-resign-form');
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
                    resignation_date: $('#add-resign-form #date-resign').val()
                },
                success: function (data) {

                    $(e.target).removeAttr('disabled');
                    showAlert(data.success);
                    $("#show-resign-button").load(" #show-resign-button");
                    jobsTable.ajax.reload();
                    $('#add-resign-popup').modal('toggle');
                    clearResignModal('#add-resign-form');
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
    }

    function clearResignError(htmlId) {
        $(htmlId + ' #date-resign').removeClass('is-invalid');
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
