@extends('layouts.base')
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
                    <div class="m-portlet m-portlet--skin-dark m-portlet--bordered-semi m--bg-brand port-item" data-toggle="collapse" data-target="#{{$slider->getReportTarget()}}">
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


    <div class="row">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header">
                    LHDN Borang E
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
@endsection
