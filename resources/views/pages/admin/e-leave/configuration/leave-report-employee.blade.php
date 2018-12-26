@extends('layouts.admin-base')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="employee-detail" class="row">
                <div class="col-md-6 float-md-left">
                    Staff ID: <strong>{{ $employee->code }}</strong><br />
                    Staff Name: <strong>{{ $employee->name }}</strong><br />
                    Year: <strong>{{ $selected_year }}</strong>
                </div>
                <div class="col-md-6 float-md-right text-right">
                    Date: {{ \Carbon\Carbon::now()->format('d/m/Y') }}<br />
                    Time: {{ \Carbon\Carbon::now()->format('h:i:sA') }}
                </div>                
            </div>
            <div class="row">
                <div class="col-md-10 float-md-left"></div>
                <div class="col-md-2 float-md-right">
                    <select class="form-control site_quick_jump">
                        <option>Select Year</option>
                        @foreach($year_data as $row)
                            <option value="{{ $employee->id }}-{{ $row->year_data }}">{{ $row->year_data }}</option>
                        @endforeach
                    </select>
                    <p></p>
                </div>
            </div>
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="positions-table">
                <thead>
                    <tr>
                        <th>Leave Code</th>
                        <th>Leave Type</th>
                        <th>Bring Forward</th>
                        <th>Entitled</th>
                        <th>Forfeited</th>
                        <th>Pending</th>
                        <th>Approved</th>
                        <th>Allow to Take</th>
                        <th>Year of Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaves as $key => $value)
                        <tr>
                            <td>{{ $value['code'] }}</td>
                            <td>{{ $value['name'] }}</td>
                            <td>{{ $value['carried_forward_days'] }}</td>
                            <td>{{ $value['allocated_days'] }}</td>
                            <td>{{ $value['rejected'] }}</td>
                            <td>{{ $value['pending'] }}</td>
                            <td>{{ $value['approved'] }}</td>
                            <td>{{ $value['allowed_to_take'] }}</td>
                            <td>{{ $value['year_of_balance'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <a role="button" class="btn btn-primary" href="{{ route('admin.e-leave.leave-report') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script>
$(function(){
    $('#positions-table').DataTable({
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

    $('.site_quick_jump').change(function(){
        window.location.href = '{{ route('admin.e-leave.leave-report') }}/' + $(this).val();
    });
})
</script>
@append
