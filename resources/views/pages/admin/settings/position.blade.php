@extends('layouts.admin-base') 
@section('content')

<div class="p-4">
    <div class="card p-4">
        <div class="card-body">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                <a role="button" class="btn btn-primary" href="{{ route('admin.settings.positions.add') }}">
                        Add Position
                    </a>
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
                                    @foreach($positions as $position)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$position['name']}}</td>
                                  
  <td>       <a class="btn btn-primary" href="{{ route('admin.settings.positions.edit.post', ['id' => $position->id]) }}" role="button">Edit</a>
                                           
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