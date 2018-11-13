@extends('layouts.base')
@section('content')

<div class="modal fade" id="addCompanyPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_company') }}" id="form_validate"  data-parsley-validate>
                    @csrf
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Name*</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                        name="name" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Code*</label>
                                <div class="col-md-12">
                                    <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Code here"
                                        name="code" value="{{ old('code') }}" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Registration No*</label>
                                <div class="col-md-12">
                                    <input id="registration_no" type="text" class="form-control{{ $errors->has('registration_no') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                        name="registration_no" value="{{ old('registration_no') }}" required>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-8">
                                <label class="col-md-12 col-form-label">Description*</label>
                                <div class="col-md-12">
                                    <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description here"
                                        name="description" value="{{ old('description') }}" required>
                                </div> 
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Url*</label>
                                <div class="col-md-12">
                                    <input id="url" type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" placeholder="Url here"
                                        name="url" value="{{ old('url') }}" required>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-12">
                                <label class="col-md-12 col-form-label">Address*</label>
                                <div class="col-md-12">
                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Address here"
                                        name="address" value="{{ old('address') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">Phone*</label>
                                <div class="col-md-12">
                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Phone here"
                                        name="phone" value="{{ old('phone') }}" required>
                                </div>
                            </div>
                            <div class="col-6">                                            
                                <label class="col-md-12 col-form-label">Tax No*</label>
                                <div class="col-md-12">
                                    <input id="tax_no" type="text" class="form-control{{ $errors->has('tax_no') ? ' is-invalid' : '' }}" placeholder="Tax No here"
                                        name="tax_no" value="{{ old('tax_no') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-4">    
                                <label class="col-md-12 col-form-label">EPF No*</label>
                                <div class="col-md-12">
                                    <input id="epf_no" type="text" class="form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" placeholder="Epf No here"
                                        name="epf_no" value="{{ old('epf_no') }}" required>
                                </div>
                            </div>
                            <div class="col-4">                                            
                                <label class="col-md-12 col-form-label">Eis No*</label>
                                <div class="col-md-12">
                                    <input id="eis_no" type="text" class="form-control{{ $errors->has('eis_no') ? ' is-invalid' : '' }}" placeholder="EIS No here"
                                        name="eis_no" value="{{ old('eis_no') }}" required>
                                </div>
                            </div>
                            <div class="col-4">        
                                <label class="col-md-12 col-form-label">Socso No*</label>
                                <div class="col-md-12">
                                    <input id="socso_no" type="text" class="form-control{{ $errors->has('socso_no') ? ' is-invalid' : '' }}" placeholder="Socso No here"
                                        name="socso_no" value="{{ old('socso_no') }}" required>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group row w-100">
                        </div> --}}
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

<div class="modal fade" id="updateCompanyPopup" tabindex="-1" role="dialog" aria-labelledby="updateCompanyLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateCompanyLabel">Edit Company</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_company') }}" id="edit_company">
                        @csrf
                        <div class="row p-3">
                            <div class="form-group row w-100">
                                <div class="col-4">
                                        <input id="company_id" name="company_id" type="text" hidden>
                                    <label class="col-md-12 col-form-label">Name*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="col-md-12 col-form-label">Code*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="code" name="code" type="text">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="col-md-12 col-form-label">Registration No*</label>
                                    <div class="col-md-12">
                                    <input class="form-control" id="registration_no" name="registration_no" type="text">
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row w-100">
                                <div class="col-8">
                                    <label class="col-md-12 col-form-label">Description*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="description" name="description" type="text">
                                                            </div> 
                                </div>
                                <div class="col-4">
                                    <label class="col-md-12 col-form-label">Url*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="url" name="url" type="text">
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row w-100">
                                <div class="col-12">
                                    <label class="col-md-12 col-form-label">Address*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="address" name="address" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row w-100">
                                <div class="col-6">
                                    <label class="col-md-12 col-form-label">Phone*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="phone" name="phone" type="text">
                                    </div>
                                </div>
                                <div class="col-6">                                            
                                    <label class="col-md-12 col-form-label">Tax No*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="tax_no" name="tax_no" type="text">
                           
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row w-100">
                                <div class="col-4">    
                                    <label class="col-md-12 col-form-label">EPF No*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="epf_no" name="epf_no" type="text">
                                                                          </div>
                                </div>
                                <div class="col-4">                                            
                                    <label class="col-md-12 col-form-label">Eis No*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="eis_no" name="eis_no" type="text">
                                
                                    </div>
                                </div>
                                <div class="col-4">        
                                    <label class="col-md-12 col-form-label">Socso No*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="socso_no" name="socso_no" type="text">
                               
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group row w-100">
                            </div> --}}
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
<div class="p-4">
    <div class="card p-4">
        <div class="card-body">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addCompanyPopup">
                        Add Company
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right tableTools-container"></div>
                    <table class="table display compact table-striped table-bordered table-hover w-100" id="setupCompanyTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Tax No</th>
                                <th>EPF No</th>
                                <th>Socso No</th>
                                <th>EIS No</th>
                                <th>Last Updated</th>
                  
                                <th>Account Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($company as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['description']}}</td>
                                <td>{{$row['registration_no']}}</td>
                                <td>{{$row['tax_no']}}</td>
                                <td>{{$row['epf_no']}}</td>
                                <td>{{$row['socso_no']}}</td>
                                <td>{{$row['eis_no']}}</td>
                                <td>Update by: {{$row['updated_by']}}<br><br> Updated on: {{$row['updated_by updated_at']}}</td>
                        
                                <td>          <button onclick="window.location='{{ url('/admin/company-edit/'.$row['id']) }}';" class="btn btn-default">View</button></td>
                                <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                    data-company-id="{{$row['id']}}"
                                    data-company-name="{{$row['name']}}"
                                    data-company-gst-no="{{$row['gst_no']}}"
                                    data-company-tax-no="{{$row['tax_no']}}"
                                    data-company-epf-no="{{$row['epf_no']}}"
                                    data-company-socso-no="{{$row['socso_no']}}"
                                    data-company-eis-no="{{$row['eis_no']}}"
                                    data-company-code="{{$row['code']}}"
                                    data-company-registration-no="{{$row['registration_no']}}"
                                    data-company-description="{{$row['description']}}"
                                    data-company-url="{{$row['url']}}"
                                    data-company-address="{{$row['address']}}"
                                    data-company-phone="{{$row['phone']}}"
                                    data-target="#updateCompanyPopup">EDIT</button>
                                    <button class="btn btn-outline-success waves-effect" onclick="window.location='{{ url('admin/setup/company-details/'.$row['id']) }}';">VIEW</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection