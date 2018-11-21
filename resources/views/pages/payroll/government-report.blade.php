@extends('layouts.admin-base')
@section('pageTitle', 'Government Reports')
@section('content')
<div class="p-4">
    <link rel="stylesheet" href="{{asset('css/report/government_report.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('css/report/carousel.css')}}" type="text/css"/>

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


    <!--government report form-->
    <div class="row">
        <div class="col-md-12">
            <div id="borangE" class="card text-center collapse show" >
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
                    <form method="post">
                        <input type="button" class="btn btn-primary" value="Generate">
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
                    <form method="post">
                        <input type="button" class="btn btn-primary" value="Generate">
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
