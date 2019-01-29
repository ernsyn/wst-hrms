@extends('layouts.admin-base')
@section('content')
<div class="container">
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
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Attendance</th>
                        {{-- <th>View</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $row)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($row->date)->format('d/m/Y') }}</td>
                            <td>{{ $row->code }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->attendance }}</td>
                            {{-- <td>
                                <button class="btn btn-outline-primary waves-effect" data-toggle="modal">
                                    <span class="fas fa-eye"></span>
                                </button>
                            </td> --}}
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
