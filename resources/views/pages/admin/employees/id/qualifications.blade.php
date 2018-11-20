<!-- ADD EXPERIENCES -->
<div class="modal fade" id="addCompanyPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.companies.post', ['id' => $id]) }}" id="add_qualification_experience">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Company*</label>
                            <div class="col-md-10">
                                <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}"
                                    placeholder="company name" name="company" value="{{ old('company') }}" required>
                                @if ($errors->has('company'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Position*</label>
                            <div class="col-md-10">
                                <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}"
                                    placeholder="Farther, Son, etc" name="position" value="{{ old('position') }}"
                                    required>
                                @if ($errors->has('position'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('position') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Start Date*</label>
                            <div class="col-md-7">
                                <input id="dobDate" autocomplete="off" type="text" class="form-control">
                                <input name="start_date" id="altdobDate" type="text" class="form-control" hidden>
                            </div>
                            <label class="col-md-5 col-form-label">End Date*</label>
                            <div class="col-md-7">
                                <input id="licenseExpiryDate" autocomplete="off" type="text" class="form-control">
                                <input name="end_date" id="altlicenseExpiryDate" type="text" class="form-control"
                                    hidden>
                            </div>
                            <label class="col-md-5 col-form-label">Note</label>
                            <div class="col-md-10">
                                <textarea name="notes" class="form-control"></textarea>
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

<!-- ADD EDUCATION -->
<div class="modal fade" id="addEducationPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.education.post', ['id' => $id]) }}" id="add_qualification_education">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Degree*</label>
                            <div class="col-md-10">
                                <input id="level" type="text" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}"
                                    placeholder="Degree name" name="level" value="{{ old('level') }}" required>
                                @if ($errors->has('level'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('level') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Field of Study*</label>
                            <div class="col-md-10">
                                <input id="major" type="text" class="form-control{{ $errors->has('major') ? ' is-invalid' : '' }}"
                                    placeholder="etc" name="major" value="{{ old('major') }}" required>
                                @if ($errors->has('major'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('major') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Start Year*</label>
                            <div class="col-md-7">
                                <input id="startYear" name="start_year" autocomplete="off" type="text" class="form-control">
                                <input id="altStartYear" type="text" class="form-control" hidden>
                            </div>
                            <label class="col-md-5 col-form-label">End Date*</label>
                            <div class="col-md-7">
                                <input id="endYear" name="end_year" autocomplete="off" type="text" class="form-control">
                                <input id="altEndYear" type="text" class="form-control" hidden>
                            </div>
                            <label class="col-md-2 col-form-label">GPA*</label>
                            <div class="col-md-10">
                                <input id="gpa" type="number" min="0" max="4" class="form-control{{ $errors->has('gpa') ? ' is-invalid' : '' }}"
                                    placeholder="etc" name="gpa" value="{{ old('gpa') }}" required>
                                @if ($errors->has('gpa'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gpa') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">School*</label>
                            <div class="col-md-10">
                                <input id="school" type="text" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}"
                                    placeholder="etc" name="school" value="{{ old('school') }}" required>
                                @if ($errors->has('school'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('school') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Description</label>
                            <div class="col-md-10">
                                <textarea name="description" class="form-control"></textarea>
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

<!-- ADD SKILLS -->
<div class="modal fade" id="addSkillsPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Skills</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.skills.post', ['id' => $id]) }}" id="add_qualification_skills">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Skill Name*</label>
                            <div class="col-md-10">
                                <input id="skills" type="text" class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}"
                                    name="skills" value="{{ old('skills') }}" required>
                                @if ($errors->has('skills'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('skills') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Year Experience*</label>
                            <div class="col-md-10">
                                <input id="year_experience" type="text" class="form-control{{ $errors->has('year_experience') ? ' is-invalid' : '' }}"
                                    name="year_experience" value="{{ old('year_experience') }}" required>
                                @if ($errors->has('year_experience'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('year_experience') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Competency</label>
                            <div class="col-md-10">
                                <select name="competency" id="competency" class="form-control">
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>
                                </select>
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

<!-- UPDATE EXPERIENCES -->
<div class="modal fade" id="updateCompanyPopup" tabindex="-1" role="dialog" aria-labelledby="updateCompanyLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCompanyLabel">Edit Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.companies.edit', ['emp_id' => $id, 'id' => 1]) }}" id="edit_qualification_company">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="comp_id" name="comp_id" type="hidden">
                            <label class="col-md-5 col-form-label">Company*</label>
                            <div class="col-md-7">
                                <input id="previous_company" name="previous_company" type="text" class="form-control{{ $errors->has('previous_company') ? ' is-invalid' : '' }}"
                                    value="{{ old('previous_company') }}" required>
                                @if ($errors->has('previous_company'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('previous_company') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Position*</label>
                            <div class="col-md-10">
                                <input id="previous_position" type="text" class="form-control{{ $errors->has('previous_position') ? ' is-invalid' : '' }}"
                                    placeholder="etc" name="previous_position" value="{{ old('previous_position') }}"
                                    required>
                                @if ($errors->has('previous_position'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('previous_position') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Start Date*</label>
                            <div class="col-md-7">
                                <input id="dobDate" autocomplete="off" type="text" class="form-control">
                                <input name="start_date" id="altdobDate" type="text" class="form-control" hidden>
                            </div>
                            <label class="col-md-5 col-form-label">End Date*</label>
                            <div class="col-md-7">
                                <input id="licenseExpiryDate" autocomplete="off" type="text" class="form-control">
                                <input name="end_date" id="altlicenseExpiryDate" type="text" class="form-control"
                                    hidden>
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
<div class="modal fade" id="updateEducationPopup" tabindex="-1" role="dialog" aria-labelledby="updateEducationLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateEducationLabel">Update Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.education.edit', ['emp_id' => $id, 'id' => 1]) }}" id="update_qualification_education">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="edu_id" name="edu_id" type="hidden">
                            <label class="col-md-5 col-form-label">Degree*</label>
                            <div class="col-md-10">
                                <input id="level" type="text" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}"
                                    placeholder="Degree name" name="level" value="{{ old('level') }}" required>
                                @if ($errors->has('level'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('level') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Field of Study*</label>
                            <div class="col-md-10">
                                <input id="major" type="text" class="form-control{{ $errors->has('major') ? ' is-invalid' : '' }}"
                                    placeholder="etc" name="major" value="{{ old('major') }}" required>
                                @if ($errors->has('major'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('major') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Start Year*</label>
                            <div class="col-md-7">
                                <input id="startYear" name="start_year" autocomplete="off" type="text" class="form-control">
                                <input id="altStartYear" type="text" class="form-control" hidden>
                            </div>
                            <label class="col-md-5 col-form-label">End Date*</label>
                            <div class="col-md-7">
                                <input id="endYear" name="end_year" autocomplete="off" type="text" class="form-control">
                                <input id="altEndYear" type="text" class="form-control" hidden>
                            </div>
                            <label class="col-md-2 col-form-label">GPA*</label>
                            <div class="col-md-10">
                                <input id="gpa" type="number" min="0" max="4" class="form-control{{ $errors->has('gpa') ? ' is-invalid' : '' }}"
                                    placeholder="etc" name="gpa" value="{{ old('gpa') }}" required>
                                @if ($errors->has('gpa'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gpa') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">School*</label>
                            <div class="col-md-10">
                                <input id="school" type="text" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}"
                                    placeholder="etc" name="school" value="{{ old('school') }}" required>
                                @if ($errors->has('school'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('school') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-5 col-form-label">Description</label>
                            <div class="col-md-10">
                                <textarea name="description" id="description" class="form-control"></textarea>
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

<!-- UPDATE SKILLS -->
<div class="modal fade" id="updateSkillsPopup" tabindex="-1" role="dialog" aria-labelledby="updateSkillsLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateSkillsLabel">Edit Skills</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.employees.immigrations.edit', ['emp_id' => $id, 'id' => 1]) }}" id="edit_qualification_skills">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="skill_id" name="skill_id" type="hidden">
                            <label class="col-md-5 col-form-label">Skill Name*</label>
                            <div class="col-md-10">
                                <input id="emp_skill" type="text" class="form-control{{ $errors->has('emp_skill') ? ' is-invalid' : '' }}"
                                    name="emp_skill" value="{{ old('emp_skill') }}" required>
                                @if ($errors->has('emp_skill'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('emp_skill') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Year Experience*</label>
                            <div class="col-md-10">
                                <input id="year_experience" type="text" class="form-control{{ $errors->has('year_experience') ? ' is-invalid' : '' }}"
                                    name="year_experience" value="{{ old('year_experience') }}" required>
                                @if ($errors->has('year_experience'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('year_experience') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="col-md-2 col-form-label">Competency</label>
                            <div class="col-md-10">
                                <select name="competency" id="competency" class="form-control">
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>
                                </select>
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


<div class="tab-pane fade show p-3" id="nav-qualification" role="tabpanel" aria-labelledby="nav-qualification-tab">
    {{-- Company --}}
    <div class="col-md-12">COMPANY</div>
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
    {{-- Education --}}
    <div class="col-md-12">EDUCATION</div>
    <table class="table table-bordered table-hover w-100" id="employee-education-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Degree</th>
                <th>Field of Study</th>
                <th>Start Year</th>
                <th>End Year</th>
                <th>GPA</th>
                <th>School</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    <div class="dropdown-divider pb-3"></div>
    {{-- Skill --}}
    <div class="col-md-12">SKILL</div>
    <table class="table table-bordered table-hover w-100" id="employee-skills-table">
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
    $('#employee-companies-table').DataTable({
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
                "data": null, // can be null or undefined
                "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#experienceModal"><i class="far fa-edit"></i></button>'
            }
        ]
    });
    $('#employee-education-table').DataTable({
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
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#educationModal"><i class="far fa-edit"></i></button>'
        }
    ]
});
$('#employee-skills-table').DataTable({
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
            "data": null, // can be null or undefined
            "defaultContent": '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#skillModal"><i class="far fa-edit"></i></button>'
        }
    ]
});
</script>
@append
