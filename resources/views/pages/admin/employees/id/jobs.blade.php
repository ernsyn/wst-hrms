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
    <table class="hrms-primary-data-table table table-bordered table-hover w-100" id="employee-jobs-table">
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
                            <input id="basic-salary" type="number" class="form-control" placeholder="" value="" required>                            {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="basic-salary-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="cost-centre"><strong>Cost Centre*</strong></label>
                            <select class="form-control" id="cost-centre" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\CostCentre::all() as $cost_centre)
                                        <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                        @endforeach
                                      </select> {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="cost-centre-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="department"><strong>Department*</strong></label>
                            <select class="form-control" id="department" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\Department::all() as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                      </select> {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="department-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="team"><strong>Team*</strong></label>
                            <select class="form-control" id="team" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\Team::all() as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                      </select> {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="team-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="main-position"><strong>Main Position*</strong></label>
                            <select class="form-control" id="main-position" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\EmployeePosition::all() as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                      </select> {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="main-position-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="grade"><strong>Grade*</strong></label>
                            <select class="form-control" id="grade" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\EmployeeGrade::all() as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                      </select> {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="grade-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="branch"><strong>Branch*</strong></label>
                            <select class="form-control" id="branch" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\Branch::all() as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                      </select> {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="branch-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-12 col-form-label"><strong>Date*</strong></label>
                        <div class="col-md-7">
                            <input id="jobDate" autocomplete="off" type="text" class="form-control" readonly>
                            <input name="jobDate" id="altjobDate" type="text" class="form-control" hidden>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="status"><strong>Employment Status*</strong></label>
                            <select class="form-control" id="status" required>
                                        <option disabled selected>Please Select</option>
                                <option value="confirmation-of-employment">Confirmation of Employment</option>
                                <option value="confirmation-of-promotion">Confirmation of Promotion</option>
                                <option value="transferred">Transferred</option>
                                <option value="probationer">Probationer</option>
                                      </select> {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="status-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="specification"><strong>Specification*</strong></label>
                            <textarea id="specification" type="number" class="form-control" placeholder="" value="" required></textarea>                            {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="specification-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-submit" type="submit" class="btn btn-primary">
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
                                <option disabled selected>Please Select</option>
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
                                        <option disabled selected>Please Select</option>
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
                                    <option disabled selected>Please Select</option>
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
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\EmployeePosition::all() as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                      </select> {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="main-position-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="grade"><strong>Grade*</strong></label>
                            <select class="form-control" id="grade" required>
                                    <option disabled selected>Please Select</option>
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
                                        <option disabled selected>Please Select</option>
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
                            <input id="jobDate" autocomplete="off" type="text" class="form-control" readonly>
                            <input name="jobDate" id="altjobDate" type="text" class="form-control" hidden>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="status"><strong>Employment Status*</strong></label>
                            <select class="form-control" id="status" required>
                                    <option disabled selected>Please Select</option>
                                    <option value="confirmation-of-employment">Confirmation of Employment</option>
                                    <option value="confirmation-of-promotion">Confirmation of Promotion</option>
                                    <option value="transferred">Transferred</option>
                                    <option value="probationer">Probationer</option>
                                    </select> {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="status-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="specification"><strong>Specification*</strong></label>
                            <textarea id="specification" type="number" class="form-control" placeholder="" value="" required></textarea>                            {{--
                            <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div id="specification-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>



@section('scripts')
<script type="text/javascript">
    $(function(){
        // INIT
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
            "data": null,
            render: function (data, type, row, meta) {
                switch(row.status) {
                case 'confirmation-of-employment':
                    return 'Confirmation of Employment';
                case 'confirmation-of-promotion':
                    return 'Confirmation of Promotion';
                case 'transferred':
                    return 'Transferred';
                case 'probationer':
                    return 'Probationer';
                } 
            }
        },        
        // {
        //     "data": null, // can be null or undefined
        //     "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#jobModal"><i class="far fa-edit"></i></button>'
        // },
        {
            "data": null, // can be null or undefined
            render: function (data, type, row, meta) {
                return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-job-popup"><i class="far fa-edit"></i></button>`;
            }
        }
    ]
});

        $('#add-job-form #jobDate').datepicker({
            altField: "#add-job-form #altjobDate",
            altFormat: 'yy-mm-dd',
            format: 'dd/mm/yy'
        });

        $('#edit-job-form #jobDate').datepicker({
            altField: "#edit-job-form #altjobDate",
            altFormat: 'yy-mm-dd',
            format: 'dd/mm/yy'
        });


        // ADD
       $('#add-job-form #add-submit').click(function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('admin.employees.jobs.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                branch_id: $('#add-job-form #branch').val(),
                emp_mainposition_id: $('#add-job-form #main-position').val(),
                department_id: $('#add-job-form #department').val(),
                team_id: $('#add-job-form #team').val(),
                cost_centre_id: $('#add-job-form #cost-centre').val(),
                emp_grade_id: $('#add-job-form #grade').val(),
                start_date: $('#add-job-form #altjobDate').val(),
                basic_salary: $('#add-job-form #basic-salary').val(),
                specification: $('#add-job-form #specification').val(),
                status: $('#add-job-form #status').val(),
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
                                    case 'name':
                                        $('#add-job-form #name').addClass('is-invalid');
                                        $('#add-job-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'emp_mainposition_id':     
                                        $('#add-job-form #main-position').addClass('is-invalid');   
                                        $('#add-job-form #main-position-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'department_id':    
                                        $('#add-job-form #department').addClass('is-invalid');   
                                        $('#add-job-form #department-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'team_id':     
                                        $('#add-job-form #team').addClass('is-invalid');   
                                        $('#add-job-form #team-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'cost_centre_id':     
                                        $('#add-job-form #centre').addClass('is-invalid');   
                                        $('#add-job-form #centre-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'emp_grade_id':     
                                    $('#add-job-form #grade').addClass('is-invalid');   
                                    $('#add-job-form #grade-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'start_date':     
                                    $('#add-job-form #jobDate').addClass('is-invalid');   
                                    $('#add-job-form #jobDate-error').html('<strong>' + errors[errorField][0] +'</strong>');
                                    break;
                                    case 'basic_salary':     
                                    $('#add-job-form #basic-salary').addClass('is-invalid');   
                                    $('#add-job-form #basic-salary-error').html('<strong>' + errors[errorField][0] +'</strong>');
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
            clearEmergencyContactError('#edit-job-form');
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
         $('#edit-job-form #edit-submit').click(function(e){
            var editRoute = editRouteTemplate.replace(encodeURI('<<id>>'), editId);
          e.preventDefault();
          $.ajax({
            url: editRoute,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                branch_id: $('#edit-job-form #branch').val(),
                emp_mainposition_id: $('#edit-job-form #main-position').val(),
                department_id: $('#edit-job-form #department').val(),
                team_id: $('#edit-job-form #team').val(),
                cost_centre_id: $('#edit-job-form #cost-centre').val(),
                emp_grade_id: $('#edit-job-form #grade').val(),
                start_date: $('#edit-job-form #altjobDate').val(),
                basic_salary: $('#edit-job-form #basic-salary').val(),
                specification: $('#edit-job-form #specification').val(),
                status: $('#edit-job-form #status').val(),
            },
            success: function(data) {
                showAlert(data.success);
                jobsTable.ajax.reload();
                $('#edit-job-popup').modal('toggle');
                clearJobModal('#edit-job-form');
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

    // DELETE

    // GENERAL FUNCTIONS
    function clearJobModal(htmlId) {
        // $(htmlId + ' #name').val('');
        // $(htmlId + ' #relationship').val('');
        // $(htmlId + ' #contact-no').val('');

        // $(htmlId + ' #name').removeClass('is-invalid');
        // $(htmlId + ' #relationship').removeClass('is-invalid');
        // $(htmlId + ' #contact-no').removeClass('is-invalid');
    }

    function showAlert(message) {
        $('#alert-container').html(`<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span id="alert-message">${message}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`)
    }
});

</script>
@append