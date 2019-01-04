<div id="accordion" role="tablist">
	<div class="card">
		<div class="card-header" role="tab" id="headingOne" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer">
			<i class="fas fa-search"></i> Filter
		</div>
		<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
			<div class="card-body">
				<div class="form-group">
					<label for="exampleFormControlCostCentres">Cost Centres</label> 
					<select class="form-control" id="selectCostCentres" name="selectCostCentres">
						<option value="0">--Select--</option> 
						@foreach($costcentres as $key => $value)
						<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select> 
					<label for="exampleFormControlDepartments">Departments</label>
					<select class="form-control" id="selectDepartments" name="selectDepartments">
						<option value="0">--Select--</option> 
						@foreach($departments as $key => $value)
						<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select> 
					<label for="exampleFormControlBranches">Branches</label>
					<select class="form-control" id="selectBranches" name="selectBranches">
						<option value="0">--Select--</option> 
						@foreach($branches as $key => $value)
						<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select> 
					<label for="exampleFormControlPositions">Positions</label>
					<select class="form-control" id="selectPositions" name="selectPositions">
						<option value="0">--Select--</option> 
						@foreach($positions as $key => $value)
						<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>