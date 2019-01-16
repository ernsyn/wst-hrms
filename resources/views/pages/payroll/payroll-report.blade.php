@extends('layouts.admin-base')
@section('pageTitle', 'Reports')
@section('content')
<div class="p-4">
    <link rel="stylesheet" href="{{asset('css/report/government_report.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('css/report/carousel.css')}}" type="text/css"/>
@if($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			{{$errors->first()}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif

		@if(session()->get('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{ session()->get('success') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
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
                        <div class="m-portlet__body engraved-text" style="text-align: center;height: 70pt;">
                        	@php
                        		echo wordwrap($slider->getReportName(),30,"<br>");
                        		if($slider->getReportTarget() !='report2') {
                        			echo "<br>";
                        			echo "<br>";
                        		}
                        	@endphp
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
                    <form method="post" action="{{action('Payroll\PayrollReportController@exportReport')}}">
                        {{csrf_field()}}
                        <div class="col-md-8 mx-auto">
                            @if ($form->getShowFilter() == 'true')
                            	@include('inc.filter')
                            @endif
                        </div>
                        <br>
                        <div class="col-md-6 mx-auto">
                            <div class="form-group">
                                @if ($form->getShowPeriod() == 'true')
								<label for="exampleFormPeriod">Periods</label>
                                <select class="form-control" id="selectPeriod" name="selectPeriod">
                                    @foreach($period as $key => $value)
                                    <option value="{{$value['yearmonth'].'-'.$value['period_id']}}">{{$value['yearmonth'].'-'.$value['period_desc']}}</option>
                                    @endforeach
                                </select>
                                @endif
                                @if ($form->getShowOfficer() == 'true')
                                <label for="exampleFormOfficer">Officer</label>
                                <select class="form-control" id="selectOfficer" name="selectOfficer">
                                    @foreach($officers as  $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @endif
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
                        <div class="m-portlet__body engraved-text" style="text-align: center;height: 70pt;">
                            @php
                        		echo wordwrap($slider->getReportName(),30,"<br>");
                        	@endphp
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
                    <form method="post" action="{{action('Payroll\PayrollReportController@exportReport')}}">
                        {{csrf_field()}}
                        <div class="col-md-8 mx-auto">
                            @if ($form->getShowFilter() == 'true')
                            	@include('inc.filter')
                            @endif
                        </div>
                        <br>
                        <div class="col-md-6 mx-auto">
                            <div class="form-group">
                                @if ($form->getShowPeriod() == 'true')
                                <label for="exampleFormPeriod">Periods</label>
                                <select class="form-control" id="selectPeriod" name="selectPeriod">
                                    @foreach($period as $key => $value)
                                    <option value="{{$value['period_id']}}">{{$value['yearmonth'].'-'.$value['period_desc']}}</option>
                                    @endforeach
                                </select>
                                @endif
                                @if ($form->getShowOfficer() == 'true')
                                <label for="exampleFormOfficer">Officer</label>
                                <select class="form-control" id="selectOfficer" name="selectOfficer">
                                    @foreach($officers as  $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @endif
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
</div>

@endsection
@section('scripts')
<script>

$("[id^=payroll_month_report]").datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat: "yy-mm",
//	  showButtonPanel: true,
//	  currentText: "This Month",
	  onChangeMonthYear: function (year, month, inst) {
	    $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month - 1, 1)));
	  },
	  onClose: function(dateText, inst) {
	    var month = $(".ui-datepicker-month :selected").val();
	    var year = $(".ui-datepicker-year :selected").val();
	    $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month, 1)));
	  }
	}).focus(function () {
	  $(".ui-datepicker-calendar").hide();
	});

</script>
<style>
.ui-datepicker-calendar {
    display: none;
}
</style>
@append
