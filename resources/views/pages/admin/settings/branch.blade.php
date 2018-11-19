@extends('layouts.admin-base') 
@section('pageTitle', 'Branch') 
@section('content')

{{-- <!-- UPDATE -->
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
</div> --}}
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
                            @foreach($branch as $branches)
                            <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$branches['name']}}</td>
                                    <td>{{$branches['city']}}</td>
                                    <td>{{$branches['country_code']}}</td>
                                    <td>{{$branches['contact_no_primary']}}</td>
                                    <td>{{$branches['state']}}</td>
                                    <td>       <a class="btn btn-primary" href="{{ route('admin.settings.branches.edit', ['id' => $branches->id]) }}" role="button">Edit</a>
                                           
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