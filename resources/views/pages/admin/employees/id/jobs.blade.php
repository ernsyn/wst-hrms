{{-- Table --}}
<div class="tab-pane fade show p-3" id="nav-job" role="tabpanel" aria-labelledby="nav-job-tab">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#add-job-popup">
                        Add Job
                    </button>
            <button type="button" class="btn btn-outline-danger waves-effect" onclick="window.location='{{ url('admin/resign') }}';">
                        Resign
                    </button>
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
                                <input id="basic-salary" type="number" class="form-control" placeholder="" value="" required>
                                {{-- <div class="valid-feedback">
                                Looks good!
                                </div> --}}
                                <div id="basic-salary-error" class="invalid-feedback">
                                
                                </div>
                            </div>
                        </div>
                    {{-- <div class="row form-group">
                        <label class="col-md-8 col-form-label">New Basic Salary*</label>
                        <div class="col-lg-8 col-md-7">
                            <input id="basic_salary" type="number" class="form-control" name="basic_salary"
                                value="" min="0" step=".01" required>
                                <div id="basic-salary-error" class="invalid-feedback">
                            
                                    </div>
                        </div>
                    </div> --}}
                    {{-- <div class="row form-group">
                        <label class="col-md-8 col-form-label">Cost Centre*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('cost_centre') ? ' is-invalid' : '' }}" name="cost_centre" id="cost_centre" required>
                                <option disabled selected>Please Select</option>
                                @foreach(App\CostCentre::all() as $cost_centre)
                                <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div> --}}
                    <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="cost-centre"><strong>Cost Centre*</strong></label>
                                <select class="form-control" id="cost-centre" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\CostCentre::all() as $cost_centre)
                                        <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                        @endforeach
                                      </select>
                                {{-- <div class="valid-feedback">
                                Looks good!
                                </div> --}}
                                <div id="cost-centre-error" class="invalid-feedback">
                                
                                </div>
                            </div>
                        </div>


                    {{-- <div class="row form-group">
                        <label class="col-md-8 col-form-label">Department*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" id="department" required>
                                <option disabled selected>Please Select</option>
                            @foreach(App\Department::all() as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="department"><strong>Department*</strong></label>
                                <select class="form-control" id="department" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\Department::all() as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                      </select>
                                {{-- <div class="valid-feedback">
                                Looks good!
                                </div> --}}
                                <div id="department-error" class="invalid-feedback">
                                
                                </div>
                            </div>
                        </div>

                    {{-- <div class="row form-group">
                        <label class="col-md-8 col-form-label">Team*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('team') ? ' is-invalid' : '' }}" name="team" id="team" required>
                                <option disabled selected>Please Select</option>
                            @foreach(App\Team::all() as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="team"><strong>Team*</strong></label>
                                <select class="form-control" id="team" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\Team::all() as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                      </select>
                                {{-- <div class="valid-feedback">
                                Looks good!
                                </div> --}}
                                <div id="team-error" class="invalid-feedback">
                                
                                </div>
                            </div>
                        </div>

                    {{-- <div class="row form-group">
                        <label class="col-md-8 col-form-label">Position*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" id="position" required>
                                <option disabled selected>Please Select</option>
                            @foreach(App\EmployeePosition::all() as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="main-position"><strong>Main Position*</strong></label>
                                <select class="form-control" id="main-position" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\EmployeePosition::all() as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                      </select>
                                {{-- <div class="valid-feedback">
                                Looks good!
                                </div> --}}
                                <div id="main-position-error" class="invalid-feedback">
                                
                                </div>
                            </div>
                        </div>

                    {{-- <div class="row form-group">
                        <label class="col-md-8 col-form-label">Grade*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('grade') ? ' is-invalid' : '' }}" name="grade" id="grade" required>
                                <option disabled selected>Please Select</option>
                            @foreach(App\EmployeeGrade::all() as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="grade"><strong>Grade*</strong></label>
                                <select class="form-control" id="grade" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\EmployeeGrade::all() as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                      </select>
                                {{-- <div class="valid-feedback">
                                Looks good!
                                </div> --}}
                                <div id="grade-error" class="invalid-feedback">
                                
                                </div>
                            </div>
                        </div>

                    {{-- <div class="row form-group">
                        <label class="col-md-8 col-form-label">Branch*</label>
                        <div class="col-lg-8 col-md-7">
                            <select class="form-control{{ $errors->has('branch') ? ' is-invalid' : '' }}" name="branch" id="branch" required>
                                    <option disabled selected>Please Select</option>
                            @foreach(App\Branch::all() as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="branch"><strong>Branch*</strong></label>
                                <select class="form-control" id="branch" required>
                                        <option disabled selected>Please Select</option>
                                        @foreach(App\Branch::all() as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                      </select>
                                {{-- <div class="valid-feedback">
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

                    {{-- <div class="row form-group">
                        <label class="col-md-10 col-form-label">Employement Status</label>
                        <div class="col-md-7">
                            <select class="form-control" id="emp_status" name="emp_status" required>
                                <option disabled selected>Please Select</option>
                                <option value="Confirmation of Employement">Confirmation of Employement</option>
                                <option value="Confirmation of Promotion">Confirmation of Promotion</option>
                                <option value="Transferred">Transferred</option>
                                <option value="Probationer">Probationer</option>
                           </select>
                        </div>
                    </div> --}}
                    <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="employment-status"><strong>Employment Status*</strong></label>
                                <select class="form-control" id="employment-status" required>
                                        <option disabled selected>Please Select</option>
                                <option value="Confirmation of Employement">Confirmation of Employement</option>
                                <option value="Confirmation of Promotion">Confirmation of Promotion</option>
                                <option value="Transferred">Transferred</option>
                                <option value="Probationer">Probationer</option>
                                      </select>
                                {{-- <div class="valid-feedback">
                                Looks good!
                                </div> --}}
                                <div id="employment-status-error" class="invalid-feedback">
                                
                                </div>
                            </div>
                        </div>

                    {{-- <div class="row form-group">
                        <label class="col-md-7 col-form-label">Remarks</label>
                        <div class="col-md-10">
                            <textarea id="remarks" type="text" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" name="remarks"
                                required>
                            </textarea>
                        </div>
                    </div> --}}
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="specification"><strong>Specification*</strong></label>
                            <textarea id="specification" type="number" class="form-control" placeholder="" value="" required></textarea>
                            {{-- <div class="valid-feedback">
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
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#jobModal"><i class="far fa-edit"></i></button>'
        }
    ]
});

</script>
<script type="text/javascript">
    $(function(){
        // INIT
        $('#jobDate').datepicker({
            altField: "#altjobDate",
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
       $('#edit-emergency-contact-popup').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editId = currentData.id;

            $('#edit-emergency-contact-form #name').val(currentData.name);
            $('#edit-emergency-contact-form #relationship').val(currentData.relationship);
            $('#edit-emergency-contact-form #contact-no').val(currentData.contact_no);
        });
       
       var editRouteTemplate = "{{ route('admin.employees.emergency-contacts.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
       $('#edit-job-form #edit-submit').click(function(e){
           var editRoute = editRouteTemplate.replace(encodeURI('<<id>>'), editId);

          e.preventDefault();
          $.ajax({
            url: editRoute,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: $('#edit-emergency-contact-form #name').val(),
                relationship: $('#edit-emergency-contact-form #relationship').val(),
                contact_no: $('#edit-emergency-contact-form #contact-no').val()
            },
            success: function(data) {
                showAlert(data.success);
                jobsTable.ajax.reload();
                $('#edit-emergency-contact-popup').modal('toggle');
                clearEmergencyContactModal('#edit-emergency-contact-form');
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
                                        $('#edit-emergency-contact-form #name').addClass('is-invalid');
                                        $('#edit-emergency-contact-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'relationship':
                                        $('#edit-emergency-contact-form #relationship').addClass('is-invalid');
                                        $('#edit-emergency-contact-form #relationship-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'contact_no':
                                        $('#edit-emergency-contact-form #contact-no').addClass('is-invalid');
                                        $('#edit-emergency-contact-form #contact-no-error').html('<strong>' + errors[errorField][0] + '</strong>');
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

</script>
@append