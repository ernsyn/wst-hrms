@extends('layouts.base') 
@section('pageTitle', 'Payroll')
@section('content')
<div class="p-4">
	<div class="card p-4">
		<div class="card-body">
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive table-bordered" style="border-radius: 10px 10px 0px 0px;">
            <table class="table" style="margin-bottom: 0px !important;">
                <thead>
                    <th colspan="5" class="col-bg-color col-border-right th-color">{{ strtoupper('basic information') }}</th>
                    <th colspan="3" class="col-bg-color col-border-right th-color">{{ strtoupper('basic earning') }}</th>
                    <th class="col-bg-color col-border-right th-color">{{ strtoupper('additions') }}</th>
                    <th class="col-bg-color col-border-right th-color">{{ strtoupper('deductions') }}</th>
                    <th class="col-bg-color col-border-right th-color"></th>
                    <th class="col-bg-color col-border-right th-color"></th>
                    <th class="col-bg-color th-color"></th>
                </thead>
                <tbody>
                    <tr>
                        <th>No</th>
                        <th>S-ID</th>
                        <th>NM</th>
                        <th>PS</th>
                        <th class="col-border-right">ED</th>
                        <th>CB</th>
                        <th>BS</th>
                        <th class="col-border-right">IS</th>
                        <th class="col-border-right">Total</th>
                        <th class="col-border-right">Total</th>
                        <th class="col-border-right">THP</th>
                        <th class="col-border-right">Remark</th>
                        <th>Action</th>
                    </tr>
                    @if (count($list))
                        @foreach ($list as $key => $info)
                            <tr>
                                <td>{{ $list->firstItem()+$key }}</td>
                                <td>{!! $info->employee_code !!}</td>
                                <td>{!! $info->full_name !!}</td>
                                <td>{!! $info->position !!}</td>
                                <td class="col-border-right">{!! $info->joined_date !!}</td>
                                <td>{!! $info->cb !!}</td>
                                <td>{!! $info->bs !!}</td>
                                <td class="col-border-right">{!! $info->is !!}</td>
                                <td class="col-border-right">{!! $info->total_addition !!}</td>
                                <td class="col-border-right">{!! $info->total_deduction !!}</td>
                                <td class="col-border-right">{!! $info->thp !!}</td>
                                <td class="col-border-right">{!! (@$info->remark)? : '-' !!}</td>
                                <td>
                                    <a href="{{ route('payroll.trx.show', ['id'=>$info->id, 'payroll_type'=>Request::get('payroll_type')]) }}" class="btn btn-primary btn-circle" data-lity><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <!-- **+2 is because of no. and action -->
                            <td colspan="{!! count($forms)+2 !!}"><em>No record found</em></td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="text-center">{!! $list->render() !!}</div>
        </div>
    </div>
</div>
</div></div></div>
@endsection