@extends('layouts.admin-base')
@section('content')
<div class="container company" style="display:none">
    <div class="p-4">
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
