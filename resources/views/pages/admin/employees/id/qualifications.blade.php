<!-- ADD EXPERIENCES -->
<div class="modal fade" id="add-experiences-popup" tabindex="-1" role="dialog" aria-labelledby="add-experiences-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-experiences-label">Add Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-experiences-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="company"><strong>Company*</strong></label>
                            <input id="company" type="text" class="form-control" placeholder="" value="" required>
                            <div id="company-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="position"><strong>Position*</strong></label>
                            <input id="position" type="text" class="form-control" placeholder="" value="" required>
                            <div id="position-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="start-date"><strong>Start Date*</strong></label>
                            <input id="start-date" type="text" class="form-control" placeholder="" value="" required>
                            <div id="start-date-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="end-date"><strong>End Date*</strong></label>
                            <input id="end-date" type="text" class="form-control" placeholder="" value="" required>
                            <div id="end-date-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="notes"><strong>Notes*</strong></label>
                            <input id="notes" type="text" class="form-control" placeholder="" value="" required>
                            <div id="notes-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-experiences-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ADD EDUCATION -->
<div class="modal fade" id="add-education-popup" tabindex="-1" role="dialog" aria-labelledby="add-education-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-education-label">Add Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-education-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="institution"><strong>Institution*</strong></label>
                            <input id="institution" type="text" class="form-control" placeholder="" value="" required>
                            <div id="institution-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="start-year"><strong>Start Year*</strong></label>
                            <input id="start-year" type="text" class="form-control" placeholder="" value="" required>
                            <div id="start-year-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="end-year"><strong>End Year*</strong></label>
                            <input id="end-year" type="text" class="form-control" placeholder="" value="" required>
                            <div id="end-year-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="level"><strong>Level*</strong></label>
                            <input id="level" type="text" class="form-control" placeholder="" value="" required>
                            <div id="level-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="major"><strong>Major*</strong></label>
                            <input id="major" type="text" class="form-control" placeholder="" value="" required>
                            <div id="major-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="gpa"><strong>Gpa*</strong></label>
                            <input id="gpa" type="text" class="form-control" placeholder="" value="" required>
                            <div id="gpa-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="description"><strong>Description*</strong></label>
                            <input id="description" type="text" class="form-control" placeholder="" value="" required>
                            <div id="description-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-education-submit" type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ADD SKILL -->
<div class="modal fade" id="add-skill-popup" tabindex="-1" role="dialog" aria-labelledby="add-skill-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-skill-label">Add Skill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form id="add-skill-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Skill Name*</strong></label>
                            <input id="name" type="text" class="form-control" placeholder="" value="" required>
                            <div id="name-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Year Experience*</strong></label>
                            <input id="years-of-experience" type="text" class="form-control" placeholder="" value="" required>
                            <div id="years-of-experience-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Competency*</strong></label>
                            <select id="competency" type="text" class="form-control" placeholder="" value="" required>
                                <option value="">Select Competency</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                            <div id="competency-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-skill-submit" type="submit" class="btn btn-primary">
                {{ __('Submit') }}
            </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- UPDATE EXPERIENCES -->
<div class="modal fade" id="updateexperiencesPopup" tabindex="-1" role="dialog" aria-labelledby="updateexperiencesLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateexperiencesLabel">Edit Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.companies.edit.post', ['emp_id' => $id, 'id' => 1]) }}" id="edit_qualification_experiences">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="comp_id" name="comp_id" type="hidden">
                            <label class="col-md-5 col-form-label">experiences*</label>
                            <div class="col-md-7">
                                <input id="previous_experiences" name="previous_experiences" type="text" class="form-control{{ $errors->has('previous_experiences') ? ' is-invalid' : '' }}"
                                    value="{{ old('previous_experiences') }}" required> @if ($errors->has('previous_experiences'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('previous_experiences') }}</strong>
                                </span> @endif
                            </div>
                            <label class="col-md-2 col-form-label">Position*</label>
                            <div class="col-md-10">
                                <input id="previous_position" type="text" class="form-control{{ $errors->has('previous_position') ? ' is-invalid' : '' }}"
                                    placeholder="etc" name="previous_position" value="{{ old('previous_position') }}" required>                                @if ($errors->has('previous_position'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('previous_position') }}</strong>
                                </span> @endif
                            </div>
                            <label class="col-md-5 col-form-label">Start Date*</label>
                            <div class="col-md-7">
                                <input id="dobDate" autocomplete="off" type="text" class="form-control">
                                <input name="start_date" id="altdobDate" type="text" class="form-control" hidden>
                            </div>
                            <label class="col-md-5 col-form-label">End Date*</label>
                            <div class="col-md-7">
                                <input id="licenseExpiryDate" autocomplete="off" type="text" class="form-control">
                                <input name="end_date" id="altlicenseExpiryDate" type="text" class="form-control" hidden>
                            </div>
                            <label class="col-md-5 col-form-label">Note</label>
                            <div class="col-md-10">
                                <textarea name="note" id="note" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- UPDATE EDUCATION -->
