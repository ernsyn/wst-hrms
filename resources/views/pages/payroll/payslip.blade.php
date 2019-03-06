@extends('layouts.base')
@section('content')
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
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="float-right tableTools-container"></div>
			<table class="hrms-data-table compact w-100 t-2" id="payrollTable">
				<thead>
					<tr>
						<th>No</th>
						<th>Payroll Month</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($payslips as $row)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ DateHelper::dateWithFormat($row->year_month, 'Y-m') }}</td>
						<td>
							<button onclick="javascript:window.open('{{ route('payslip.download',$row->id) }}', '_blank')" class="round-btn btn btn-default fas fa-download"></button>
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
	    { "orderable": false, "targets": [2] }
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
