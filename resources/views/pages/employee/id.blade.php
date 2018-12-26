@extends('layouts.base')
@section('content')
<div class="container">
    <div id="alert-container">
    </div>
    <div id="employee-profile-card" class="card shadow-sm">
        <div id="employee-profile-details" class="card-body bg-primary text-white">
            <div class="d-flex align-items-stretch" id="reload-profile1">
                <div id="profile-pic-container" class="p-2 flex-grow-0 d-flex flex-column align-items-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-current="{{$employee->user}}" data-target="#edit-picture-popup">
                        @if ($userMediaSize!=0)
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
                    <div class="details">
                        <div class="field pb-1">
                            <span class="field-name mr-2">IC No</span>
                            <span class="field-value">{{$employee->ic_no}}</span>
                        </div>
                        <div class="field pb-1">
                            <span class="field-name mr-2">DOB</span>
                            <span class="field-value">{!! $employee->dob ? $employee->dob->format('d/m/Y'):'<strong>(not set)</strong>' !!}</span>
                        </div>
                        <div class="field pb-1">
                            <span class="field-name mr-2">Gender</span>
                            <span class="field-value">{{ ucfirst($employee->gender) }}</span>
                        </div>
                        <div class="field pb-1">
                            <span class="field-name mr-2">Nationality</span>
                            <span class="field-value">{!! $employee->nationality ? $employee->nationality:'<strong>(not set)</strong>' !!}</span>
                        </div>
                    </div>
                </div>
                <div id="end-btn-group">
                    <button id="emp-change-password-btn" data-toggle="modal" data-target="#change-password-popup" type="button" class="btn btn-sm text-white rounded">
                        {{-- <i class="fas fa-pen"></i> --}}
                        Change Password
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                {{-- Tab List --}}
                <nav class="col-sm-12">
                    <div class="nav nav-tabs font-weight-bold scrollable d-flex flex-nowrap tabbable text-nowrap" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                            aria-selected="false">Profile</a>
                        <a class="nav-item nav-link" id="nav-emergency-tab" data-toggle="tab" href="#nav-emergency" role="tab" aria-controls="nav-emergency"
                            aria-selected="false">Emergency</a>
                        <a class="nav-item nav-link" id="nav-dependent-tab" data-toggle="tab" href="#nav-dependent" role="tab" aria-controls="nav-dependent"
                            aria-selected="true">Dependent</a>
                        <a class="nav-item nav-link" id="nav-immigration-tab" data-toggle="tab" href="#nav-immigration" role="tab" aria-controls="nav-immigration"
                            aria-selected="false">Immigration</a>
                        <a class="nav-item nav-link" id="nav-visa-tab" data-toggle="tab" href="#nav-visa" role="tab" aria-controls="nav-visa" aria-selected="true">Visa</a>
                        <a class="nav-item nav-link" id="nav-job-tab" data-toggle="tab" href="#nav-job" role="tab" aria-controls="nav-job" aria-selected="false">Job</a>
                        <a class="nav-item nav-link" id="nav-bank-tab" data-toggle="tab" href="#nav-bank" role="tab" aria-controls="nav-bank" aria-selected="true">Bank</a>
                        <a class="nav-item nav-link" id="nav-qualification-tab" data-toggle="tab" href="#nav-qualification" role="tab" aria-controls="nav-qualification"
                            aria-selected="false">Qualification</a>
                        <a class="nav-item nav-link" id="nav-attachments-tab" data-toggle="tab" href="#nav-attachments" role="tab" aria-controls="nav-attachments"
                            aria-selected="true">Attachment</a>
                        <a class="nav-item nav-link" id="nav-workdays-tab" data-toggle="tab" href="#nav-workdays" role="tab" aria-controls="nav-workdays"
                            aria-selected="false">Work Days</a>
                        <a class="nav-item nav-link" id="nav-reportto-tab" data-toggle="tab" href="#nav-reportto" role="tab" aria-controls="nav-reportto"
                            aria-selected="true">Report To</a>
                        <a class="nav-item nav-link" id="nav-history-tab" data-toggle="tab" href="#nav-history" role="tab" aria-controls="nav-history"
                            aria-selected="false">History</a>
                        <a class="nav-item nav-link" id="nav-security-tab" data-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security"
                            aria-selected="true">Security Group</a>
                            <a class="nav-item nav-link" id="nav-attendance-tab" data-toggle="tab" href="#nav-attendance" role="tab" aria-controls="nav-attendance"
                            aria-selected="true">Attendance</a>
                    </div>
                </nav>
                {{-- Tab Content --}}
                <div class="tab-content col-sm-12 text-justify" id="nav-tabContent">
                    {{-- Profile --}}
                    <div class="tab-pane fade show active p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row" id="reload-profile2">
                                <div class="col-md-11">
                                    <div class="row p-3">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <span class="col-lg-5 p-3">Address</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <div class="field pb-1">
                                                        <span class="field-value">{{$employee->address}}</span>
                                                    </div>
                                                    <div class="field pb-1">
                                                        <span class="field-value">{{$employee->address2}}</span>
                                                    </div>
                                                    <div class="field pb-1">
                                                        <span class="field-value">{{$employee->address3}}</span>
                                                    </div>
                                                </div>
                                                <span class="col-lg-5 p-3">Contact No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->contact_no}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Marital Status</span>
                                                <div class="col-lg-7 font-weight-bold p-3 text-capitalize">
                                                    <span class="field-value">{{$employee->marital_status}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Number of Child</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{!! $employee->total_children ? $employee->total_children:'<strong>(not set)</strong>' !!}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">EIS No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{!! $employee->eis_no ? $employee->eis_no:'<strong>(not set)</strong>' !!}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">SOCSO No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{!! $employee->socso_no ? $employee->socso_no:'<strong>(not set)</strong>' !!}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Security Group</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{!! isset($employee->main_security_groups) ? $employee->main_security_groups->name : '<strong>(not set)</strong>' !!}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Basic Salary</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{!! $employee->employee_jobs->implode('basic_salary') ? $employee->employee_jobs->implode('basic_salary'):'<strong>(not set)</strong>' !!}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <span class="col-lg-5 p-3">Race</span>
                                                <div class="col-lg-7 font-weight-bold p-3 text-capitalize">
                                                    <span class="field-value">{{$employee->race}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Driver License No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{!!$employee->driver_license_no ? $employee->driver_license_no : '<strong>(not set)</strong>'!!}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">License Expiry Date</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{!!$employee->driver_license_expiry_date ? $employee->driver_license_expiry_date->format('d/m/Y'): '<strong>(not set)</strong>'!!}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">EPF No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->epf_no}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Tax No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->tax_no}}</span>
                                                </div>

                                                <span class="col-lg-5 p-3">ID No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->code}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Joined Date</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    {{-- <span class="field-value">{!! $employee->employee_jobs_joined_date->implode('start_date') ? $employee->employee_jobs_joined_date->implode('start_date'):'<strong>(not set)</strong>' !!}</span> --}}
                                                </div>
                                                <span class="col-lg-5 p-3">Confirmation Date</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{!! $employee->employee_confirmed->implode('start_date') ? $employee->employee_confirmed->implode('start_date'):'<strong>(not set)</strong>' !!}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Resignation Date</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    {{-- <span class="field-value">{!! $employee->employee_jobs_resigned_date->implode('start_date') ? $employee->employee_jobs_resigned_date->implode('start_date'):'<strong>(not set)</strong>' !!}</span> --}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                    </div>
                    {{-- Emergency --}}
                    @include('pages.employee.id.emergency-contacts', ['id' => $employee->id])
                    {{-- Dependent --}}
                    @include('pages.employee.id.dependents', ['id' => $employee->id])
                    {{-- Immigration --}}
                    @include('pages.employee.id.immigrations', ['id' => $employee->id])
                    {{-- Visa --}}
                    @include('pages.employee.id.visas', ['id' => $employee->id])
                    {{-- Job --}}
                    @include('pages.employee.id.jobs', ['id' => $employee->id])
                    {{-- Bank --}}
                    @include('pages.employee.id.bank-accounts', ['id' => $employee->id])
                    {{-- Qualification --}}
                    @include('pages.employee.id.qualifications', ['id' => $employee->id])
                    {{-- Attachment --}}
                    @include('pages.employee.id.attachments', ['id' => $employee->id])
                    {{-- Work Days --}}
                    @include('pages.employee.id.working-day', ['id' => $employee->id])
                    {{-- Report To --}}
                    @include('pages.employee.id.report-to', ['id' => $employee->id])
                    {{-- History --}}
                    @include('pages.employee.id.history', ['id' => $employee->id])
                    {{-- Security Group --}}
                    @include('pages.employee.id.security-group', ['id' => $employee->id])
                    {{-- Attendance --}}
                    @include('pages.employee.id.attendance', ['id' => $employee->id])
                </div>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE -->
<div class="modal fade" id="edit-profile-popup" tabindex="-1" role="dialog" aria-labelledby="edit-profile-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-profile-label">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-profile-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="ic-no"><strong>IC*</strong></label>
                            <input id="ic-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="ic-no-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="dob"><strong>Date of Birth*</strong></label>
                            <input id="alt-dob" type="text" class="form-control" hidden>
                            <input id="dob" type="text" class="form-control" placeholder="" value="" required readonly>
                            <div id="dob-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="gender"><strong>Gender*</strong></label>
                            <select name="gender" id="gender" class="form-control" placeholder="" value="" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div id="gender-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="contact-no"><strong>Contact Number*</strong></label>
                            <input id="contact-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="contact-no-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="marital-status-no"><strong>Marital Status*</strong></label>
                            <select name="marital-status" id="marital-status" class="form-control" placeholder="" value="" required>
                                <option value="">Select Marital Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                            </select>
                            <div id="marital-status-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="race"><strong>Race*</strong></label>
                            {{-- <select name="race" id="race" class="form-control" placeholder="" value="" required>
                                <option value="">Select Race</option>
                                <option value="malay">Malay</option>
                                <option value="chinese">Chinese</option>
                                <option value="indian">Indian</option>
                                <option value="other">Other</option>
                            </select> --}}
                            <input id="race" type="text" class="form-control" placeholder="" value="" required>
                            <div id="race-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="total-children"><strong>Number of Child</strong></label>
                            <input id="total-children" type="text" class="form-control" placeholder="" value="" required>
                            <div id="total-children-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="driver-license-no"><strong>Driver License No</strong></label>
                            <input id="driver-license-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="driver-license-no-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="driver-license-expiry-date"><strong>License Expiry Date</strong></label>
                            <input id="alt-driver-license-expiry-date" type="text" class="form-control" hidden>
                            <input id="driver-license-expiry-date" type="text" class="form-control" placeholder="" value="" readonly>
                            <div id="driver-license-expiry-date-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="epf-no"><strong>EPF No*</strong></label>
                            <input id="epf-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="epf-no-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="tax-no"><strong>Tax No*</strong></label>
                            <input id="tax-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="tax-no-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="eis-no"><strong>EIS No*</strong></label>
                            <input id="eis-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="eis-no-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="socso-no"><strong>SOCSO No*</strong></label>
                            <input id="socso-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="socso-no-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-profile-submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Change Password --}}
