@extends('layouts.base') 
@section('pageTitle', 'Branch') 
@section('content')
<div class="p-4">
    <div class="card py-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="setupBranchTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($branch as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['city']}}</td>
                                <td>{{$row['country']}}</td>
                                <td>{{$row['phone_1']}}</td>
                                <td>{{$row['status']}}</td>
                                <td>Action</td>
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