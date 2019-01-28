@extends('layouts.admin-base') 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="audit-trail-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Time</th>
                        <th>Employee</th>
                        <th>Action</th>
                        <th>Data Type</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
 
@section('scripts')
<script>
    var displayNamesMatrix = {
        'App\\LeaveType': {
            name: 'Leave Type',
            fields: {

            },
        },
        'App\\Employee': {
            name: 'Employee',
            fields: {

            },
        },
        'App\\Media': {
            name: 'Media',
            fields: {

            },
        },
        'App\\Eis': {
            name: 'EIS',
            fields: {

            },
        },
        'App\\EmployeeJob': {
            name: 'Employee Job',
            fields: {

            },
        },
        'App\\EmployeeWorkingDay': {
            name: 'Employee Working Days',
            fields: {

            },
        },
        'App\\EmployeeDependent': {
            name: 'Employee Dependent',
            fields: {

            },
        },
    };

    var auditTrailTable = $('#audit-trail-table').DataTable({
        "bInfo": true,
        "bDeferRender": true,
        "serverSide": true,
        "bStateSave": true,
        "ajax": "{{ route('admin.audit-trail.dt') }}",
        "columnDefs": [ {
            "targets": 4,
            "orderable": false
        } ],
        "columns": [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "created_at",
            },
            {
                "data": null, // can be null or undefined
                render: function (data, type, row, meta) {
                    var displayedData = '';
                    if(row.user.employee != null) {
                        displayedData = '<span class="badge badge-warning">' + row.user.employee.code + '</span>&nbsp;&nbsp;<b class="text-primary">' + row.user.name + '</b>';
                    } else {
                        displayedData = '<b class="text-secondary">' + row.user.name + '</b>';
                    }
                    
                    return displayedData; 
                }
            },
            {
                "data": null, // can be null or undefined
                render: function (data, type, row, meta) {
                    return '<b class="text-dark">' + row.event.toUpperCase() + '</b>'; 
                }
            },
            {
                "data": null, // can be null or undefined
                render: function (data, type, row, meta) {
                    if(displayNamesMatrix.hasOwnProperty(row.auditable_type)) {
                        return '<span class="text-dark">' + displayNamesMatrix[row.auditable_type].name + '</span>';
                    } else {
                        return '<span class="text-dark">' + row.auditable_type + '</span>'; 
                    }
                }
            },
            {
                "data": null, // can be null or undefined
                render: function (data, type, row, meta) {
                    return `<button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-current="${encodeURI(JSON.stringify(row))}" data-target="#edit-emergency-contact-popup"><i class="far fa-eye"></i></button>`;
                }
            }
        ]
    });

</script>
@append