@extends('layouts.admin-base')
@section('content')
<div id="page-current-day-attendance" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10">
                    Date: <strong>{{ \Carbon\Carbon::today()->format('d/m/Y') }}</strong>
                </div>
                <div class="col-md-2 text-right">
                    <p></p>
                </div>          
            </div>
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="attendances-table">
                <thead>
                    <tr>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Clock In Time</th>
                        <th>Clock In Status</th>
                        <th>Clock In Reason</th>
                        <th>Clock Out Time</th>
                        <th>Clock Out Status</th>
                        <th>Clock Out Reason</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $key => $value)
                        <tr>
                            <td>{{ $value['code'] }}</td>
                            <td>{{ $value['name'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($value['clock_in_time'])->format('g:m:s a') }}</td>
                            <td>{{ $value['clock_in_status']}}</td>
                            <td>{{ $value['clock_in_reason']}}</td>
                            <td>{{ \Carbon\Carbon::parse($value['clock_out_time'])->format('g:m:s a') }}</td>
                            <td>{{ $value['clock_out_status']}}</td>
                            <td>{{ $value['clock_out_reason']}}</td>
                            <td>
                                <button class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#attendance_details_modal_{{ $key }}">
                                    <span class="fas fa-eye"></span>
                                </button>
                                <div class="modal fade" id="attendance_details_modal_{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirm-delete-label">Attendance Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-6 float-md-left">
                                                    <p><strong>Clock In</strong></p>
                                                    <p><img src="{{ $value['clock_in_media'] }}" class="img-responsive" width="100%" /></p>
                                                    <p>
                                                        <strong>Address:</strong><br />
                                                        {{ $value['clock_in_address'] }}
                                                    </p>
                                                    <p><strong>Lat:</strong> {{ $value['clock_in_lat'] }}</p>
                                                    <p><strong>Long:</strong> {{ $value['clock_in_long'] }}</p>
                                                </div>
                                                <div class="col-md-6 float-md-right">
                                                    <p><strong>Clock Out</strong></p>
                                                    <p><img src="{{ $value['clock_out_media'] }}" class="img-responsive" width="100%" /></p>
                                                    <p>
                                                        <strong>Address:</strong><br />
                                                        {{ $value['clock_out_address'] ? $value['clock_out_address'] : 'NA' }}
                                                    </p>
                                                    <p><strong>Lat:</strong> {{ $value['clock_out_lat'] ? $value['clock_out_lat'] : 'NA' }}</p>
                                                    <p><strong>Long:</strong> {{ $value['clock_out_long'] ? $value['clock_out_long'] : 'NA' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script>
$(function(){
    $('#attendances-table').DataTable({
        responsive: true,
        stateSave: true,
        paging: false,
        info: false,
        dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        <'row'<'col-md-6'><'col-md-6'>>
        <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fas fa-table"></i>',
                className: 'btn-segment',
                titleAttr: 'Export Excel',
                messageTop: $('#employee-detail').text()
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print "></i>',
                className: 'btn-segment',
                titleAttr: 'Print',
                messageTop: $('#employee-detail').text()
            },
        ]
    });
})
</script>
@append
