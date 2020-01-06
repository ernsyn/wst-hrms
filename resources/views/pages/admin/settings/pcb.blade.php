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
    @can(PermissionConstant::ADD_PCB) 
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
        <div class="col-auto">
            <a role="button" class="btn btn-primary" href="{{ route('admin.settings.pcb.add') }}">
                Add PCB
            </a>
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="pcb-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category<select id="category" class="form-control"><option value=""></option></select></th>
                        <th>Salary (RM)<input type="text" id="salary" class="form-control"></input></th>
                        <th>Number of Children<select id="number-of-children" class="form-control"><option value=""></option></select></th>
                        <th>Amount (RM)<input type="text" id="amount"class="form-control"></input></th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            <i class="fas fa-info-circle"></i> Category 1: Single Person<br/>
            <span style="padding-left:1.1rem">Category 2: Spouse is not working<br/> 
            <span style="padding-left:1.1rem">Category 3: Spouse is working</span>
        </div>
    </div>

</div>

@can(PermissionConstant::DELETE_PCB)
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
	var category = '';
	var salary = '';
	var numberOfChildren = '';
	var amount = '';
	var t = getPcb(category, salary, numberOfChildren, amount);

	function getPcb(category, salary, numberOfChildren, amount) {
		$('#pcb-table').DataTable().destroy();
    	var t = $('#pcb-table').DataTable({
        	processing: true,
            serverSide: true,
//             bLengthChange: false,
            searching: false,
            ajax: {
    			url: '{!! route('get.pcb.data') !!}',
    			type: 'GET',
    			data: { 
    				category: category, 
    				salary: salary, 
    				numberOfChildren: numberOfChildren,
    				amount: amount
    			},
            },
            columns: [
//                 { data: 'id', name: 'id', orderable: false, searchable: false },
//                 { data: 'category', name: 'category'},
//                 { data: 'salary', name: 'salary'},
//                 { data: 'total_children', name: 'total_children'},
//                 { data: 'amount', name: 'amount'},
//                 { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            "columnDefs": [ 
                {
                    "targets": 0,
                    "searchable": false,
                    "orderable": false
                },
                {
                	"targets": [1,2,3,4],
                	"type": "numeric"
                },
                {
                    "targets": 5,
                    "searchable": false,
                    "orderable": false,
                },
        	],
        
//         initComplete: function (data) {
//             	console.log(data.name);
//         	this.api().columns([2, 3, 4]).every( function () {
//             	var column = this;
//                 var select = $('<select class="form-control"><option value=""></option></select>')
//     	        	//.appendTo( $(column.footer()).empty() )
//     	            .appendTo( $(column.header()) )
//                     .on( 'change', function () {
//                     	var val = $.fn.dataTable.util.escapeRegex(
//                         	$(this).val()
//                         );
         
// //                     	column.search( this.value ).draw();
//                     	column
//                         	.search( val ? '^'+val+'$' : '', true, false )
//                         	.draw();
//     				} );
//                 column.data().unique().sort().each( function ( d, j ) {
//                     select.append( '<option value="'+d+'">'+d+'</option>' )
//                 } );
//                 column
//                 	.data()
//                     .unique()
//                     .sort()
//                     .each(function(d, j) {
// //                     	var val = $.fn.dataTable.util.escapeRegex(d);
// //                     	column.search( this.value ).draw();
//                       	if (column.search() === "^" + d + "$") {
//                         	select.append(
//                           		'<option value="' + d + '" selected="selected">' + d + "</option>"
//                         	);
//                       	} else {
//                         	select.append('<option value="' + d + '">' + d + "</option>");
//                       	}
//                     });

//                 $( select ).click( function(e) {
//                     e.stopPropagation();
//               	});
// 			});
//     	}
    	});

    	t.on( 'draw.dt', function () {
    	    var PageInfo = $('#pcb-table').DataTable().page.info();
    	         t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
    	            cell.innerHTML = i + 1 + PageInfo.start;
    	        });
        });
	}

	$.ajax({
        url: "{{ route('admin.settings.pcb.get-category') }}",
        type: 'GET',
        error: function(xhr) {
            console.log("Error: ", xhr);
        },
        success: function(res) {
//             console.log(res);
            res.forEach( item => $('#category').append( '<option value="'+item.category+'">'+item.category+'</option>') );
        }
    });
    
	$.ajax({
        url: "{{ route('admin.settings.pcb.get-number-of-children') }}",
        type: 'GET',
        error: function(xhr) {
            console.log("Error: ", xhr);
        },
        success: function(res) {
//             console.log(res);
            res.forEach( item => $('#number-of-children').append( '<option value="'+item.total_children+'">'+item.total_children+'</option>') );
        }
    });

	$('select').click( function(e) {
        e.stopPropagation();
  	});

	$('#amount, #salary').click( function(e) {
        e.stopPropagation();
  	});

	$('#category, #number-of-children').on('change', function () {
		category = $('#category').val();
		salary = $('#salary').val();
		numberOfChildren = $('#number-of-children').val();
		amount = $('#amount').val();
		console.log(category, salary, numberOfChildren, amount);
		getPcb(category, salary, numberOfChildren, amount)
  	  	
    });

	var timeout = null;
	$('#amount, #salary').on('keyup', function () {
		category = $('#category').val();
		salary = $('#salary').val();
		numberOfChildren = $('#number-of-children').val();
		amount = $('#amount').val();
		console.log(category, salary, numberOfChildren, amount);
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			getPcb(category, salary, numberOfChildren, amount)
	    }, 500)
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
});

</script>
@append
