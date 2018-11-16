@extends('layouts.base')
@section('pageTitle', 'User List - DEPRECATED') 
@section('content')

<div class="p-4">
        <div class="card p-4">
            <div class="card-body">
                <div class="row pb-3">
                    <div class="col-auto mr-auto"></div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="float-right tableTools-container"></div>
                        <table class="table display compact table-striped table-bordered table-hover w-100" id="setupUserTable">
                            <thead>
                                <tr>
                                        <th>No</th>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>     
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($userlist as $row)
                
                                <tr>
                                    {{--
                                    <tr onclick="window.location='{{ route('/admin/employee-profile',['course_id' => Crypt::encrypt('1') ]) }}';">
                                    --}}
                             
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row['id']}}</td>
                                        <td>{{$row['name']}}</td>
                                        <td>{{$row['email']}}</td>
                                  
                                        <td>
                                                <button onclick="window.location='{{ url('/admin/profile-employee/'.$row['id']) }}';" class="btn btn-default">View</button>
                                                {{-- <button onclick="window.location='{{ url('/admin/edit-employee/'.$row['id']) }}';" class="btn btn-default">Edit</button> --}}
                                        
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
