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

@include('partials.messages')

@if($info->status !== 'Locked')
    {{ Form::open(['route'=>['payroll.trx.update', 'id'=>$id], 'id'=>'form']) }}
    {{ Form::hidden('payroll_type', Request::get('payroll_type')) }}
    {{ Form::hidden('payrolltrx_id', $id) }}
    {{ Form::hidden('payroll_id', $payroll_id) }}
    {{ Form::hidden('month', $month, ['id'=>'month']) }}
    {{ Form::hidden('year', $year, ['id'=>'year']) }}
    {{ Form::hidden('total_days', $total_days, ['id'=>'total_days']) }}
@endif

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

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong> {{ strtoupper('basic earnings') }} </strong>
            </div>
            <div class="panel-body">
                @foreach($salary_form as $key => $form)
                    <div class="row">
                        <div class="col-sm-4 mb15"> {{ $key }} </div>
                        <div class="col-sm-6 mb15">
                            {!! $form !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong> {{ strtoupper('bonus') }} </strong>
            </div>
            <div class="panel-body">
                @if($employee->payroll_type != 'Regional')
                    @foreach($bonus_form as $key => $form)
                        <div class="row">
                            <div class="col-sm-4 mb15"> {{ $key }} </div>
                            <div class="col-sm-6 mb15">
                                {!! $form !!}
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Only In Charge Person Can Submit -->
                    @if(@$is_in_charge  && $info->status !== 'Locked')
                        <div class="row">
                            <div class="col-sm-4 mb15"></div>
                            <div class="col-sm-6 mb15 text-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    @endif
                @else
                    <em>No bonus, KPI feature for this employee.</em>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6" id="additions">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong> {{ strtoupper('additions') }} &nbsp; &nbsp; <br/> <small style="color:red;">*Enter number of days or hours to calculate amount.</small> </strong>
            </div>
            <div class="panel-body">
                @foreach($payrolltrx_additionForm as $key => $form)
                    <div class="row" data-code="{{$key}}" data-statutory="{!! (@$form->statutory)? $form->statutory : '' !!}">
                        <div class="col-sm-4 mb15"> {{ $form->name }} </div>
                        @php $name = $form->name; @endphp
                        @if(count(get_object_vars($form)) > 3)
                            @php 
                                unset($form->name); 
                                $i = 0;
                            @endphp
                            @foreach($form as $key => $sub_form)
                                @if($i == 0)
                                    <div class="col-sm-2 mb15">
                                        {!! $sub_form !!}
                                    </div>
                                @else
                                    <div class="col-sm-4 mb15">
                                        {!! $sub_form !!}
                                    </div>
                                @endif
                                @php $i++; @endphp
                            @endforeach
                        @else 
                            <div class="col-sm-6 mb15">
                                {!! $form->$name !!}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-6" id="deductions">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong> {{ strtoupper('deductions') }} &nbsp; &nbsp; <br/> <small style="color:red;">*Enter number of days or hours to calculate amount.</small> </strong>
            </div>
            <div class="panel-body">
                @foreach($payrolltrx_deductionForm as $key => $form)
                    <div class="row" data-code="{{$key}}">
                        <div class="col-sm-4 mb15"> {{ $form->name }} </div>
                        @php $name = $form->name; @endphp
                        @if(count(get_object_vars($form)) > 2)
                            @php 
                                unset($form->name); 
                                $i = 0;
                            @endphp
                            @foreach($form as $key => $sub_form)
                                @if($i == 0)
                                    <div class="col-sm-2 mb15">
                                        {!! $sub_form !!}
                                    </div>
                                @else
                                    <div class="col-sm-4 mb15">
                                        {!! $sub_form !!}
                                    </div>
                                @endif
                                @php $i++; @endphp
                            @endforeach
                        @else 
                            <div class="col-sm-6 mb15">
                                {!! $form->$name !!}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong> {{ strtoupper('employee contributions') }} </strong>
            </div>
            <div class="panel-body">
                @foreach($employeeContribution_form as $key => $form)
                    <div class="row">
                        <div class="col-sm-4 mb15"> {{ $key }} </div>
                        <div class="col-sm-6 mb15">
                            {!! $form !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong> {{ strtoupper('employer contributions') }} </strong>
            </div>
            <div class="panel-body">
                @foreach($employerContribution_form as $key => $form)
                    <div class="row">
                        <div class="col-sm-4 mb15"> {{ $key }} </div>
                        <div class="col-sm-6 mb15">
                            {!! $form !!}
                        </div>
                    </div>
                @endforeach
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

{{ Form::close() }}

@stop

@push('styles')
    <style type="text/css">
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            border-top: none !important;
        }
    </style>
    {!! HTML::style('/fteg/plugins/select2/select2.min.css') !!}
    {!! HTML::style('/fteg/plugins/select2/select2_custom.css') !!}
@endpush

@push('scripts')
    {!! HTML::script('/fteg/plugins/select2/select2.min.js') !!}
    {!! HTML::script('/fteg/plugins/select2/select-tool.js') !!}

    <!-- Submit Form via AJAX -->
    <script type="text/javascript">

        $(document).ready(function() {
            var basic_salary = parseFloat($('#basic_salary').val());
            var total_days = parseFloat($('#total_days').val());
            var additions_days_typing_timer;
            var additions_hours_typing_timer;
            var deductions_days_typing_timer;
            var amount_in_currency_typing_timer;
            var done_typing_interval = 1000;  //time i
                

            displayResult();

            $('input').keyup(function(){
                displayResult();
            });

            $('.additions_days').keyup(function(){
                var days = $(this).val();
                var code = $(this).parent().parent().data('code');
                var amount = calculateExtra(code, days, 0);

                $(this).parent().parent().find('.additions').val(checkIsNumber(amount));
                $(this).val(parseFloat(checkIsNumber(days)));

                clearTimeout(additions_days_typing_timer);
                if(amount) {
                    additions_days_typing_timer = setTimeout(function(){
                        calculateContribution();
                    }, done_typing_interval);
                }

                displayResult();
            });

            $('.deductions_days').keyup(function(){
                var days = $(this).val();
                var code = $(this).parent().parent().data('code');
                var amount = calculateExtra(code, days, 0);

                $(this).parent().parent().find('.deductions').val(checkIsNumber(amount));
                $(this).val(parseFloat(checkIsNumber(days)));

                clearTimeout(deductions_days_typing_timer);
                if(amount) {
                    deductions_days_typing_timer = setTimeout(function(){
                        calculateContribution();
                    }, done_typing_interval);
                }

                displayResult();
            });

            $('.additions_hours').keyup(function(){
                var hours = $(this).val();
                var code = $(this).parent().parent().data('code');
                var amount = calculateExtra(code, 0, hours);

                $(this).parent().parent().find('.additions').val(checkIsNumber(amount));
                $(this).val(parseFloat(checkIsNumber(hours)));

                clearTimeout(additions_hours_typing_timer);
                if(amount) {
                    additions_hours_typing_timer = setTimeout(function(){
                        calculateContribution();
                    }, done_typing_interval);
                }

                displayResult();
            });

            function checkIsNumber(value){
                if(isNaN(value)) value = 0;
                return value;
            }

            function calculateAdditions() {
                var amount = 0;
                $('.additions').each(function() {
                    amount += parseFloat($(this).val());
                });
                return checkIsNumber(amount);
            }

            function calculateDeductions() {
                var amount = 0;
                $('.deductions').each(function() {
                    amount += parseFloat($(this).val());
                });
                return checkIsNumber(amount);
            }

            function calculateEmployeeContributions() {
                var amount = 0;
                $('.contributions').each(function() {
                    amount += parseFloat($(this).val());
                });
                return checkIsNumber(amount);
            }

            function calculateGrossPay() {
                return calculateContractBase() + calculateBonus();
            }

            function calculateNetPay() {
                return calculateGrossPay() + calculateAdditions() - calculateDeductions() - calculateEmployeeContributions();
            }

            function calculateContractBase() {
                return basic_salary + parseFloat($('#seniority_pay').val());
            }

            function calculateBonus() {
                return checkIsNumber(parseFloat($('#bonus').val()) * parseFloat($('#kpi').val()));
            }

            function displayResult() {
                $('#gross_pay').find('span').text('RM ' + parseFloat(calculateGrossPay()).toFixed(2));
                $('#additional_earnings').find('span').text('RM ' + parseFloat(calculateAdditions()).toFixed(2));
                $('#additional_deductions').find('span').text('RM ' + parseFloat(calculateDeductions()).toFixed(2));
                $('#net_pay').find('span').text('RM ' + parseFloat(calculateNetPay()).toFixed(2));
                $('#total_bonus').val(parseFloat(calculateBonus()).toFixed(2));
                $('#employee-contributions').find('span').text('RM ' + parseFloat(calculateEmployeeContributions()).toFixed(2));
            }

            /** Extra addition & dedcution **/
            function calculateExtra(code, days, hours) {
                var result = 0;

                switch(code) {
                    case 'UL':
                        result = basic_salary / total_days * days;
                        break;
                    case 'ALP':
                    case 'CFLP':
                        result = (basic_salary >= 2000)? basic_salary / total_days * days : basic_salary / 26 * days;
                        break;
                    case 'PH':
                        result = basic_salary / 26 * 2 * days;
                        break;
                    case 'RD':
                        result = basic_salary / 26 * days;
                        break;
                    case 'OT':
                        result = basic_salary / 26 / 8 * 1.5 * hours;
                        break;
                    default:
                        break;
                }
                return parseFloat(checkIsNumber(result)).toFixed(2);
            }

            /** Calculate Contribution **/
            function calculateContribution() {
                $.ajax({
                    url: '/calculation/contribution',
                    data: getFormInput(),
                    method: 'POST',
                    success: function(data){
                        $('#employee_epf').val(data.info.employee.epf);
                        $('#employee_eis').val(data.info.employee.eis);
                        $('#employee_socso').val(data.info.employee.socso);
                        $('#employer_epf').val(data.info.employer.epf);
                        $('#employer_eis').val(data.info.employer.eis);
                        $('#employer_socso').val(data.info.employer.socso);
                    },
                });
            }

            // Display all form data
            function getFormInput() {
                var pairs = $('#form').serializeArray();
                var input = {};

                $.each(pairs, function (i, pair) {
                  input[pair.name] = pair.value;
                });
                return input;
            }
            

        });

    </script>
@endpush