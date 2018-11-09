@extends('layouts.app') 
@section('content')

<!-- ADD -->
<div class="modal fade" id="addDependentPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Emergency Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_employee_dependent') }}" id="add_employee_dependent">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="name" value="{{ old('name') }}" required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> @endif
                            </div>
                            <label class="col-md-2 col-form-label">Relationship*</label>
                            <div class="col-md-10">
                                <input id="relationship" type="text" class="form-control{{ $errors->has('relationship') ? ' is-invalid' : '' }}" placeholder="Farther, Son, etc"
                                    name="relationship" value="{{ old('relationship') }}" required>                                @if ($errors->has('relationship'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relationship') }}</strong>
                                </span> @endif
                            </div>
                            <label class="col-md-5 col-form-label">Date Of Birth*</label>
                            <div class="col-md-7">
                                <input name="dobDate" autocomplete="off" id="dobDate" type="text" class="form-control">
                                <input name="altdobDate" id="altdobDate" type="text" class="form-control" hidden>
                            </div>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- UPDATE -->
<div class="modal fade" id="updateDependentPopup" tabindex="-1" role="dialog" aria-labelledby="updateDependentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateDependentLabel">Edit Employee Dependent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_employee_dependent') }}" id="edit_emergency_contact">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8">
                            <input id="emp_dep_id" name="emp_dep_id" type="hidden">
                            <label class="col-md-5 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}"
                                    required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> @endif
                            </div>
                            <label class="col-md-2 col-form-label">Relationship*</label>
                            <div class="col-md-10">
                                <input id="relationship" type="text" class="form-control{{ $errors->has('relationship') ? ' is-invalid' : '' }}" placeholder="Farther, Son, etc"
                                    name="relationship" value="{{ old('relationship') }}" required>                                @if ($errors->has('relationship'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relationship') }}</strong>
                                </span> @endif
                            </div>
                            <label class="col-md-5 col-form-label">Date Of Birth*</label>
                            <div class="col-md-7">
                                <input name="editDobDate" id="editDobDate" type="text" class="form-control" readonly>
                            </div>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="p-4">
    <div class="card py-4">
        <div class="card-body">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addDependentPopup">
                                    Add Dependent
                                </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Relationship</th>
                            <th>Date of Birth</th>
                            <th>Action</th>
                        </tr>

                        @foreach($dependents as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$row['dependent_name']}}</td>
                            <td>{{$row['dependent_relationship']}}</td>
                            <td>{{$row['date_of_birth']}}</td>
                            <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal" data-dependent-id="{{$row['id']}}"
                                    data-dependent-name="{{$row['dependent_name']}}" data-dependent-relationship="{{$row['dependent_relationship']}}"
                                    data-date-of-birth="{{$row['date_of_birth']}}" data-target="#updateDependentPopup">EDIT</button></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection