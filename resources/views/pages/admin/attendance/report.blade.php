@extends('layouts.admin-base')
@section('content')
<div class="container">
        <div id="alert-container">
            </div>  
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10">
                    Date: <strong>{{ \Carbon\Carbon::parse($selected_date)->format('d/m/Y') }}</strong>
                </div>
                <div class="col-md-2 text-right input-group date" data-target-input="nearest">
                    <input type="text" id="select-date" class="form-control datetimepicker-input" data-target="#select-date" autocomplete="off"/>
                    <div class="input-group-append" data-target="#select-date" data-toggle="datetimepicker">
                        <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                    </div>
                </div>
            </div>
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="attendances-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Attendance</th>
                        <th>Employee</th>
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
                            <td>{{ $value['date'] }}</td>
                            <td>{{ $value['attendance'] }}</td>
                            <td><span class="badge badge-warning">{{ $value['code'] }}</span> <b class="text-primary">{{ $value['name'] }}</span></td>
                            <td>{{ $value['clock_in_time'] }}</td>
                            <td>{{ $value['clock_in_status'] }}</td>
                            <td>{{ $value['clock_in_reason'] }}</td>
                            <td>{{ $value['clock_out_time'] }}</td>
                            <td>{{ $value['clock_out_status'] }}</td>
                            <td>{{ $value['clock_out_reason'] }}</td>
                            <td>
                                @if($value['attendance'] == 'Absent')
                                    <button class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#attendance_details_modal_{{ $key }}" disabled="">
                                        <span class="fas fa-ban"></span>
                                    </button>
                                @else
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
                                                            {{ $value['clock_out_address'] }}
                                                        </p>
                                                        <p><strong>Lat:</strong> {{ $value['clock_out_lat'] }}</p>
                                                        <p><strong>Long:</strong> {{ $value['clock_out_long'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                messageTop: $('#employee-detail').text(),
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print "></i>',
                className: 'btn-segment',
                titleAttr: 'Print',
                messageTop: $('#employee-detail').text(),
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
        ]
    });

    $('#select-date').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    // disable keyboard input & hide caret
    $('#select-date').keydown(false);
    $('#select-date').css('caret-color', 'transparent');
    
    // assign value of datetimepicker to the page
    $('#select-date').on("hide.datetimepicker", function(e) {
        window.location.href = '{{ route('admin.attendance.report') }}/' + $('#select-date').datetimepicker('viewDate').format('YYYY-MM-DD')
    });
})
</script>
@append
