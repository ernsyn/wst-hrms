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
    </div>

    <!--government report form slider-->
    <div class="row">
        <div class="col-md-12">
            <div id="borangE" class="card text-center collapse" >
                <div class="card-header">
                    LHDN Borang E
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_borangE">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp21" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP21
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp21">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp22" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP22
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp22a" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP22a
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22a">
                        <input type="submit" class="btn btn-primary" value="Generate">
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
    </div>

    <!--government report form slider 1-->
    <div class="row">
        <div class="col-md-12">
            <div id="cp22b" class="card text-center collapse" >
                <div class="card-header">
                    LHDN CP22b
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22b">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp39" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP39
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp39">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp39lieu" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP39 Lieu
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp39lieu">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="eaform" class="card text-center collapse">
                <div class="card-header">
                    LHDN EA Form
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_eaform">
                        <input type="submit" class="btn btn-primary" value="Generate">
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
    </div>

    <!--government report form slider 2-->
    <div class="row">
        <div class="col-md-12">
            <div id="caruman" class="card text-center collapse" >
                <div class="card-header">
                    Tabung Haji Caruman
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="Tabung_Haji_caruman">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Tabung Haji
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="disket" class="card text-center collapse">
                <div class="card-header">
                    Tabung Haji Disket
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="Tabung_Haji_disket">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Tabung Haji
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp22" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP22
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp22a" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP22a
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22a">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
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
    </div>

    <!--government report form slider 3-->
    <div class="row">
        <div class="col-md-12">
            <div id="borangE" class="card text-center collapse" >
                <div class="card-header">
                    LHDN Borang E
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_borangE">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp21" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP21
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp21">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp22" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP22
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp22a" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP22a
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22a">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
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
    </div>

    <!--government report form slider 4-->
    <div class="row">
        <div class="col-md-12">
            <div id="borangE" class="card text-center collapse" >
                <div class="card-header">
                    LHDN Borang E
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_borangE">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp21" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP21
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp21">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp22" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP22
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="cp22a" class="card text-center collapse">
                <div class="card-header">
                    LHDN CP22a
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reportName" value="LHDN_cp22a">
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Lembaga Hasil Dalam Negeri
                </div>
            </div>
        </div>
    </div>


</div>

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
<script>
    // accordion fix
    $('.port-item').click(function () {
        $('.collapse').collapse('hide');
    })
</script>

@endsection
