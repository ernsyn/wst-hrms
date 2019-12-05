@if(session('mode') == 'admin')
	ADMIN
	@extends('layouts.admin-base')
@else
	EMP
	@extends('layouts.base')
@endif
@section('content')

<!-- todo: pigination, search -->
<div class="container">
	<div class="row pb-3">
		<div class="col-auto mr-auto">
			@if($errors->any())
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				{{$errors->first()}}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif 
			
			@if(session()->get('success'))
			<div class="alert alert-primary alert-dismissible fade show" role="alert">
				<span id="alert-message">{{ session()->get('success') }}</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
		</div>
		<div class="col-auto">
			@hasrole('HR Admin') 
			<a role="button" class="btn btn-primary" href="{{ route('payroll.create') }}"> Add Payroll </a> 
			@endhasrole
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="float-right tableTools-container"></div>
			<table class="hrms-data-table compact w-100 t-2" id="payrollTable">
				<thead>
					<tr>
						<th>No</th>
						<th>Payroll Month</th>
						<th>Period</th>
						<th>Payroll Period</th>
						<th>Created By</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($payroll as $row)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ DateHelper::dateWithFormat($row->year_month, 'Y-m') }}</td>
						<td>{{ PayrollPeriodEnum::getDescription($row->period)}}</td>
						<td>{{ $row->start_date }} to {{ $row->end_date}}</td>
						<td>{{ $row->name }}</td>
						<td>
							<button onclick="window.location='{{ route('payroll.show',$row->id) }}';" class="round-btn btn btn-default fas fa-eye btn-segment"></button>
							@hasanyrole('Super Admin|admin')
							<form action="{{ route('payroll.status.update', ['id'=>$row->id]) }}" method="POST" style="display: inline;">
								<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
								@if ($row->status === 0) 
									<input type="hidden" name="status" value="1">
									<button type="submit" class="round-btn btn btn-default fas fa-unlock btn-segment" title="Unlock"></button>
								@else
									<input type="hidden" name="status" value="0">
									<button type="submit" class="round-btn btn btn-default fas fa-lock btn-segment" title="Lock"></button>
								@endif
							</form> 
							@endhasanyrole
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection 
@section('scripts')
<script>
$('#payrollTable').DataTable({
	columnDefs: [
	    { "orderable": false, "targets": [3] }
	],
	responsive: true,
    stateSave: true,
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
</script>
@append
