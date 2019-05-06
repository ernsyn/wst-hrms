@extends('layouts.admin-base')
@section('content')
<div class="container">
        <div id="alert-container">
            </div>  
    <div class="row">
        <div class="col-md-12">
            <div id="employee-detail" class="row">
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {!! nl2br(e($message)) !!}
                    </div>
                </div>      
            </div>
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="positions-table">
                <thead>
                    <tr>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Job</th>
                        <th>Leave Type</th>
                        <th>Allocated</th>                        
                        <th>Spent</th>
                        <th>Carried Forward</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leave_allocation as $row)
                        <tr>
                            <td>{{ $row->code }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->remarks }}</td>
                            <td>{{ $row->lt_code }}</td>
                            <td>{{ $row->allocated_days }}</td>
                            <td>{{ $row->spent_days ? $row->spent_days : '0.0' }}</td>                            
                            <td>{{ $row->carried_forward_days ? $row->carried_forward_days : '0.0' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <a role="button" class="btn btn-primary" href="{{ route('admin.e-leave.configuration') }}">Back</a>
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
        info: false,
        dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        <'row'<'col-md-6'><'col-md-6'>>
        <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fas fa-table"></i>',
                className: 'btn-segment',
                titleAttr: 'Export Excel'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print "></i>',
                className: 'btn-segment',
                titleAttr: 'Print'
            },
        ]
    });
})
</script>
@append
