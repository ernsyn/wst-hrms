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
    <div class="row">
    	<div class="col-12 mx-auto">
            <div id="accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer">
                        <i class="fas fa-search"></i> Filter
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
                                	<small class="form-text text-muted col-12">If multiple Name, seperate by comma.</small>
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
                                    	<select class="form-control" name="gender">
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
                                            <input type="text" id="join_group_from_date" name="join_group_from_date" class="form-control datetimepicker-input" data-target="#join_group_from_date" autocomplete="off"/>
                                            <div class="input-group-append" data-target="#join_group_from_date" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                            &nbsp; to &nbsp;  
                                            <input type="text" id="join_group_to_date" name="join_group_to_date" class="form-control datetimepicker-input" data-target="#join_group_to_date" autocomplete="off"/>
                                            <div class="input-group-append" data-target="#join_group_to_date" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="col-12 col-form-label">Join Company Date</label>
                                    <div class="col-12">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="join_company_from_date" name="join_company_from_date" class="form-control datetimepicker-input" data-target="#join_company_from_date" autocomplete="off"/>
                                            <div class="input-group-append" data-target="#join_company_from_date" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                            &nbsp; to &nbsp;  
                                            <input type="text" id="join_company_to_date" name="join_company_to_date" class="form-control datetimepicker-input" data-target="#join_company_to_date" autocomplete="off"/>
                                            <div class="input-group-append" data-target="#join_company_to_date" data-toggle="datetimepicker">
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
                                            <input type="text" id="confirm_from_date" name="confirm_from_date" class="form-control datetimepicker-input" data-target="#confirm_from_date" autocomplete="off"/>
                                            <div class="input-group-append" data-target="#confirm_from_date" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                            &nbsp; to &nbsp;  
                                            <input type="text" id="confirm_to_date" name="confirm_to_date" class="form-control datetimepicker-input" data-target="#confirm_to_date" autocomplete="off"/>
                                            <div class="input-group-append" data-target="#confirm_to_date" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="col-12 col-form-label">Resign Date</label>
                                    <div class="col-12">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="resign_from_date" name="resign_from_date" class="form-control datetimepicker-input" data-target="#resign_from_date" autocomplete="off"/>
                                            <div class="input-group-append" data-target="#resign_from_date" data-toggle="datetimepicker">
                                                <div class="input-group-text rounded-right"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                            &nbsp; to &nbsp;  
                                            <input type="text" id="resign_to_date" name="resign_to_date" class="form-control datetimepicker-input" data-target="#resign_to_date" autocomplete="off"/>
                                            <div class="input-group-append" data-target="#resign_to_date" data-toggle="datetimepicker">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
	$('#join_group_from_date, #join_group_to_date').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
	$('.costCentres, .departments, .sections, .positions, .teams, .categories, .areas, .grades, .bankCodes').multiselect({
        numberDisplayed: 0,
        includeSelectAllOption: true,
        selectAllText: 'Select all',
        maxHeight: 200,
//         buttonWidth: '300px'
    });
    
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
