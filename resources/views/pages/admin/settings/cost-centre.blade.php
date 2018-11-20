@extends('layouts.admin-base') 
@section('content')


<div class="container">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                    <a role="button" class="btn btn-primary" href="{{ route('admin.settings.cost-centres.add') }}">
                            Add Cost Centre
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right tableTools-container"></div>
                        <table class="hrms-data-table compact w-100 t-2" id="cost-centres-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Seniority Pay</th>
                                    <th>Amount</th>
                                    <th>Payroll Type</th>                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($costs as $cost)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$cost['name']}}</td>
                                        <td>{{$cost['seniority_pay']}}</td>
                                        <td>{{$cost['amount']}}</td>
                                        <td>{{$cost['payroll_type']}}</td>
                
                                        <td>
                                            <button onclick="window.location='{{ route('admin.settings.cost-centres.edit', ['id' => $cost->id]) }}';"
                                                class="round-btn btn btn-default fas fa-edit btn-segment">
                                            </button>
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
$('#cost-centres-table').DataTable({
    responsive: true,
    stateSave: true,
    dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        <'row'<'col-md-6'><'col-md-6'>>
        <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
    buttons: [{
            extend: 'copy',
            text: '<i class="fas fa-copy fa-fw"></i>',
            className: 'btn-segment',
            titleAttr: 'Copy'
        },
        {
            extend: 'colvis',
            text: '<i class="fas fa-search fa-fw"></i>',
            className: 'btn-segment',
            titleAttr: 'Show/Hide Column'
        },
        {
            extend: 'csv',
            text: '<i class="fas fa-file-alt fa-fw"></i>',
            className: 'btn-segment',
            titleAttr: 'Export CSV'
        },
        {
            extend: 'print',
            text: '<i class="fas fa-print fa-fw"></i>',
            className: 'btn-segment',
            titleAttr: 'Print'
        },
    ],
    initComplete: function () {
        this.api().columns(1).every(function () {
            var that = this;
            $('div.dataTables_wrapper div.dataTables_filter input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    }
});
</script>
@append