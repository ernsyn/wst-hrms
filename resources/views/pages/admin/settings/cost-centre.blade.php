@extends('layouts.admin-base') 
@section('content')


<div class="p-4">
    <div class="card p-4">
        <div class="card-body">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                    <a role="button" class="btn btn-primary" href="{{ route('admin.settings.cost-centres.add') }}">
                            Add Cost Centre
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right tableTools-container"></div>
                        <table class="table display compact table-striped table-bordered table-hover w-100 text-capitalize" id="setupJobconfigureCostCentreTable">
                            <thead>
                                <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Seniority Pay</th>
                                        <th>Amount</th>
                                        <th>Payroll Type</th>                                   
                                        <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($costs as $cost)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$cost['name']}}</td>
                                        <td>{{$cost['seniority_pay']}}</td>
                                        <td>{{$cost['amount']}}</td>
                                        <td>{{$cost['payroll_type']}}</td>
                
                                        <td>       <a class="btn btn-primary" href="{{ route('admin.settings.cost-centres.edit', ['id' => $cost->id]) }}" role="button">Edit</a>
    
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection