@extends('layouts.admin-base') 
@section('content')
<div class="container pb-5">
    <div class="card">
            <form method="POST" action="{{ route('admin.employees.add') }}" id="register_employee">
        <div class="card-body">
                @csrf {{-- Basic --}}
                <div class="row">
                    <div class="col-sm-12 p-3">
                        <h3>Basic Details</h3>
                    </div>
                    <div class="col-sm-4 d-flex justify-content-center">
                        <i class="fas fa-user-circle fa-10x text-info"></i>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right text-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                    required> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-2 col-form-label text-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    value="{{ old('password') }}" required> {{-- @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span> @endif --}}
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-2 col-form-label text-right">Mobile No</label>
                            <div class="col-md-6">
                                <input id="contact_no" type="text" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" name="contact_no"
                                    value="{{ old('contact_no') }}" required> @if ($errors->has('contact_no'))
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('contact_no') }}</strong>
                          </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-2 col-form-label text-right">Address</label>
                            <div class="col-md-6">
                                <textarea id="address" type="Address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }} text-left" name="address"
                                    value="{{ old('address') }}" required></textarea> @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                    </div>
                </div>
                {{-- Personal --}}
                <hr>
                <div class="row">
                    <div class="col-sm-12 p-3">
                        <h3>Personal Details</h3>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">IC No:</label>
                            <div class="col-md-6">
                                <input id="ic_no" type="text" class="form-control{{ $errors->has('ic_no') ? ' is-invalid' : '' }}" name="ic_no" value="{{ old('ic_no') }}"
                                    required> @if ($errors->has('ic_no'))
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('ic_no') }}</strong>
                                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Gender:</label>
                            <div class="col-md-6">
                                <select name="gender" id="gender" class="form-control">
                                                    {{-- <option {{ $Gender->type == 'Male' ? 'selected':'' }}>Male</option> --}}
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                               </select>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Date of Birth:</label>
                            <div class="col-md-6">
                                <input id="dobDate" type="text" class="form-control" readonly>
                                <input id="altdobDate" type="text" class="form-control" name="dob" hidden>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Marital Status:</label>
                            <div class="col-md-6">
                                <select class="form-control" id="maritial_status" name="maritial_status">
                                        <option selected disabled>Select Marital Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
        
                                               </select>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Race:</label>
                            <div class="col-md-6">
                                <input id="race" type="text" class="form-control{{ $errors->has('race') ? ' is-invalid' : '' }}" name="race" value="{{ old('race') }}"
                                    required> @if ($errors->has('race'))
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('race') }}</strong>
                                                </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">Nationality:</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('countries') ? ' is-invalid' : '' }}" name="countries" id="countries">
                                                    <option selected disabled>Select Nationality</option>
                                                  @foreach($countries as $item)
                                                  <option value="{{ $item->id }}">{{ $item->citizenship }}</option>
                                                  @endforeach
                                                </select> @if ($errors->has('countries'))
                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('countries') }}</strong>
                                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Number of Child:</label>
                            <div class="col-md-6">
                                <input id="total_child" type="text" class="form-control{{ $errors->has('total_child') ? ' is-invalid' : '' }}" name="total_child"
                                    value="{{ old('total_child') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Driver License No:</label>
                            <div class="col-md-6">
                                <input id="driver_license_number" type="text" class="form-control{{ $errors->has('driver_license_number') ? ' is-invalid' : '' }}"
                                    name="driver_license_number" value="{{ old('driver_license_number') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">License Expiry Date:</label>
                            <div class="col-md-6">
                                <input id="licenseExpiryDate" type="text" class="form-control" readonly>
                                <input id="altlicenseExpiryDate" type="text" class="form-control" name="driver_license_expiry_date" hidden>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Company --}}
                <hr>
                <div class="row">
                    <div class="col-sm-12 p-3">
                        <h3>Company Details</h3>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">Employee ID:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">Department:</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('departments') ? ' is-invalid' : '' }}" name="departments" id="departments">
                                                    @foreach(App\Department::all() as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                    @endforeach
                                                  </select> @if ($errors->has('departments'))
                                <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $errors->first('departments') }}</strong>
                                                      </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Company:</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" name="company_id" id="company_id">
                                                    @foreach(App\Company::all() as $company)
                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @endforeach
                                                  </select> @if ($errors->has('company_id'))
                                <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $errors->first('company_id') }}</strong>
                                                      </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">EPF No:</label>
                            <div class="col-md-6">
                                <input id="epf_no" type="text" class="form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" name="epf_no" value="{{ old('epf_no') }}"
                                    required>

                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Confirmation Date:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Basic Salary:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" readonly>

                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">Position:</label>
                            <div class="col-md-6">
                                <select id="position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="dropdown">
                                                    @foreach(App\EmployeePosition::all() as $position)
                                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                    @endforeach
                                                  </select> @if ($errors->has('position'))
                                <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $errors->first('position') }}</strong>
                                                      </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Tax No:</label>
                            <div class="col-md-6">
                                <input id="tax_no" type="text" class="form-control{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" name="tax_no" value="{{ old('tax_no') }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Joined Date:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-right">Resignation Date:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>

           
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">
                {{ __('Submit') }}
            </button>
        </div>
    </form>
    </div>
</div>
@endsection