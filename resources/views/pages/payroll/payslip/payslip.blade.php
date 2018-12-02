<!DOCTYPE html>
<html>
<head>
    <title>Pay Slip</title>
    <style type="text/css">
        .table{
            border-spacing: 0;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border-color: black;
        }
        td{
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            padding: 10px;
        }
        .bl0{
            border-left-style: none;
        }
        .br0{
            border-right-style: none;
        }
        .bb0{
            border-bottom-style: none;
        }
        .bb1{
            border-bottom-style: solid;
        }
        .bt0{
            border-top-style: none;
        }
        .line{
            text-decoration: underline;
        }
        .text-right, .text-right-all td{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <table class="table">
        <thead></thead>
        <tbody>
            <tr>
                <td colspan="2" class="br0" width="50%">
                    <p>COMP: {{ @$info->company_name }}</p>
                    <p>NAME: {{ @$info->name }}</p>
                    <p>I/C #: {{ @$info->ic_no }}</p>
                    <p>SEX: {{ strtoupper(@$info->gender) }}</p>
                </td>
                <td colspan="2" class="bl0" valign="top" width="50%">
                    <p>{{ strtoupper(str_replace(' Month', '', PayrollPeriodEnum::getDescription($info->period)).'-'.DateHelper::dateWithFormat($info->year_month, 'M-Y')) }}</p>
                    <p>EMPL#: {{ @$info->employee_code }}</p>
                    <p>DEPT#: {{ @$info->branch }}</p>
                </td>
            </tr>
            <tr>
                <td class="line bt0" style="border-bottom-style:none;">EARNINGS DESCRIPTION</td>
                <td class="line text-right" style="border:none;border-bottom-style:none;">RM</td>
                <td class="line" style="border-bottom-style:none;">DEDUCTION DESCRIPTION</td>
                <td class="line text-right" style="border:none;border-bottom-style:none;">RM</td>
            </tr>
            

            @for($i = 0; $i < $info->extra_count; $i++)
                <tr>
                    @if(@$info->addition[$i])
                        <td class="br0 bt0" style="border:none;"> {!! $info->addition[$i]->name !!} </td>
                        <td class="text-right" style="border:none;"> {!! number_format($info->addition[$i]->amount, 2) !!} </td>
                    @else
                        <td class="br0 bt0" style="border:none;"></td>
                        <td style="border:none;"></td>
                    @endif
                    @if(@$info->deduction[$i])
                        <td class="br0 bt0" style="border:none;"> {!! $info->deduction[$i]->name !!} </td>
                        <td class="text-right" style="border:none;"> {!! number_format($info->deduction[$i]->amount, 2) !!}</td>
                    @else
                        <td class="br0 bt0" style="border:none;"></td>
                        <td style="border:none;"></td>
                    @endif
                </tr>
            @endfor

            <tr class="bt0">
                <td class="text-right">TOTAL:</td>
                <td class="text-right">{!! number_format(@$info->salary->contract_base+@$info->salary->total_bonus+@$info->salary->total_addition,2) !!}</td>
                <td class="text-right">TOTAL:</td>
                <td class="text-right">{!! number_format(@$info->salary->total_deduction+@$info->salary->employee_epf+@$info->salary->employee_socso+@$info->salary->employee_eis+@$info->salary->employee_pcb,2) !!}</td>
            </tr>
            <tr>
                @for($y = 0; $y < $info->leave_count; $y++)
                    @php $class = ($y+1 == $info->leave_count)? 'bb1' : 'bb0'; @endphp
                    <tr class="bt0 {{$class}}">
                        @if(@$info->leave[$y])
                            <td class="br0">{!! strtoupper($info->leave[$y]->name) !!}: {!! $info->leave[$y]->total_days !!}</td>
                            <td class="bl0">BALANCE: {!! $info->leave[$y]->start_balance-$info->leave[$y]->total_days !!}</td>
                        @else
                            <td class="br0"></td>
                            <td class="bl0"></td>
                        @endif

                        @if($y == 0)
                            <td class="text-right">NETT PAY:</td>
                            <td class="text-right" style="border-bottom: 1px solid">{!! (@$info->salary->final_payment > 0)? number_format(@$info->salary->final_payment,2) : number_format(@$info->salary->contract_base+@$info->salary->total_bonus+@$info->salary->total_addition-(@$info->salary->total_deduction+@$info->salary->employee_epf+@$info->salary->employee_socso+@$info->salary->employee_eis+@$info->salary->employee_pcb),2) !!}</td>
                        @elseif($y == 1)
                            <td colspan="2">
                                <p>EPF#: {{ @$info->employee->epf_no }}</p>
                                <p>SOCSO#: {{ @$info->employee->socso_no }}</p>
                                <p>TAX#: {{ @$info->employee->tax_no }}</p>
                                <p>BANK A/C: {!! @$info->salary->account_number !!}</p>
                            </td>
                        @else
                            <td colspan="2"></td>
                        @endif
                    </tr>
                @endfor

            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead></thead>
        <tbody>
            <tr class="bt0">
                <td colspan="5" class="text-center bl0 br0 bt0">Current Month</td>
                <td colspan="5" class="text-center bl0 br0 bt0">Year to Date</td>
            </tr>
            <tr class="bt0 bb0 text-right-all">
                <td></td>
                <td class="line">E.P.F</td>
                <td class="line">SOCSO</td>
                <td class="line">EIS</td>
                <td class="line">TAX</td>
                <td></td>
                <td class="line">E.P.F</td>
                <td class="line">SOCSO</td>
                <td class="line">EIS</td>
                <td class="line">TAX</td>
            </tr>
            <tr class="bt0 bb0 text-right-all"  style="border-bottom: 0px solid;">
                <td align="left">Employee:</td>
                <td>{!! number_format(@$info->salary->employee_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_eis,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_pcb,2) !!}</td>
                <td align="left">Employee:</td>
                <td>{!! number_format(@$info->salary->employee_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_eis,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_pcb,2) !!}</td>
            </tr>
            <tr class="bt0 bb0 text-right-all"  style="border-bottom: 0px solid;">
                <td align="left">Employer:</td>
                <td>{!! number_format(@$info->salary->employer_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employer_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employer_eis,2) !!}</td>
                <td></td>
                <td align="left">Employer:</td>
                <td>{!! number_format(@$info->salary->employer_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employer_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employer_eis,2) !!}</td>
                <td></td>
            </tr>
            <tr class="bt0 text-right-all" style="border-bottom: 0px solid;">
                <td align="left">Total:</td>
                <td>{!! number_format(@$info->salary->employee_epf+@$info->salary->employer_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_socso+@$info->salary->employer_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_eis+@$info->salary->employer_eis,2) !!}</td>
                <td></td>
                <td align="left">Total:</td>
                <td>{!! number_format(@$info->salary->employee_epf+@$info->salary->employer_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_socso+@$info->salary->employer_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_eis+@$info->salary->employer_eis,2) !!}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" style="border: none;">
    	<tr>
            <td width="50%" style="border: none;">APPROVED BY: ___________________________</td>
            <td width="50%" style="border: none;">RECEIVED BY: ___________________________</td>
        </tr>
    </table>
</body>
</html>