@extends('layouts.app')

@section('page-title', $title)

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $title }}
        </h1>
    </div>
</div>

<div class="row mb15">
    <a class="btn btn-info col-sm-1 ml15" href="/payroll/{{$payroll_id}}"> <i class="fa fa-angle-left pr10"></i> Back</a>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong> {{ strtoupper('basic information') }} </strong>
            </div>
            <div class="panel-body">
                @foreach($employee_forms as $form) 
                    <div class="row">
                        <div class="col-sm-4 mb15">{!! ucwords(str_replace('_', ' ', $form)) !!}</div>
                        <div class="col-sm-8 mb15"><strong> {!! (@$employee->$form)? : '-' !!} </strong></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong> {{ strtoupper('remark') }} </strong>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 mb15"> Write your remark here: </div>
                    <div class="col-sm-12 mb15">
                        @php
                            $read = (Auth::user()->id == $info->user_id && Auth::user()->hasRole('Employee'))? 'readonly':'';
                        @endphp
                        <textarea name="note" class="form-control" rows="7" style="resize:none;" {{ $read }}>{!! (@$info->remark)?:'-' !!}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row" id="calculate_result">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-2" id="gross_pay">
                        <label>Gross Pay</label> <br/>
                        <span style="font-size: 22px;"></span>
                    </div>
                    <div class="col-sm-2" id="additional_earnings">
                        <label>Additional Earnings</label> <br/>
                        <span style="font-size: 22px;" id=""></span>
                    </div>
                    <div class="col-sm-2" id="additional_deductions">
                        <label>Deductions</label> <br/>
                        <span style="font-size: 22px;" id=""></span>
                    </div>
                    <div class="col-sm-2" id="employee-contributions">
                        <label>Employee Contributions</label> <br/>
                        <span style="font-size: 22px;" id=""></span>
                    </div>
                    <div class="col-sm-2" id="net_pay">
                        <label>Net Pay</label> <br/>
                        <span style="font-size: 22px;" id=""></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb15">
    <div class="col-sm-9">
    </div>
    <div class="col-sm-3 text-right">
        @if(Auth::user()->id != $info->user_id && ($info->status !== 'Locked') && !@$is_in_charge)
            <button class="btn btn-primary" type="submit" name="save">Save</button>
            <button class="btn btn-success" type="submit" name="save_n_next" value="1">Save & Next</button>
        @endif
    </div>
</div>

@endsection