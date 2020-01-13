<!-- ADD EXPERIENCES -->
@can(PermissionConstant::ADD_EXPERIENCE)
<div class="modal fade" id="add-experience-popup" tabindex="-1" role="dialog" aria-labelledby="add-experience-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-experience-label">Add Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-experience-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="company"><strong>Company*</strong></label>
                            <input name="company" type="text" class="form-control" placeholder="" value="">
                            <div id="company-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="industry"><strong>Industry*</strong></label>
                            <input name="industry" type="text" class="form-control" placeholder="" value="">
                            <div id="industry-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="contact"><strong>Contact Person/Tel*</strong></label>
                            <input name="contact" type="text" class="form-control" placeholder="" value="">
                            <div id="contact-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="position"><strong>Position*</strong></label>
                            <input name="position" type="text" class="form-control" placeholder="" value="">
                            <div id="position-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="start-date"><strong>Start Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="start-date-experience" class="form-control datetimepicker-input" placeholder="dd/mm/yyyy" data-target="#start-date-experience" autocomplete="off"/>
                                <div class="input-group-append" data-target="#start-date-experience" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="start-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="end-date"><strong>End Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="end-date-experience" class="form-control datetimepicker-input" placeholder="dd/mm/yyyy" data-target="#end-date-experience" autocomplete="off"/>
                                <div class="input-group-append" data-target="#end-date-experience" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="end-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="notes"><strong>Notes</strong></label>
                            <input name="notes" type="text" class="form-control" placeholder="" value="" >

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-experience-submit" type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

<!-- ADD EDUCATION -->
@can(PermissionConstant::ADD_EDUCATION)
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
                            <input name="institution" type="text" class="form-control" placeholder="" value="">
                            <div id="institution-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="start-year"><strong>Start Year*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="start-year" class="form-control datetimepicker-input" data-target="#start-year" autocomplete="off"/>
                                <div class="input-group-append" data-target="#start-year" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="start-year-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="end-year"><strong>End Year*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="end-year" class="form-control datetimepicker-input" data-target="#end-year" autocomplete="off"/>
                                <div class="input-group-append" data-target="#end-year" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="end-year-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="level"><strong>Level*</strong></label>
                            <input name="level" type="text" class="form-control" placeholder="" value="">
                            <div id="level-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="major"><strong>Major*</strong></label>
                            <input name="major" type="text" class="form-control" placeholder="" value="">
                            <div id="major-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="gpa"><strong>Gpa*</strong></label>
                            <input name="gpa" type="text" class="form-control" placeholder="" value="">
                            <div id="gpa-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="description"><strong>Description</strong></label>
                            <input name="description" type="text" class="form-control" placeholder="" value="" >

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
@endcan

<!-- ADD SKILL -->
@can(PermissionConstant::ADD_SKILL)
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
                            <input name="name" type="text" class="form-control" placeholder="" value="">
                            <div id="name-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Year Experience*</strong></label>
                            <input name="years-of-experience" type="text" class="form-control" placeholder="" value="">
                            <div id="years-of-experience-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Competency*</strong></label>
                            <select name="competency" type="text" class="form-control" placeholder="" value="">
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
@endcan

<!-- UPDATE EXPERIENCES -->
@can(PermissionConstant::UPDATE_EXPERIENCE)
<div class="modal fade" id="edit-experience-popup" tabindex="-1" role="dialog" aria-labelledby="edit-experience-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-experience-label">Edit Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="edit-experience-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="company"><strong>Company*</strong></label>
                            <input name="company" type="text" class="form-control" placeholder="" value="">
                            <div id="company-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="position"><strong>Position*</strong></label>
                            <input name="position" type="text" class="form-control" placeholder="" value="">
                            <div id="position-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="industry"><strong>Industry*</strong></label>
                            <input name="industry" type="text" class="form-control" placeholder="" value="">
                            <div id="industry-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="contact"><strong>Contact Person/Tel*</strong></label>
                            <input name="contact" type="text" class="form-control" placeholder="" value="">
                            <div id="contact-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="start-date"><strong>Start Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="start-date-experience-edit" class="form-control datetimepicker-input" data-target="#start-date-experience-edit" autocomplete="off"/>
                                <div class="input-group-append" data-target="#start-date-experience-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="start-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="end-date"><strong>End Date*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="end-date-experience-edit" class="form-control datetimepicker-input" data-target="#end-date-experience-edit" autocomplete="off"/>
                                <div class="input-group-append" data-target="#end-date-experience-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="end-date-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="notes"><strong>Notes</strong></label>
                            <input name="notes" type="text" class="form-control" placeholder="" value="" >

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-experience-submit" type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

