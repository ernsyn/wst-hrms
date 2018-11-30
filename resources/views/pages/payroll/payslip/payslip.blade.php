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
            border: 1px solid;
            padding: 10px;
        }
        .bl0{
            border-left: 0px solid;
        }
        .br0{
            border-right: 0px solid;
        }
        .bb0 td{
            border-bottom: 0px solid;
        }
        .bb1{
            border-bottom: 1px solid;
        }
        .bt0 td{
            border-top: 0px solid;
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
                <td colspan="2" class="br0">
                    <p>COMP: {{ @$info->company_name }}</p>
                    <p>NAME: {{ @$info->name }}</p>
                    <p>I/C #: {{ @$info->ic_no }}</p>
                    <p>SEX: {{ @$info->employee->gender }}</p>
                </td>
                <td colspan="2" class="bl0">
                    <p>{{ strtoupper(str_replace(' month', '', @$info->salary->period)).'-'.@$info->salary->month_name.'-'.@$info->salary->year }}</p>
                    <p>EMPL#: {{ @$info->employee->employee_id }}</p>
                    <p>DEPT#: {{ @$info->employee->branch }}</p>
                </td>
            </tr>
            <tr class="bb0">
                <td class="line">EARNINGS DESCRIPTION</td>
                <td class="line text-right">RM</td>
                <td class="line">DEDUCTION DESCRIPTION</td>
                <td class="line text-right">RM</td>
            </tr>

            @for($i = 0; $i < $info->extra_count; $i++)
                <tr class="bt0 bb0">
                    @if(@$info->addition[$i])
                        <td> {!! $info->addition[$i]->name !!} </td>
                        <td class="text-right"> {!! number_format($info->addition[$i]->amount, 2) !!} </td>
                    @else
                        <td></td>
                        <td></td>
                    @endif
                    @if(@$info->deduction[$i])
                        <td> {!! $info->deduction[$i]->name !!} </td>
                        <td class="text-right"> {!! number_format($info->deduction[$i]->amount, 2) !!}</td>
                    @else
                        <td></td>
                        <td></td>
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
                <td colspan="5" class="text-center bl0 br0">Current Month</td>
                <td colspan="5" class="text-center bl0 br0">Year to Date</td>
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
            <tr class="bt0 bb0 text-right-all">
                <td>Employee:</td>
                <td>{!! number_format(@$info->salary->employee_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_eis,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_pcb,2) !!}</td>
                <td>Employee:</td>
                <td>{!! number_format(@$info->salary->employee_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_eis,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_pcb,2) !!}</td>
            </tr>
            <tr class="bt0 bb0 text-right-all">
                <td>Employer:</td>
                <td>{!! number_format(@$info->salary->employer_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employer_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employer_eis,2) !!}</td>
                <td></td>
                <td>Employer:</td>
                <td>{!! number_format(@$info->salary->employer_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employer_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employer_eis,2) !!}</td>
                <td></td>
            </tr>
            <tr class="bt0 text-right-all">
                <td>Total:</td>
                <td>{!! number_format(@$info->salary->employee_epf+@$info->salary->employer_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_socso+@$info->salary->employer_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_eis+@$info->salary->employer_eis,2) !!}</td>
                <td></td>
                <td>Total:</td>
                <td>{!! number_format(@$info->salary->employee_epf+@$info->salary->employer_epf,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_socso+@$info->salary->employer_socso,2) !!}</td>
                <td>{!! number_format(@$info->salary->employee_eis+@$info->salary->employer_eis,2) !!}</td>
                <td></td>
            </tr>
            <tr class="bt0 bb0">
                <td colspan="8" class="bl0 br0"></td>
            </tr>
            <tr class="bt0 bb0">
                <td colspan="4" class="bl0 br0">APPROVED BY: ___________________________</td>
                <td colspan="4" class="bl0 br0">RECEIVED BY: ___________________________</td>
            </tr>
        </tbody>
    </table>
</body>
</html>