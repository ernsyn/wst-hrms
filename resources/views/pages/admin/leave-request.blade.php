@extends('layouts.base') 
@section('pageTitle', 'Leave Request') 
@section('content')
<div class="p-4">
        <div class="card p-4">
            <div class="card-body">
                <div class="row pb-3">
                    <div class="col-auto mr-auto"></div>
                    <div class="col-auto">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right tableTools-container"></div>
                        <table class="table display compact table-striped table-bordered table-hover w-100" id="setupJobconfigureCostCentreTable">
                            <thead>
                                    <tr>
                                            <th>No</th>
                                            <th>Employee</th>
                                            <th>Leave Type</th>
                                            
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Total Days</th>      
                                            <th>Status</th>                              
                                            <th>Action</th>
                                        </tr>
                            </thead>
                            <tbody>
                                    @foreach($leaverequest as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row['name']}}</td>
                                        <td>{{$row['leave_type']}}</td>
                                     
                                        <td>{{$row['start_date']}}</td>
                                        <td>{{$row['end_date']}}</td>
                                        <td>{{$row['total_days']}}</td>
                                        <td>{{$row['status']}}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endsection --}}
{{-- <div class="p-4">
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
                    </table> --}}

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

