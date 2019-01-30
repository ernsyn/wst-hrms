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
<!-- Modal -->
<div class="modal fade" id="audit-details-modal" tabindex="-1" role="dialog" aria-labelledby="audit-details-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="audit-details-modal-label">Audit Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
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

    function getModelFieldName(modelDisplayNames, field) {
        if(modelDisplayNames.fields.hasOwnProperty(field)) {
            return modelDisplayNames.fields[field];
        }

        return field;
    }

    $('#audit-details-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.attr('data-id');
        var type = button.attr('data-type');
        var changed = button.attr('data-changed');
        var event = button.attr('data-event');

        var modal = $(this);
        modal.find('.modal-title').text('Audit: ' + event.toUpperCase() + ' ' + displayNamesMatrix[type].name + ' (' + id + ') ');
        modal.find('.modal-body').text(decodeURI(changed));
    })

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
                    // var newElement = $('<button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#edit-emergency-contact-popup"><i class="far fa-eye"></i></button>');
                    // var newElement = document.createElement('button');
                    // return newElement;

                    if(type === 'display'){
                        var element = $('<button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#audit-details-modal"><i class="far fa-eye"></i></button>');
                        element.attr('data-type', row.auditable_type); 
                        element.attr('data-id', row.auditable_id); 
                        element.attr('data-event', row.event); 
                        element.attr('data-changed', encodeURI(JSON.stringify({
                            old: row.old_values,
                            new: row.new_values
                        }))); 
                        console.log("Data: ", element.prop('outerHTML'));
                        return element.prop('outerHTML');
                    } else {
                        return data;
                    }
                }
            }
        ]
    });

</script>
@append