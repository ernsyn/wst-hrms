@extends('layouts.admin-base') 
@section('content')
<div class="main-content">
	<div id="alert-container"></div>  
    
    @if(session()->get('success'))
	<div class="alert alert-primary alert-dismissible fade show" role="alert">
		<span id="alert-message">{{ session()->get('success') }}</span>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif
	@can(PermissionConstant::ADD_ROLE)
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <a role="button" class="btn btn-primary" href="{{ route('admin.role-permission.add') }}">
                Add Role
            </a>
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="role-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                	@can(PermissionConstant::VIEW_ROLE_AND_PERMISSION)
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$role['name']}}</td>
                        <td>{{$role['description']}}</td>
                        <td>
                        	@can(PermissionConstant::VIEW_ROLE_AND_PERMISSION)
                        		<button onclick="window.location='{{ route('admin.role-permission.show', ['id' => $role->id]) }}';" class="btn btn-default btn-smt fas fa-eye"></button>
                            @endcan
                            @can(PermissionConstant::UPDATE_ROLE)
                            	<button onclick="window.location='{{ route('admin.role-permission.edit', $role->id) }}';" class="btn btn-success btn-smt fas fa-edit"></button>
                            @endcan
                            @can(PermissionConstant::DELETE_ROLE)
                            	<button type="submit" data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title="{{ $role->name }}" data-link="{{ route('admin.role-permission.delete', ['id ' => $role->id]) }}" class="btn btn-danger btn-smt far fa-trash-alt"></button>
                            @endcan
                            @can(PermissionConstant::DUPLICATE_ROLE)
                            	<button onclick="window.location='{{ route('admin.role-permission.duplicate', $role->id) }}';" class="btn btn-info btn-smt far fa-copy"></button>
                        	@endcan
                        </td>
                    </tr>
                    @endforeach
                    @endcan
                </tbody>
            </table>
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
                <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                @can(PermissionConstant::UPDATE_ROLE)
                <button type="button" class="btn btn-danger" id="confirm">Delete</button>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('scripts')
<script>
$(document).ready(function() {
	var t = $('#role-table').DataTable({
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
        ],
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": [0, 3]
        } ],
//         "order": [[ 1, 'asc' ]],
        "columns": [
            { "width": "3%" },
            { "width": "30%" },
            { "width": "52%" },
            { "width": "15%" },
          ]

    });

	t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

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
});
</script>
@append