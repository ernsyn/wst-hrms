{{-- Table --}}
<div class="tab-pane fade show p-3" id="nav-job" role="tabpanel" aria-labelledby="nav-job-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#add-job-popup">
                        Add Job
                    </button> @if(App\EmployeeJob::where('emp_id', $id)->whereNull('end_date')->count() > 0)
            <button type="button" class="btn btn-outline-danger waves-effect" onclick="window.location='{{ route('admin.employees.id.action.resign', ['id' => $id ]) }}';">
                            Resign
                        </button> @else
            <h5><span class="badge badge-danger">Resigned / Job Not Assigned</span></h5>
            @endif
        </div>
    </div>
    <table class="hrms-primary-data-table table table-bordered table-hover w-100 text-capitalize" id="employee-jobs-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Position</th>
                <th>Department</th>
                <th>Team</th>
                <th>Cost Centre</th>
                <th>Grade</th>
                <th>Basic Salary</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
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
                            <input id="basic-salary" type="number" class="form-control" placeholder="" value="" required>
                            <div id="basic-salary-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="cost-centre"><strong>Cost Centre*</strong></label>
                            <select class="form-control" id="cost-centre" required>
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
                            <select class="form-control" id="department" required>
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
                            <select class="form-control" id="team" required>
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
                            <select class="form-control" id="main-position" required>
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
                            <select class="form-control" id="grade" required>
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
                            <select class="form-control" id="branch" required>
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
                            <input id="alt-date-job" type="text" class="form-control" hidden>
                            <input id="date-job" type="text" class="form-control" readonly>
                            <div id="date-job-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="employment-status"><strong>Employment Status*</strong></label>
                            <select class="form-control" id="employment-status" required>
                                <option value="">Please Select</option>
                                <option value="employment-confirmed">Confirmed Employment</option>
                                <option value="promotion-confirmed">Confirmed Promotion</option>
                                <option value="transferred">Transferred</option>
                                <option value="probationer">Probationer</option>
                            </select>
                            <div id="employment-status-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="specification"><strong>Specification*</strong></label>
                            <textarea id="specification" type="number" class="form-control" placeholder="" value="" required></textarea>
                            <div id="specification-error" class="invalid-feedback">

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
                            <input id="basic-salary" type="number" class="form-control" placeholder="" value="" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="cost-centre"><strong>Cost Centre*</strong></label>
                            <select class="form-control" id="cost-centre" required>
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
                            <select class="form-control" id="department" required>
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
                            <select class="form-control" id="team" required>
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
                            <select class="form-control" id="main-position" required>
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
                            <select class="form-control" id="grade" required>
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
                            <select class="form-control" id="branch" required>
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
                            <input id="alt-date-job-edit" type="text" class="form-control">
                            <input id="date-job-edit" type="text" class="form-control" readonly>
                            <div id="date-job-error" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="status"><strong>Employment Status*</strong></label>
                            <select class="form-control" id="status" required>
                                    <option value="">Please Select</option>
                                    <option value="employment-confirmed">Confirmed Employment</option>
                                    <option value="promotion-confirmed">Confirmed Promotion</option>
                                    <option value="transferred">Transferred</option>
                                    <option value="probationer">Probationer</option>
                                    </select>
                            <div id="status-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="specification"><strong>Specification*</strong></label>
                            <textarea id="specification" type="number" class="form-control" placeholder="" value="" required></textarea>
                            <div id="specification-error" class="invalid-feedback">

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
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "start_date"
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
            "data": "basic_salary"
        },
        {
            "data": "status"
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
    $(function(){
    //datepicker
    $('#date-job').datepicker({
        altField: "#alt-date-job",
        altFormat: 'yy-mm-dd',
        format: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-80:+0"
    });
    $('#date-job-edit').datepicker({
        altField: "#alt-date-job-edit",
        altFormat: 'yy-mm-dd',
        format: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-80:+0"
    });
    // ADD
    $('#add-job-popup').on('show.bs.modal', function (event) {
        clearJobError('#add-job-form');
    });
    $('#add-job-form #add-job-submit').click(function(e){
        clearJobError('#add-job-form');
        e.preventDefault();
        $.ajax({
            url: "{{ route('admin.employees.jobs.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                basic_salary: $('#add-job-form #basic-salary').val(),
                cost_centre_id: $('#add-job-form #cost-centre').val(),
                department_id: $('#add-job-form #department').val(),
                team_id: $('#add-job-form #team').val(),
                emp_mainposition_id: $('#add-job-form #main-position').val(),
                emp_grade_id: $('#add-job-form #grade').val(),
                branch_id: $('#add-job-form #branch').val(),
                start_date: $('#add-job-form #alt-date-job').val(),
                status: $('#add-job-form #employment-status').val(),
                specification: $('#add-job-form #specification').val()
            },
            success: function(data) {
                showAlert(data.success);
                jobsTable.ajax.reload();
                $('#add-job-popup').modal('toggle');
                clearJobModal('#add-job-form');
            },
            error: function(xhr) {
                if(xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'basic_salary':
                                        $('#add-job-form #basic-salary').addClass('is-invalid');
                                        $('#add-job-form #basic-salary-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'cost_centre_id':
                                        $('#add-job-form #cost-centre').addClass('is-invalid');
                                        $('#add-job-form #cost-centre-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'department_id':
                                        $('#add-job-form #department').addClass('is-invalid');
                                        $('#add-job-form #department-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'team_id':
                                        $('#add-job-form #team').addClass('is-invalid');
                                        $('#add-job-form #team-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'emp_mainposition_id':
                                        $('#add-job-form #main-position').addClass('is-invalid');
                                        $('#add-job-form #main-position-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'emp_grade_id':
                                        $('#add-job-form #grade').addClass('is-invalid');
                                        $('#add-job-form #grade-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'branch_id':
                                        $('#add-job-form #branch').addClass('is-invalid');
                                        $('#add-job-form #branch-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'start_date':
                                        $('#add-job-form #date-job').addClass('is-invalid');
                                        $('#add-job-form #date-job-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'status':
                                        $('#add-job-form #employment-status').addClass('is-invalid');
                                        $('#add-job-form #employment-status-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'specification':
                                        $('#add-job-form #specification').addClass('is-invalid');
                                        $('#add-job-form #specification-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'status':
                                    $('#add-job-form #status').addClass('is-invalid');
                                    $('#add-job-form #status-error').html('<strong>' + errors[errorField][0] +'</strong>');
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
            $('#edit-job-form #branch').val(currentData.branch_id);
            $('#edit-job-form #main-position').val(currentData.emp_mainposition_id);
            $('#edit-job-form #department').val(currentData.department_id);
            $('#edit-job-form #team').val(currentData.team_id);
            $('#edit-job-form #cost-centre').val(currentData.cost_centre_id);
            $('#edit-job-form #grade').val(currentData.emp_grade_id);
            $('#edit-job-form #altjobDate').val(currentData.start_date);
            $('#edit-job-form #jobDate').val(currentData.start_date);
            $('#edit-job-form #basic-salary').val(currentData.basic_salary);
            $('#edit-job-form #specification').val(currentData.specification);
            $('#edit-job-form #status').val(currentData.status);
        });

        var editRouteTemplate = "{{ route('admin.employees.jobs.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-job-form #edit-job-submit').click(function(e){
            var editRoute = editRouteTemplate.replace(encodeURI('<<id>>'), editId);

            e.preventDefault();
            $.ajax({
                url: editRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#edit-job-form #name').val(),
                    relationship: $('#edit-job-form #relationship').val(),
                    contact_no: $('#edit-job-form #contact-no').val()
                },
                success: function(data) {
                    showAlert(data.success);
                    jobsTable.ajax.reload();
                    $('#edit-job-popup').modal('toggle');
                    clearEmergencyContactModal('#edit-job-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'name':
                                        $('#edit-job-form #name').addClass('is-invalid');
                                        $('#edit-job-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'emp_mainposition_id':
                                        $('#edit-job-form #main-position').addClass('is-invalid');
                                        $('#edit-job-form #main-position-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'department_id':
                                        $('#edit-job-form #department').addClass('is-invalid');
                                        $('#edit-job-form #department-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'team_id':
                                        $('#edit-job-form #team').addClass('is-invalid');
                                        $('#edit-job-form #team-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'cost_centre_id':
                                        $('#edit-job-form #centre').addClass('is-invalid');
                                        $('#edit-job-form #centre-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'emp_grade_id':
                                    $('#edit-job-form #grade').addClass('is-invalid');
                                    $('#edit-job-form #grade-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'start_date':
                                    $('#edit-job-form #jobDate').addClass('is-invalid');
                                    $('#edit-job-form #jobDate-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'basic_salary':
                                    $('#edit-job-form #basic-salary').addClass('is-invalid');
                                    $('#edit-job-form #basic-salary-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'specification':
                                    $('#edit-job-form #specification').addClass('is-invalid');
                                    $('#edit-job-form #specification-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'status':
                                    $('#edit-job-form #status').addClass('is-invalid');
                                    $('#edit-job-form #status-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });
    });

    // DELETE

    // GENERAL FUNCTIONS
    function clearJobModal(htmlId) {
        $(htmlId + ' #basic-salary').val('');
        $(htmlId + ' #cost-centre').val('');
        $(htmlId + ' #department').val('');
        $(htmlId + ' #team').val('');
        $(htmlId + ' #main-position').val('');
        $(htmlId + ' #grade').val('');
        $(htmlId + ' #branch').val('');
        $(htmlId + ' #date-job').val('');
        $(htmlId + ' #employment-status').val('');
        $(htmlId + ' #specification').val('');

        $(htmlId + ' #basic-salary').removeClass('is-invalid');
        $(htmlId + ' #cost-centre').removeClass('is-invalid');
        $(htmlId + ' #department').removeClass('is-invalid');
        $(htmlId + ' #team').removeClass('is-invalid');
        $(htmlId + ' #main-position').removeClass('is-invalid');
        $(htmlId + ' #grade').removeClass('is-invalid');
        $(htmlId + ' #branch').removeClass('is-invalid');
        $(htmlId + ' #date-job').removeClass('is-invalid');
        $(htmlId + ' #employment-status').removeClass('is-invalid');
        $(htmlId + ' #specification').removeClass('is-invalid');
    }

    function clearJobError(htmlId) {
        $(htmlId + ' #basic-salary').removeClass('is-invalid');
        $(htmlId + ' #cost-centre').removeClass('is-invalid');
        $(htmlId + ' #department').removeClass('is-invalid');
        $(htmlId + ' #team').removeClass('is-invalid');
        $(htmlId + ' #main-position').removeClass('is-invalid');
        $(htmlId + ' #grade').removeClass('is-invalid');
        $(htmlId + ' #branch').removeClass('is-invalid');
        $(htmlId + ' #date-job').removeClass('is-invalid');
        $(htmlId + ' #employment-status').removeClass('is-invalid');
        $(htmlId + ' #specification').removeClass('is-invalid');
    }

    function showAlert(message) {
        $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`)
    }

</script>
@append
