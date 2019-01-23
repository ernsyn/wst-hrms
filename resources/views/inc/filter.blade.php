<div id="accordion" role="tablist">
	<div class="card">
		<div class="card-header" role="tab" id="headingOne" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer">
			<i class="fas fa-search"></i> Filter
		</div>
		<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
			<div class="card-body">
				<div class="form-group">
					<label for="exampleFormControlCostCentres">Cost Centres</label> 
					<select class="form-control selectCostCentres" name="selectCostCentres">
						<option value="0">--Select--</option> 
						@foreach($costcentres as $key => $value)
						<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select> 
					<label for="exampleFormControlDepartments">Departments</label>
					<select class="form-control selectDepartments" name="selectDepartments">
						<option value="0">--Select--</option> 
						@foreach($departments as $key => $value)
						<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select> 
					<label for="exampleFormControlBranches">Branches</label>
					<select class="form-control selectBranches" name="selectBranches">
						<option value="0">--Select--</option> 
						@foreach($branches as $key => $value)
						<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select> 
					<label for="exampleFormControlPositions">Positions</label>
					<select class="form-control selectPositions" name="selectPositions">
						<option value="0">--Select--</option> 
						@foreach($positions as $key => $value)
						<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select>
					<br> Employee &nbsp;&nbsp;&nbsp;
					<div class="btn-group btn-group-toggle" data-toggle="buttons">
    					<label class="btn btn-secondary active employee-all" style="width: 60pt;"> 
    						<input type="radio" name="government-employees-radio" autocomplete="off" checked> All
    					</label> 
    					<label class="btn btn-secondary employee-selected" data-report-name="{{$form->getValue()}}" style="width: 60pt;"> 
    						<input type="radio" name="government-employees-radio" autocomplete="off"> Selected
    					</label>
    				</div>
    				
    				<input type="hidden" class="form-control selectOfficer" name="selectOfficer" value="0">
    				<input type="hidden" class="form-control selectPeriod" name="selectPeriod" value="0">
    				<input type="hidden" class="form-control selectYear" name="selectYear" value="0">
				</div>
			</div>
		</div>
	</div>
</div>