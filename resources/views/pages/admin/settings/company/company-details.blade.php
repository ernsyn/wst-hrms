@extends('layouts.admin-base')
@section('content')
<div class="main-content company" style="display:none">
        <div id="alert-container"></div>
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
                            	@can(PermissionConstant::VIEW_COMPANY_BANK)
                                    <a class="nav-item nav-link active" id="nav-bank-tab" data-toggle="tab" href="#nav-bank" role="tab" aria-controls="nav-bank"
                                        aria-selected="false">Company Bank</a>
                                @endcan
                                @can(PermissionConstant::VIEW_JOB_COMPANY)
                                    <a class="nav-item nav-link" id="nav-job-company-tab" data-toggle="tab" href="#nav-job-company" role="tab" aria-controls="nav-job-company"
                                        aria-selected="true">Job - Company</a>
                                @endcan
                            </div>
                        </nav>
                        {{-- TABLES --}}
                        <div class="tab-content col-sm-12 text-justify pt-4" id="nav-tabContent">
                            {{-- Company Bank --}}
                            @include('pages.admin.settings.company.details.company-bank')
                            {{-- Job Comapny --}}
                            @include('pages.admin.settings.company.details.job-company')
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection


@section('scripts')
<script>
    $(function() {
        $('.company').show();

        $('a[data-toggle="tab"]').on('click', function(e) {
            window.localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = window.localStorage.getItem('activeTab');
        if (activeTab) {
            $('#nav-tab a[href="' + activeTab + '"]').tab('show');
        }
    });
</script>
@append
