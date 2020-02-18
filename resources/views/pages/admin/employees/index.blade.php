@extends('layouts.admin-base')
@section('content')
<!-- ADD -->
<div class="modal fade" id="import-file" tabindex="-1" role="dialog" aria-labelledby="import-file"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="import-file">Import</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form enctype="multipart/form-data" id="import-file-form" name="import-file-form">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label><strong>Select File</strong></label>
                            <input name="file_import" id="file_import" type="file" class="form-control" required>
                            <div id="file-error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="import-file-submit" type="button" class="btn btn-primary">
                    {{ __('Import') }}
                </button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END ADD -->
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
    <!-- Filter -->
    <form id="searchForm">
    <div class="row">
    	<div class="col-12 mx-auto">
            <div id="accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer">
                        <i class="fas fa-search"></i> Search
                    </div>
                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                        		<div class="col form-group">
                                    <label for="costCentres" class="col-12 col-form-label">Cost Centre</label>
                                    <div class="col-12">
                                        <select id="costCentres" class="form-control costCentres col-12" name="costCentres" multiple>
                                            @foreach($costCentres as $costCentre)
                                            <option value="{{ $costCentre->id }}">{{ $costCentre->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        		</div>
                        		
                        		<div class="col form-group">
                                    <label for="departments" class="col-12 col-form-label">Department</label>
                                    <div class="col-12">
                                        <select id="departments" class="form-control departments col-12" name="departments" multiple>
                                            @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        		</div>
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">Section</label>
                                    <div class="col-12">
                                        <select class="form-control sections col-12" name="sections" multiple>
                                            @foreach($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        		</div>
                        	</div>
                        	<div class="row">
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">Position</label>
                                    <div class="col-12">
                                        <select class="form-control positions col-12" name="positions" multiple>
                                            @foreach($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        		</div>
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">Team</label>
                                    <div class="col-12">
                                        <select class="form-control teams" name="teams" multiple>
                                            @foreach($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        		</div>
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">Category</label>
                                    <div class="col-12">
                                        <select class="form-control categories" name="categories" multiple>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        		</div>
                    		</div>
                        	<div class="row">
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">Area</label>
                                    <div class="col-12">
                                        <select class="form-control areas" name="areas" multiple>
                                            @foreach($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        		</div>
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">Grade</label>
                                    <div class="col-12">
                                        <select class="form-control grades" name="grades" multiple>
                                            @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        		</div>
                        		<div class="col form-group">
                                    <label for="employeeId" class="col-12 col-form-label">Employee ID</label>
                                    <div class="col-12">
                                    	<input id="employeeId" name="employeeId" class="form-control" value=""></input>
                                   	</div>
                                   	<small class="form-text text-muted col-12">If multiple Employee ID, seperate by comma.</small>
                        		</div>
                        	</div>
                        	<div class="row">
                        		<div class="col form-group">
                                    <label for="name" class="col-12 col-form-label">Name</label>
                                    <div class="col-12">
                                    	<input id="name" name="name" class="form-control col-12" value=""></input>
                                	</div>
                        		</div>
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">IC Number</label>
                                    <div class="col-12">
                                    	<input id="icNumber" name="icNumber" class="form-control" value=""></input>
                                   	</div>
                                   	<small class="form-text text-muted col-12">Number without dash.</small>
                        		</div>
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">Gender</label>
                                    <div class="col-12">
                                    	<select id="gender" class="form-control" name="gender">
                                    		<option></option>
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                        </select>
                                	</div>
                        		</div>
                    		</div>
                    		<div class="row">
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">Bank Account</label>
                                    <div class="col-12">
                                    	<input id="bankAccount" name="bankAccount" class="form-control" value=""></input>
                                   	</div>
                        		</div>
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">Bank Code</label>
                                    <div class="col-12">
                                    	<select class="form-control bankCodes" name="bankCodes" multiple>
                                            @foreach($bankCodes as $bankCode)
                                            <option value="{{ $bankCode->id }}">{{ $bankCode->name }}</option>
                                            @endforeach
                                        </select>
                                	</div>
                        		</div>
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">EPF Number</label>
                                    <div class="col-12">
                                    	<input id="epfNumber" name="epfNumber" class="form-control" value=""></input>
                                   	</div>
                        		</div>
                    		</div>
                        	<div class="row">
                        		<div class="col form-group">
                                    <label class="col-12 col-form-label">SOCSO Number</label>
                                    <div class="col-12">
                                    	<input id="socsoNumber" name="socsoNumber" class="form-control" value=""></input>
                                	</div>
                        		</div>
                        		<div class="col-4 form-group">
                                    <label class="col-12 col-form-label">Join Group Date</label>
                                    <div class="col-12">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="joinGroupDateFrom" name="joinGroupDateFrom" class="form-control datetimepicker-input" data-target="#joinGroupDateFrom" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                            <div class="input-group-append" data-target="#joinGroupDateFrom" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                            &nbsp; to &nbsp;  
                                            <input type="text" id="joinGroupDateTo" name="joinGroupDateTo" class="form-control datetimepicker-input" data-target="#joinGroupDateTo" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                            <div class="input-group-append" data-target="#joinGroupDateTo" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="col-12 col-form-label">Join Company Date</label>
                                    <div class="col-12">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="joinCompanyDateFrom" name="joinCompanyDateFrom" class="form-control datetimepicker-input" data-target="#joinCompanyDateFrom" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                            <div class="input-group-append" data-target="#joinCompanyDateFrom" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                            &nbsp; to &nbsp;  
                                            <input type="text" id="joinCompanyDateTo" name="joinCompanyDateTo" class="form-control datetimepicker-input" data-target="#joinCompanyDateTo" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                            <div class="input-group-append" data-target="#joinCompanyDateTo" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    		</div>
                    		<div class="row">
                    			<div class="col-4 form-group">
                                    <label class="col-12 col-form-label">Confirm Date</label>
                                    <div class="col-12">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="confirmDateFrom" name="confirmDateFrom" class="form-control datetimepicker-input" data-target="#confirmDateFrom" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                            <div class="input-group-append" data-target="#confirmDateFrom" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                            &nbsp; to &nbsp;  
                                            <input type="text" id="confirmDateTo" name="confirmDateTo" class="form-control datetimepicker-input" data-target="#confirmDateTo" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                            <div class="input-group-append" data-target="#confirmDateTo" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="col-12 col-form-label">Resign Date</label>
                                    <div class="col-12">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="resignDateFrom" name="resignDateFrom" class="form-control datetimepicker-input" data-target="#resignDateFrom" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                            <div class="input-group-append" data-target="#resignDateFrom" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                            &nbsp; to &nbsp;  
                                            <input type="text" id="resignDateTo" name="resignDateTo" class="form-control datetimepicker-input" data-target="#resignDateTo" autocomplete="off" placeholder="DD/MM/YYYY"/>
                                            <div class="input-group-append" data-target="#resignDateTo" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="col-12 col-form-label">Service Year</label>
                                    <div class="col-12 input-group">
                                    	<input id="serviceYearFrom" name="serviceYearFrom" class="form-control" type="number" value=""></input>
                                    	&nbsp; to &nbsp;
                                    	<input id="serviceYearTo" name="serviceYearTo" class="form-control" type="number" value=""></input>
                                    </div>
                                </div>
                           	</div>
                           	<div class="row">
                                <div class="col-4 form-group">
                                    <label class="col-12 col-form-label">Basic</label>
                                    <div class="col-12 input-group">
                                    	<input id="basicFrom" name="basicFrom" class="form-control" type="number" value=""></input>
                                    	&nbsp; to &nbsp;
                                    	<input id="basicTo" name="basicTo" class="form-control" type="number" value=""></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-4 form-group">
                            		<div class="col-12">
                            			<button id="search" class="btn btn-primary">Search</button> &nbsp; <button id="clear" type="button" class="btn btn-primary" onclick="resetForm()">Reset Search</button>
                            		</div>
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!-- end filter -->
    

    <div class="row"><div class="col-12">&nbsp;</div></div>
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
                        <th>IC Number</th>
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
$(document).ready(function() {
    var hideColumn = [];
    
    for(var i=7; i<23; i++) {
    	hideColumn.push(i);
    }
	
	$('#joinGroupDateFrom, #joinGroupDateTo, #joinCompanyDateFrom, #joinCompanyDateTo, #confirmDateFrom, #confirmDateTo, #resignDateFrom, #resignDateTo').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
	$('.costCentres, .departments, .sections, .positions, .teams, .categories, .areas, .grades, .bankCodes').multiselect({
        numberDisplayed: 0,
        includeSelectAllOption: true,
        selectAllText: 'Select all',
        maxHeight: 200,
//         buttonWidth: '300px'
    });

	$("#search").on('click', function(e) {
		e.preventDefault();
		getEmployees();
	});
//     console.log($("#searchForm").serialize());

	var t = getEmployees();
	
	function getEmployees() {
		$('#employees-table').DataTable().destroy();
		var t = $('#employees-table').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            searching: false,
            stateSave: true,
    		ajax: {
    			url: '{!! route('get.employees.data') !!}',
    			type: 'GET',
    			data: { 
    				costCentres: $('.costCentres').val(), 
    				departments: $('.departments').val(),
    				sections: $('.sections').val(), 
    				positions: $('.positions').val(),
    				teams: $('.teams').val(), 
    				categories: $('.categories').val(),
    				areas: $('.areas').val(), 
    				grades: $('.grades').val(),
    				employeeId: $('#employeeId').val(),
    				name:  $('#name').val(),
        			icNumber: $('#icNumber').val(),
        			gender: $('#gender').val(),
        			bankAccount: $('#bankAccount').val(),
    				bankCodes: $('.bankCodes').val(),
    				epfNumber: $('#epfNumber').val(),
    				socsoNumber: $('#socsoNumber').val(),
    				joinGroupDateFrom: $('#joinGroupDateFrom').val(),
    				joinGroupDateTo: $('#joinGroupDateTo').val(),
    				joinCompanyDateFrom: $('#joinCompanyDateFrom').val(), 
					joinCompanyDateTo: $('#joinCompanyDateTo').val(),
					confirmDateFrom: $('#confirmDateFrom').val(),
					confirmDateTo: $('#confirmDateTo').val(),
					resignDateFrom: $('#resignDateFrom').val(),
					resignDateTo: $('#resignDateTo').val(),
					serviceYearFrom: $('#serviceYearFrom').val(),
					serviceYearTo: $('#serviceYearTo').val(),
					basicFrom: $('#basicFrom').val(),
					basicTo: $('#basicTo').val(),
    			},
//     			type: 'POST',
//     			data: function ( d ) {
// 					d.form = $('#searchForm').serializeArray();
// 				},
//     			headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 },
            },
        	columnDefs: [
        	    { "orderable": false, "searchable": false, "targets": [0, 23] },
        	    { "visible": false, "targets": hideColumn },
        	],
            dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
            <'row'<'col-md-6'><'col-md-6'>>
            <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
            buttons: [
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-search "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Show/Hide Column'
                },
                @can(PermissionConstant::EXPORT_EMPLOYEE) 
                {
                    text: '<i class="far fa-file-pdf"></i>',
                    className: 'btn-segment',
                    titleAttr: 'Export PDF',
                    action: function ( e, dt, node, config ) {
                        console.log( e );
                        exportFile('pdf');
                    }
                },
                {
                    text: '<i class="far fa-file-excel"></i>',
                    className: 'btn-segment',
                    titleAttr: 'Export Excel',
                   action: function ( e, dt, button, config ) {
                       window.location = "{{ route('export.data')}}";
                    }
                },
                @endcan
                {
                    text: '<i class="fas fa-download"></i>',
                    className: 'btn-segment',
                    titleAttr: 'Excel Template',
                    action: function ( e, dt, button, config ) {
                       window.location = "{{ route('export.template')}}";
                    }
                    
                }
                ,{
                    text: '<i class="fas fa-upload"></i>',
                    className: 'btn-segment',
                    titleAttr: 'Import',
                    action: function ( e, node, config ) {
                       //window.location = "{{ route('import.employees')}}";
                        $('#import-file').modal('show')
                    }
                    
                }
            ]
    
        });

    	t.on( 'draw.dt', function () {
    	    var PageInfo = $('#employees-table').DataTable().page.info();
    	         t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
    	            cell.innerHTML = i + 1 + PageInfo.start;
    	        });
        });

	}


});

function exportFile(fileType) {
	console.log(fileType);

	var table = $('#employees-table').DataTable();
   	var allColumns = table.columns().visible();
	var visibleColumns = [];
	for (var i = 0; i < allColumns.length; i++) {
		if (allColumns[i] === true) {
			visibleColumns.push(i);
		}
	}
	console.log(visibleColumns);
	
	$.ajax({
        url: "{{ route('export.employees') }}",
        type: 'GET',
        xhrFields: {
            responseType: 'blob'
        },
        data: {
        	costCentres: $('.costCentres').val(), 
			departments: $('.departments').val(),
			sections: $('.sections').val(), 
			positions: $('.positions').val(),
			teams: $('.teams').val(), 
			categories: $('.categories').val(),
			areas: $('.areas').val(), 
			grades: $('.grades').val(),
			employeeId: $('#employeeId').val(),
			name:  $('#name').val(),
			icNumber: $('#icNumber').val(),
			gender: $('#gender').val(),
			bankAccount: $('#bankAccount').val(),
			bankCodes: $('.bankCodes').val(),
			epfNumber: $('#epfNumber').val(),
			socsoNumber: $('#socsoNumber').val(),
			joinGroupDateFrom: $('#joinGroupDateFrom').val(),
			joinGroupDateTo: $('#joinGroupDateTo').val(),
			joinCompanyDateFrom: $('#joinCompanyDateFrom').val(), 
			joinCompanyDateTo: $('#joinCompanyDateTo').val(),
			confirmDateFrom: $('#confirmDateFrom').val(),
			confirmDateTo: $('#confirmDateTo').val(),
			resignDateFrom: $('#resignDateFrom').val(),
			resignDateTo: $('#resignDateTo').val(),
			serviceYearFrom: $('#serviceYearFrom').val(),
			serviceYearTo: $('#serviceYearTo').val(),
			basicFrom: $('#basicFrom').val(),
			basicTo: $('#basicTo').val(),
			visibleColumns: visibleColumns,
			fileType: fileType,
        },
        error: function() {
            callback();
        },
        success: function(res) {
            console.log(res);
        	var a = document.createElement('a');
            var url = window.URL.createObjectURL(res);
            a.href = url;
            a.download = 'Employees.'+fileType;
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        }
    });
}



function resetForm() {
	document.getElementById("searchForm").reset();
	$('.costCentres, .departments, .sections, .positions, .teams, .categories, .areas, .grades, .bankCodes').multiselect('refresh');
}

 $('#import-file').on('show.bs.modal', function (event) {
            clearImportError('#import-file-form');
        });
         $('#import-file-form #import-file-submit').click(function(e){
            e.preventDefault();
             var form = document.forms.namedItem("import-file-form");
            var formdata = new FormData(form);
            clearImportError('#import-file-form');
            $.ajax({
                url: "{{ route('import.employees') }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data:formdata,
                success: function(data) {
                    //showAlert(data.success);
                    $('#import-file').modal('toggle');
                    clearImportModal('#import-file-form')
                },
                error: function(xhr) {
                    if(xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        console.log("Error: ", xhr);
                        for (var errorField in errors) {
                            if (errors.hasOwnProperty(errorField)) {
                                console.log("Error: ", errorField);
                                switch(errorField) {
                                    case 'file_import':
                                        $('#import-file-form input[name=file_import]').addClass('is-invalid');
                                        $('#import-file-form #file-error').html('<strong>' + errors[errorField][0] + '</strong>');
                                    break;
                                }
                            }
                        }
                    }
                }
            });
        });


        function clearImportModal(htmlId) {

            $("#file_import").val(null);
         
            $(htmlId + ' input[name=file_import]').removeClass('is-invalid');
        }

        function clearImportError(htmlId) {
             $(htmlId + ' input[name=file_import]').removeClass('is-invalid');
        }
</script>
@append