<div class="modal fade" id="edit-education-popup" tabindex="-1" role="dialog" aria-labelledby="edit-education-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-education-label">Add Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="edit-education-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="institution"><strong>Institution*</strong></label>
                            <input id="institution" type="text" class="form-control" placeholder="" value="" required>
                            <div id="institution-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="start-year"><strong>Start Year*</strong></label>
                            <input id="start-year" type="text" class="form-control" placeholder="" value="" required>
                            <div id="start-year-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="end-year"><strong>End Year*</strong></label>
                            <input id="end-year" type="text" class="form-control" placeholder="" value="" required>
                            <div id="end-year-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="level"><strong>Level*</strong></label>
                            <input id="level" type="text" class="form-control" placeholder="" value="" required>
                            <div id="level-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="major"><strong>Major*</strong></label>
                            <input id="major" type="text" class="form-control" placeholder="" value="" required>
                            <div id="major-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="gpa"><strong>Gpa*</strong></label>
                            <input id="gpa" type="text" class="form-control" placeholder="" value="" required>
                            <div id="gpa-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="description"><strong>Description*</strong></label>
                            <input id="description" type="text" class="form-control" placeholder="" value="" required>
                            <div id="description-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-education-submit" type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- UPDATE SKILLS -->
<div class="modal fade" id="edit-skill-popup" tabindex="-1" role="dialog" aria-labelledby="edit-skill-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-skill-label">Edit Skill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-skill-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Skill Name*</strong></label>
                            <input id="name" type="text" class="form-control" placeholder="" value="" required>
                            <div id="name-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Year Experience*</strong></label>
                            <input id="years-of-experience" type="text" class="form-control" placeholder="" value="" required>
                            <div id="years-of-experience-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Competency*</strong></label>
                            <select id="competency" type="text" class="form-control" placeholder="" value="" required>
                                    <option value="">Select Competency</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            <div id="competency-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-skill-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DELETE EXP--}}
<div class="modal fade" id="confirm-delete-experiences-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-experiences-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-experiences-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-experiences-submit">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- DELETE EDU--}}
<div class="modal fade" id="confirm-delete-educations-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-educations-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-educations-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-educations-submit">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- TABLE SKILL--}}
<div class="tab-pane fade show p-3" id="nav-qualification" role="tabpanel" aria-labelledby="nav-qualification-tab">
    {{-- Experiences Table--}}
    <div class="row pb-3">
        <div class="col-auto mr-auto">EXPERIENCE</div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-experiences-popup">
                Add Experience
            </button>
        </div>
    </div>
    <table class="table table-bordered table-hover w-100" id="employee-companies-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Company</th>
                <th>Position</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    <div class="dropdown-divider pb-3"></div>
    {{-- Education Table--}}
    <div class="row pb-3">
        <div class="col-auto mr-auto">EDUCATION</div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-education-popup">
                        Add Education
                    </button>
        </div>
    </div>
    <table class="table table-bordered table-hover w-100" id="employee-education-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Institution</th>
                <th>Start Year</th>
                <th>End Year</th>
                <th>Level</th>
                <th>Major</th>
                <th>GPA</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    <div class="dropdown-divider pb-3"></div>
    {{-- Skill Table--}}
    <div class="row pb-3">
        <div class="col-auto mr-auto">SKILL</div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-skill-popup">
                    Add Skill
                </button>
        </div>
    </div>
    <table class="table table-bordered table-hover w-100 text-capitalize" id="employee-skill-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Skill Name</th>
                <th>Year Experience</th>
                <th>Competency</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>





