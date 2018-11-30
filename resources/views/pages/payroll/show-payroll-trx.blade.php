@extends('layouts.admin-base') 
@section('pageTitle', 'Payroll')
@section('content')

<form action="{{ route('payroll.trx.update', ['id'=>$id]) }}" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
	<input name="payroll_trx_id" type="hidden" value="{{ $id }}">
	<input name="basic_salary" id="basic_salary" type="hidden" value="{{ $info->bs }}">
	<input name="total_days" id="total_days" type="hidden" value="{{ $total_days }}">
	<input name="seniority_pay" id="seniority_pay" type="hidden" value="{{ $info->is }}">
	<input name="total_addition" id="total_addition" type="hidden" value="">
	<input name="total_deduction" id="total_deduction" type="hidden" value="">
	<input name="take_home_pay" id="take_home_pay" type="hidden" value="">
	<div class="p-2 clearfix" style="height: 300px;">
		<span class="float-left col-md-6 h-100">
			<div class="card h-100">
				<div class="card-header">Basic Information</div>
				<div class="card-body">
					<div class="row p-2">
						<div class="col-sm-4 mb15">S-ID</div>
						<div class="col-sm-8 mb15">
							<strong>{!! $employee->code !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Full Name</div>
						<div class="col-sm-8 mb15">
							<strong>{!! $info->name !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Joined Date</div>
						<div class="col-sm-8 mb15">
							<strong>{!! (@$info->joined_date)? : '-' !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Resignation Date</div>
						<div class="col-sm-8 mb15">
							<strong>{!! (@$info->resignation_date)? : '-' !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Confirmation Date</div>
						<div class="col-sm-8 mb15">
							<strong>{!! (@$info->confirmation_date)? : '-' !!}</strong>
						</div>
					</div>
				</div>
			</div>
		</span> 
		<span class="float-right col-md-6 h-100">
			<div class="card h-100">
				<div class="card-header">Remark</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 mb15">Write your remark here:</div>
						<div class="col-sm-12 mb15">
							@php $read = (Auth::user()->id == $info->user_id && Auth::user()->hasRole('Employee'))? 'readonly':''; 
							@endphp
							<textarea name="note" class="form-control" rows="6" style="resize: none;"{{ $read }}>{!! (@$info->remark)?:'-' !!}</textarea>
						</div>
					</div>
				</div>
			</div></span>
	</div>
	<div class="p-2 clearfix" style="height: 300px;">
		<span class="float-left col-md-6 h-100">
			<div class="card h-100">
				<div class="card-header">Basic Earnings</div>
				<div class="card-body">
					<div class="row p-2">
						<div class="col-sm-4 mb15">Basic Salary (BS)</div>
						<div class="col-sm-8 mb15">
							<strong>{!! $info->bs !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Seniority Pay (IS)</div>
						<div class="col-sm-8 mb15">
							<strong>{!! $info->is !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Contract Base (CB)</div>
						<div class="col-sm-8 mb15">
							<strong>{!! $info->cb !!}</strong>
						</div>
					</div>
				</div>
			</div>
		</span> 
		<span class="float-right col-md-6 h-100">
			<div class="card h-100">
				<div class="card-header">Bonus</div>
				<div class="card-body">
					@php
    					$disable = '';
    					
    					if(!$info->isKpiProposer)
    						$disable = 'disabled'
					@endphp
					<div class="row p-2">
						<div class="col-sm-4 mb15">Bonus (BN)</div>
						<div class="col-sm-8 mb15">
							<input class="form-control" step="any" placeholder="0.00" id="bonus" name="bonus" type="number" value="{{ $info->bonus }}" {{ $disable }} >
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">KPI (0.5-1.5)</div>
						<div class="col-sm-8 mb15">
							<input class="form-control" step="any" placeholder="0.00" id="kpi" name="kpi" type="number" value="{!! $info->kpi !!}" {{ $disable }}>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Total (TL)</div>
						<div class="col-sm-8 mb15">
							<input class="form-control" readonly="" placeholder="0.00" id="total_bonus" name="total_bonus" type="text" value="{{ $info->bonus * $info->kpi }}">
						</div>
					</div>
					
					@if($info->isKpiProposer)
					<div class="row p-2">
						<div class="col-sm-4 mb15"></div>
						<div class="col-sm-8 mb15 text-right">
							<button type="submit" class="btn btn-primary" name="saveKpi" value="1">Save</button>
						</div>
					</div>
					@endif
				</div>
			</div>
		</span>
	</div>
	<div class="p-2 clearfix">
		<span class="float-left col-md-6">
			<div class="card">
				<div class="card-header">Additions<br>*Enter number of days or hours to calculate amount.</div>
				<div class="card-body">
					@foreach($payrollTrxAdditionList as $row)
    					@if(in_array($row->name, PayrollHelper::payroll_addition_with_days()))
    					@php
    						$tooltip = '';
    						$days = 0;
    						$amount = 0;
    					
        					if($row->code == 'ALP' && count($annualLeaves) > 0) {
        						foreach($annualLeaves as $al){
        							$tooltip .= 'from '.$al->start_date.' to '.$al->end_date.' ('.$al->applied_days.' day(s))<br>';
        							$days += $al->applied_days;
        						}
        						
        						$amount = ($info->bs >= 2000)? $info->bs / $total_days * $days : $info->bs / 26 * $days;
        						
        					} else if ($row->code == 'CFLP' && count($carryForwardLeaves) > 0) {
        						foreach($carryForwardLeaves as $cfl){
        							$tooltip .= 'from '.$cfl->start_date.' to '.$cfl->end_date.' ('.$cfl->applied_days.' day(s))<br>';
        							$days += $cfl->applied_days;
        						}
        						
        						$amount = ($info->bs >= 2000)? $info->bs / $total_days * $days : $info->bs / 26 * $days;
        					
        					} else if ($row->code == 'PH' && count($ph) > 0) {
        						foreach($ph as $p){
        							$diff = date_diff(date_create($o->clock_in_time), date_create($o->clock_out_time));
        							$tooltip .= 'from '.$p->clock_in_time.' to '.$p->clock_out_time.' ('.$diff->format('%d').' day(s))<br>';
        							$days += $diff->format('%d');
        						}
        						
        						$amount = $info->bs / 26 * 2 * $days;
        					
        					} else if ($row->code == 'RD' && count($rd) > 0) {
        						foreach($rd as $r){
        							$diff = date_diff(date_create($r->clock_in_time), date_create($r->clock_out_time));
        							$tooltip .= 'from '.$r->clock_in_time.' to '.$r->clock_out_time.' ('.$diff->format('%d').' day(s))<br>';
        							$days += $diff->format('%d');
        						}
        						
        						$amount = $info->bs / 26 * $days;
        					
        					} else {
        						$days = $row->days;
        						$amount = $row->amount;
        					}
    					@endphp
    					<div class="row p-2" data-code="{{ $row->code }}" data-statutory="">
    						<div class="col-sm-6 mb15">{{ $row->name }}</div>
    						<div class="col-sm-2 mb15">
    							<input class="form-control additions_days" readonly="" placeholder="0" name="payrolltrxaddition_id_days_{{$loop->iteration}}" type="number" value="{{ $days }}" data-toggle="tooltip" rel="tooltip" title="{{ $tooltip }}">
    						</div>
    						<div class="col-sm-4 mb15">
    							<input class="form-control additions" readonly="" placeholder="0.00" name="payrolltrxaddition_id_{{$loop->iteration}}" type="number" value="{{ $amount }}">
    						</div>
    					</div>
    					@elseif(in_array($row->name, PayrollHelper::payroll_addition_with_hours()))
    					@php
    						$tooltip = '';
    						$hours = 0;
    						$amount = 0;
    					
        					if ($row->code == 'OT' && count($ot) > 0) {
        						foreach($ot as $o){
            						$diff = date_diff(date_create($o->clock_in_time), date_create($o->clock_out_time));
            							
        							$tooltip .= 'from '.$o->clock_in_time.' to '.$o->clock_out_time.' ('.$diff->format('%h').' hour(s))<br>';
        							$hours += $diff->format('%h');
        						}
        						
        						$amount = $info->bs / 26 /8 * 1.5 * $hours; 
        					
        					} else {
        						$hours = $row->hours;
        						$amount = $row->amount;
        					}
    					@endphp
    					<div class="row p-2" data-code="{{ $row->code }}" data-statutory="">
    						<div class="col-sm-6 mb15">{{ $row->name }}</div>
    						<div class="col-sm-2 mb15">
    							<input class="form-control additions_hours" readonly="" placeholder="0" name="payrolltrxaddition_id_hours_{{$loop->iteration}}" type="number" value="{{ $hours }}">
    						</div>
    						<div class="col-sm-4 mb15">
    							<input class="form-control additions" readonly="" placeholder="0.00" name="payrolltrxaddition_id_{{$loop->iteration}}" type="number" value="{{ $amount }}">
    						</div>
    					</div>
    					@else
    					<div class="row p-2" data-code="{{ $row->code }}" data-statutory="">
                        <div class="col-sm-6 mb15">{{ $row->name}}</div>
                                                 
                            <div class="col-sm-6 mb15">
                                <input class="form-control additions" placeholder="0.00" name="payrolltrxaddition_id_{{$loop->iteration}}" type="number" value="{{ $row->amount }}">
                            </div>
                        </div>
    					@endif
					@endforeach
				</div>
			</div></span> <span class="float-right col-md-6"><div class="card">
				<div class="card-header">Deductions<br/>*Enter number of days or hours to calculate amount.</div>
				<div class="card-body">
					@foreach($payrollTrxDeductionList as $row)
    					@if(in_array($row->name, PayrollHelper::payroll_deduction_with_days()))
    					@php
    						$tooltip = '';
    						$days = 0;
    						$amount = 0;
    					
        					if($row->code == 'UL' && count($unpaidLeaves) > 0) {
        						foreach($unpaidLeaves as $ul){
        							$tooltip .= 'from '.$ul->start_date.' to '.$ul->end_date.' ('.$ul->applied_days.' day(s))<br>';
        							$days += $ul->applied_days;
        						}
        						
        						$amount = $info->bs / $total_days * $days;
        					} else {
        						$days = $row->days;
        						$amount = $row->amount;
        					}
    					@endphp
    					<div class="row p-2" data-code="{{ $row->code }}" data-statutory="">
    						<div class="col-sm-6 mb15">{{ $row->name }}</div>
    						<div class="col-sm-2 mb15">
    							<input class="form-control deductions_days" readonly="" placeholder="0" name="payrolltrxdeduction_id_days_{{$loop->iteration}}" type="number" value="{{ $days }}" data-toggle="tooltip" rel="tooltip" title="{{ $tooltip }}">
    						</div>
    						<div class="col-sm-4 mb15">
    							<input class="form-control deductions" readonly="" placeholder="0.00" name="payrolltrxdeduction_id_{{$loop->iteration}}" type="number" value="{{ $amount }}">
    						</div>
    					</div>
    					
    					@else
    					<div class="row p-2" data-code="{{ $row->code }}" data-statutory="">
                        <div class="col-sm-6 mb15">{{ $row->name}}</div>
                                                 
                            <div class="col-sm-6 mb15">
                                <input class="form-control deductions" placeholder="0.00" name="payrolltrxdeduction_id_{{$loop->iteration}}" type="number" value="{{ $row->amount }}">
                            </div>
                                            </div>
    					@endif
					@endforeach
				</div>
			</div></span>
	</div>
	<div class="p-2 clearfix">
		<span class="float-left col-md-6"><div class="card">
				<div class="card-header">Employee Contributions</div>
				<div class="card-body">
					<div class="row p-2">
						<div class="col-sm-4 mb15">Employee EPF</div>
						<div class="col-sm-8 mb15">
							<strong class="contributions">{!! $info->employee_epf !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Employee EIS</div>
						<div class="col-sm-8 mb15">
							<strong class="contributions">{!! $info->employee_eis !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Employee SOCSO</div>
						<div class="col-sm-8 mb15">
							<strong class="contributions">{!! $info->employee_socso !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Employee PCB</div>
						<div class="col-sm-8 mb15">
							<strong class="contributions">{!! $info->employee_pcb !!}</strong>
						</div>
					</div>
				</div>
			</div></span> <span class="float-right col-md-6"><div class="card">
				<div class="card-header">Employer Contributions</div>
				<div class="card-body">
					<div class="row p-2">
						<div class="col-sm-4 mb15">Employer EPF</div>
						<div class="col-sm-8 mb15">
							<strong>{!! $info->employer_epf !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Employer EIS</div>
						<div class="col-sm-8 mb15">
							<strong>{!! $info->employer_eis !!}</strong>
						</div>
					</div>
					<div class="row p-2">
						<div class="col-sm-4 mb15">Employer SOCSO</div>
						<div class="col-sm-8 mb15">
							<strong>{!! $info->employer_socso !!}</strong>
						</div>
					</div>
				</div>
			</div></span>
	</div>
	<div class="p-4">
		<div class="card p-4">
			<div class="card-body">
				<div class="row" id="calculate_result">
                    <div class="col-sm-2" id="gross_pay">
                        <label>Gross Pay</label> <br/>
                        <span style="font-size: 22px;">RM {{ number_format($info->cb + ($info->bonus * $info->kpi), 2, '.', '') }}</span>
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
                        <span style="font-size: 22px;" id="">RM {{ $info->employee_epf + $info->employee_eis + $info->employee_pcb + $info->employee_socso }}</span>
                    </div>
                    <div class="col-sm-2" id="net_pay">
                        <label>Net Pay</label> <br/>
                        <span style="font-size: 22px;" id=""></span>
                    </div>
</div>
			</div>
		</div>
	</div>

@if($info->status == 0)
<div class="row mb15 p-4">
	<div class="col-sm-9"></div>
	<div class="col-sm-3 text-right">
		<button class="btn btn-primary" type="submit" name="save">Save</button>
		<button class="btn btn-success" type="submit" name="save_n_next"
			value="1">Save &amp; Next</button>
	</div>
</div>
@endif
</form>
@section('scripts')
<style>
.tooltip-inner {
    max-width: 350px;
    /* If max-width does not work, try using width instead */
    width: 350px; 
}
</style>
<script type="text/javascript">
        $(document).ready(function() {
        	$('[data-toggle="tooltip"]').tooltip({html:true});
        	
        	$('#kpi, #bonus').on('change keyup', function() {
        		  var kpi = $("#kpi").val();
        		  var bonus = $("#bonus").val();
        		  var total = kpi * bonus;
        		  $("#total_bonus").val(total);
        		});
        
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
//                         calculateContribution();
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
//                         calculateContribution();
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
//                         calculateContribution();
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
                    amount += parseFloat($(this).text());
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
                $('#take_home_pay').val(parseFloat(calculateNetPay()).toFixed(2));
                $('#total_addition').val(parseFloat(calculateAdditions()).toFixed(2));
                $('#total_deduction').val(parseFloat(calculateDeductions()).toFixed(2));
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
@append 
@endsection
