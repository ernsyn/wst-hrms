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
                            <button type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#editEmployeePopup">
                                Edit <i class="fas fa-pen"></i>
                            </button>
                        </div>
                    </div>
                </form>
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
                            <a class="nav-item nav-link" id="nav-attachment-tab" data-toggle="tab" href="#nav-attachment" role="tab" aria-controls="nav-attachment"
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
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->nationality}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Number of Child</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->total_child}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Driver License No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->driver_license_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">License Expiry Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->driver_license_expiry_date}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider pb-3"></div>
                                        <div class="col-md-12">COMPANY</div>
                                        <div class="row p-3">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Company ID</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->company_id}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">EPF No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->epf_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Confirmation Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->name}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Basic Salary</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->basic_salary}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">

                                                    <label class="col-lg-5 col-form-label">Tax No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->tax_no}}">
                                                    </div>

                                                    <label class="col-lg-5 col-form-label">SOCSO No</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->eis_no}}">
                                                    </div>
                                                    <label class="col-lg-5 col-form-label">Joined Date</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" readonly class="text-capitalize form-control-plaintext" value="{{$user->joined_date}}">
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
                       
                                        <button type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#editProfilePopup">
                                                Edit <i class="fas fa-pen"></i>
                                            </button>
                                    </div>
                                    <div class="col-md-1">
                       
                                        <button type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#editCompanyPopup">
                                                Edit <i class="fas fa-pen"></i>
                                            </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        {{-- Emergency --}}
                        @include('pages.admin.emergency-contact', ['user' => $user])
                        {{-- Dependent --}}
                        @include('pages.admin.employee-dependent')
                        {{-- Immigration --}}
                        @include('pages.admin.employee-immigration')
                        {{-- Visa --}}
                        @include('pages.admin.employee-visa')
                        {{-- Job --}}
                        @include('pages.admin.job')
                        {{-- Bank --}}
                        @include('pages.admin.employee-bank')
                        {{-- Qualification --}}
                        @include('pages.admin.qualification')
                        {{-- Attachment --}}
                        @include('pages.admin.attachment')
                        {{-- Work Days --}}
                        <div class="tab-pane fade show p-3" id="nav-workdays" role="tabpanel" aria-labelledby="nav-workdays-tab">
                        </div>
                        {{-- Report To --}}
                        @include('pages.admin.report-to')
                        {{-- History --}}
                        @include('pages.admin.history')
                        {{-- Security Group --}}
                        <div class="tab-pane fade show p-3" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                







<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="updateContactLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateContactLabel">Edit Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_emergency_contact') }}" id="edit_emergency_contact">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">                      
                            <label class="col-md-10 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>                          
                            </div>  
                            <label class="col-md-10 col-form-label">Email*</label>
                            <div class="col-md-7">
                                <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>                          
                            </div>  
                            <label class="col-md-10 col-form-label">Mobile No*</label>
                            <div class="col-md-7">
                                <input id="mobile" name="mobile" type="text" class="phone-format form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" value="{{ old('mobile') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Address</label> 
                            <div class="col-md-10">                                     
                                <textarea name="address" class="form-control"></textarea>
                            </div>    
                            <label class="col-md-10 col-form-label">IC No*</label>
                            <div class="col-md-7">
                                <input id="ic_no" name="ic_no" type="text" class="form-control{{ $errors->has('ic_no') ? ' is-invalid' : '' }}" value="{{ old('ic_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Nationality*</label>
                            <div class="col-md-7">
                                <input id="ic_no" name="ic_no" type="text" class="form-control{{ $errors->has('ic_no') ? ' is-invalid' : '' }}" value="{{ old('ic_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Gender*</label>
                            <div class="col-md-7">
                                <input id="ic_no" name="ic_no" type="text" class="form-control{{ $errors->has('ic_no') ? ' is-invalid' : '' }}" value="{{ old('ic_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Number of Child*</label>
                            <div class="col-md-7">
                                <input id="no_child" name="no_child" type="number" class="form-control{{ $errors->has('no_child') ? ' is-invalid' : '' }}" value="{{ old('no_child') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Date of Birth*</label>
                            <div class="col-md-7">
                                <input id="no_child" name="no_child" type="number" class="form-control{{ $errors->has('no_child') ? ' is-invalid' : '' }}" value="{{ old('no_child') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Driver License No*</label>
                            <div class="col-md-7">
                                <input id="license_no" name="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" value="{{ old('license_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Maritual Status*</label>
                            <div class="col-md-7">
                                <input id="license_no" name="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" value="{{ old('license_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">License Expiry Date*</label>
                            <div class="col-md-7">
                                <input id="license_no" name="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" value="{{ old('license_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Race*</label>
                            <div class="col-md-7">
                                <input id="license_no" name="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" value="{{ old('license_no') }}" required>                          
                            </div>
                            <hr>
                            <label class="col-md-10 col-form-label">Position*</label>
                            <div class="col-md-7">
                                <input id="license_no" name="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" value="{{ old('license_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Department*</label>
                            <div class="col-md-7">
                                <input id="license_no" name="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" value="{{ old('license_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Tax No*</label>
                            <div class="col-md-7">
                                <input id="tax_no" name="tax_no" type="text" class="form-control{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" value="{{ old('tax_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">EPF No*</label>
                            <div class="col-md-7">
                                <input id="epf_no" name="epf_no" type="text" class="form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" value="{{ old('epf_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Joined Date*</label>
                            <div class="col-md-7">
                                <input id="license_no" name="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" value="{{ old('license_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Confirmation Date*</label>
                            <div class="col-md-7">
                                <input id="license_no" name="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" value="{{ old('license_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Resignation Date*</label>
                            <div class="col-md-7">
                                <input id="license_no" name="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" value="{{ old('license_no') }}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Basic Salary*</label>
                            <div class="col-md-7">
                                <input id="basic_salary" name="basic_salary" type="number" class="form-control{{ $errors->has('basic_salary') ? ' is-invalid' : '' }}" value="{{ old('basic_salary') }}" required>                          
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
 

