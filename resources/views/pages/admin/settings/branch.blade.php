@extends('layouts.admin-base') 
@section('pageTitle', 'Branch') 
@section('content')

<div class="modal fade" id="addBranchPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.settings.branches.add.post') }}" id="add_branch">
                    @csrf
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <div class="col-12">
                                <label class="col-md-12 col-form-label">Name*</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter name"
                                        name="name" value="{{ old('name') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Contact (Primary)*</label>
                                <div class="col-md-12">
                                    <input id="contact_no_primary" type="text" class="form-control{{ $errors->has('contact_no_primary') ? ' is-invalid' : '' }}" placeholder="Enter primary contact number"
                                        name="contact_no_primary" value="{{ old('contact_no_primary') }}" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Contact (Secondary)*</label>
                                <div class="col-md-12">
                                    <input id="contact_no_secondary" type="text" class="form-control{{ $errors->has('concontact_no_secondarytact_no_primary') ? ' is-invalid' : '' }}" placeholder="Enter Secondary contact number"
                                        name="contact_no_secondary" value="{{ old('contact_no_secondary') }}" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="col-md-12 col-form-label">Contact (Fax)*</label>
                                <div class="col-md-12">
                                    <input id="contact_fax" type="text" class="form-control{{ $errors->has('contact_fax') ? ' is-invalid' : '' }}" placeholder="Enter Fax number"
                                        name="contact_fax" value="{{ old('contact_fax') }}" required>
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
                                <label class="col-md-12 col-form-label">State*</label>
                                <div class="col-md-12">
                                    <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" placeholder="State here"
                                        name="state" value="{{ old('state') }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">City*</label>
                                <div class="col-md-12">
                                    <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="City here"
                                        name="city" value="{{ old('city') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">Zip Code*</label>
                                <div class="col-md-7">
                                    <input id="zip_code" type="text" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" placeholder="Zip Code here"
                                        name="zip_code" value="{{ old('zip_code') }}" required>
                                </div>
                            </div>
                            <div class="col-6">                                
                                <label class="col-md-12 col-form-label">Country Code*</label>
                                <div class="col-md-12">
                                    <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Code here"
                                        name="code" value="{{ old('code') }}" required>
                                </div>
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
<!-- UPDATE -->
<div class="modal fade" id="updateBranchPopup" tabindex="-1" role="dialog" aria-labelledby="updateBranchLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateBranchLabel">Edit Branch</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.settings.branches.edit.post') }}" id="edit_branch">
                    @csrf
                    <div class="row p-3">
                            <div class="form-group row w-100">
                                <div class="col-12">
                                        <input id="branch_id" name="branch_id" type="text" hidden>
                                    <label class="col-md-12 col-form-label">Name*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="name" name="name" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row w-100">
                                <div class="col-4">
                                    <label class="col-md-12 col-form-label">Contact (Primary)*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="contact_no_primary" name="contact_no_primary" type="text">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="col-md-12 col-form-label">Contact (Secondary)*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="contact_no_secondary" name="contact_no_secondary" type="text">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="col-md-12 col-form-label">Contact (Fax)*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="fax_no" name="fax_no" type="text">
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
                                    <label class="col-md-12 col-form-label">State*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="state" name="state" type="text">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="col-md-12 col-form-label">City*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="city" name="city" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row w-100">
                                <div class="col-6">
                                    <label class="col-md-12 col-form-label">Zip Code*</label>
                                    <div class="col-md-7">
                                            <input class="form-control" id="zip_code" name="zip_code" type="text">
                                    </div>
                                </div>
                                <div class="col-6">                                
                                    <label class="col-md-12 col-form-label">Country Code*</label>
                                    <div class="col-md-12">
                                            <input class="form-control" id="country_code" name="country_code" type="text">
                                    </div>
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
<div class="p-4">
        <div class="card p-4">
            <div class="card-body">
                <div class="row pb-3">
                    <div class="col-auto mr-auto"></div>
                    <div class="col-auto">
                    <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#addBranchPopup">
                        Add Branch
                    </button>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="float-right tableTools-container"></div>
                        <table class="table display compact table-striped table-bordered table-hover w-100" id="setupBranchTable">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>Phone</th>
                                <th>State</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($branch as $row)
                            <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$row['name']}}</td>
                                    <td>{{$row['city']}}</td>
                                    <td>{{$row['country_code']}}</td>
                                    <td>{{$row['contact_no_primary']}}</td>
                                    <td>{{$row['state']}}</td>
                                    <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                        data-branch-id="{{$row['id']}}"
                                        data-branch-name="{{$row['name']}}"
                                        data-branch-city="{{$row['city']}}"
    
                                        data-branch-country-code="{{$row['country_code']}}"
                                        data-branch-contact-no-primary="{{$row['contact_no_primary']}}"
                                        data-branch-state="{{$row['state']}}"

                                        data-branch-fax-no="{{$row['fax_no']}}"
                                        data-branch-contact-no-secondary="{{$row['contact_no_secondary']}}"
                                        data-branch-zip-code="{{$row['zip_code']}}"
                                        data-branch-address="{{$row['address']}}"

                                        data-target="#updateBranchPopup">EDIT</button></td>
    
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