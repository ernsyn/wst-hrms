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
                            <span class="field-value">{{ App\Country::find($employee->nationality)->citizenship }}</span>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <div class="col-lg-12">
                            <input type="text" readonly class="form-control-plaintext form-control-lg font-weight-bold"
                                value="{{$employee->user->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" readonly class="form-control-plaintext" value="{{$employee->user->email}}">
                        </div>
                        <label class="col-lg-2 col-form-label">Mobile No</label>
                        <div class="col-lg-10">
                            <input type="text" readonly class="form-control-plaintext" value="{{$employee->contact_no}}">
                        </div>
                        <label class="col-lg-2 col-form-label">Address</label>
                        <div class="col-lg-10">
                            <textarea type="Address" readonly class="form-control-plaintext" rows="3" style="resize:none">{{$employee->address}}
                                    </textarea>
                        </div>
                    </div> --}}
                </div>
                {{-- <div id="profile-pic-container" class="col-xl-3">
                    <div class="row col">
                        <i class="fas fa-user-circle fa-10x"></i>
                    </div>
                    <div class="row col">
                        <h6><strong>Profile Image</strong></h6>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <input type="text" readonly class="form-control-plaintext form-control-lg font-weight-bold"
                                value="{{$employee->user->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" readonly class="form-control-plaintext" value="{{$employee->user->email}}">
                        </div>
                        <label class="col-lg-2 col-form-label">Mobile No</label>
                        <div class="col-lg-10">
                            <input type="text" readonly class="form-control-plaintext" value="{{$employee->contact_no}}">
                        </div>
                        <label class="col-lg-2 col-form-label">Address</label>
                        <div class="col-lg-10">
                            <textarea type="Address" readonly class="form-control-plaintext" rows="3" style="resize:none">{{$employee->address}}
                                    </textarea>
                        </div>
                    </div> --}}

                {{-- Ignore --}}
                <div id="end-btn-group">
                    <button type="button" class="btn btn-primary rounded">
                        <i class="fas fa-pen"></i>
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body">
            {{-- <div class="container-fluid font-weight-bold"> --}}
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
                                                    <label class="col-lg-5 col-form-label">IC No</label>
                                                    <div class="col-lg-7 text-lowercase">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->ic_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Gender</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->gender}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Date of Birth</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->dob}}">
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
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Nationality</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->nationality}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Number of Child</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->total_child}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Driver License No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->driver_license_number}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">License Expiry Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->license_expiry_date}}">
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
                                                    <label class="col-lg-5 col-form-label">EPF No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->epf_no}}">
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
                                                    <label class="col-lg-5 col-form-label">Tax No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="{{$employee->tax_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Joined Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            value="09-09-2018">
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
                                        <button type="button" class="btn btn-primary rounded-circle">
                                            <i class="fas fa-pen"></i>
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
                        <div class="tab-pane fade show p-3" id="nav-workdays" role="tabpanel" aria-labelledby="nav-workdays-tab">
                        </div>
                        {{-- Report To --}}
                        @include('pages.admin.employees.id.report-to', ['id' => $employee->id])
                        {{-- History --}}
                        @include('pages.admin.employees.id.history', ['id' => $employee->id])
                        {{-- Security Group --}}
                        <div class="tab-pane fade show p-3" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
        </div>
    </div>
</div>
@endsection