<!-- UPDATE EDUCATION -->
@can(PermissionConstant::UPDATE_EDUCATION)
<div class="modal fade" id="edit-education-popup" tabindex="-1" role="dialog" aria-labelledby="edit-education-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-education-label">Edit Education</h5>
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
                            <input name="institution" type="text" class="form-control" placeholder="" value="">
                            <div id="institution-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="start-year"><strong>Start Year*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="start-year-edit" class="form-control datetimepicker-input" placeholder="dd/mm/yyyy" data-target="#start-year-edit"/>
                                <div class="input-group-append" data-target="#start-year-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="start-year-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="end-year"><strong>End Year*</strong></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="end-year-edit" class="form-control datetimepicker-input" placeholder="dd/mm/yyyy" data-target="#end-year-edit"/>
                                <div class="input-group-append" data-target="#end-year-edit" data-toggle="datetimepicker">
                                    <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <div id="end-year-error" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="level"><strong>Level*</strong></label>
                            <input name="level" type="text" class="form-control" placeholder="" value="">
                            <div id="level-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="major"><strong>Major*</strong></label>
                            <input name="major" type="text" class="form-control" placeholder="" value="">
                            <div id="major-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="gpa"><strong>Gpa*</strong></label>
                            <input name="gpa" type="text" class="form-control" placeholder="" value="">
                            <div id="gpa-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="description"><strong>Description</strong></label>
                            <input name="description" type="text" class="form-control" placeholder="" value="" >
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
@endcan

<!-- UPDATE SKILLS -->
@can(PermissionConstant::UPDATE_SKILL)
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
                            <input name="name" type="text" class="form-control" placeholder="" value="">
                            <div id="name-error" class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Year Experience*</strong></label>
                            <input name="years-of-experience" type="text" class="form-control" placeholder="" value="">
                            <div id="years-of-experience-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Competency*</strong></label>
                            <select name="competency" type="text" class="form-control" placeholder="" value="">
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
@endcan

{{-- DELETE EXP--}}
@can(PermissionConstant::DELETE_EXPERIENCE)
<div class="modal fade" id="confirm-delete-experience-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-experience-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-experience-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-experience-submit">Delete</button>
            </div>
        </div>
    </div>
</div>
@endcan

{{-- DELETE EDU--}}
@can(PermissionConstant::DELETE_EDUCATION)
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
                <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-educations-submit">Delete</button>
            </div>
        </div>
    </div>
</div>
@endcan

{{-- DELETE SKILL--}}
@can(PermissionConstant::DELETE_SKILL)
<div class="modal fade" id="confirm-delete-skills-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-skills-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-skills-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="delete-skills-submit">Delete</button>
            </div>
        </div>
    </div>
</div>
@endcan

{{-- TABLE --}}
<div class="tab-pane fade show p-3" id="nav-qualification" role="tabpanel" aria-labelledby="nav-qualification-tab">
    {{-- Experiences Table--}}    
    @can(PermissionConstant::VIEW_EXPERIENCE)
    <div class="row pb-3">
        <div class="col-auto mr-auto">EXPERIENCE</div>
        <div class="col-auto">
        	@can(PermissionConstant::ADD_EXPERIENCE)
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-experience-popup">
                Add Experience
            </button>
            @endcan
        </div>
    </div>
    <table class="hrms-primary-data-table table w-100" id="employee-companies-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Company</th>
                <th>Position</th>
                <th>Industry</th>
                <th>Contact Person/Tel</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    <div class="dropdown-divider pb-3"></div>
    @endcan
    {{-- Education Table--}}
    @can(PermissionConstant::VIEW_EDUCATION)
    <div class="row pb-3">
        <div class="col-auto mr-auto">EDUCATION</div>
        <div class="col-auto">
        	@can(PermissionConstant::ADD_EDUCATION)
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-education-popup">
                        Add Education
            </button>
            @endcan
        </div>
    </div>
    <table class="hrms-primary-data-table table w-100" id="employee-education-table">
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
    @endcan
    {{-- Skill Table--}}
    @can(PermissionConstant::VIEW_SKILL)
    <div class="row pb-3">
        <div class="col-auto mr-auto">SKILL</div>
        <div class="col-auto">
        	@can(PermissionConstant::ADD_SKILL)
            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-skill-popup">
                    Add Skill
            </button>
            @endcan
        </div>
    </div>
    <table class="hrms-primary-data-table table w-100 text-capitalize" id="employee-skill-table">
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
@endcan
</div>

@section('scripts')
<script>
    var experiencesTable = $('#employee-companies-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('admin.employees.dt.experiences', ['id' => $id]) }}",
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
                "data": "company"
            },
            {
                "data": "position"
            },
            {
                "data": "industry"
            },
            {
                "data": "contact"
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
                    return `
                    @can(PermissionConstant::UPDATE_EXPERIENCE)
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-experience-popup"><i class="far fa-edit"></i></button>
					@endcan` + `@can(PermissionConstant::DELETE_EXPERIENCE)
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-experience-modal"><i class="far fa-trash-alt"></i></button>
					@endcan
                    `;
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
                    return `
                    @can(PermissionConstant::UPDATE_EDUCATION)
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-education-popup"><i class="far fa-edit"></i></button>
					@endcan` + `@can(PermissionConstant::DELETE_EDUCATION)
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-educations-modal"><i class="far fa-trash-alt"></i></button>
					@endcan
                    `;
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
        "columnDefs": [ {
            "targets": 4,
            "orderable": false
        } ],
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
                    return `
                    @can(PermissionConstant::UPDATE_SKILL)
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-skill-popup"><i class="far fa-edit"></i></button>
					@endcan` + `@can(PermissionConstant::DELETE_SKILL)
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#confirm-delete-skills-modal"><i class="far fa-trash-alt"></i></button>
					@endcan
                    `;
                }
            }
        ]
    });

</script>

{{-- datepicker --}}
<script type="text/javascript">
    $(function () {
        // datepicker add exp
        $('#start-date-experience').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $("#start-date-experience").on("change.datetimepicker", function (e) {
            $('#end-date-experience').datetimepicker('minDate', e.date);
        });
        //enable keyboard input & hide caret
        //$("#start-date-experience").keydown(false);
        $("#start-date-experience").css('caret-color', 'transparent');

        $('#end-date-experience').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        $("#end-date-experience").on("change.datetimepicker", function (e) {
            $('#start-date-experience').datetimepicker('maxDate', e.date);
        });
        //enable keyboard input & hide caret
        //$("#end-date-experience").keydown(false);
        $("#end-date-experience").css('caret-color', 'transparent');

        // datepicker edit exp
        $('#start-date-experience-edit').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $("#start-date-experience-edit").on("change.datetimepicker", function (e) {
            $('#end-date-experience-edit').datetimepicker('minDate', e.date);
        });
        //enable keyboard input & hide caret
        //$("#start-date-experience-edit").keydown(false);
        $("#start-date-experience-edit").css('caret-color', 'transparent');

        $('#end-date-experience-edit').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        $("#end-date-experience-edit").on("change.datetimepicker", function (e) {
            $('#start-date-experience-edit').datetimepicker('maxDate', e.date);
        });
        //enable keyboard input & hide caret
        //$("#end-date-experience-edit").keydown(false);
        $("#end-date-experience-edit").css('caret-color', 'transparent');

        // datepicker add edu
        $('#start-year').datetimepicker({
            format: 'YYYY'
        });
        $("#start-year").on("change.datetimepicker", function (e) {
            $('#end-year').datetimepicker('minDate', e.date);
        });
        //enable keyboard input & hide caret
        //$("#start-year").keydown(false);
        $("#start-year").css('caret-color', 'transparent');

        $('#end-year').datetimepicker({
            format: 'YYYY',
            useCurrent: false
        });
        $("#end-year").on("change.datetimepicker", function (e) {
            $('#start-year').datetimepicker('maxDate', e.date);
        });
        //enable keyboard input & hide caret
        //$("#end-year").keydown(false);
        $("#end-year").css('caret-color', 'transparent');

        // datepicker edit edu
        $('#start-year-edit').datetimepicker({
            format: 'YYYY'
        });
        $("#start-year-edit").on("change.datetimepicker", function (e) {
            $('#end-year-edit').datetimepicker('minDate', e.date);
        });
        //enable keyboard input & hide caret
        //$("#start-year-edit").keydown(false);
        $("#start-year-edit").css('caret-color', 'transparent');

        $('#end-year-edit').datetimepicker({
            format: 'YYYY'
        });
        $("#end-year-edit").on("change.datetimepicker", function (e) {
            $('#start-year-edit').datetimepicker('maxDate', e.date);
        });
        //enable keyboard input & hide caret
        //$("#end-year-edit").keydown(false);
        $("#end-year-edit").css('caret-color', 'transparent');
    });
