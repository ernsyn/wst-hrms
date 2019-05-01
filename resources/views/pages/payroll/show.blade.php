@extends((AccessControllHelper::isKpiProposer() && !(AccessControllHelper::hasHrAdminRole() || AccessControllHelper::hasHrExecRole())) ? 'layouts.base' : 'layouts.admin-base')
@section('content')

<div class="container">
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
    </div>
	<div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
                <table class="hrms-data-table compact w-100 t-2" id="payroll-trx">
    				<thead>
    					<tr>
                            <th colspan="5" class="col-bg-color col-border-right th-color">{{ strtoupper('basic information') }}</th>
                            <th colspan="3" class="col-bg-color col-border-right th-color">{{ strtoupper('basic earning') }}</th>
                            <th class="col-bg-color col-border-right th-color">{{ strtoupper('additions') }}</th>
                            <th class="col-bg-color col-border-right th-color">{{ strtoupper('deductions') }}</th>
        					<th class="col-bg-color col-border-right th-color"></th>
        					<th class="col-bg-color th-color"></th>
    					</tr>
    					<tr>
    						<th>No</th>
    						<th>S-ID</th>
    						<th>NM</th>
    						<th>Position</th>
    						<th class="col-border-right">ED</th>
    						<th>CB</th>
    						<th>BS</th>
    						<th class="col-border-right">IS</th>
    						<th class="col-border-right">Total</th>
    						<th class="col-border-right">Total</th>
    						<th class="col-border-right">THP</th>
    						<!-- <th class="col-border-right">Remark</th> -->
    						<th>Action</th>
    					</tr>
    				</thead>
    				<tbody>
						@if (count($list)) 
							@foreach ($list as $key => $info)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{!! $info->employee_code !!}</td>
							<td>{!! $info->name !!}</td>
							<td>{!! $info->position !!}</td>
							<td class="col-border-right">{!! $info->joined_date !!}</td>
							<td>{!! $info->cb !!}</td>
							<td>{!! $info->bs !!}</td>
							<td class="col-border-right">{!! $info->is !!}</td>
							<td class="col-border-right">{!! $info->total_addition !!}</td>
							<td class="col-border-right">{!! $info->total_deduction !!}</td>
							<td class="col-border-right">{!! $info->thp !!}</td>
							<td>
								<button onclick="window.location='{{ route('payroll.trx.show', ['id'=>$info->id]) }}';"
                                    class="round-btn btn btn-default fas fa-edit btn-segment">
                                </button>
							</td>
						</tr>
                        @endforeach
                    	@else
						<tr>
							<!-- **+2 is because of no. and action -->
							<td colspan="12"><em>No record found</em></td>
						</tr>
						@endif
				</tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$('#payroll-trx').DataTable({
	columnDefs: [
	    { "orderable": false, "targets": [11] }
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
$( document ).ready(function() {
	$("#page-title").append("{{ $title }}");
	$("#breadcrumbs .active").append("{{ $title }}");

});
</script>
@append
