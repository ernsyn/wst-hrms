@extends('layouts.base') 
@section('pageTitle', 'Leave Request') 
@section('content')

{{-- Approved Leave Request --}}
<div class="modal fade" id="approveLeaverequest" tabindex="-1" role="dialog" aria-labelledby="approveLeaverequest" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateContactLabel">Approve Leave Request</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('approve_leave') }}">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="req_id" name="req_id" hidden>      
                            <label class="col-md-8 col-form-label">Approve this leave?</label>                     
                        </div>
                    </div>     
                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                Approve
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                </form>
            </div>
          </div>
        </div>
</div>

{{-- Disapproved Leave Request --}}
<div class="modal fade" id="disapproveLeaverequest" tabindex="-1" role="dialog" aria-labelledby="disapproveLeaverequest" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateContactLabel">Disapprove Leave Request</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('disapprove_leave') }}">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="req_id" name="req_id" hidden>      
                            <label class="col-md-8 col-form-label">Disapprove this leave?</label>                     
                        </div>
                    </div>     
                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                Disapprove
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right tableTools-container"></div>
                        <table class="table display compact table-striped table-bordered table-hover w-100" id="leaveRequestTable">
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
                                        <td>{{date('d/m/Y', strtotime($row['start_date']))}}</td>
                                        <td>{{date('d/m/Y', strtotime($row['end_date']))}}</td>
                                        <td>{{$row['total_days']}}</td>
                                        <td>{{$row['status']}}</td>
                                        <td>
                                            @if ($row['status'] == 'Pending')
                                            
                                                <button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                                data-leaverequest-id="{{$row['request_id']}}"
                                                data-target="#approveLeaverequest"><span class="fas fa-check-circle"></span></button>
                                                <button class="btn btn-outline-danger waves-effect" data-toggle="modal"
                                                data-leaverequest-id="{{$row['request_id']}}"
                                                data-target="#disapproveLeaverequest"><span class="fas fa-times-circle"></span></button>                                            
                                            @else
                                                <button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                                disabled><span class="fas fa-check-circle"></span></button>
                                                <button class="btn btn-outline-danger waves-effect" data-toggle="modal"
                                                disabled><span class="fas fa-times-circle"></span></button>                                            
                                            @endif                                                                                        
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