</script>
{{-- EXPERIENCES --}}
<script type="text/javascript">
    $(function(){
        // ADD EXPERIENCES
        $('#add-experience-popup').on('show.bs.modal', function (event) {
            clearExperiencesError('#add-experience-form');
        });
        $('#add-experience-form #add-experience-submit').click(function(e){
            clearExperiencesError('#add-experience-form');
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.employees.experiences.post', ['id' => $id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    // Form Data
                    company: $('#add-experience-form input[name=company]').val(),
                    position: $('#add-experience-form input[name=position]').val(),
                    industry: $('#add-experience-form input[name=industry]').val(),
                    contact: $('#add-experience-form input[name=contact]').val(),
                    start_date: $('#add-experience-form #start-date-experience').val(),
                    end_date: $('#add-experience-form #end-date-experience').val(),
                    notes: $('#add-experience-form input[name=notes]').val()
                },
                success: function(data) {
                    showAlert(data.success);
                    experiencesTable.ajax.reload();
                    $('#add-experience-popup').modal('toggle');
                    clearExperiencesModal('#add-experience-form');
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
                                        $('#add-experience-form input[name=company]').addClass('is-invalid');
                                        $('#add-experience-form #company-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'position':
                                        $('#add-experience-form input[name=position]').addClass('is-invalid');
                                        $('#add-experience-form #position-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'industry':
                                        $('#add-experience-form input[name=industry]').addClass('is-invalid');
                                        $('#add-experience-form #industry-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'contact':
                                        $('#add-experience-form input[name=contact]').addClass('is-invalid');
                                        $('#add-experience-form #contact-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'start_date':
                                        $('#add-experience-form #start-date-experience').addClass('is-invalid');
                                        $('#add-experience-form #start-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'end_date':
                                        $('#add-experience-form #end-date-experience').addClass('is-invalid');
                                        $('#add-experience-form #end-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    // case 'notes':
                                    //     $('#add-experience-form input[name=notes]').addClass('is-invalid');
                                    //     $('#add-experience-form #notes-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    // break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // EDIT EXPERIENCE
        var editExperienceId = null;
        // Function: On Modal Clicked Handler
        $('#edit-experience-popup').on('show.bs.modal', function (event) {
            clearExperiencesError('#edit-experience-form');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editExperienceId = currentData.id;

            $('#edit-experience-form input[name=company]').val(currentData.company);
            $('#edit-experience-form input[name=position]').val(currentData.position);
            $('#edit-experience-form input[name=industry]').val(currentData.industry);
            $('#edit-experience-form input[name=contact]').val(currentData.contact);
            $('#edit-experience-form #start-date-experience-edit').val(currentData.start_date);
            $('#edit-experience-form #end-date-experience-edit').val(currentData.end_date);
            $('#edit-experience-form input[name=notes]').val(currentData.notes);
        });

        var editExperienceRouteTemplate = "{{ route('admin.employees.experiences.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-experience-submit').click(function(e){
            var editExperienceRoute = editExperienceRouteTemplate.replace(encodeURI('<<id>>'), editExperienceId);
            clearExperiencesError('#edit-experience-form');
            e.preventDefault();
            $.ajax({
                url: editExperienceRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    company: $('#edit-experience-form input[name=company]').val(),
                    position: $('#edit-experience-form input[name=position]').val(),
                    industry: $('#edit-experience-form input[name=industry]').val(),
                    contact: $('#edit-experience-form input[name=contact]').val(),
                    start_date: $('#edit-experience-form #start-date-experience-edit').val(),
                    end_date: $('#edit-experience-form #end-date-experience-edit').val(),
                    notes: $('#edit-experience-form input[name=notes]').val()
                },
                success: function(data) {
                    showAlert(data.success);
                    experiencesTable.ajax.reload();
                    $('#edit-experience-popup').modal('toggle');
                    clearExperiencesModal('#edit-experience-form');
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
                                        $('#edit-experience-form input[name=company]').addClass('is-invalid');
                                        $('#edit-experience-form #company-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'position':
                                        $('#edit-experience-form input[name=position]').addClass('is-invalid');
                                        $('#edit-experience-form #position-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'industry':
                                        $('#edit-experience-form input[name=industry]').addClass('is-invalid');
                                        $('#edit-experience-form #industry-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'contact':
                                        $('#edit-experience-form input[name=contact]').addClass('is-invalid');
                                        $('#edit-experience-form #contact-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'start_date':
                                        $('#edit-experience-form #start-date-experience-edit').addClass('is-invalid');
                                        $('#edit-experience-form #start-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'end_date':
                                        $('#edit-experience-form #end-date-experience-edit').addClass('is-invalid');
                                        $('#edit-experience-form #end-date-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    // case 'notes':
                                    //     $('#edit-experience-form input[name=notes]').addClass('is-invalid');
                                    //     $('#edit-experience-form #notes-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    // break;
                                }
                            }
                        }
                    }
                }
            });
        });

        // DELETE EXPERIENCE
        var deleteExperienceId = null;
        // Function: On Modal Clicked Handler
        $('#confirm-delete-experience-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            deleteExperienceId = currentData.id;
        });

        var deleteExperienceRouteTemplate = "{{ route('admin.settings.experiences.delete', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#delete-experience-submit').click(function(e){
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
                    $('#confirm-delete-experience-modal').modal('toggle');
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
        $(htmlId + ' input[name=company]').val('');
        $(htmlId + ' input[name=position]').val('');
        $(htmlId + ' input[name=industry]').val('');
        $(htmlId + ' input[name=contact]').val('');
        $(htmlId + ' #start-date-experience').val('');
        $(htmlId + ' #end-date-experience').val('');
        $(htmlId + ' input[name=notes]').val('');

        $(htmlId + ' input[name=company]').removeClass('is-invalid');
        $(htmlId + ' input[name=position]').removeClass('is-invalid');
        $(htmlId + ' input[name=industry]').removeClass('is-invalid');
        $(htmlId + ' input[name=contact]').removeClass('is-invalid');
        $(htmlId + ' #start-date-experience').removeClass('is-invalid');
        $(htmlId + ' #end-date-experience').removeClass('is-invalid');
        $(htmlId + ' input[name=notes]').removeClass('is-invalid');
    }
    function clearExperiencesError(htmlId) {
        $(htmlId + ' input[name=company]').removeClass('is-invalid');
        $(htmlId + ' input[name=position]').removeClass('is-invalid');
        $(htmlId + ' input[name=industry]').removeClass('is-invalid');
        $(htmlId + ' input[name=contact]').removeClass('is-invalid');
        $(htmlId + ' #start-date-experience').removeClass('is-invalid');
        $(htmlId + ' #end-date-experience').removeClass('is-invalid');
        $(htmlId + ' input[name=notes]').removeClass('is-invalid');
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
        $('#add-education-popup').on('show.bs.modal', function (event) {
            clearEducationsError('#add-education-form');
        });
        $('#add-education-form #add-education-submit').click(function(e){
            clearEducationsError('#add-education-form');
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.employees.educations.post', ['id' => $id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    // Form Data
                    institution: $('#add-education-form input[name=institution]').val(),
                    start_year: $('#add-education-form #start-year').val(),
                    end_year: $('#add-education-form #end-year').val(),
                    level: $('#add-education-form input[name=level]').val(),
                    major: $('#add-education-form input[name=major]').val(),
                    gpa: $('#add-education-form input[name=gpa]').val(),
                    description: $('#add-education-form input[name=description]').val()
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
                                        $('#add-education-form input[name=institution]').addClass('is-invalid');
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
                                        $('#add-education-form input[name=level]').addClass('is-invalid');
                                        $('#add-education-form #level-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'major':
                                        $('#add-education-form input[name=major]').addClass('is-invalid');
                                        $('#add-education-form #major-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'gpa':
                                        $('#add-education-form input[name=gpa]').addClass('is-invalid');
                                        $('#add-education-form #gpa-error').html('<strong>' + errors[errorField][0] + '</strong>');
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
            clearEducationsError('#edit-education-form');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editEducationId = currentData.id;

            $('#edit-education-form input[name=institution]').val(currentData.institution);
            $('#edit-education-form #start-year-edit').val(currentData.start_year);
            $('#edit-education-form #end-year-edit').val(currentData.end_year);
            $('#edit-education-form input[name=level]').val(currentData.level);
            $('#edit-education-form input[name=major]').val(currentData.major);
            $('#edit-education-form input[name=gpa]').val(currentData.gpa);
            $('#edit-education-form input[name=description]').val(currentData.description);
        });

        var editEducationRouteTemplate = "{{ route('admin.employees.educations.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-education-submit').click(function(e){
            var editEducationRoute = editEducationRouteTemplate.replace(encodeURI('<<id>>'), editEducationId);
            clearEducationsError('#edit-education-form');
            e.preventDefault();
            $.ajax({
                url: editEducationRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    institution: $('#edit-education-form input[name=institution]').val(),
                    start_year: $('#edit-education-form #start-year-edit').val(),
                    end_year: $('#edit-education-form #end-year-edit').val(),
                    level: $('#edit-education-form input[name=level]').val(),
                    major: $('#edit-education-form input[name=major]').val(),
                    gpa: $('#edit-education-form input[name=gpa]').val(),
                    description: $('#edit-education-form input[name=description]').val()
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
                                        $('#edit-education-form input[name=institution]').addClass('is-invalid');
                                        $('#edit-education-form #institution-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'start_year':
                                        $('#edit-education-form #start-year-edit').addClass('is-invalid');
                                        $('#edit-education-form #start-year-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'end_year':
                                        $('#edit-education-form #end-year-edit').addClass('is-invalid');
                                        $('#edit-education-form #end-year-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'level':
                                        $('#edit-education-form input[name=level]').addClass('is-invalid');
                                        $('#edit-education-form #level-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'major':
                                        $('#edit-education-form input[name=major]').addClass('is-invalid');
                                        $('#edit-education-form #major-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'gpa':
                                        $('#edit-education-form input[name=gpa]').addClass('is-invalid');
                                        $('#edit-education-form #gpa-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;

                                }
                            }
                        }
                    }
                }
            });
        });

        // DELETE EDUCATION
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
        $(htmlId + ' input[name=institution]').val('');
        $(htmlId + ' #start-year').val('');
        $(htmlId + ' #end-year').val('');
        $(htmlId + ' input[name=level]').val('');
        $(htmlId + ' input[name=major]').val('');
        $(htmlId + ' input[name=gpa]').val('');
        $(htmlId + ' input[name=description]').val('');

        $(htmlId + ' input[name=institution]').removeClass('is-invalid');
        $(htmlId + ' #start-year').removeClass('is-invalid');
        $(htmlId + ' #end-year').removeClass('is-invalid');
        $(htmlId + ' input[name=level]').removeClass('is-invalid');
        $(htmlId + ' input[name=major]').removeClass('is-invalid');
        $(htmlId + ' input[name=gpa]').removeClass('is-invalid');
        $(htmlId + ' input[name=description]').removeClass('is-invalid');
    }

    function clearEducationsError(htmlId) {
        $(htmlId + ' input[name=institution]').removeClass('is-invalid');
        $(htmlId + ' #start-year').removeClass('is-invalid');
        $(htmlId + ' #end-year').removeClass('is-invalid');
        $(htmlId + ' input[name=level]').removeClass('is-invalid');
        $(htmlId + ' input[name=major]').removeClass('is-invalid');
        $(htmlId + ' input[name=gpa]').removeClass('is-invalid');
        $(htmlId + ' input[name=description]').removeClass('is-invalid');
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
        $('#add-skill-form select[name=competency]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        var editCompetency = $('#edit-skill-form select[name=competency]').selectize({
            plugins: ['restore_on_backspace'],
            sortField: 'text'
        });
        // ADD SKILLS
        $('#add-skill-popup').on('show.bs.modal', function (event) {
            clearSkillsError('#add-skill-form');
        });
        $('#add-skill-form #add-skill-submit').click(function(e){
            e.preventDefault();
            clearSkillsError('#add-skill-form');
            $.ajax({
                url: "{{ route('admin.employees.skills.post', ['id' => $id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    // Form Data
                    name: $('#add-skill-form input[name=name]').val(),
                    years_of_experience: $('#add-skill-form input[name=years-of-experience]').val(),
                    competency: $('#add-skill-form select[name=competency]').val()
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
                                        $('#add-skill-form input[name=name]').addClass('is-invalid');
                                        $('#add-skill-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'years_of_experience':
                                        $('#add-skill-form input[name=years-of-experience]').addClass('is-invalid');
                                        $('#add-skill-form #years-of-experience-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'competency':
                                        $('#add-skill-form select[name=competency]').addClass('is-invalid');
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
            clearSkillsError('#edit-skill-form');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = JSON.parse(decodeURI(button.data('current'))) // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editSkillId = currentData.id;

            $('#edit-skill-form input[name=name]').val(currentData.name);
            $('#edit-skill-form input[name=years-of-experience]').val(currentData.years_of_experience);
            editCompetency[0].selectize.setValue(currentData.competency);
        });

        var editSkillRouteTemplate = "{{ route('admin.employees.skills.edit.post', ['emp_id' => $id, 'id' => '<<id>>']) }}";
        $('#edit-skill-submit').click(function(e){
            var editSkillRoute = editSkillRouteTemplate.replace(encodeURI('<<id>>'), editSkillId);
            clearSkillsError('#edit-skill-form');
            e.preventDefault();
            $.ajax({
                url: editSkillRoute,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#edit-skill-form input[name=name]').val(),
                    years_of_experience: $('#edit-skill-form input[name=years-of-experience]').val(),
                    competency: $('#edit-skill-form select[name=competency]').val()
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
                                        $('#edit-skill-form input[name=name]').addClass('is-invalid');
                                        $('#edit-skill-form #name-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'years_of_experience':
                                        $('#edit-skill-form input[name=years-of-experience]').addClass('is-invalid');
                                        $('#edit-skill-form #years-of-experience-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'competency':
                                        $('#edit-skill-form select[name=competency]').addClass('is-invalid');
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
        $(htmlId + ' input[name=name]').val('');
        $(htmlId + ' input[name=years-of-experience]').val('');
        $(htmlId + ' select[name=competency]')[0].selectize.clear();

        $(htmlId + ' input[name=name]').removeClass('is-invalid');
        $(htmlId + ' input[name=years-of-experience]').removeClass('is-invalid');
        $(htmlId + ' select[name=competency]').removeClass('is-invalid');
    }

    function clearSkillsError(htmlId) {
        $(htmlId + ' input[name=name]').removeClass('is-invalid');
        $(htmlId + ' input[name=years-of-experience]').removeClass('is-invalid');
        $(htmlId + ' select[name=competency]').removeClass('is-invalid');
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
