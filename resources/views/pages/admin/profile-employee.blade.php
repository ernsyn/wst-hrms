@extends('layouts.base') 
@section('pageTitle', 'Home') 
@section('content')
<div class="p-4">
    <div class="card py-4 shadow-sm">
        <div class="card-body">
            <div class="container-fluid font-weight-bold">
                <form>
                    <div class="row">
                        <div class="col-xl-2 d-flex justify-content-center">
                            <i class="fas fa-user-circle fa-10x text-info"></i>
                        </div>
                      
                        <div class="col-md-8">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" readonly class="text-capitalize form-control-plaintext form-control-lg font-weight-bold" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="email" readonly class="text-capitalize form-control-plaintext" value="{{$user->email}}">
                                </div>
                                <label class="col-lg-2 col-form-label">Mobile No</label>
                                <div class="col-lg-10">
                                    <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->contact_no}}">
                                </div>
                                <label class="col-lg-2 col-form-label">Address</label>
                                <div class="col-lg-10">
                                    <textarea type="Address" readonly class="text-capitalize form-control-plaintext" rows="3" style="resize:none">{{$user->address}}
                                        </textarea>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary rounded">
                                Edit <i class="fas fa-pen"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    {{-- Tab List --}}
                    <nav class="col-sm-12">
                        <div class="nav nav-tabs font-weight-bold scrollable d-flex flex-nowrap tabbable" id="nav-tab" role="tablist">
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
                            <a class="nav-item nav-link" id="nav-attachment-tab" data-toggle="tab" href="#nav-attachment" role="tab" aria-controls="nav-attachment"
                                aria-selected="true">Attachment</a>
                            <a class="nav-item nav-link" id="nav-workdays-tab" data-toggle="tab" href="#nav-workdays" role="tab" aria-controls="nav-workdays"
                                aria-selected="false">WorkDays</a>
                            <a class="nav-item nav-link" id="nav-reportto-tab" data-toggle="tab" href="#nav-reportto" role="tab" aria-controls="nav-reportto"
                                aria-selected="true">ReportTo</a>
                            <a class="nav-item nav-link" id="nav-history-tab" data-toggle="tab" href="#nav-history" role="tab" aria-controls="nav-history"
                                aria-selected="false">History</a>
                            <a class="nav-item nav-link" id="nav-security-tab" data-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security"
                                aria-selected="true">SecurityGroup</a>
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
                                                    <label class="col-lg-5 col-form-label">IC No</label>
                                                    <div class="col-lg-7 text-lowercase">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->ic_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Gender</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->gender}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Date of Birth</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->dob}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Marital Status</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->marital_status}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Race</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->race}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Nationality</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->citizenship}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Number of Child</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->total_child}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Driver License No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->driver_license_number}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">License Expiry Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->license_expiry_date}}">
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
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->emp_id}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Department</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="IT Department">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">EPF No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->epf_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Confirmation Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="10-1-2019">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Basic Salary</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->basic_salary}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Position</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="Executive">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Tax No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->tax_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Joined Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="09-09-2018">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Resignation Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-primary rounded-circle">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- Emergency --}}
                        @include('pages.employee.emergency-contact')
                        {{-- Dependent --}}
                        @include('pages.employee.employee-dependent')
                        {{-- Immigration --}}
                        @include('pages.employee.employee-immigration')
                        {{-- Visa --}}
                        @include('pages.employee.employee-visa')
                        {{-- Job --}}
                        @include('pages.employee.job')
                        {{-- Bank --}}
                        @include('pages.employee.bank')
                        {{-- Qualification --}}
                        @include('pages.employee.qualification')
                        {{-- Attachment --}}
                        @include('pages.employee.attachment')
                        {{-- Work Days --}}
                        <div class="tab-pane fade show p-3" id="nav-workdays" role="tabpanel" aria-labelledby="nav-workdays-tab">
                        </div>
                        {{-- Report To --}}
                        @include('pages.employee.report-to')
                        {{-- History --}}
                        @include('pages.employee.history')
                        {{-- Security Group --}}
                        <div class="tab-pane fade show p-3" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection