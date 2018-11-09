@extends('layouts.base') 
@section('content')

<!-- ADD -->
<div class="modal fade" id="addTeamPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Team</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_team') }}" id="add_cost_centre">
                    @csrf
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Team name*</label>
                            <div class="col-md-12">
                                <input id="team_name" type="text" class="form-control{{ $errors->has('team_name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                    name="team_name" value="{{ old('team_name') }}" required>
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
<div class="modal fade" id="updateTeamPopup" tabindex="-1" role="dialog" aria-labelledby="updateTeamLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateTeamLabel">Edit Team</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_team') }}" id="edit_visa">
                    @csrf
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <input id="team_id" name="team_id" type="text" hidden>
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input class="form-control" id="team_name" name="name" type="text">
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
                        <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addTeamPopup">
                                Add Team
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right tableTools-container"></div>
                        <table class="table display compact table-striped table-bordered table-hover w-100" id="setupJobconfigureCostCentreTable">
                            <thead>
                                <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($team as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$row['name']}}</td>
                                        <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                            data-team-id="{{$row['id']}}"
                                            data-name="{{$row['name']}}"
                                            data-target="#updateTeamPopup">EDIT</button></td>
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

