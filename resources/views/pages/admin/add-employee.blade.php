@extends('layouts.base') 
@section('pageTitle', 'Profile')
@section('content')

<div class="card py-4">
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="container-fluid">
            <form method="POST" action="{{ route('register_employee') }}" id="register_employee">
                @csrf
                <div class="row">
                    <div class="col-xl-2 d-flex justify-content-center">
                        <i class="fas fa-user-circle fa-10x text-info"></i>
                    </div>
                    <div class="col-xl-8">
     

                       <div class="form-group row">                        
                            <label class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="012-34567890" name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                  <br/>
                  <label class="col-md-2 col-form-label">Email</label>
                  <div class="col-md-10">
                      <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="012-34567890" name="email" value="{{ old('email') }}" required>
                      @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                      @endif
                  </div>
        <br></br>
        <label class="col-md-2 col-form-label">Password</label>
        <div class="col-md-10">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="password"
                name="password" value="{{ old('password') }}" required>            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span> @endif
        </div>
<br></br>
                  <label class="col-md-2 col-form-label">Mobile No</label>
                  <div class="col-md-10">
                      <input id="contact_no" type="text" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" placeholder="012-34567890" name="contact_no" value="{{ old('contact_no') }}" required>
                      @if ($errors->has('contact_no'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('contact_no') }}</strong>
                      </span>
                      @endif
                  </div>
                  <br></br>
                            <label class="col-md-2 col-form-label">Address</label>
                            <div class="col-md-10">
                                <textarea id="address" type="Address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>
                                </textarea>
                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                          
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <nav class="col-sm-12">
                        <div class="nav nav-tabs font-weight-bold" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Profile</a>
                            <a class="nav-item nav-link" id="nav-company-tab" data-toggle="tab" href="#nav-company" role="tab" aria-controls="nav-company"
                                aria-selected="true">Company</a>
                                {{-- <a class="nav-item nav-link" id="nav-emergency-tab" data-toggle="tab" href="#nav-emergency" role="tab" aria-controls="nav-emergency"
                                aria-selected="true">Emergency Contact</a>
                                <a class="nav-item nav-link" id="nav-dependent-tab" data-toggle="tab" href="#nav-dependent" role="tab" aria-controls="nav-dependent"
                                aria-selected="true">Dependent</a>


                                <a class="nav-item nav-link" id="nav-immigration-tab" data-toggle="tab" href="#nav-immigration" role="tab" aria-controls="nav-immigration"
                                aria-selected="true">Immigration</a>
                                <a class="nav-item nav-link" id="nav-visa-tab" data-toggle="tab" href="#nav-visa" role="tab" aria-controls="nav-visa"
                                aria-selected="true">Visa</a>
                                <a class="nav-item nav-link" id="nav-job-tab" data-toggle="tab" href="#nav-job" role="tab" aria-controls="nav-job"
                                aria-selected="true">Job</a>

                                <a class="nav-item nav-link" id="nav-immigration-tab" data-toggle="tab" href="#nav-immigration" role="tab" aria-controls="nav-immigration"
                                aria-selected="true">Bank</a>
                                <a class="nav-item nav-link" id="nav-visa-tab" data-toggle="tab" href="#nav-visa" role="tab" aria-controls="nav-visa"
                                aria-selected="true">Qualification</a>
                                <a class="nav-item nav-link" id="nav-job-tab" data-toggle="tab" href="#nav-job" role="tab" aria-controls="nav-job"
                                aria-selected="true">Attachment</a>

                                <a class="nav-item nav-link" id="nav-immigration-tab" data-toggle="tab" href="#nav-immigration" role="tab" aria-controls="nav-immigration"
                                aria-selected="true">Working Days</a>
                                <a class="nav-item nav-link" id="nav-visa-tab" data-toggle="tab" href="#nav-visa" role="tab" aria-controls="nav-visa"
                                aria-selected="true">Report To</a>
                                <a class="nav-item nav-link" id="nav-job-tab" data-toggle="tab" href="#nav-job" role="tab" aria-controls="nav-job"
                                aria-selected="true">History</a>

                                <a class="nav-item nav-link" id="nav-job-tab" data-toggle="tab" href="#nav-job" role="tab" aria-controls="nav-job"
                                aria-selected="true">Security</a> --}}
                        </div>
                    </nav>
                    {{-- Profile --}}
                    <div class="tab-content col-sm-12 text-justify pt-4" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">IC No:</label>
                                        <div class="col-md-7">
                                            <input id="ic_no" type="text" class="form-control{{ $errors->has('ic_no') ? ' is-invalid' : '' }}" placeholder="9012104332102" name="ic_no" value="{{ old('ic_no') }}" required>
                                            @if ($errors->has('ic_no'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ic_no') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Gender:</label>
                                        <div class="col-md-7">
                                            <select name="gender" id="gender" class ="form-control">
                                                {{-- <option {{ $Gender->type == 'Male' ? 'selected':'' }}>Male</option> --}}
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                           </select>
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Date of Birth:</label>
                                        <div class="col-md-7">
                                            <input id="dobDate" type="text" class="form-control" readonly>
                                            <input id="altdobDate" type="text" class="form-control" name="dob" hidden>                                            
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Marital Status:</label>
                                        <div class="col-md-7">
                                            <select class ="form-control" id="maritial_status" name="maritial_status">
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
    
                                           </select>
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Race:</label>
                                        <div class="col-md-7">
                                            <input id="race" type="text" class="form-control{{ $errors->has('race') ? ' is-invalid' : '' }}" name="race" value="{{ old('race') }}" required>
                                            @if ($errors->has('race'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('race') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br></br>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Nationality:</label>
                                        <div class="col-md-7">
                                            <select class="form-control{{ $errors->has('countries') ? ' is-invalid' : '' }}" name="countries" id="countries">
                                              @foreach($countries as $item)
                                              <option value="{{ $item->id }}">{{ $item->citizenship }}</option>
                                              @endforeach
                                            </select>                                
                                            @if ($errors->has('countries'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('countries') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Number of Child:</label>
                                        <div class="col-md-7">
                                            <input id="total_child" type="text" class="form-control{{ $errors->has('total_child') ? ' is-invalid' : '' }}" placeholder="0" name="total_child" value="{{ old('total_child') }}" required>
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Driver License No:</label>
                                        <div class="col-md-7">
                                            <input id="driver_license_number" type="text" class="form-control{{ $errors->has('driver_license_number') ? ' is-invalid' : '' }}" placeholder="3213213555" name="driver_license_number" value="{{ old('driver_license_number') }}" required>
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">License Expiry Date:</label>
                                        <div class="col-md-7">
                                            <input id="licenseExpiryDate" type="text" class="form-control" readonly>
                                            <input id="altlicenseExpiryDate" type="text" class="form-control" name="driver_license_expiry_date" hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Company --}}
                        <div class="tab-pane fade" id="nav-company" role="tabpanel" aria-labelledby="nav-company-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Employee ID:</label>
                                        <div class="col-md-7">
                                            <input  type="text" class="form-control" readonly>
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Department:</label>
                                        <div class="col-md-7">
                                            <select class="form-control{{ $errors->has('departments') ? ' is-invalid' : '' }}" name="departments" id="departments">
                                                @foreach($departments as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                              </select>                                
                                              @if ($errors->has('departments'))
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('departments') }}</strong>
                                                  </span>
                                              @endif
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Company:</label>
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
                                        <br></br>
                                        <label class="col-md-5 col-form-label">EPF No:</label>
                                        <div class="col-md-7">
                                            <input id="epf_no" type="text" class="form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" placeholder="012-34567890" name="epf_no" value="{{ old('epf_no') }}" required>
                                            
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Confirmation Date:</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" placeholder="" readonly>
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Basic Salary:</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" placeholder="" readonly>
                                            
                                        </div>
                                        <br></br>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Position:</label>
                                        <div class="col-md-7">
                                            <select id="position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="dropdown">
                                                @foreach($position as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                              </select>                                
                                              @if ($errors->has('position'))
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('position') }}</strong>
                                                  </span>
                                              @endif
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Tax No:</label>
                                        <div class="col-md-7">
                                            <input id="tax_no" type="text" class="form-control{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" placeholder="123123" name="tax_no" value="{{ old('tax_no') }}" required>                                            
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Joined Date:</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" placeholder="" readonly>
                                        </div>
                                        <br></br>
                                        <label class="col-md-5 col-form-label">Resignation Date:</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" placeholder="" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.
                        </div> --}}
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection