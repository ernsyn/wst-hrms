@extends('layouts.admin-base')
@section('content')
<div class="main-content">
    <div id="alert-container"></div>    
    @if (session('status'))
    <div class="alert alert-primary fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @can(PermissionConstant::ADD_BRANCH) 
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <a role="button" class="btn btn-primary" href="{{ route('admin.settings.branches.add') }}">
                    Add Branch
                </a>
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="branches-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Area</th>
                        <th>State Holiday</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branches as $branch)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$branch['name']}}</td>
                        <td>{{$branch['contact_no_primary']}}</td>
                        <td>{{$branch['city']}}</td>
                        <td>{{$branch['state']}}</td>
                        <td>
                        	@if($branch->area()->first() != null)
                        		{{ $branch->area()->first()->name }}
                        	@endif
                       	</td>
                        <td>{{$branch['state_holiday']}}</td>
                        <td>
                        	@can(PermissionConstant::VIEW_BRANCH)
                        		<button onclick="window.location='{{ route('admin.settings.branches.show', ['id' => $branch->id]) }}';" class="btn btn-default btn-smt fas fa-eye"></button>
                            @endcan
                        	@can(PermissionConstant::UPDATE_BRANCH) 
                            	<button onclick="window.location='{{ route('admin.settings.branches.edit', ['id' => $branch->id]) }}';" class="btn btn-success btn-smt fas fa-edit"></button>
                            @endcan
                            @can(PermissionConstant::DELETE_BRANCH)
                            	<button type="submit" data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title='{{ $branch->name }}' data-link='{{ route('admin.settings.branches.delete', ['id ' => $branch->id]) }}' class="btn btn-danger btn-smt fas fa-trash-alt"></button>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@can(PermissionConstant::DELETE_BRANCH)
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
                <button type="button" class="btn btn-danger" id="confirm">Delete</button>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection

@section('scripts')
<script>
$(function(){
    var t = $('#branches-table').DataTable({
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
            "targets": [0, 7]
        } ],

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
})
</script>
@append
