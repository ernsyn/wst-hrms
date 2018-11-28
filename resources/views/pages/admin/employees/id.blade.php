@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div id="alert-container">
    </div>
    <div id="employee-profile-card" class="card shadow-sm">
        <div id="employee-profile-details" class="card-body bg-primary text-white">
            <div class="d-flex align-items-stretch" id="reload-profile1">
                <div id="profile-pic-container" class="p-2 flex-grow-0 d-flex flex-column align-items-center">
                    <div class="p-2">
                        <i class="fas fa-user-circle fa-8x"></i>
                    </div>
                    <div class="pt-2 mt-auto">
                        <h6><strong>Profile Image</strong></h6>
                    </div>
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
                            <span class="field-value">{{$employee->dob}}</span>
                        </div>
                        <div class="field pb-1">
                            <span class="field-name mr-2">Gender</span>
                            <span class="field-value">{{ ucfirst($employee->gender) }}</span>
                        </div>
                        <div class="field pb-1">
                            <span class="field-name mr-2">Nationality</span>
                            <span class="field-value">{{$employee->nationality}}</span>
                        </div>
                    </div>
                </div>
                {{-- Ignore --}} {{--
                <div id="end-btn-group">
                    <button type="button" class="btn btn-primary rounded">
                        <i class="fas fa-pen"></i>
                    </button>
                </div> --}}
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
                    </div>
                </nav>
                {{-- Tab Content --}}
                <div class="tab-content col-sm-12 text-justify" id="nav-tabContent">
                    {{-- Profile --}}
                    <div class="tab-pane fade show active p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row" id="reload-profile2">
                                <div class="col-md-11 text-capitalize">
                                    {{-- <div class="col-md-12 font-weight-bold">PERSONAL</div> --}}
                                    <div class="row p-3">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <span class="col-lg-5 p-3">Contact No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->contact_no}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Marital Status</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->marital_status}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Race</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->race}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Number of Child</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->total_children}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <span class="col-lg-5 p-3">Driver License No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->driver_license_no}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">License Expiry Date</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->driver_license_expiry_date}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">EPF No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->epf_no}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Tax No</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->tax_no}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="dropdown-divider pb-3"></div>
                                    <div class="col-md-12 font-weight-bold">COMPANY</div>
                                    <div class="row p-3">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <span class="col-lg-5 p-3">Employee ID</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->id}}</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Department</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">IT Department</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Confirmation Date</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">10-1-2019</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Basic Salary</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">{{$employee->basic_salary}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <span class="col-lg-5 p-3">Position</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value">Executive</span>
                                                </div>
                                                <span class="col-lg-5 p-3">Joined Date</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value"></span>
                                                </div>
                                                <span class="col-lg-5 p-3">Resignation Date</span>
                                                <div class="col-lg-7 font-weight-bold p-3">
                                                    <span class="field-value"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="col-md-1">
                                    {{-- <button type="button" class="btn btn-primary rounded-circle">
                                            <i class="fas fa-pen"></i>
                                        </button> --}}
                                    <button type="button" class="btn btn-primary rounded-circle" data-toggle="modal" data-current="{{$employee}}" data-target="#edit-profile-popup"><i class="fas fa-pen"></i>
                                        </button>
                                </div>
                            </div>
                    </div>
                    {{-- Emergency --}}
                    @include('pages.admin.employees.id.emergency-contacts', ['id' => $employee->id])
                    {{-- Dependent --}}
                    @include('pages.admin.employees.id.dependents', ['id' => $employee->id])
                    {{-- Immigration --}}
                    @include('pages.admin.employees.id.immigrations', ['id' => $employee->id])
                    {{-- Visa --}}
                    @include('pages.admin.employees.id.visas', ['id' => $employee->id])
                    {{-- Job --}}
                    @include('pages.admin.employees.id.jobs', ['id' => $employee->id])
                    {{-- Bank --}}
                    @include('pages.admin.employees.id.bank-accounts', ['id' => $employee->id])
                    {{-- Qualification --}}
                    @include('pages.admin.employees.id.qualifications', ['id' => $employee->id])
                    {{-- Attachment --}}
                    @include('pages.admin.employees.id.attachments', ['id' => $employee->id])
                    {{-- Work Days --}}
                    @include('pages.admin.employees.id.working-day', ['id' => $employee->id])
                    {{-- Report To --}}
                    @include('pages.admin.employees.id.report-to', ['id' => $employee->id])
                    {{-- History --}}
                    @include('pages.admin.employees.id.history', ['id' => $employee->id])
                    {{-- Security Group --}}
                    @include('pages.admin.employees.id.security-group', ['id' => $employee->id])
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
                            <label for="dob"><strong>DOB*</strong></label>
                            <input id="dob" type="text" class="form-control" placeholder="" value="" required>
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
                            <label for="total-children"><strong>Number of Child*</strong></label>
                            <input id="total-children" type="text" class="form-control" placeholder="" value="" required>
                            <div id="total-children-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="driver-license-no"><strong>Driver License No*</strong></label>
                            <input id="driver-license-no" type="text" class="form-control" placeholder="" value="" required>
                            <div id="driver-license-no-error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="driver-license-expiry-date"><strong>License Expiry Date*</strong></label>
                            <input id="driver-license-expiry-date" type="text" class="form-control" placeholder="" value="" required>
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
                </div>
                <div class="modal-footer">
                    <button id="edit-profile-submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
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
            $('#edit-profile-form #dob').val(currentData.dob);
            $('#edit-profile-form #gender').val(currentData.gender);
            $('#edit-profile-form #contact-no').val(currentData.contact_no);
            $('#edit-profile-form #marital-status').val(currentData.marital_status);
            $('#edit-profile-form #race').val(currentData.race);
            $('#edit-profile-form #total-children').val(currentData.total_children);
            $('#edit-profile-form #driver-license-no').val(currentData.driver_license_no);
            $('#edit-profile-form #driver-license-expiry-date').val(currentData.driver_license_expiry_date);
            $('#edit-profile-form #epf-no').val(currentData.epf_no);
            $('#edit-profile-form #tax-no').val(currentData.tax_no);
        });

        var editRouteTemplate = "{{ route('admin.employees.profile.edit.post', ['id' => $employee->id]) }}";
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
                    dob: $('#edit-profile-form #dob').val(),
                    gender: $('#edit-profile-form #gender').val(),
                    contact_no: $('#edit-profile-form #contact-no').val(),
                    marital_status: $('#edit-profile-form #marital-status').val(),
                    race: $('#edit-profile-form #race').val(),
                    total_children: $('#edit-profile-form #total-children').val(),
                    driver_license_no: $('#edit-profile-form #driver-license-no').val(),
                    driver_license_expiry_date: $('#edit-profile-form #driver-license-expiry-date').val(),
                    epf_no: $('#edit-profile-form #epf-no').val(),
                    tax_no: $('#edit-profile-form #tax-no').val()
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
