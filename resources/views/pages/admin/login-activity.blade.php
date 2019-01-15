@extends('layouts.admin-base')
@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-primary fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    @endif
    <div class="row pb-3">
        <div class="col-auto mr-auto"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="float-right tableTools-container"></div>
            <table class="hrms-data-table compact w-100 t-2" id="employees-table">
                <thead>
                    <tr>
                    	<th>No</th>
                        <th>User</th>
                        <th>User Agent</th>
                        <th>IP Address</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loginActivities as $loginActivity)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $loginActivity->user_id }}</td>
                        <td>{{ $loginActivity->user_agent }}</td>
                        <td>{{ $loginActivity->ip_address }}</td>
                        <td>{{ $loginActivity->created_at }}</td>
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
    $('#employees-table').DataTable({
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
