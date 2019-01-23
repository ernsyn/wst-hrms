<!--employee sidebar right -->
<div class="modal right fade employeeSidebarModal" id="employeeSidebarModal" tabindex="-1" role="dialog" aria-labelledby="sidebarModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Employee</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<input class="form-control search_employees" type="search" name="search_employees" placeholder="Search employees"> 
					<span class="input-group-append">
						<button class="btn btn-outline-secondary button-search-employee" type="button" data-report-name="">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
				<br>
				<div class="scroll-report" data-report-name="" data-report-page="0" style="height: 363pt; overflow: scroll;">
					<table class="report-employees-table table table-hover table-sm table-bordered" id="report-employees-table">
						<thead>
							<tr>
								<th><input type="checkbox" name="all_employee_list_checkbox" onclick="javascript:toggleSelectAllEmployee(this)"></th>
								<th>Name</th>
								<th>IC</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="3"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<span class="loading-span">Loading...</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>