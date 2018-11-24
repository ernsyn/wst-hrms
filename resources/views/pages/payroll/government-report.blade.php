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
                    <div class="m-portlet m-portlet--skin-dark m-portlet--bordered-semi {{$slider->getReportCss()}} port-item" data-toggle="collapse"  data-target="#{{$slider->getReportTarget()}}">
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

    <!--government report form -->
    <div class="row">
        @foreach($dforms as $form)
        <div class="col-md-8 mx-auto">
            <div id="{{$form->getReportTarget()}}" class="card text-center form-collapse collapse" >
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    {{$form->getReportName()}}
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <div class="col-md-8 mx-auto">
                            <div id="accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer">
                                        <i class="fas fa-search"></i> Filter
                                    </div>
                                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                                <div class="form-group">
                                                    <label for="exampleFormControlCostCentres">Cost Centres</label>
                                                    <select class="form-control" id="selectCostCentres" name="selectCostCentres">
                                                        <option value="0">--Select--</option>
                                                        @foreach($costcentres as $key => $value)
                                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="exampleFormControlDepartments">Departments</label>
                                                    <select class="form-control" id="selectDepartments" name="selectDepartments">
                                                        <option value="0">--Select--</option>
                                                        @foreach($departments as $key => $value)
                                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="exampleFormControlBranches">Branches</label>
                                                    <select class="form-control" id="selectBranches" name="selectBranches">
                                                        <option value="0">--Select--</option>
                                                        @foreach($branches as $key => $value)
                                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="exampleFormControlPositions">Positions</label>
                                                    <select class="form-control" id="selectPositions" name="selectPositions">
                                                        <option value="0">--Select--</option>
                                                        @foreach($positions as $key => $value)
                                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-6 mx-auto">
                            <div class="form-group">
                                <label for="exampleFormPeriod">Periods</label>
                                <select class="form-control" id="selectPeriod" name="selectPeriod">
                                    <option value="0">--Select--</option>
                                    @foreach($period['period'] as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                <label for="exampleFormOfficer">Officer</label>
                                <select class="form-control" id="selectOfficer" name="selectOfficer">
                                    <option value="0">--Select--</option>
                                    @foreach($officers as  $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="reportName" value="{{$form->getValue()}}">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    {{$form->getReportGroup()}}
                </div>
            </div>
        </div>
        @endforeach
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

    <!--government report form  1-->
    <div class="row">
        @foreach($dforms1 as $form)
        <div class="col-md-8 mx-auto">
            <div id="{{$form->getReportTarget()}}" class="card text-center form-collapse collapse" >
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    {{$form->getReportName()}}
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <div class="col-md-8 mx-auto">
                            <div id="accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer">
                                        <i class="fas fa-search"></i> Filter
                                    </div>
                                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleFormControlCostCentres">Cost Centres</label>
                                                <select class="form-control" id="selectCostCentres" name="selectCostCentres">
                                                    <option value="0">--Select--</option>
                                                    @foreach($costcentres as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlDepartments">Departments</label>
                                                <select class="form-control" id="selectDepartments" name="selectDepartments">
                                                    <option value="0">--Select--</option>
                                                    @foreach($departments as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlBranches">Branches</label>
                                                <select class="form-control" id="selectBranches" name="selectBranches">
                                                    <option value="0">--Select--</option>
                                                    @foreach($branches as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlPositions">Positions</label>
                                                <select class="form-control" id="selectPositions" name="selectPositions">
                                                    <option value="0">--Select--</option>
                                                    @foreach($positions as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="reportName" value="{{$form->getValue()}}">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    {{$form->getReportGroup()}}
                </div>
            </div>
        </div>
        @endforeach
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

    <!--government report form 2-->
    <div class="row">
        @foreach($dforms2 as $form)
        <div class="col-md-8 mx-auto">
            <div id="{{$form->getReportTarget()}}" class="card text-center form-collapse collapse" >
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    {{$form->getReportName()}}
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <div class="col-md-8 mx-auto">
                            <div id="accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer">
                                        <i class="fas fa-search"></i> Filter
                                    </div>
                                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleFormControlCostCentres">Cost Centres</label>
                                                <select class="form-control" id="selectCostCentres" name="selectCostCentres">
                                                    <option value="0">--Select--</option>
                                                    @foreach($costcentres as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlDepartments">Departments</label>
                                                <select class="form-control" id="selectDepartments" name="selectDepartments">
                                                    <option value="0">--Select--</option>
                                                    @foreach($departments as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlBranches">Branches</label>
                                                <select class="form-control" id="selectBranches" name="selectBranches">
                                                    <option value="0">--Select--</option>
                                                    @foreach($branches as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlPositions">Positions</label>
                                                <select class="form-control" id="selectPositions" name="selectPositions">
                                                    <option value="0">--Select--</option>
                                                    @foreach($positions as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="reportName" value="{{$form->getValue()}}">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    {{$form->getReportGroup()}}
                </div>
            </div>
        </div>
        @endforeach
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

    <!--government report form 3-->
    <div class="row">
        @foreach($dforms3 as $form)
        <div class="col-md-8 mx-auto">
            <div id="{{$form->getReportTarget()}}" class="card text-center form-collapse collapse" >
                <div class="card-header">
                    <div  style="float: left;">
                        <i class="fas fa-edit" style="color: #7b7474;font-size: 12pt;"></i>
                    </div>
                    {{$form->getReportName()}}
                    <button type="button" class="close port-item" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{action('Payroll\GovernmentReportController@generateReport')}}">
                        {{csrf_field()}}
                        <div class="col-md-8 mx-auto">
                            <div id="accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer">
                                        <i class="fas fa-search"></i> Filter
                                    </div>
                                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleFormControlCostCentres">Cost Centres</label>
                                                <select class="form-control" id="selectCostCentres" name="selectCostCentres">
                                                    <option value="0">--Select--</option>
                                                    @foreach($costcentres as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlDepartments">Departments</label>
                                                <select class="form-control" id="selectDepartments" name="selectDepartments">
                                                    <option value="0">--Select--</option>
                                                    @foreach($departments as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlBranches">Branches</label>
                                                <select class="form-control" id="selectBranches" name="selectBranches">
                                                    <option value="0">--Select--</option>
                                                    @foreach($branches as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlPositions">Positions</label>
                                                <select class="form-control" id="selectPositions" name="selectPositions">
                                                    <option value="0">--Select--</option>
                                                    @foreach($positions as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="reportName" value="{{$form->getValue()}}">
                        <input type="submit" class="btn btn-info" value="Generate">
                    </form>
                </div>
                <div class="card-footer text-muted">
                    {{$form->getReportGroup()}}
                </div>
            </div>
        </div>
        @endforeach
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
            <div id="asbn" class="card text-center form-collapse collapse" >
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
            <div id="lampiran1" class="card text-center form-collapse collapse">
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
@endsection

