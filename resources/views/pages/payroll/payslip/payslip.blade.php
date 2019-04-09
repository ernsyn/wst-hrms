<!DOCTYPE html>
<html>
<head>
<title>Payslip</title>
<style type="text/css">
body {
	text-transform: uppercase;
	font-size: 12px;
}

.table {
	border-spacing: 0;
	border-collapse: collapse;
	width: 100%;
	max-width: 100%;
	margin-bottom: 20px;
	border-color: black;
}

td {
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	padding: 10px;
}

.bl0 {
	border-left-style: none;
}

.br0 {
	border-right-style: none;
}

.bb0 {
	border-bottom-style: none;
}

.bb1 {
	border-bottom-style: solid;
}

.bt0 {
	border-top-style: none;
}

.line {
	text-decoration: underline;
}

.text-right, .text-right-all td {
	text-align: right;
}

.text-center{
	text-align: center;
}

.text-left td {
	text-align: left;
}
</style>
</head>
<body>
	<table class="table">
		<tbody>
			<tr>
				<td colspan="2" class="br0" width="50%">
					<p>COMP: {{ strtoupper(@$info->company_name) }}</p>
					<p>NAME: {{ strtoupper(@$info->name) }}</p>
					<p>I/C #: {{ @$info->ic_no }}</p>
					<p>GENDER: {{ strtoupper(@$info->gender) }}</p>
				</td>
				<td colspan="2" class="bl0" valign="top" width="50%">
					<p>{{ strtoupper(str_replace(' Month', '', PayrollPeriodEnum::getDescription($info->period)).'-'.DateHelper::dateWithFormat($info->year_month, 'M-Y')) }}</p>
					<p>EMPL#: {{ @$info->code }}</p>
					<p>DEPT#: {{ @$info->employeeBranch }}</p>
				</td>
			</tr>
			<tr>
				<td class="line bt0 bb0">EARNINGS DESCRIPTION</td>
				<td class="line text-right bb0">RM</td>
				<td class="line bb0">DEDUCTIONS DESCRIPTION</td>
				<td class="line text-right bb0">RM</td>
			</tr>

			@for($i = 0; $i < $info->extra_count; $i++)
			<tr>
				@if(@$addition[$i])
				<td class="bt0 bb0">{!! $addition[$i]['name'] !!}</td>
				<td class="text-right bt0 bb0">{!! $addition[$i]['amount'] !!}</td> 
				@else
				<td class="bt0 bb0"></td>
				<td class="bt0 bb0"></td> 
				@endif
				
				@if(@$deduction[$i])
				<td class="bt0 bb0">{!! $deduction[$i]['name'] !!}</td>
				<td class="text-right bt0 bb0">{!! $deduction[$i]['amount'] !!}</td> 
				@else
				<td class="bt0 bb0"></td>
				<td class="bt0 bb0"></td> 
				@endif
			</tr>
			@endfor

			<tr class="bt0">
				<td class="text-right">TOTAL:</td>
				<td class="text-right">{!! $totalEarnings !!}</td>
				<td class="text-right">TOTAL:</td>
				<td class="text-right">{!! $totalDeductions !!}</td>
			</tr>
			<tr>
				<td class="text-right br0"></td>
				<td class="text-right br0 bl0"></td>
				<td class="text-right bl0">NETT PAY:</td>
				<td class="text-right">{!! $nettPay !!}</td>
			</tr>
		</tbody>
	</table>
	<table class="table">
		<tbody>
			<tr>
				<td width="20%" valign="top" class="br0">
					<p>ANNL LEAVE TAKEN:</p>
					<p>SICK LEAVE TAKEN:</p>
				</td>
				<td width="5%" valign="top" class="text-right br0 bl0">
					<p>{{ $info->leave[0]['taken'] }}</p>
					<p>{{ $info->leave[1]['taken'] }}</p>
				</td>
				<td width="10%" class="text-right br0 bl0"></td>
				<td width="10%" valign="top" class="br0 bl0">
					<p>BALANCE:</p>
					<p>BALANCE:</p>
				</td>
				<td width="5%" valign="top" class="text-right br0 bl0">
					<p>{{ $info->leave[0]['balance'] }}</p>
					<p>{{ $info->leave[1]['balance'] }}</p>
				</td>
				<td width="50%">
					<p>EPF#: {{ @$info->epf_no }}</p>
					<p>SOCSO#: {{ @$info->socso_no }}</p>
					<p>TAX#: {{ @$info->tax_no }}</p>
					<p>BANK A/C: {!! @$info->employeeBank !!} {!!
						@$info->employeeBankAccNo !!}</p>
				</td>
			</tr>
		</tbody>
	</table>
	<br />
	<table class="table">
		<tbody>
			<tr>
				<td colspan="5" class="text-center">Current Month</td>
				<td colspan="5" class="text-center">Year-to-Date</td>
			</tr>
			<tr class="text-right-all">
				<td class="br0 bb0"></td>
				<td class="line text-center br0 bl0 bb0">E.P.F</td>
				<td class="line text-center br0 bl0 bb0">SOCSO</td>
				<td class="line text-center br0 bl0 bb0">EIS</td>
				<td class="line text-center br0 bl0 bb0">TAX</td>
				<td class="br0 bb0"></td>
				<td class="line text-center br0 bl0 bb0">E.P.F</td>
				<td class="line text-center br0 bl0 bb0">SOCSO</td>
				<td class="line text-center br0 bl0 bb0">EIS</td>
				<td class="line text-center bl0 bb0">TAX</td>
			</tr>
			<tr>
				<td class="text-left br0 bt0 bb0">EMP'EE:</td>
				<td class="text-right br0 bl0 bt0 bb0">{!! number_format(@$info->employee_epf,2) !!}</td>
				<td class="text-right br0 bl0 bt0 bb0">{!! number_format(@$info->employee_socso,2) !!}</td>
				<td class="text-right br0 bl0 bt0 bb0">{!! number_format(@$info->employee_eis,2) !!}</td>
				<td class="text-right bl0 bt0 bb0">{!! number_format(@$info->employee_pcb,2) !!}</td>
				<td class="text-left br0 bt0 bb0">EMP'EE:</td>
				<td class="text-right br0 bl0 bt0 bb0">{!! number_format(@$employeeContributions->employee_epf_contribution,2) !!}</td>
				<td class="text-right br0 bl0 bt0 bb0">{!! number_format(@$employeeContributions->employee_socso_contribution,2) !!}</td>
				<td class="text-right br0 bl0 bt0 bb0">{!! number_format(@$employeeContributions->employee_eis_contribution,2) !!}</td>
				<td class="text-right bl0 bt0 bb0">{!! number_format(@$employeeContributions->employee_pcb,2) !!}</td>
			</tr>
			<tr>
				<td class="text-left br0 bb0 bt0">EMP'ER:</td>
				<td class="text-right br0 bl0 bb0 bt0">{!! number_format(@$info->employer_epf,2) !!}</td>
				<td class="text-right br0 bl0 bb0 bt0">{!! number_format(@$info->employer_socso,2) !!}</td>
				<td class="text-right br0 bl0 bb0 bt0">{!! number_format(@$info->employer_eis,2) !!}</td>
				<td class="text-right br0 bl0 bb0 bt0"></td>
				<td class="text-left br0 bb0 bt0">EMP'ER:</td>
				<td class="text-right br0 bl0 bb0 bt0">{!! number_format(@$employeeContributions->employer_epf_contribution,2) !!}</td>
				<td class="text-right br0 bl0 bb0 bt0">{!! number_format(@$employeeContributions->employer_socso_contribution,2) !!}</td>
				<td class="text-right br0 bl0 bb0 bt0">{!! number_format(@$employeeContributions->employer_eis_contribution,2) !!}</td>
				<td class="text-right bl0 bt0 bb0"></td>
			</tr>
			<tr>
				<td class="text-left br0 bt0">TOTAL:</td>
				<td class="text-right br0 bl0 bt0">{!! number_format(@$info->employee_epf+@$info->employer_epf,2) !!}</td>
				<td class="text-right br0 bl0 bt0">{!! number_format(@$info->employee_socso+@$info->employer_socso,2) !!}</td>
				<td class="text-right br0 bl0 bt0">{!! number_format(@$info->employee_eis+@$info->employer_eis,2) !!}</td>
				<td class="text-right br0 bl0 bt0"></td>
				<td class="text-left br0 bt0">TOTAL:</td>
				<td class="text-right br0 bl0 bt0">{!! number_format(@$employeeContributions->employee_epf_contribution+@$employeeContributions->employer_epf_contribution,2) !!}</td>
				<td class="text-right br0 bl0 bt0">{!! number_format(@$employeeContributions->employee_socso_contribution+@$employeeContributions->employer_socso_contribution,2) !!}</td>
				<td class="text-right br0 bl0 bt0">{!! number_format(@$employeeContributions->employee_eis_contribution+@$employeeContributions->employer_eis_contribution,2) !!}</td>
				<td class="text-right bl0 bt0"></td>
			</tr>
		</tbody>
	</table>
	<br/>
	<table width="100%" cellspacing="0" cellpadding="0" style="border: none;">
		<tr>
			<td width="50%" style="border: none;">APPROVED BY: ___________________________</td>
			<td width="50%" style="border: none;">RECEIVED BY: ___________________________</td>
		</tr>
	</table>
</body>
</html>