@extends('layouts.base') 
@section('pageTitle', 'Leave Request') 
@section('content')

<div class="p-4">
    <div class="card py-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="leaveRequestTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee</th>
                                <th>Department</th>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Days</th>      
                                <th>Status</th>                              
                                <th>Action</th>
                            </tr>
                            <tbody>
                        @foreach($leaverequest as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row['emp']}}</td>
                                <td>{{$row['department']}}</td>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['start_date']}}</td>
                                <td>{{$row['end_date']}}</td>
                                <td>{{$row['total_days']}}</td>
                                <td>{{$row['status']}}</td>
                                <td>Action</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="testswall" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection