@extends('layouts.admin-base')
@section('pageTitle', 'Employee Profile')
@section('content')
<div class="container">
    <div id="alert-container">

    </div>
    <div id="employee-profile-card" class="card shadow-sm">
        <div id="employee-profile-details" class="card-body bg-primary text-white">
            <div class="d-flex align-items-stretch">
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
                {{-- Ignore --}}
                <div id="end-btn-group">
                    <button type="button" class="btn btn-primary rounded">
                        <i class="fas fa-pen"></i>
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body">
                <div class="row">
                    {{-- Tab List --}}
                    <nav class="col-sm-12">
                        <div class="nav nav-tabs font-weight-bold scrollable d-flex flex-nowrap tabbable text-nowrap"
                            id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                            <a class="nav-item nav-link" id="nav-emergency-tab" data-toggle="tab" href="#nav-emergency"
                                role="tab" aria-controls="nav-emergency" aria-selected="false">Emergency</a>
                            <a class="nav-item nav-link" id="nav-dependent-tab" data-toggle="tab" href="#nav-dependent"
                                role="tab" aria-controls="nav-dependent" aria-selected="true">Dependent</a>
                            <a class="nav-item nav-link" id="nav-immigration-tab" data-toggle="tab" href="#nav-immigration"
                                role="tab" aria-controls="nav-immigration" aria-selected="false">Immigration</a>
                            <a class="nav-item nav-link" id="nav-visa-tab" data-toggle="tab" href="#nav-visa" role="tab"
                                aria-controls="nav-visa" aria-selected="true">Visa</a>
                            <a class="nav-item nav-link" id="nav-job-tab" data-toggle="tab" href="#nav-job" role="tab"
                                aria-controls="nav-job" aria-selected="false">Job</a>
                            <a class="nav-item nav-link" id="nav-bank-tab" data-toggle="tab" href="#nav-bank" role="tab"
                                aria-controls="nav-bank" aria-selected="true">Bank</a>
                            <a class="nav-item nav-link" id="nav-qualification-tab" data-toggle="tab" href="#nav-qualification"
                                role="tab" aria-controls="nav-qualification" aria-selected="false">Qualification</a>
                            <a class="nav-item nav-link" id="nav-attachments-tab" data-toggle="tab" href="#nav-attachments"
                                role="tab" aria-controls="nav-attachments" aria-selected="true">Attachment</a>
                            <a class="nav-item nav-link" id="nav-workdays-tab" data-toggle="tab" href="#nav-workdays"
                                role="tab" aria-controls="nav-workdays" aria-selected="false">Work Days</a>
                            <a class="nav-item nav-link" id="nav-reportto-tab" data-toggle="tab" href="#nav-reportto"
                                role="tab" aria-controls="nav-reportto" aria-selected="true">Report To</a>
                            <a class="nav-item nav-link" id="nav-history-tab" data-toggle="tab" href="#nav-history"
                                role="tab" aria-controls="nav-history" aria-selected="false">History</a>
                            <a class="nav-item nav-link" id="nav-security-tab" data-toggle="tab" href="#nav-security"
                                role="tab" aria-controls="nav-security" aria-selected="true">Security Group</a>
                        </div>
                    </nav>
                    {{-- Tab Content --}}
                    <div class="tab-content col-sm-12 text-justify" id="nav-tabContent">
                        {{-- Profile --}}
                        <div class="tab-pane fade show active p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form>
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="col-md-12">PERSONAL</div>
                                        <div class="row p-3">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Contact No</label>
                                                    <div class="col-lg-7 text-lowercase">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->contact_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Marital Status</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->marital_status}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Race</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->race}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Number of Child</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->total_children}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Driver License No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->driver_license_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">License Expiry Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->driver_license_expiry_date}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">EPF No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->epf_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Tax No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->tax_no}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider pb-3"></div>
                                        <div class="col-md-12">COMPANY</div>
                                        <div class="row p-3">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Employee ID</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->id}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Department</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="IT Department">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Confirmation Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="10-1-2019">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Basic Salary</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->basic_salary}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Position</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="Executive">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Joined Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Resignation Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        {{-- <button type="button" class="btn btn-primary rounded-circle">
                                            <i class="fas fa-pen"></i>
                                        </button> --}}
                                        <button type="button" class="btn btn-primary rounded-circle" data-toggle="modal" data-current="{{$employee}}" data-target="#edit-profile-popup"><i class="fas fa-pen"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
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
                {{-- </div> --}}
        </div>
    </div>
</div>
<!-- UPDATE -->
<div class="modal fade" id="edit-profile-popup" tabindex="-1" role="dialog" aria-labelledby="edit-profile-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-profile-label">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-profile-form">
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
                            <label for="contact-no"><strong>Contact Number*</strong></label>
                            <input id="contact-no" type="tel" class="form-control" placeholder="" value="" required>
                            <div id="contact-no-error" class="invalid-feedback">
                            </div>
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
            $('#edit-profile-form #contact-no').val(currentData.contact_no);
        });

        // var editRouteTemplate = "{{ route('admin.employees.profile.edit.post', ['id' => '<<id>>']) }}";
        // $('#edit-profile-submit').click(function(e){
        //     clearProfilesError('#edit-profile-form');
        //     var editProfileRoute = editProfileRouteTemplate.replace(encodeURI('<<id>>'), editProfileId);
        //     e.preventDefault();
        //     $.ajax({
        //         url: editProfileRoute,
        //         type: 'POST',
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             ic_no: $('#edit-profile-form #ic-no').val(),
        //             contact_no: $('#edit-profile-form #contact-no').val()
        //         },
        //         success: function(data) {
        //             showAlert(data.success);
        //             // attachmentsTable.ajax.reload();
        //             $('#edit-profile-popup').modal('toggle');
        //             clearProfilesModal('#edit-profile-form');
        //         },
        //         error: function(xhr) {
        //             if(xhr.status == 422) {
        //                 var errors = xhr.responseJSON.errors;
        //                 console.log("Error: ", xhr);
        //                 for (var errorField in errors) {
        //                     if (errors.hasOwnProperty(errorField)) {
        //                         console.log("Error: ", errorField);
        //                         switch(errorField) {
        //                             case 'ic_no':
        //                                 $('#edit-profile-form #ic-no').addClass('is-invalid');
        //                                 $('#edit-profile-form #contact-no').html('<strong>' + errors[errorField][0] + "</strong>");
        //                             break;
        //                             case 'contact_no':
        //                                 $('#edit-profile-form #ic-no').addClass('is-invalid');
        //                                 $('#edit-profile-form #contact-no').html('<strong>' + errors[errorField][0] + '</strong>');
        //                             break;
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     });
        // });

    });


    // GENERAL FUNCTIONS
    function clearProfilesModal(htmlId) {
        $(htmlId + ' #ic-no').val('');
        $(htmlId + ' #contact-no').val('');

        $(htmlId + ' #ic-no').removeClass('is-invalid');
        $(htmlId + ' #contact-no').removeClass('is-invalid');
    }
    function clearProfilesError(htmlId) {
        $(htmlId + ' #ic-no').removeClass('is-invalid');
        $(htmlId + ' #contact-no').removeClass('is-invalid');
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
