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
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table table w-100" id="employees-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cost Centre</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Section</th>
                        <th>Position</th>
                        <th>Team</th>
                        <th>Category</th>
                        <th>Area</th>
                        <th>Grade</th>
                        <th>Join Group Date</th>
                        <th>Join Company Date</th>
                        <th>Confirm Date</th>
                        <th>Resign Date</th>
                        <th>Service Year</th>
                        <th>I/C Number</th>
                        <th>Gender</th>
                        <th>Basic</th>
                        <th>Bank Account</th>
                        <th>Bank Code</th>
                        <th>EPF Number</th>
                        <th>SOCSO Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
var hideColumn = [];

for(var i=7; i<23; i++) {
	hideColumn.push(i);
}

$(document).ready(function() {
	var t = $('#employees-table').DataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        searching: false,
		ajax: {
			url: '{!! route('get.employees.data') !!}',
			type: 'GET',
        },
    	columnDefs: [
    	    { "orderable": false, "searchable": false, "targets": [0, 23] },
    	    { "visible": false, "targets": hideColumn },
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
        ]

    });

});
</script>
@append
