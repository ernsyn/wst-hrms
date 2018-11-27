@extends('layouts.admin-base') 
@section('pageTitle', 'Reports')
@section('content')

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
                        <div class="m-portlet__body engraved-text" style="text-align: center;height: 70pt;font-size: 15pt; word-wrap: break-word;">
                            {{$slider->getReportName()}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

<div class="container">
	<div class="card">
		<form method="POST" action="{{ route('payroll.report.show') }}" id="add_payroll">
			<div class="card-body">
				@csrf
				<div class="row p-3">
					<div class="form-group row w-100">
						<div class="col-4">
							<label class="col-md-12 col-form-label">Payroll Month*</label>
							<div class="col-md-12">
								<input id="year_month" type="text" class="form-control{{ $errors->has('year_month') ? ' is-invalid' : '' }}" placeholder="YYYY-DD" name="year_month" value="{{ old('year_month') }}" required> 
								@if ($errors->has('year_month')) 
									<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('year_month') }}</strong></span>
								@endif
							</div>
						</div>
						<div class="col-4">
							<label class="col-md-12 col-form-label">Period*</label>
							<div class="col-md-12">
								<select class="form-control" id="period" name="period"> 
									@foreach ($period as $k=>$v )
									<option value="{{ $k }}">{{ $v }}</option>
									 @endforeach
								</select>
							</div>
						</div>
					</div>
					{{--
					<div class="form-group row w-100"></div>
					--}}
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
				<a role="button" class="btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
			</div>
		</form>
	</div>
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
                        <div class="m-portlet__body engraved-text" style="text-align: center;height: 70pt;font-size: 15pt;word-wrap: break-word;">
                            {{$slider->getReportName()}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection 
@section('scripts')
<script src="{{asset('js/report/jquery-3.3.1.min.js')}}" ></script>
<script>
//     $('#year_month').datepicker({
//     	changeMonth: true,
//         changeYear: true,
//         showButtonPanel: true,
//         dateFormat: 'yy-mm',

// 	    onClose: function(dateText, inst) {  
//             var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
//             var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
//             $(this).datepicker('setDate', new Date(year, month, 1)); 
//         }
//     });

    // accordion fix
    $('.port-item').click(function () {
        $('.collapse').collapse('hide');
    })
</script>
<link rel="stylesheet" href="{{asset('css/report/government_report.css')}}" type="text/css"/>
<link rel="stylesheet" href="{{asset('css/report/carousel.css')}}" type="text/css"/>
<style>
.ui-datepicker-calendar {
    display: none;
}
</style>
@append
