@extends('layouts.admin-base')
@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-primary fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
    </div>
    @endif

    {{-- Approved Leave Request --}}
<div class="modal fade" id="approveLeaverequest" tabindex="-1" role="dialog" aria-labelledby="approveLeaverequest" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateContactLabel">Approve Leave Request</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('approve_leave')}} ">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                                {{-- <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="Registration No. here"
                                name="id" value="{{ $leaveRequest->id }}" readonly> --}}
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

    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="positions-table">
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
                        @foreach($leaveRequests as $leaveRequest)
                        <tr>
                            
                            <td>{{$loop->iteration}}</td>
                            <td>    {{$leaveRequest->employee->user->name}}</td>
                            <td>
                                    {{$leaveRequest->leave_type->name}}
                            
                               </td>                                     
                            <td>{{$leaveRequest['start_date']}}</td>
                            <td>{{$leaveRequest['end_date']}}</td>
                            <td>{{$leaveRequest['applied_days']}}</td>

                            <td>{{$leaveRequest['status']}}</td>
                            <td>             @if ($leaveRequest['status'] == 'new')
                                
                                    <button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                    data-leaverequest-id="{{$leaveRequest['id']}}"onclick="window.location='{{ route('admin.e-leave.add-leave-request', ['id' => $leaveRequest->id]) }}';" 
                                    {{-- data-target="#approveLeaverequest" --}}
                                    >
                                    <span class="fas fa-check-circle"></span></button>
                                    <button class="btn btn-outline-danger waves-effect" data-toggle="modal"
                                    data-leaverequest-id="{{$leaveRequest['id']}}
                                    {{-- data-target="#disapproveLeaverequest" --}}
                                    "onclick="window.location='{{ route('admin.e-leave.add-leave-request-disapprove', ['id' => $leaveRequest->id]) }}';" 
                                    ><span class="fas fa-times-circle"></span></button>                                            
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
<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(function(){
    $('#positions-table').DataTable({
        responsive: true,
        stateSave: true,
        dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        <'row'<'col-md-6'><'col-md-6'>>
        <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
        buttons: [{
                extend: 'copy',
                text: '<i class="fas fa-copy "></i>',
                // text: '<i class="fas fa-copy "></i>',
                className: 'btn-segment',
                titleAttr: 'Copy'
            },
            {
                extend: 'colvis',
                text: '<i class="fas fa-search "></i>',
                className: 'btn-segment',
                titleAttr: 'Show/Hide Column'
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-alt "></i>',
                className: 'btn-segment',
                titleAttr: 'Export CSV'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print "></i>',
                className: 'btn-segment',
                titleAttr: 'Print'
            },
        ]

    });
    $('#confirm-delete-modal').on('show.bs.modal', function (e) {
        var entryTitle = $(e.relatedTarget).data('entry-title');
        var link = $(e.relatedTarget).data('link');
        $(this).find('.modal-body p').text('Are you sure you want to delete - ' + entryTitle + '?');

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', link);
    });

    $('#confirm-delete-modal').find('.modal-footer #confirm').on('click', function(){
        window.location = $(this).data('form');
    });
})

</script>
@append
