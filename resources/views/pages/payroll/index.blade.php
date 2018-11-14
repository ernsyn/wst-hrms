@extends('layouts.base') 
@section('pageTitle', 'Payroll')
@section('content')

@include('pages.payroll.create')
<!-- todo: pigination, search -->
<div class="p-4">
	<div class="card p-4">
		<div class="card-body">
			<div class="row pb-3">
				<div class="col-auto mr-auto"></div>
				<div class="col-auto">
					<button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addPayrollPopup">Add Payroll</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="float-right tableTools-container"></div>
					<table
						class="table display compact table-striped table-bordered table-hover w-100"
						id="setupCompanyTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Company</th>
								<th>Payroll Month</th>
								<th>Period</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($payroll as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $row->name }}</td>
                    			<td>{{ $row->year_month }}</td>
                    			<td>{{ PayrollPeriodEnum::getDescription($row->period)}}</td>
								<td><a href="{{ route('payroll.show', ['id'=>$row->id]) }}"
				title="Edit">Edit</a> |
				<form action="{{ route('payroll.status.update', ['id'=>$row->id]) }}"
					method="POST" id="update_status_form" style="display: inline;">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"> <input
						type="hidden" name="status" value="1">
					<button type="submit" id="update_status"
						class="btn btn-danger btn-circle inline-block" title="Lock">Lock</button>
				</form></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
