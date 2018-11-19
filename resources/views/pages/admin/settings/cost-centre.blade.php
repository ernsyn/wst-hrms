@extends('layouts.admin-base') 
@section('content')

<!-- ADD -->
<div class="modal fade" id="addCostCentrePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Cost Centre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.settings.cost-centre.add.post') }}" id="form_validate" data-parsley-validate>
                    @csrf
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">Name*</label>
                                <div class="col-md-12">
                                    <input id="category_name" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" placeholder="Name here"
                                        name="category_name" value="{{ old('category_name') }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">Seniority Pay*</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="seniority_pay" name="seniority_pay">
                                        <option value="Auto">Auto</option>
                                        <option value="Manual">Manual</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-12">
                                <label class="col-md-12 col-form-label">Payroll Type*</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="payroll_type" name="payroll_type">
                                        <option value="Regional">Regional</option>
                                        <option value="HQ">HQ</option>
                                        <option value="HQ with travel allowance">HQ with travel allowance</option>                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- UPDATE -->
<div class="modal fade" id="updateCostCentrePopup" tabindex="-1" role="dialog" aria-labelledby="updateCostCentreLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCostCentreLabel">Edit Cost Centre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.settings.cost-centre.edit.post') }}" id="edit_cost_centre">
                    @csrf
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <div class="col-6">
                                <input id="cost_id" name="cost_id" type="text" hidden>
                                <label class="col-md-12 col-form-label">Name*</label>
                                <div class="col-md-12">
                                    <input class="form-control" id="category_name" name="category_name" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-md-12 col-form-label">Seniority Pay*</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="seniority_pay" name="seniority_pay">
                                        <option value="auto">Auto</option>
                                        <option value="manual">Manual</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row w-100">
                            <div class="col-12">
                                <label class="col-md-12 col-form-label">Payroll Type*</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="payroll_type" name="payroll_type">
                                        <option value="Regional">Regional</option>
                                        <option value="HQ">HQ</option>
                                        <option value="HQ with travel allowance">HQ with travel allowance</option>                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="p-4">
    <div class="card p-4">
        <div class="card-body">
            <div class="row pb-3">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#addCostCentrePopup">
                            Add Cost Centre
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
                                    @foreach($costs as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$row['name']}}</td>
                                        <td>{{$row['seniority_pay']}}</td>
                                        <td>{{$row['amount']}}</td>
                                        <td>{{$row['payroll_type']}}</td>
                
                                        <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                            data-cost-centre-id="{{$row['id']}}"
                                            data-cost-centre-name="{{$row['name']}}"
                                            data-cost-centre-seniority-pay="{{$row['seniority_pay']}}"
                                            data-cost-centre-payroll-type="{{$row['payroll_type']}}"
                                            data-target="#updateCostCentrePopup">EDIT</button></td>
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