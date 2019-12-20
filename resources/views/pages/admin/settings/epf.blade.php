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
    @can(PermissionConstant::ADD_EPF) 
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <a role="button" class="btn btn-primary" href="{{ route('admin.settings.epf.add') }}">
                Add EPF
            </a>
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="epf-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Salary (RM)</th>
                        <th>Employer Contribution (RM)</th>
                        <th>Employee Contribution (RM)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($epfs as $epf)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ EpfCategoryEnum::getDescription($epf['category']) }}</td>
                        <td>{{$epf['salary']}}</td>
                        <td>{{$epf['employer']}}</td>
                        <td>{{$epf['employee']}}</td>
                        <td>
                        	@can(PermissionConstant::UPDATE_EPF) 
                            <button onclick="window.location='{{ route('admin.settings.epf.edit.post', ['id' => $epf->id]) }}';" 
                                class="btn btn-success btn-smt fas fa-edit">
                                </button>
                            @endcan
                            @can(PermissionConstant::DELETE_EPF) 
                            <button type="submit" data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title='{{ EpfCategoryEnum::getDescription($epf["category"]) }} : {{ $epf["salary"] }}' data-link='{{ route('admin.settings.epf.delete', ['id ' => $epf->id]) }}' 
                                class="btn btn-danger btn-smt fas fa-trash-alt">
                                </button>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@can(PermissionConstant::DELETE_EPF)
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
$(document).ready(function() {
	var t = $('#epf-table').DataTable({
    	responsive: true,
        stateSave: true,
        "order": [[ 1, "desc" ]],
        "columnDefs": [ 
            {
                "targets": 0,
                "searchable": false,
                "orderable": false
            },
            {
                "targets": 5,
                "searchable": false,
                "orderable": false
            },
    	],
        dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        <'row'<'col-md-6'><'col-md-6'>>
        <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
        buttons: [{
            	extend: 'copy',
                text: '<i class="fas fa-copy "></i>',
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
        
    	initComplete: function () {
        	this.api().columns([1, 2, 3, 4]).every( function () {
            	var column = this;
                var select = $('<select class="form-control"><option value=""></option></select>')
    	        	//.appendTo( $(column.footer()).empty() )
    	            .appendTo( $(column.header()) )
                    .on( 'change', function () {
                    	var val = $.fn.dataTable.util.escapeRegex(
                        	$(this).val()
                        );
         
                        column
                        	.search( val ? '^'+val+'$' : '', true, false )
                            .draw();
    				} );
     
                column
                	.data()
                    .unique()
                    .sort()
                    .each(function(d, j) {
                    	var val = $.fn.dataTable.util.escapeRegex(d);
                      	if (column.search() === "^" + val + "$") {
                        	select.append(
                          		'<option value="' + d + '" selected="selected">' + d + "</option>"
                        	);
                      	} else {
                        	select.append('<option value="' + d + '">' + d + "</option>");
                      	}
                    });

                $( select ).click( function(e) {
                    e.stopPropagation();
              	});
			});
    	}
	});

	t.on( 'draw.dt', function () {
	    var PageInfo = $('#epf-table').DataTable().page.info();
	         t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
	            cell.innerHTML = i + 1 + PageInfo.start;
	        });
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
