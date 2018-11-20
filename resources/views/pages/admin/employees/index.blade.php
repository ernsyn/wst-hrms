@extends('layouts.admin-base')
@section('pageTitle', 'Employee List')
@section('content')

<div class="container">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right tableTools-container" ></div>
                    <table class="hrms-data-table compact w-100 t-2" id="employees-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                            @foreach($employees as $employee)
                          
                            <tr onclick="window.location='{{ route('admin.employees.id',['id' => $employee->id ]) }}'">

                                <td class="id">{{$loop->iteration}}</td>
                                <td class="name">{{$employee->user->name}}</td>
                                <td class="email">{{$employee->user->email}}</td>

                                <td>
                                    {{-- <button onclick="window.location='{{ url('/admin/profile-employee/'.$employee['id']) }}';"
                                        class="btn btn-default">View</button> --}}
                             
                                    {{-- <button onclick="window.location='{{ url('/admin/edit-employee/'.$employee['id']) }}';"
                                        class="btn btn-default">Edit</button> --}}
                                    <button onclick="window.location='{{ route('admin.employees.id',['id' => $employee->id ]) }}';"
                                        class="round-btn btn btn-default fas fa-edit btn-segment">
                                    </button>

                                    <button onclick="window.location='{{ route('admin.employees.id', ['id' => $employee->id]) }}';" class="round-btn btn btn-default fas fa-eye btn-segment"></button>
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
    $('#employees-table').DataTable({
        responsive: true,
        stateSave: true,
        dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        <'row'<'col-md-6'><'col-md-6'>>
        <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
        buttons: [{
                extend: 'copy',
                text: '<i class="fas fa-copy "></i>',
                // text: '<i class="fas fa-copy "></i>',
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
