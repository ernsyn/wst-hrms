@extends('layouts.admin-base')
@section('content')
<div class="container">
        <div id="alert-container">
            </div>   
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    <div class="p-4">
        @if (session('status'))
        <div class="alert alert-primary fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @endif
        <div class="card py-4">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <nav class="col-sm-12">
                            <div class="nav nav-tabs font-weight-bold" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-bank-tab" data-toggle="tab" href="#nav-bank" role="tab" aria-controls="nav-bank"
                                    aria-selected="false">Company Bank</a>
                                <a class="nav-item nav-link" id="nav-security-tab" data-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security"
                                    aria-selected="true">Security Group</a>
                                <a class="nav-item nav-link" id="nav-addition-tab" data-toggle="tab" href="#nav-addition" role="tab" aria-controls="nav-addition"
                                    aria-selected="true">Addition</a>
                                <a class="nav-item nav-link" id="nav-deduction-tab" data-toggle="tab" href="#nav-deduction" role="tab" aria-controls="nav-deduction"
                                    aria-selected="true">Deduction</a>
                            </div>
                        </nav>
                        {{-- TABLES --}}
                        <div class="tab-content col-sm-12 text-justify pt-4" id="nav-tabContent">
                            {{-- Company Bank --}}
                            @include('pages.admin.settings.company.details.company-bank')
                            {{-- Security Group --}}
                            @include('pages.admin.settings.company.details.security-group')
                            {{--ADDITION--}}
                            @include('pages.admin.settings.company.details.addition')
                            {{-- DEDUCTION --}}
                            @include('pages.admin.settings.company.details.deduction')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- @section('scripts')
<script>
    $('#travel-allowance-table').DataTable({
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
</script> --}}
