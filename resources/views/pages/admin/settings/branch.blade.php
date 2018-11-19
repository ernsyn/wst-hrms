@extends('layouts.admin-base') 
@section('pageTitle', 'Branch') 
@section('content')


<div class="p-4">
        <div class="card p-4">
            <div class="card-body">
                <div class="row pb-3">
                    <div class="col-auto mr-auto"></div>
                    <div class="col-auto">
                            <a role="button" class="btn btn-primary" href="{{ route('admin.settings.branches.add') }}">
                                    Add Branches
                                </a>
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