<div class="modal fade" id="change-password-popup" tabindex="-1" role="dialog" aria-labelledby="change-password-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="change-password-label">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="change-password-form">
                <div class="modal-body">
                    @csrf
                    {{-- <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Current Password*</strong></label>
                            <input name="current_password" type="password" class="form-control" placeholder="" value="" required>
                            <div id="current-password-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>New Password*</strong></label>
                            <input name="new_password" type="password" class="form-control" placeholder="" value="" required>
                            <div id="new-password-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>Confirm New Password*</strong></label>
                            <input name="confirm_new_password" type="password" class="form-control" placeholder="" value="" required>
                            <div id="confirm-new-password-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="change-password-submit" type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Update picture --}}
<div class="modal fade" id="edit-picture-popup" tabindex="-1" role="dialog" aria-labelledby="edit-picture-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-picture-label">Upload new profile picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-picture-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name"><strong>New Profile Picture*</strong></label>
                            <input name="required_picture" type="file" id="picture" class="form-control-file{{ $errors->has('picture') ? ' is-invalid' : '' }}">
                            <div id="picture-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="edit-picture-submit" type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('#dob').datepicker({
        altField: "#alt-dob",
        altFormat: 'yy-mm-dd',
        format: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-80:+0"
    });
    $('#driver-license-expiry-date').datepicker({
        altField: "#alt-driver-license-expiry-date",
        altFormat: 'yy-mm-dd',
        format: 'dd/mm/yy'
    });
    $(function(){
        // EDIT Profile
        var editProfileId = null;
        // Function: On Modal Clicked Handler
        $('#edit-profile-popup').on('show.bs.modal', function (event) {
            clearProfilesError('#edit-profile-form');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = button.data('current') // Extract info from data-* attributes
            console.log('Data: ', currentData)

            editProfileId = currentData.id;

            $('#edit-profile-form #ic-no').val(currentData.ic_no);
            $('#edit-profile-form #alt-dob').val(currentData.dob);
            $('#edit-profile-form #gender').val(currentData.gender);
            $('#edit-profile-form #contact-no').val(currentData.contact_no);
            $('#edit-profile-form #marital-status').val(currentData.marital_status);
            $('#edit-profile-form #race').val(currentData.race);
            $('#edit-profile-form #total-children').val(currentData.total_children);
            $('#edit-profile-form #driver-license-no').val(currentData.driver_license_no);
            $('#edit-profile-form #alt-driver-license-expiry-date').val(currentData.driver_license_expiry_date);
            $('#edit-profile-form #epf-no').val(currentData.epf_no);
            $('#edit-profile-form #tax-no').val(currentData.tax_no);
            $('#edit-profile-form #eis-no').val(currentData.eis_no);
            $('#edit-profile-form #socso-no').val(currentData.socso_no);

            if(currentData.dob!=null) {
                formatDob = $.datepicker.formatDate("d/mm/yy", new Date(currentData.dob));
                $('#edit-profile-form #dob').val(formatDob);
            } else
                $('#edit-profile-form #dob').val();

            if(currentData.driver_license_expiry_date!=null) {
                formatLicenseExpiry = $.datepicker.formatDate("d/mm/yy", new Date(currentData.driver_license_expiry_date));
                $('#edit-profile-form #driver-license-expiry-date').val(formatLicenseExpiry);
            } else
                $('#edit-profile-form #driver-license-expiry-date').val();

        });

        var editRouteTemplate = "{{ route('employee.profile.edit.post', ['id' => $employee->id]) }}";
        $('#edit-profile-submit').click(function(e){
            clearProfilesError('#edit-profile-form');
            // var editProfileRoute = editProfileRouteTemplate.replace($id, editProfileId);
            e.preventDefault();
            $.ajax({
                url: editRouteTemplate,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ic_no: $('#edit-profile-form #ic-no').val(),
                    dob: $('#edit-profile-form #alt-dob').val(),
                    gender: $('#edit-profile-form #gender').val(),
                    contact_no: $('#edit-profile-form #contact-no').val(),
                    marital_status: $('#edit-profile-form #marital-status').val(),
                    race: $('#edit-profile-form #race').val(),
                    total_children: $('#edit-profile-form #total-children').val(),
                    driver_license_no: $('#edit-profile-form #driver-license-no').val(),
                    driver_license_expiry_date: $('#edit-profile-form #alt-driver-license-expiry-date').val(),
                    epf_no: $('#edit-profile-form #epf-no').val(),
                    tax_no: $('#edit-profile-form #tax-no').val(),
                    eis_no: $('#edit-profile-form #eis-no').val(),
                    socso_no: $('#edit-profile-form #socso-no').val()
                },
                success: function(data) {
                    showAlert(data.success);
                    $('#edit-profile-popup').modal('toggle');
                    $('#employee-profile-details').load(' #reload-profile1');
                    $('#nav-profile').load(' #reload-profile2');
                    clearProfilesModal('#edit-profile-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'ic_no':
                                        $('#edit-profile-form #ic-no').addClass('is-invalid');
                                        $('#edit-profile-form #ic-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'dob':
                                        $('#edit-profile-form #dob').addClass('is-invalid');
                                        $('#edit-profile-form #dob-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'gender':
                                        $('#edit-profile-form #gender').addClass('is-invalid');
                                        $('#edit-profile-form #gender-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'contact_no':
                                        $('#edit-profile-form #contact-no').addClass('is-invalid');
                                        $('#edit-profile-form #contact-no-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'marital_status':
                                        $('#edit-profile-form #marital-status').addClass('is-invalid');
                                        $('#edit-profile-form #marital-status-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'race':
                                        $('#edit-profile-form #race').addClass('is-invalid');
                                        $('#edit-profile-form #race-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'total_children':
                                        $('#edit-profile-form #total-children').addClass('is-invalid');
                                        $('#edit-profile-form #total-children-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'driver_license_no':
                                        $('#edit-profile-form #driver-license-no').addClass('is-invalid');
                                        $('#edit-profile-form #driver-license-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'driver_license_expiry_date':
                                        $('#edit-profile-form #driver-license-expiry-date').addClass('is-invalid');
                                        $('#edit-profile-form #driver-license-expiry-date-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'epf_no':
                                        $('#edit-profile-form #epf-no').addClass('is-invalid');
                                        $('#edit-profile-form #epf-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'tax_no':
                                        $('#edit-profile-form #tax-no').addClass('is-invalid');
                                        $('#edit-profile-form #tax-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'eis_no':
                                        $('#edit-profile-form #eis-no').addClass('is-invalid');
                                        $('#edit-profile-form #eis-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                    case 'socso_no':
                                        $('#edit-profile-form #socso-no').addClass('is-invalid');
                                        $('#edit-profile-form #socso-no-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });

    });


    // GENERAL FUNCTIONS
    function clearProfilesModal(htmlId) {
        $(htmlId + ' #ic-no').val('');
        $(htmlId + ' #dob').val('');
        $(htmlId + ' #gender').val('');
        $(htmlId + ' #contact-no').val('');
        $(htmlId + ' #marital-status').val('');
        $(htmlId + ' #race').val('');
        $(htmlId + ' #total-children').val('');
        $(htmlId + ' #driver-license-no').val('');
        $(htmlId + ' #driver-license-expiry-date').val('');
        $(htmlId + ' #epf-no').val('');
        $(htmlId + ' #tax-no').val('');
        $(htmlId + ' #eis-no').val('');
        $(htmlId + ' #socso-no').val('');

        $(htmlId + ' #ic-no').removeClass('is-invalid');
        $(htmlId + ' #dob').removeClass('is-invalid');
        $(htmlId + ' #gender').removeClass('is-invalid');
        $(htmlId + ' #contact-no').removeClass('is-invalid');
        $(htmlId + ' #marital-status').removeClass('is-invalid');
        $(htmlId + ' #race').removeClass('is-invalid');
        $(htmlId + ' #total-children').removeClass('is-invalid');
        $(htmlId + ' #driver-license-no').removeClass('is-invalid');
        $(htmlId + ' #driver-license-expiry-date').removeClass('is-invalid');
        $(htmlId + ' #epf-no').removeClass('is-invalid');
        $(htmlId + ' #tax-no').removeClass('is-invalid');
        $(htmlId + ' #eis-no').removeClass('is-invalid');
        $(htmlId + ' #socso-no').removeClass('is-invalid');
    }
    function clearProfilesError(htmlId) {
        $(htmlId + ' #ic-no').removeClass('is-invalid');
        $(htmlId + ' #dob').removeClass('is-invalid');
        $(htmlId + ' #gender').removeClass('is-invalid');
        $(htmlId + ' #contact-no').removeClass('is-invalid');
        $(htmlId + ' #marital-status').removeClass('is-invalid');
        $(htmlId + ' #race').removeClass('is-invalid');
        $(htmlId + ' #total-children').removeClass('is-invalid');
        $(htmlId + ' #driver-license-no').removeClass('is-invalid');
        $(htmlId + ' #driver-license-expiry-date').removeClass('is-invalid');
        $(htmlId + ' #epf-no').removeClass('is-invalid');
        $(htmlId + ' #tax-no').removeClass('is-invalid');
        $(htmlId + ' #eis-no').removeClass('is-invalid');
        $(htmlId + ' #socso-no').removeClass('is-invalid');
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
<script>
    $(function () {
        $('#change-password-submit').click(function(e){
            e.preventDefault();
            $(e.target).attr('disabled', true);

            $.ajax({
                url: "{{ route('employee.change-password.post', ['id' => $employee->id]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    new_password: $('#change-password-form input[name=new_password]').val(),
                    confirm_new_password: $('#change-password-form input[name=confirm_new_password]').val(),
                },
                success: function(data) {
                    showAlert(data.success);
                    clearChangePasswordModal('#change-password-form');
                    $('#change-password-popup').modal('toggle');
                    $(e.target).removeAttr('disabled');
                },
                error: function(xhr) {
                    clearChangePasswordModal('#change-password-form');
                    $(e.target).removeAttr('disabled');
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'new_password':
                                        $('#change-password-form input[name=new_password]').addClass('is-invalid');
                                        $('#change-password-form #new-password-error').html('<strong>' + errors[errorField][0] + "</strong>");
                                    break;
                                }
                            }
                        }
                    }
                }
            });

        });

        function clearChangePasswordModal(htmlId) {
            let form = $(htmlId);
            form.find("input[name=new_password]").removeClass('is-invalid');
        }



    });
</script>
<script type="text/javascript">
    $(function(){

        // EDIT picture
        var editMediaId = null;
        // Function: On Modal Clicked Handler
        $('#edit-picture-popup').on('show.bs.modal', function (event) {
            clearPicturesError('#edit-picture-form');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var currentData = button.data('current'); // Extract info from data-* attributes
            console.log('Data pic: ', currentData)

            editMediaId = currentData.profile_media_id;
        });

        var editPictureRouteTemplate = "{{ route('employees.picture.edit.post', ['id' => $employee->user->profile_media_id]) }}";
        $('#edit-picture-submit').click(function(e){
            clearPicturesError('#edit-picture-form');
            e.preventDefault();
            var file = document.querySelector('input[name=required_picture]').files[0];

            var data = {
                _token: '{{ csrf_token() }}'

            };

            if(file) {
                if(file.size<=2000000) {
                    console.log("File>>>",file);
                    getBase64(file, function(attachmentDataUrl) {
                        data.attachment = attachmentDataUrl;
                        postEditPicture(data);
                    });
                } else {
                    $('#edit-picture-form input[name=required_picture]').addClass('is-invalid');
                    $('#edit-picture-form #picture-error').html('<strong>The file size may not be greater than 2MB.</strong>');
                }
            }else {
                postEditPicture(data);
            }
        });

        function postEditPicture(data) {
            $.ajax({
                url: editPictureRouteTemplate,
                type: 'POST',
                data: data,
                success: function(data) {
                    showAlert(data.success);
                    $('#edit-picture-popup').modal('toggle');
                    $('#employee-profile-details').load(' #reload-profile1');
                    $('#nav-profile').load(' #reload-profile2');
                    clearPicturesModal('#edit-picture-form');
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'attachment':
                                        $('#edit-picture-form input[name=required_picture]').addClass('is-invalid');
                                        $('#edit-picture-form #picture-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                    case 'required_picture':
                                        $('#edit-picture-form input[name=required_picture]').addClass('is-invalid');
                                        $('#edit-picture-form #picture-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                    if(xhr.status == 413) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error 413: ", xhr);
                        console.log("Error 413 status: ", xhr.statusText);
                        $('#edit-picture-form input[name=required_picture]').addClass('is-invalid');
                        $('#edit-picture-form #picture-error').html('<strong>File is too large</strong>');

                    }
                }
            });
        }
    });



    // GENERAL FUNCTIONS
    // convert attachement to base64
    function getBase64(file, onLoad) {
        var reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = function () {
            onLoad(reader.result);
        };
        reader.onerror = function (error) {
            console.log('Error: ', error);
        };
    }

    function clearPicturesModal(htmlId) {
        $(htmlId + ' #attachment').val('');
        $(htmlId + ' #picture').val('');

        $(htmlId + ' #attachment').removeClass('is-invalid');
        $(htmlId + ' #picture').removeClass('is-invalid');
    }
    function clearPicturesError(htmlId) {
        $(htmlId + ' #attachment').removeClass('is-invalid');
        $(htmlId + ' #picture').removeClass('is-invalid');

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