<div class="modal fade" id="editCompanyPopup" tabindex="-1" role="dialog" aria-labelledby="updateProfileLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="updateContactLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('edit_company_popup') }}" id="edit_company_popup">
                @csrf
                <div class="row pb-5">
                    <div class="col-xl-8">                      

                 
                        <label class="col-md-10 col-form-label">Company*</label>
                        <div class="col-md-7">
                            <select class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" name="company_id" id="company_id">
                                @foreach($companies as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                              </select>                                
                              @if ($errors->has('company_id'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('company_id') }}</strong>
                                  </span>
                              @endif
                        </div>
                        <label class="col-md-10 col-form-label">Tax No*</label>
                        <div class="col-md-7">
                            <input id="tax_no" name="tax_no" type="text" class="form-control{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" value="{{$user->tax_no}}" required>                          
                        </div>
                        <label class="col-md-10 col-form-label">EPF No*</label>
                        <div class="col-md-7">
                            <input id="epf_no" name="epf_no" type="text" class="form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" value="{{$user->epf_no}}" required>                          
                        </div>
                 
                    <label class="col-md-10 col-form-label">SOCSO No*</label>
                    <div class="col-md-7">
                        <input id="socso_no" name="socso_no" type="text" class="form-control{{ $errors->has('socso_no') ? ' is-invalid' : '' }}" value="{{$user->eis_no}}" required>                          
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

<div class="modal fade" id="editEmployeePopup" tabindex="-1" role="dialog" aria-labelledby="updateContactLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateContactLabel">Edit Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_employee_popup') }}" id="edit_employee_popup">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">                      
                            <label class="col-md-10 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$user->name}}" required>                          
                            </div>  
                            <label class="col-md-10 col-form-label">Email*</label>
                            <div class="col-md-7">
                                <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$user->email}}" required>                          
                            </div>  
                            <label class="col-md-10 col-form-label">Mobile No*</label>
                            <div class="col-md-7">
                                <input id="contact_no" name="contact_no" type="text" class="phone-format form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" value="{{$user->contact_no}}" required>                          
                            </div>
                            <label class="col-md-10 col-form-label">Address</label> 
                            <div class="col-md-10">                                     
                                <textarea name="address" class="form-control">{{$user->address}}</textarea>
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

<div class="modal fade" id="editProfilePopup" tabindex="-1" role="dialog" aria-labelledby="updateProfileLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="updateContactLabel">Edit Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('edit_profile_popup') }}" id="edit_profile_popup">
                            @csrf
                            <div class="row pb-5">
                                <div class="col-xl-8">                      
   
                                    <label class="col-md-10 col-form-label">IC No*</label>
                                    <div class="col-md-7">
                                        <input id="ic_no" name="ic_no" type="text" class="form-control{{ $errors->has('ic_no') ? ' is-invalid' : '' }}" value="{{$user->ic_no}}" required>                          
                                    </div>
                                    <label class="col-md-10 col-form-label">Nationality*</label>
                                    <div class="col-md-7">
                                        <input id="nationality" name="nationality" type="text" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" value="{{$user->nationality}}" required>                          
                                    </div>
                                    <label class="col-md-10 col-form-label">Gender*</label>
                                    <div class="col-md-7">
                                            <select name="gender" id="gender" class ="form-control">
                                                    
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                               </select>                       
                                    </div>
                                    <label class="col-md-10 col-form-label">Number of Child*</label>
                                    <div class="col-md-7">
                                        <input id="no_child" name="no_child" type="number" class="form-control{{ $errors->has('no_child') ? ' is-invalid' : '' }}" value="{{$user->total_child}}" required>                          
                                    </div>
                                    <label class="col-md-10 col-form-label">Date of Birth*</label>
                                    <div class="col-md-7">
                                            <input id="dobDateEdit" type="text" class="form-control" readonly>
                                            <input id="altdobDateEdit" type="text" class="form-control" name="altdobDateEdit" hidden>     
         
                                    </div>
                                    <label class="col-md-10 col-form-label">Driver License No*</label>
                                    <div class="col-md-7">
                                        <input id="license_no" name="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" value="{{$user->driver_license_no}}" required>                          
                                    </div>
                                    <label class="col-md-10 col-form-label">Maritual Status*</label>
                                    <div class="col-md-7">
                                            <select class ="form-control" id="maritial_status" name="maritial_status">
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                               </select>                          
                                    </div>
                                    <label class="col-md-10 col-form-label">License Expiry Date*</label>
                                    <div class="col-md-7">
                                            <input id="licenseExpiryDateAddition" type="text" class="form-control" readonly>
                                            <input id="altlicenseExpiryDateAddition" type="text" class="form-control" name="altlicenseExpiryDateAddition" hidden>                          
                                    </div>
                                    <label class="col-md-10 col-form-label">Race*</label>
                                    <div class="col-md-7">
                                        <input id="race" name="race" type="text" class="form-control{{ $errors->has('race') ? ' is-invalid' : '' }}" value="{{$user->race}}" required>                          
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



@endsection