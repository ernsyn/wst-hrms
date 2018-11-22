@extends('layouts.admin-base')
@section('pageTitle', 'Government Reports')
@section('content')
<div class="p-4">
    <link rel="stylesheet" href="{{asset('css/report/government_report.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('css/report/carousel.css')}}" type="text/css"/>

<!--    <div class="row">
        <div class="carousel">
            <div class="carousel-row">
                @foreach($sliders as $slider)
                <div class="carousel-tile">
                    <div class="m-portlet m-portlet--skin-dark m-portlet--bordered-semi {{$slider->getReportCss()}} port-item" data-toggle="collapse" data-target="#{{$slider->getReportTarget()}}">
                    <div class="m-portlet__head" style="padding-top:12pt;align-items: center;height: 20pt;">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <div class="m-portlet__head-icon" style="float:left;">
                                        <i class="far fa-file-pdf" style="font-size: 13pt;"></i>
                                    </div>
                                    <div class="m-portlet__head-text">
                                        &nbsp;{{$slider->getReportGroup()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body" style="text-align: center;height: 70pt;font-size: 30pt;">
                            {{$slider->getReportName()}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>-->

    <div class="row">
        <div class="carousel">
            <div class="carousel-row">
                @foreach($sliders as $slider)
                <div class="carousel-tile">
                    <div class="m-portlet m-portlet--skin-dark m-portlet--bordered-semi {{$slider->getReportCss()}} port-item" data-toggle="collapse" data-target="#{{$slider->getReportTarget()}}">
                        <div class="m-portlet__head" style="padding-top:12pt;align-items: center;height: 20pt;">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <div class="m-portlet__head-icon" style="float:left;">
                                        <i class="far fa-file-pdf" style="font-size: 13pt;"></i>
                                    </div>
                                    <div class="m-portlet__head-text engraved-text">
                                        &nbsp;{{$slider->getReportGroup()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body engraved-text" style="text-align: center;height: 70pt;font-size: 30pt;">
                            {{$slider->getReportName()}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!--government report form slider-->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div id="borangE" class="card text-center collapse" >
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    LHDN Borang E
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_borangE">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="cp21" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    LHDN CP21
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp21">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="cp22" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    LHDN CP22
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="cp22a" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    LHDN CP22a
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22a">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
    </div>

    <!--government report slider 1-->
    <div class="row">
        <div class="carousel">
            <div class="carousel-row">
                @foreach($sliders1 as $slider)
                <div class="carousel-tile">
                    <div class="m-portlet m-portlet--skin-dark m-portlet--bordered-semi {{$slider->getReportCss()}} port-item" data-toggle="collapse" data-target="#{{$slider->getReportTarget()}}">
                        <div class="m-portlet__head" style="padding-top:12pt;align-items: center;height: 20pt;">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <div class="m-portlet__head-icon" style="float:left;">
                                        <i class="far fa-file-pdf" style="font-size: 13pt;"></i>
                                    </div>
                                    <div class="m-portlet__head-text engraved-text">
                                        &nbsp;{{$slider->getReportGroup()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body engraved-text" style="text-align: center;height: 70pt;font-size: 30pt;">
                            {{$slider->getReportName()}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!--government report form slider 1-->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div id="cp22b" class="card text-center collapse" >
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    LHDN CP22b
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22b">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="cp39" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    LHDN CP39
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp39">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="cp39lieu" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    LHDN CP39 Lieu
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp39lieu">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="eaform" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    LHDN EA Form
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_eaform">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
    </div>


    <!--government report slider 2-->
    <div class="row">
        <div class="carousel">
            <div class="carousel-row">
                @foreach($sliders2 as $slider)
                <div class="carousel-tile">
                    <div class="m-portlet m-portlet--skin-dark m-portlet--bordered-semi {{$slider->getReportCss()}} port-item" data-toggle="collapse" data-target="#{{$slider->getReportTarget()}}">
                        <div class="m-portlet__head" style="padding-top:12pt;align-items: center;height: 20pt;">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <div class="m-portlet__head-icon" style="float:left;">
                                        <i class="far fa-file-pdf" style="font-size: 13pt;"></i>
                                    </div>
                                    <div class="m-portlet__head-text engraved-text">
                                        &nbsp;{{$slider->getReportGroup()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body engraved-text" style="text-align: center;height: 70pt;font-size: 30pt;">
                            {{$slider->getReportName()}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!--government report form slider 2-->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div id="caruman" class="card text-center collapse" >
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    Tabung Haji Caruman
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="Tabung_Haji_caruman">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Tabung Haji
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="disket" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    Tabung Haji Disket
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="Tabung_Haji_disket">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Tabung Haji
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="bbcd" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    EPF BBCD
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="EPF_bbcd">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Kumpulan Wang Simpanan Pekerja
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="borangA" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    EPF Borang A
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="EPF_borangA">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Kumpulan Wang Simpanan Pekerja
                </div>
            </div>
        </div>
    </div>


    <!--government report slider 3-->
    <div class="row">
        <div class="carousel">
            <div class="carousel-row">
                @foreach($sliders3 as $slider)
                <div class="carousel-tile">
                    <div class="m-portlet m-portlet--skin-dark m-portlet--bordered-semi {{$slider->getReportCss()}} port-item" data-toggle="collapse" data-target="#{{$slider->getReportTarget()}}">
                        <div class="m-portlet__head" style="padding-top:12pt;align-items: center;height: 20pt;">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <div class="m-portlet__head-icon" style="float:left;">
                                        <i class="far fa-file-pdf" style="font-size: 13pt;"></i>
                                    </div>
                                    <div class="m-portlet__head-text engraved-text">
                                        &nbsp;{{$slider->getReportGroup()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body engraved-text" style="text-align: center;height: 70pt;font-size: 30pt;">
                            {{$slider->getReportName()}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!--government report form slider 3-->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div id="lampiranA" class="card text-center collapse" >
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    SOSCO Lampiran A
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="SOSCO_lampiranA">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Pertubuhan Keselamatan Social
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="borang8A" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    SOSCO Borang 8A
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="SOSCO_borang8A">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Pertubuhan Keselamatan Social
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="ptptn" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    PTPTN
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="PTPTN_montly">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Perbadanan Tabung Pendidikan Tinggi Nasional
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="zakat" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    ZAKAT
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="ZAKAT_montly">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    ZAKAT Malaysia
                </div>
            </div>
        </div>
    </div>

    <!--government report slider 4-->
    <div class="row">
        <div class="carousel">
            <div class="carousel-row">
                @foreach($sliders4 as $slider)
                <div class="carousel-tile">
                    <div class="m-portlet m-portlet--skin-dark m-portlet--bordered-semi {{$slider->getReportCss()}} port-item" data-toggle="collapse" data-target="#{{$slider->getReportTarget()}}">
                        <div class="m-portlet__head" style="padding-top:12pt;align-items: center;height: 20pt;">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <div class="m-portlet__head-icon" style="float:left;">
                                        <i class="far fa-file-pdf" style="font-size: 13pt;"></i>
                                    </div>
                                    <div class="m-portlet__head-text engraved-text">
                                        &nbsp;{{$slider->getReportGroup()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body engraved-text" style="text-align: center;height: 70pt;font-size: 30pt;">
                            {{$slider->getReportName()}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!--government report form slider 4-->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div id="asbn" class="card text-center collapse" >
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    ASBN
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="ASBN_montly">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Amanah Saham National Berhad
                </div>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div id="lampiran1" class="card text-center collapse">
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    EIS Lampiran 1
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="EIS_lampiran1">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Employment Insurance System
                </div>
            </div>
        </div>
    </div>


</div>

<script src="{{asset('js/report/jquery-3.3.1.min.js')}}" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="{{asset('js/report/bootstrap.min.js')}}" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
<script>
    // accordion fix
    $('.port-item').click(function () {
        $('.collapse').collapse('hide');
    })
</script>

@endsection