@section('scripts')
<script>
    var experiencesTable = $('#employee-companies-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('admin.employees.dt.experiences', ['id' => $id]) }}",
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "company"
            },
            {
                "data": "position"
            },
            {
                "data": "start_date"
            },
            {
                "data": "end_date"
            },
            {
                "data": "notes"
            },
            {
                "data": null,
                render: function (data, type, row, meta) {
                    return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-skill-popup"><i class="far fa-edit"></i></button>` +
                        `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-experiences-modal"><i class="far fa-trash-alt"></i></button>`;
                }
            }
        ]
    });
var educationsTable = $('#employee-education-table').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "{{ route('admin.employees.dt.education', ['id' => $id]) }}",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "institution"
        },
        {
            "data": "start_year"
        },
        {
            "data": "end_year"
        },
        {
            "data": "level"
        },
        {
            "data": "major"
        },
        {
            "data": "gpa"
        },
        {
            "data": "description"
        },
        {
            "data": null,
            render: function (data, type, row, meta) {
                return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-education-popup"><i class="far fa-edit"></i></button>` +
                    `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-educations-modal"><i class="far fa-trash-alt"></i></button>`;
            }
        }
    ]
});
var skillsTable = $('#employee-skill-table').DataTable({
    "bInfo": true,
    "bDeferRender": true,
    "serverSide": true,
    "bStateSave": true,
    "ajax": "{{ route('admin.employees.dt.skills', ['id' => $id]) }}",
    "columns": [{
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "name"
        },
        {
            "data": "years_of_experience"
        },
        {
            "data": "competency"
        },
        {
            "data": null,
            render: function (data, type, row, meta) {
                return `<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-skill-popup"><i class="far fa-edit"></i></button>` +
                    `<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-skills-modal"><i class="far fa-trash-alt"></i></button>`;
            }
        }
    ]
});

</script>

