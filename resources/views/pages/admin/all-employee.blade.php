@extends('layouts.base')
@section('content')

<div class="p-4">
    <div class="card py-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>No</th>
                            <th>Employee ID</th>
                            <th>Full Name</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>

                        @foreach($employees as $row)
                        <tr onclick="window.location='{{ url('/admin/profile-employee/'.$row['user_id']) }}';">
                            {{--
                            <tr onclick="window.location='{{ route('/admin/employee-profile',['course_id' => Crypt::encrypt('1') ]) }}';">
                            --}}

                                <td>{{$loop->iteration}}</td>
                                <td>{{$row['user_id']}}</td>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['contact_no']}}</td>
                                <td>{{$row['email']}}</td>
                                <td> <button onclick="window.location='{{ url('/admin/profile-employee/'.$row['id']) }}';" class="btn btn-default">Edit</button></td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Open add emergency contact -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employeePopup">
        Add
    </button>

<!-- Modal -->
<div class="modal fade" id="employeePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Emergency Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection