@extends('layouts.base') 
@section('content')

<!-- ADD -->
<div class="modal fade" id="addDepartmentPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_department') }}" id="add_cost_centre">
                    @csrf
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="name" value="{{ old('name') }}" required>
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
<div class="modal fade" id="updateDepartmentPopup" tabindex="-1" role="dialog" aria-labelledby="updateDepartmentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateDepartmentLabel">Edit Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_department') }}" id="edit_visa">
                    @csrf
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <input id="department_id" name="department_id" type="text" hidden>
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input class="form-control" id="department_name" name="department_name" type="text">
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
                        <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addDepartmentPopup">
                                Add Department
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right tableTools-container"></div>
                        <table class="table display compact table-striped table-bordered table-hover w-100" id="setupJobconfigureDeptTable">
                            <thead>
                                <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($departments as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$row['name']}}</td>
                                        <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                            data-department-id="{{$row['id']}}"
                                            data-department-name="{{$row['name']}}"
                                            data-target="#updateDepartmentPopup">EDIT</button></td>
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
