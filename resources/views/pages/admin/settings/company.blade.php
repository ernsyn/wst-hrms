@extends('layouts.admin-base')
@section('content')

<div class="container">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                <a role="button" class="btn btn-primary" href="{{ route('admin.settings.companies.add') }}">
                        Add Company
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right tableTools-container"></div>
                    <table class="hrms-data-table compact w-100 t-2" id="setupCompanyTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                {{-- <th>Description</th>
                                <th>Image</th> --}}
                                <th>Tax No</th>
                                <th>EPF No</th>
                                <th>Socso No</th>
                                <th>EIS No</th>
                                <th>Last Updated</th>
                  
                                {{-- <th>Account Number</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                            <tr onclick="window.location='{{ route('admin.settings.companies.edit', ['id' => $company->id]) }}';">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$company['name']}}</td>
                                {{-- <td>{{$company['description']}}</td> --}}
                                {{-- <td>{{$company['registration_no']}}</td> --}}
                                <td>{{$company['tax_no']}}</td>
                                <td>{{$company['epf_no']}}</td>
                                <td>{{$company['socso_no']}}</td>
                                <td>{{$company['eis_no']}}</td>
                                <td>{{$company['updated_at']}}</td>
                        
                                {{-- <td>          <button onclick="window.location='{{ url('/admin/company-edit/'.$row['id']) }}';" class="btn btn-default">View</button></td> --}}
                                <td>
                                    {{-- <a class="btn btn-primary" href="{{ route('admin.settings.companies.edit', ['id' => $company->id]) }}" role="button">Edit</a>
                                    <button class="btn btn-success waves-effect" onclick="window.location='{{ url('admin/setup/company-details/'.$company['id']) }}';">View</button> --}}
                                    <button onclick="window.location='{{ route('admin.settings.companies.edit', ['id' => $company->id]) }}';"
                                            class="round-btn btn btn-default fas fa-edit btn-segment">
                                        </button>
    
                                        <button onclick="window.location='{{ route('admin.settings.companies.edit', ['id' => $company->id]) }}';" class="round-btn btn btn-default fas fa-eye btn-segment"></button>
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
$('#setupCompanyTable').DataTable({
    responsive: true,
    stateSave: true,
    dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        <'row'<'col-md-6'><'col-md-6'>>
        <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
    buttons: [{
            extend: 'copy',
            text: '<i class="fas fa-copy"></i>',
            className: 'btn-segment',
            titleAttr: 'Copy',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'colvis',
            text: '<i class="fas fa-search"></i>',
            className: 'btn-segment',
            titleAttr: 'Show/Hide Column',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'csv',
            text: '<i class="fas fa-file-alt"></i>',
            className: 'btn-segment',
            titleAttr: 'Export CSV',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'pdfHtml5',
            download: 'open',
            exportOptions: {
                columns: ':visible'
            },
            text: '<i class="fas fa-file-pdf fa-fw"></i>',
            className: 'btn-segment',
            titleAttr: 'Export PDF'
        },
        {
            extend: 'print',
            text: '<i class="fas fa-print fa-fw"></i>',
            className: 'btn-segment',
            titleAttr: 'Print',
            exportOptions: {
                columns: ':visible'
            }
        },
    ]

});
</script>
@append