{{-- EXPERIENCES --}}
<script type="text/javascript">
    $(function(){
        // ADD EXPERIENCES
        $('#add-experiences-form #add-experiences-submit').click(function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('admin.employees.companies.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                // Form Data
                company: $('#add-experiences-form #company').val(),
                position: $('#add-experiences-form #position').val(),
                start_date: $('#add-experiences-form #start-date').val(),
                end_date: $('#add-experiences-form #end-date').val(),
                notes: $('#add-experiences-form #notes').val()
            },
            success: function(data) {
                showAlert(data.success);
                experiencesTable.ajax.reload();
                $('#add-experiences-popup').modal('toggle');
                clearExperiencesModal('#add-experiences-form');
            },
            error: function(xhr) {
                if(xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'company':
                                        $('#add-experiences-form #company').addClass('is-invalid');
                                        $('#add-experiences-form #company-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'position':
                                        $('#add-experiences-form #position').addClass('is-invalid');
                                        $('#add-experiences-form #position-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'start_date':
                                        $('#add-experiences-form #start-date').addClass('is-invalid');
                                        $('#add-experiences-form #start-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'end_date':
                                        $('#add-experiences-form #end-date').addClass('is-invalid');
                                        $('#add-experiences-form #end-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'notes':
                                        $('#add-experiences-form #notes').addClass('is-invalid');
                                        $('#add-experiences-form #notes-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // EDIT SKILLS
        // var editSkillId = null;
        // // Function: On Modal Clicked Handler
        // $('#edit-skill-popup').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget) // Button that triggered the modal
        //     var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
        //     console.log('Data: ', currentData)

        //     editSkillId = currentData.id;

        //     $('#edit-skill-form #name').val(currentData.name);
        //     $('#edit-skill-form #years-of-experience').val(currentData.years_of_experience);
        //     $('#edit-skill-form #competency').val(currentData.contact_no);
        // });

        // var editSkillRouteTemplate = "{{ route('admin.employees.skills.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        // $('#edit-skill-submit').click(function(e){
        //     var editSkillRoute = editSkillRouteTemplate.replace(encodeURI('<<id>>'), editSkillId);
        //     e.preventDefault();
        //     $.ajax({
        //         url: editSkillRoute,
        //         type: 'POST',
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             name: $('#edit-skill-form #name').val(),
        //             years_of_experience: $('#edit-skill-form #years-of-experience').val(),
        //             contact_no: $('#edit-skill-form #competency').val()
        //         },
        //         success: function(data) {
        //             showAlert(data.success);
        //             skillsTable.ajax.reload();
        //             $('#edit-skill-popup').modal('toggle');
        //             clearSkillsModal('#edit-skill-form');
        //         },
        //         error: function(xhr) {
        //             if(xhr.status == 422) {
        //                 var errors = xhr.responseJSON.errors;
        //                 console.log("Error: ", xhr);
        //                 for (var errorField in errors) {
        //                     if (errors.hasOwnProperty(errorField)) {
        //                         console.log("Error: ", errorField);
        //                         switch(errorField) {
        //                             case 'name':
        //                                 $('#edit-skill-form #name').addClass('is-invalid');
        //                                 $('#edit-skill-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
        //                             break;
        //                             case 'years_of_experience':
        //                                 $('#edit-skill-form #years-of-experience').addClass('is-invalid');
        //                                 $('#edit-skill-form #years-of-experience-error').html('<strong>' + errors[errorField][0] + "</strong>");
        //                             break;
        //                             case 'contact_no':
        //                                 $('#edit-skill-form #competency').addClass('is-invalid');
        //                                 $('#edit-skill-form #competency-error').html('<strong>' + errors[errorField][0] + '</strong>');
        //                             break;
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     });
        // });

        // DELETE EXPERIENCE
        var deleteExperienceId = null;
        // Function: On Modal Clicked Handler
        $('#confirm-delete-experiences-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            deleteExperienceId = currentData.id;
        });

        var deleteExperienceRouteTemplate = "{{ route('admin.settings.skills.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-experiences-submit').click(function(e){
            var deleteExperienceRoute = deleteExperienceRouteTemplate.replace(encodeURI('<<id>>'), deleteExperienceId);
            e.preventDefault();
            $.ajax({
                url: deleteExperienceRoute,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: deleteExperienceId
                },
                success: function(data) {
                    showAlert(data.success);
                    experiencesTable.ajax.reload();
                    $('#confirm-delete-experiences-modal').modal('toggle');
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
    });


    // GENERAL FUNCTIONS
    function clearExperiencesModal(htmlId) {
        $(htmlId + ' #company').val('');
        $(htmlId + ' #position').val('');
        $(htmlId + ' #start-date').val('');
        $(htmlId + ' #end-date').val('');
        $(htmlId + ' #notes').val('');

        $(htmlId + ' #company').removeClass('is-invalid');
        $(htmlId + ' #position').removeClass('is-invalid');
        $(htmlId + ' #start-date').removeClass('is-invalid');
        $(htmlId + ' #end-date').removeClass('is-invalid');
        $(htmlId + ' #notes').removeClass('is-invalid');
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

{{-- EDUCATION --}}
<script type="text/javascript">
    $(function(){
        // ADD EDUCATION
        $('#add-education-form #add-education-submit').click(function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('admin.employees.educations.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                // Form Data
                institution: $('#add-education-form #institution').val(),
                start_year: $('#add-education-form #start-year').val(),
                end_year: $('#add-education-form #end-year').val(),
                level: $('#add-education-form #level').val(),
                major: $('#add-education-form #major').val(),
                gpa: $('#add-education-form #gpa').val(),
                description: $('#add-education-form #description').val()
            },
            success: function(data) {
                showAlert(data.success);
                educationsTable.ajax.reload();
                $('#add-education-popup').modal('toggle');
                clearEducationsModal('#add-education-form');
            },
            error: function(xhr) {
                if(xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'institution':
                                        $('#add-education-form #institution').addClass('is-invalid');
                                        $('#add-education-form #institution-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'start_year':
                                        $('#add-education-form #start-year').addClass('is-invalid');
                                        $('#add-education-form #start-year-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'end_year':
                                        $('#add-education-form #end-year').addClass('is-invalid');
                                        $('#add-education-form #end-year-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'level':
                                        $('#add-education-form #level').addClass('is-invalid');
                                        $('#add-education-form #level-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'major':
                                        $('#add-education-form #major').addClass('is-invalid');
                                        $('#add-education-form #major-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'gpa':
                                        $('#add-education-form #gpa').addClass('is-invalid');
                                        $('#add-education-form #gpa-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'description':
                                        $('#add-education-form #description').addClass('is-invalid');
                                        $('#add-education-form #description-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // EDIT EDUCATION
        var editEducationId = null;
        // Function: On Modal Clicked Handler
        $('#edit-education-popup').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editEducationId = currentData.id;

            $('#edit-education-form #institution').val(currentData.institution);
            $('#edit-education-form #start-year').val(currentData.start_year);
            $('#edit-education-form #end-year').val(currentData.end_year);
            $('#edit-education-form #level').val(currentData.level);
            $('#edit-education-form #major').val(currentData.major);
            $('#edit-education-form #gpa').val(currentData.gpa);
            $('#edit-education-form #description').val(currentData.description);
        });

        var editEducationRouteTemplate = "{{ route('admin.employees.educations.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-education-submit').click(function(e){
            var editEducationRoute = editEducationRouteTemplate.replace(encodeURI('<<id>>'), editEducationId);
            e.preventDefault();
            $.ajax({
                url: editEducationRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    institution: $('#edit-education-form #institution').val(),
                    start_year: $('#edit-education-form #start-year').val(),
                    end_year: $('#edit-education-form #end-year').val(),
                    level: $('#edit-education-form #level').val(),
                    major: $('#edit-education-form #major').val(),
                    gpa: $('#edit-education-form #gpa').val(),
                    description: $('#edit-education-form #description').val()
                },
                success: function(data) {
                    showAlert(data.success);
                    educationsTable.ajax.reload();
                    $('#edit-education-popup').modal('toggle');
                    clearEducationsModal('#edit-education-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'institution':
                                        $('#edit-education-form #institution').addClass('is-invalid');
                                        $('#edit-education-form #institution-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'start_year':
                                        $('#edit-education-form #start-year').addClass('is-invalid');
                                        $('#edit-education-form #start-year-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'end_year':
                                        $('#edit-education-form #end-year').addClass('is-invalid');
                                        $('#edit-education-form #end-year-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'level':
                                        $('#edit-education-form #level').addClass('is-invalid');
                                        $('#edit-education-form #level-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'major':
                                        $('#edit-education-form #major').addClass('is-invalid');
                                        $('#edit-education-form #major-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'gpa':
                                        $('#edit-education-form #gpa').addClass('is-invalid');
                                        $('#edit-education-form #gpa-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'description':
                                        $('#edit-education-form #description').addClass('is-invalid');
                                        $('#edit-education-form #description-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // DELETE SKILLS
        var deleteEducationId = null;
        // Function: On Modal Clicked Handler
        $('#confirm-delete-educations-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            deleteEducationId = currentData.id;
        });

        var deleteEducationRouteTemplate = "{{ route('admin.settings.educations.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-educations-submit').click(function(e){
            var deleteEducationRoute = deleteEducationRouteTemplate.replace(encodeURI('<<id>>'), deleteEducationId);
            e.preventDefault();
            $.ajax({
                url: deleteEducationRoute,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: deleteEducationId
                },
                success: function(data) {
                    showAlert(data.success);
                    educationsTable.ajax.reload();
                    $('#confirm-delete-educations-modal').modal('toggle');
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
    });


    // GENERAL FUNCTIONS
    function clearEducationsModal(htmlId) {
        $(htmlId + ' #institution').val('');
        $(htmlId + ' #start-year').val('');
        $(htmlId + ' #end-year').val('');
        $(htmlId + ' #level').val('');
        $(htmlId + ' #major').val('');
        $(htmlId + ' #gpa').val('');
        $(htmlId + ' #description').val('');

        $(htmlId + ' #institution').removeClass('is-invalid');
        $(htmlId + ' #start-year').removeClass('is-invalid');
        $(htmlId + ' #end-year').removeClass('is-invalid');
        $(htmlId + ' #level').removeClass('is-invalid');
        $(htmlId + ' #major').removeClass('is-invalid');
        $(htmlId + ' #gpa').removeClass('is-invalid');
        $(htmlId + ' #description').removeClass('is-invalid');
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


{{-- SKILLS --}}
<script type="text/javascript">
    $(function(){
        // ADD SKILLS
       $('#add-skill-form #add-skill-submit').click(function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('admin.employees.skills.post', ['id' => $id]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                // Form Data
                name: $('#add-skill-form #name').val(),
                years_of_experience: $('#add-skill-form #years-of-experience').val(),
                competency: $('#add-skill-form #competency').val()
            },
            success: function(data) {
                showAlert(data.success);
                skillsTable.ajax.reload();
                $('#add-skill-popup').modal('toggle');
                clearSkillsModal('#add-skill-form');
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
                                        $('#add-skill-form #name').addClass('is-invalid');
                                        $('#add-skill-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'years_of_experience':
                                        $('#add-skill-form #years-of-experience').addClass('is-invalid');
                                        $('#add-skill-form #years-of-experience-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'competency':
                                        $('#add-skill-form #competency').addClass('is-invalid');
                                        $('#add-skill-form #competency-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });


        // EDIT SKILLS
        var editSkillId = null;
        // Function: On Modal Clicked Handler
        $('#edit-skill-popup').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editSkillId = currentData.id;

            $('#edit-skill-form #name').val(currentData.name);
            $('#edit-skill-form #years-of-experience').val(currentData.years_of_experience);
            $('#edit-skill-form #competency').val(currentData.competency);
        });

        var editSkillRouteTemplate = "{{ route('admin.employees.skills.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-skill-submit').click(function(e){
            var editSkillRoute = editSkillRouteTemplate.replace(encodeURI('<<id>>'), editSkillId);
            e.preventDefault();
            $.ajax({
                url: editSkillRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#edit-skill-form #name').val(),
                    years_of_experience: $('#edit-skill-form #years-of-experience').val(),
                    competency: $('#edit-skill-form #competency').val()
                },
                success: function(data) {
                    showAlert(data.success);
                    skillsTable.ajax.reload();
                    $('#edit-skill-popup').modal('toggle');
                    clearSkillsModal('#edit-skill-form');
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
                                        $('#edit-skill-form #name').addClass('is-invalid');
                                        $('#edit-skill-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'years_of_experience':
                                        $('#edit-skill-form #years-of-experience').addClass('is-invalid');
                                        $('#edit-skill-form #years-of-experience-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'competency':
                                        $('#edit-skill-form #competency').addClass('is-invalid');
                                        $('#edit-skill-form #competency-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // DELETE SKILLS
        var deleteSkillId = null;
        // Function: On Modal Clicked Handler
        $('#confirm-delete-skills-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            deleteSkillId = currentData.id;
        });

        var deleteSkillRouteTemplate = "{{ route('admin.settings.skills.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-skills-submit').click(function(e){
            var deleteSkillRoute = deleteSkillRouteTemplate.replace(encodeURI('<<id>>'), deleteSkillId);
            e.preventDefault();
            $.ajax({
                url: deleteSkillRoute,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: deleteSkillId
                },
                success: function(data) {
                    showAlert(data.success);
                    skillsTable.ajax.reload();
                    $('#confirm-delete-skills-modal').modal('toggle');
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
    });


    // GENERAL FUNCTIONS
    function clearSkillsModal(htmlId) {
        $(htmlId + ' #name').val('');
        $(htmlId + ' #years-of-experience').val('');
        $(htmlId + ' #competency').val('');

        $(htmlId + ' #name').removeClass('is-invalid');
        $(htmlId + ' #years-of-experience').removeClass('is-invalid');
        $(htmlId + ' #competency').removeClass('is-invalid');
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
