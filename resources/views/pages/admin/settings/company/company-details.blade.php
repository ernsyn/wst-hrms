@extends('layouts.admin-base')
@section('pageTitle', 'Job Configure')
@section('content')
<div class="container">
    {{-- @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach --}}
    <div class="p-4">
        @if (session('status'))
        <div class="alert alert-primary fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @endif
        <div class="card py-4">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <nav class="col-sm-12">
                            <div class="nav nav-tabs font-weight-bold" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-bank-tab" data-toggle="tab" href="#nav-bank" role="tab" aria-controls="nav-bank"
                                    aria-selected="false">Company Bank</a>
                                <a class="nav-item nav-link" id="nav-security-tab" data-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security"
                                    aria-selected="true">Security Group</a>
                                <a class="nav-item nav-link" id="nav-travel-tab" data-toggle="tab" href="#nav-travel" role="tab" aria-controls="nav-travel"
                                    aria-selected="true">
                                    Travel Allowance</a>
                                <a class="nav-item nav-link" id="nav-addition-tab" data-toggle="tab" href="#nav-addition" role="tab" aria-controls="nav-addition"
                                    aria-selected="true">Addition</a>
                                <a class="nav-item nav-link" id="nav-deduction-tab" data-toggle="tab" href="#nav-deduction" role="tab" aria-controls="nav-deduction"
                                    aria-selected="true">Deduction</a>
                            </div>
                        </nav>

                        {{-- TABLES --}}
                        <div class="tab-content col-sm-12 text-justify pt-4" id="nav-tabContent">
                            {{-- Company Bank --}}
                            <div class="tab-pane fade show active" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
                                <div class="row pb-3">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#addCompanyBankPopup">
                                            Add Company Bank
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right tableTools-container"></div>
                                        <table class="hrms-data-table compact w-100 t-2" id="company-banks-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Company Name</th>
                                                    <th>Account Name</th>
                                                    <th>Bank Code</th>
                                                    <th>Created At</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($bank as $companybanks)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$companybanks->company->name}}</td>
                                                    <td>{{$companybanks['account_name']}}</td>
                                                    <td>{{$companybanks['bank_code']}}</td>
                                                    <td>{{$companybanks['created_at']}}</td>
                                                    <td>{{$companybanks['status']}}</td>

                                                    <td><button type="button" class="btn btn-outline-primary waves-effect"
                                                            data-toggle="modal" data-bank-id="{{$companybanks['id']}}" data-bank-code="{{$companybanks['bank_code']}}"
                                                            data-bank-accout-name="{{$companybanks['account_name']}}" data-bank-status="{{$companybanks['status']}}"
                                                            data-target="#editCompanyBankPopup"><i class="fas fa-pencil-alt"></i></button>

                                                        <button type='submit' data-toggle="modal" data-target="#confirm-delete-modal" data-entry-title='{{ $companybanks->account_name }}' data-link='{{ route('admin.settings.company-banks.delete', ['id ' => $companybanks->id]) }}' class="round-btn btn btn-default fas fa-trash-alt btn-segment"></button>

                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            {{-- Security Group --}}
                            <div class="tab-pane fade" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
                                <div class="row pb-3">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#addSecurityGroupPopup">
                                                        Add Security Group
                                                    </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right tableTools-container"></div>
                                        <table class="hrms-data-table compact w-100 t-2" id="security-groups-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Company Name</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($security as $securities)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$securities->company->name}}</td>
                                                    <td>{{$securities['name']}}</td>
                                                    <td>{{$securities['description']}}</td>
                                                    <td><button type="button" class="btn btn-outline-primary waves-effect"
                                                            data-toggle="modal" data-security-id="{{$securities['id']}}"
                                                            data-security-name="{{$securities['name']}}" data-security-description="{{$securities['description']}}"
                                                            data-security-status="{{$securities['status']}}" data-target="#editSecurityGroupPopup"><i class="fas fa-pencil-alt"></i></button></td>


                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            {{--ADDITION--}}
                            <div class="tab-pane fade" id="nav-addition" role="tabpanel" aria-labelledby="nav-addition-tab">
                                <div class="row pb-3">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#addCompanyAdditionPopup">
                                                        Add Company Addition
                                                    </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right tableTools-container"></div>
                                        <table class="hrms-data-table compact w-100 t-2" id="additions-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($additions as $additions)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$additions['code']}}</td>
                                                    <td>{{$additions['name']}}</td>
                                                    <td>{{$additions['amount']}}</td>
                                                    <td><button type="button" class="btn btn-outline-primary waves-effect"
                                                            data-toggle="modal" data-addition-id="{{$additions['id']}}" data-addition-code="{{$additions['code']}}"
                                                            data-addition-accout-name="{{$additions['name']}}" data-addition-status="{{$additions['status']}}"
                                                            data-target="#editCompanyAdditionPopup"><i class="fas fa-pencil-alt"></i></button></td>


                                                </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            {{-- DEDUCTION --}}
                            <div class="tab-pane fade" id="nav-deduction" role="tabpanel" aria-labelledby="nav-deduction-tab">
                                <div class="row pb-3">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#addDeductionPopup">
                                        Add Company Deduction
                                    </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right tableTools-container"></div>
                                        <table class="hrms-data-table compact w-100 t-2" id="deductions-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($deductions as $deductions)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$deductions['code']}}</td>
                                                    <td>{{$deductions['name']}}</td>
                                                    <td>{{$deductions['amount']}}</td>
                                                    <td><button type="button" class="btn btn-outline-primary waves-effect"
                                                            data-toggle="modal" data-deduction-id="{{$deductions['id']}}"
                                                            data-deduction-code="{{$deductions['code']}}" data-deduction-name="{{$deductions['name']}}"
                                                            data-deduction-type="{{$deductions['type']}}" data-deduction-amount="{{$deductions['amount']}}"
                                                            data-deduction-confirmed_employee="{{$deductions['confirmed_employee']}}"
                                                            data-deduction-status="{{$deductions['status']}}" data-target="#editCompanyDeductionPopup"><i class="fas fa-pencil-alt"></i></button></td>


                                                </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>


                            {{-- TRAVEL ALLOWANCE --}}
                            <div class="tab-pane fade" id="nav-travel" role="tabpanel" aria-labelledby="nav-travel-tab">
                                <div class="row pb-3">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#addTravelPopup">
                                                Add Company Travel Allowance
                                            </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right tableTools-container"></div>
                                        <table class="hrms-data-table compact w-100 t-2" id="travel-allowance-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($company_travel_allowance as $company_travel_allowances)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$company_travel_allowances['company_id']}}</td>
                                                    <td>{{$company_travel_allowances['rate']}}</td>
                                                    <td>{{$company_travel_allowances['code']}}</td>
                                                    <td><button type="button" class="btn btn-outline-primary waves-effect"
                                                            data-toggle="modal" data-travel-id="{{$company_travel_allowances['id']}}"
                                                            data-travel-code="{{$company_travel_allowances['code']}}" data-travel-rate="{{$company_travel_allowances['rate']}}"
                                                            data-travel-status="{{$company_travel_allowances['status']}}"
                                                            data-target="#editTravelPopup"><i class="fas fa-pencil-alt"></i></button></td>


                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            {{-- ADDITION --}} {{--
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ADD COMPANY BANK -->
<div class="modal fade" id="addCompanyBankPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @foreach($bank as $banks)
            <form method="POST" action="{{ route('admin.settings.company-banks.add.post', ['id' => $banks->company_id ])}} " id="form_validate">
                @endforeach
                <div class="modal-body">
                    @csrf
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Account Bank Name*</label>
                            <div class="col-md-12">
                                <select class="form-control{{ $errors->has('bank_code') ? ' is-invalid' : '' }}" name="bank_code" id="bank_code" required>
                                <option value="">Please Select</option>
                                @foreach(App\BankCode::all() as $banks)
                                <option value="{{ $banks->bank_code }}">{{ $banks->name }}</option>
                                @endforeach
                            </select> @if ($errors->has('bank_code'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bank_code') }}</strong>
                            </span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="form-group row w-100">
                            <label class="col-md-12 col-form-label">Account Name*</label>
                            <div class="col-md-12">
                                <input id="account_name" type="text" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" name="account_name"
                                    value="{{ old('account_name') }}" required> @if ($errors->has('account_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('account_name') }}</strong>
                                </span> @endif
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

<!-- UPDATE COMPANY BANK -->
<div class="modal fade" id="editCompanyBankPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Company Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @foreach($bank as $banks)
                <form method="POST" action="{{route('admin.settings.company-banks.edit.post', ['id' => $banks->company_id ])}}"
                    id="edit_company_bank">
                    @endforeach @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <div class="col-md-12">
                                <input id="company_bank_id" type="text" class="form-control{{ $errors->has('company_bank_id') ? ' is-invalid' : '' }}" name="company_bank_id"
                                    value="{{ old('company_bank_id') }}" readonly>
                            </div>
                            <label class="col-md-12 col-form-label">Account Name*</label>
                            <div class="col-md-12">
                                <input id="account_name" type="text" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" name="account_name"
                                    value="" required>
                            </div>
                            <label class="col-md-12 col-form-label">Bank*</label>
                            <div class="col-md-12">
                                <select class="form-control{{ $errors->has('bank_code') ? ' is-invalid' : '' }}" name="bank_code" id="bank_code" value="{{ old('bank_code') }}">
                                    @foreach(App\BankCode::all() as $banks)
                                    <option value="{{ $banks->bank_code }}">{{ $banks->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-md-12 col-form-label">Status*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="status" name="status" value="{{ old('status') }}">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
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
<!-- DELETE COMPANY BANK -->
<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- ADD SECURITY GROUP -->
<div class="modal fade" id="addSecurityGroupPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Security Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @foreach($company as $company_security_group)
                <form method="POST" action="{{ route('admin.settings.security-groups.add.post', ['id' => $company_security_group->id])}} "
                    id="add_company_bank">
                    @endforeach @csrf @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-12 col-form-label">Security Group Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Description*</label>
                            <div class="col-md-10">
                                <textarea name="description" class="form-control"></textarea>
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

<!-- UPDATE SECURITY GROUP -->
<div class="modal fade" id="editSecurityGroupPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Security Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{route('admin.settings.security-groups.edit.post')}}" id="security_group">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="security_group_id" name="security_group_id" type="hidden">
                            <label class="col-md-12 col-form-label">Security Group Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Description*</label>
                            <div class="col-md-10">
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"
                                    value="{{ old('description') }}" required>
                            </div>
                            <label class="col-md-12 col-form-label">Status*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
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

<!-- ADD COMPANY ADDITION -->
<div class="modal fade" id="addCompanyAdditionPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                @foreach($company as $company_deduction)
                <form method="POST" action="{{ route('admin.settings.additions.add.post', ['id' => $company_deduction->id])}} " id="add_company_addition">
                    @endforeach @csrf

                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-12 col-form-label">Code*</label>
                            <div class="col-md-12">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Type*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="type" name="type">
                                            <option value="Fixed">Fixed</option>
                                            <option value="Custom">Custom</option>
                                        </select>
                            </div>
                            <label class="col-md-12 col-form-label">Amount</label>
                            <div class="col-md-12">
                                <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Status*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="status" name="status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                            </div>
                            <label class="col-md-12 col-form-label">Statutory</label>
                            <div class="checkbox col-md-12">
                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox1" name="statutory[]" value="PCB"> PCB
                                            </label>
                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox2" name="statutory[]" value="EPF"> EPF
                                            </label>
                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" name="statutory[]" value="SOCSO"> SOCSO
                                            </label>
                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox4" name="statutory[]" value="EIS"> EIS
                                            </label>
                            </div>
                            <label class="col-md-12 col-form-label">Applies To</label>
                            <div class="checkbox col-md-12">
                                <label class="checkbox-inline">
                                            <input type="checkbox" id="check_cost_centre" name="applies[]" value="PCB"> Cost Centre
                                        </label>
                                <label class="checkbox-inline">
                                            <input type="checkbox" id="check_job_grade" name="applies[]" value="EPF"> Job Grade
                                        </label>
                                <label class="checkbox-inline">
                                            <input type="checkbox" id="check_comfirmed_employee" name="applies[]" value="SOCSO"> Confirmed Employee
                                        </label>
                            </div>
                            <label class="col-md-12 col-form-label">Cost Centre</label>
                            <div class="col-md-12">


                                <div class="col-md-12">
                                    <select multiple class="tagsinput form-control{{ $errors->has('cost_centres') ? ' is-invalid' : '' }}" id="cost_centre" name="cost_centres"
                                        required disabled>
                                                @foreach(App\CostCentre::all() as $cost_centre)
                                                <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                                @endforeach
                                            </select> @if ($errors->has('cost_centres'))
                                    <span class="invalid-feedback" role="alert">
                                                                      <strong>{{ $errors->first('cost_centres') }}</strong>
                                                                  </span> @endif
                                    </select>

                                </div>
                            </div>
                            <label class="col-md-12 col-form-label">Job Grade</label>
                            <div class="col-md-12">
                                <select multiple class="tagsinput form-control{{ $errors->has('job_grade') ? ' is-invalid' : '' }}" id="job_grade" name="job_grade[]"
                                    required disabled>
                                                                      @foreach(App\EmployeeGrade::all() as $grade)
                                                                      <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                      @endforeach
                                                                  </select> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $errors->first('name') }}</strong>
                                                                                        </span>                                @endif



                                </select>
                            </div>
                            {{--
                            <div class="form-group">
                                <label>Enter your Skill</label>
                                <input type="typeahead" name="tags" id="tags" data-role="tagsinput" style="background-color:pink" class="form-control" />
                            </div> --}}
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
<!-- UPDATE COMPANY ADDITION -->
<div class="modal fade" id="editCompanyAdditionPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Security Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.settings.company-addition.edit.post')}}" id="addition">
                        @csrf
                        <div class="row pb-5">
                            <div class="col-xl-8">
                                <input id="company_addition_id" name="company_addition_id" type="hidden">
                                <label class="col-md-12 col-form-label">Code*</label>
                                <div class="col-md-12">
                                    <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}"
                                        required>
                                </div>
                                <label class="col-md-12 col-form-label">Name*</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                        required>
                                </div>
                                <label class="col-md-12 col-form-label">Type*</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="type" name="type">
                                    <option value="Fixed">Fixed</option>
                                    <option value="Custom">Custom</option>
                                </select>
                                </div>
                                <label class="col-md-12 col-form-label">Amount</label>
                                <div class="col-md-12">
                                    <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}"
                                        required>
                                </div>
                                <label class="col-md-12 col-form-label">Status*</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                                </div>
                                <label class="col-md-12 col-form-label">Statutory</label>
                                <div class="checkbox col-md-12">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox1" name="statutory[]" value="PCB"> PCB
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox2" name="statutory[]" value="EPF"> EPF
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox3" name="statutory[]" value="SOCSO"> SOCSO
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox4" name="statutory[]" value="EIS"> EIS
                                    </label>
                                </div>
                                <label class="col-md-12 col-form-label">EA Form*</label>
                                <div class="col-md-12">
                                    <select class="form-control{{ $errors->has('ea_form') ? ' is-invalid' : '' }}" name="ea_form" id="ea_form">
                                    @foreach($ea_form as $item)
                                    <option value="{{ $item->id }}">{{ $item->code }}: {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <label class="col-md-12 col-form-label">Applies To</label>
                                <div class="checkbox col-md-12">
                                    <label class="checkbox-inline">
                                    <input type="checkbox" id="check_cost_centre_a" name="applies[]" value="PCB"> Cost Centre
                                </label>
                                    <label class="checkbox-inline">
                                    <input type="checkbox" id="check_job_grade_a" name="applies[]" value="EPF"> Job Grade
                                </label>
                                    <label class="checkbox-inline">
                                    <input type="checkbox" id="check_comfirmed_employee" name="applies[]" value="SOCSO"> Confirmed Employee
                                </label>
                                </div>
                                <label class="col-md-12 col-form-label">Cost Centre</label>
                                <div class="col-md-12">
                                    <select multiple class="tagsinput form-control{{ $errors->has('cost_centres') ? ' is-invalid' : '' }}" id="cost_centre_a"
                                        name="cost_centres" required disabled>
                                        @foreach(App\CostCentre::all() as $cost_centre)
                                        <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                        @endforeach
                                    </select> @if ($errors->has('cost_centres'))
                                    <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $errors->first('cost_centres') }}</strong>
                                                          </span> @endif
                                    </select>

                                </div>
                            </div>
                            <label class="col-md-12 col-form-label">Job Grade</label>
                            <div class="col-md-12">
                                <select multiple class="tagsinput form-control{{ $errors->has('job_grade') ? ' is-invalid' : '' }}" id="job_grade_a" name="job_grade[]"
                                    required disabled>
                                                              @foreach(App\EmployeeGrade::all() as $grade)
                                                              <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                              @endforeach
                                                          </select> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                                </span> @endif



                                </select>
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
<!-- ADD COMPANY DEDUCTION -->
<div class="modal fade" id="addDeductionPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                @foreach($company as $company_deduction)
                <form method="POST" action="{{ route('admin.settings.deductions.add.post', ['id' => $company_deduction->id])}} " id="add_company_deduction">
                    @endforeach @csrf

                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-12 col-form-label">Code*</label>
                            <div class="col-md-12">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Type*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="type" name="type">
                                            <option value="Fixed">Fixed</option>
                                            <option value="Custom">Custom</option>
                                        </select>
                            </div>
                            <label class="col-md-12 col-form-label">Amount</label>
                            <div class="col-md-12">
                                <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Status*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="status" name="status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                            </div>
                            <label class="col-md-12 col-form-label">Statutory</label>
                            <div class="checkbox col-md-12">
                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox1" name="statutory[]" value="PCB"> PCB
                                            </label>
                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox2" name="statutory[]" value="EPF"> EPF
                                            </label>
                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" name="statutory[]" value="SOCSO"> SOCSO
                                            </label>
                                <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox4" name="statutory[]" value="EIS"> EIS
                                            </label>
                            </div>
                            <label class="col-md-12 col-form-label">Applies To</label>
                            <div class="checkbox col-md-12">
                                <label class="checkbox-inline">
                                            <input type="checkbox" id="check_cost_centre_d" name="applies[]" value="PCB"> Cost Centre
                                        </label>
                                <label class="checkbox-inline">
                                            <input type="checkbox" id="check_job_grade_d" name="applies[]" value="EPF"> Job Grade
                                        </label>
                                <label class="checkbox-inline">
                                            <input type="checkbox" id="check_comfirmed_employee" name="applies[]" value="SOCSO"> Confirmed Employee
                                        </label>
                            </div>
                            <label class="col-md-12 col-form-label">Cost Centre</label>
                            <div class="col-md-12">


                                <div class="col-md-12">
                                    <select multiple class="tagsinput form-control{{ $errors->has('cost_centres') ? ' is-invalid' : '' }}" id="cost_centre_d"
                                        name="cost_centres" required disabled>
                                                @foreach(App\CostCentre::all() as $cost_centre)
                                                <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                                @endforeach
                                            </select> @if ($errors->has('cost_centres'))
                                    <span class="invalid-feedback" role="alert">
                                                                      <strong>{{ $errors->first('cost_centres') }}</strong>
                                                                  </span> @endif
                                    </select>

                                </div>
                            </div>
                            <label class="col-md-12 col-form-label">Job Grade</label>
                            <div class="col-md-12">
                                <select multiple class="tagsinput form-control{{ $errors->has('job_grade') ? ' is-invalid' : '' }}" id="job_grade_d" name="job_grade[]"
                                    required disabled>
                                                                      @foreach(App\EmployeeGrade::all() as $grade)
                                                                      <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                                      @endforeach
                                                                  </select> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $errors->first('name') }}</strong>
                                                                                        </span>                                @endif



                                </select>
                            </div>
                            {{--
                            <div class="form-group">
                                <label>Enter your Skill</label>
                                <input type="typeahead" name="tags" id="tags" data-role="tagsinput" style="background-color:pink" class="form-control" />
                            </div> --}}
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

<!-- UPDATE COMPANY DEDUCTION -->
<div class="modal fade" id="editCompanyDeductionPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Company Deduction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('admin.settings.company-deduction.edit.post')}}" id="deduction">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="company_deduction_id" name="company_deduction_id" type="hidden">
                            <label class="col-md-12 col-form-label">Code*</label>
                            <div class="col-md-12">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Type*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="type" name="type">
                                        <option value="Fixed">Fixed</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                            </div>
                            <label class="col-md-12 col-form-label">Amount</label>
                            <div class="col-md-12">
                                <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Status*</label>
                            <div class="col-md-12">
                                <select class="form-control" id="status" name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                            </div>
                            <label class="col-md-12 col-form-label">Statutory</label>
                            <div class="checkbox col-md-12">
                                <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox1" name="statutory[]" value="PCB"> PCB
                                        </label>
                                <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox2" name="statutory[]" value="EPF"> EPF
                                        </label>
                                <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox3" name="statutory[]" value="SOCSO"> SOCSO
                                        </label>
                                <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox4" name="statutory[]" value="EIS"> EIS
                                        </label>
                            </div>
                            <label class="col-md-12 col-form-label">Applies To</label>
                            <div class="checkbox col-md-12">
                                <label class="checkbox-inline">
                                        <input type="checkbox" id="check_cost_centre_de" name="applies[]" value="PCB"> Cost Centre
                                    </label>
                                <label class="checkbox-inline">
                                        <input type="checkbox" id="check_job_grade_de" name="applies[]" value="EPF"> Job Grade
                                    </label>
                                <label class="checkbox-inline">
                                        <input type="checkbox" id="check_comfirmed_employee" name="applies[]" value="SOCSO"> Confirmed Employee
                                    </label>
                            </div>
                            <label class="col-md-12 col-form-label">Cost Centre</label>
                            <div class="col-md-12">
                                <select multiple class="tagsinput form-control{{ $errors->has('cost_centres') ? ' is-invalid' : '' }}" id="cost_centre_a"
                                    name="cost_centres" required disabled>
                                        @foreach(App\CostCentre::all() as $cost_centre)
                                        <option value="{{ $cost_centre->id }}">{{ $cost_centre->name }}</option>
                                        @endforeach
                                    </select> @if ($errors->has('cost_centres'))
                                <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $errors->first('cost_centres') }}</strong>
                                                          </span> @endif
                                </select>

                            </div>
                        </div>
                        <label class="col-md-12 col-form-label">Job Grade</label>
                        <div class="col-md-12">
                            <select multiple class="tagsinput form-control{{ $errors->has('job_grade') ? ' is-invalid' : '' }}" id="job_grade_a" name="job_grade[]"
                                required disabled>
                                                              @foreach(App\EmployeeGrade::all() as $grade)
                                                              <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                              @endforeach
                                                          </select> @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                                </span> @endif



                            </select>
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

<!-- ADD TRAVEL ALLOWANCE -->
<div class="modal fade" id="addTravelPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Travel Allowance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">

                @foreach($company as $company_travel)
                <form method="POST" action="{{ route('admin.settings.company-travel-allowance.add.post', ['id' => $company_travel->id])}} "
                    id="add_company_bank">
                    @endforeach @csrf @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-12 col-form-label">Security Group Name*</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Description*</label>
                            <div class="col-md-10">
                                <textarea name="description" class="form-control"></textarea>
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
<!-- UPDATE TRAVEL ALLOWANCE  -->
<div class="modal fade" id="editTravelPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Travel Allowance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('admin.settings.travel-allowance.edit.post')}}" id="travel_allowance">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="travel_id" name="travel_id" type="hidden">
                            <label class="col-md-12 col-form-label">Code*</label>
                            <div class="col-md-12">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Name*</label>
                            <div class="col-md-12">
                                <input id="rate" type="text" class="form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}" name="rate" value="{{ old('rate') }}"
                                    required>
                            </div>
                            <label class="col-md-12 col-form-label">Type*</label>
                            <div class="col-md-12">
                                {{-- <select class="form-control" id="type" name="type">
                                        <option value="Fixed">Fixed</option>
                                        <option value="Custom">Custom</option>
                                    </select> --}}
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
@endsection


@section('scripts')
<script>
    $('#company-banks-table').DataTable({
        responsive: true,
        stateSave: true,
        dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
        <'row'<'col-md-6'><'col-md-6'>>
        <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
        buttons: [{
                extend: 'copy',
                text: '<i class="fas fa-copy "></i>',
                // text: '<i class="fas fa-copy "></i>',
                className: 'btn-segment',
                titleAttr: 'Copy'
            },
            {
                extend: 'colvis',
                text: '<i class="fas fa-search "></i>',
                className: 'btn-segment',
                titleAttr: 'Show/Hide Column'
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-alt "></i>',
                className: 'btn-segment',
                titleAttr: 'Export CSV'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print "></i>',
                className: 'btn-segment',
                titleAttr: 'Print'
            },
        ]

    });

    $('#confirm-delete-modal').on('show.bs.modal', function (e) {
        var entryTitle = $(e.relatedTarget).data('entry-title');
        var link = $(e.relatedTarget).data('link');
        $(this).find('.modal-body p').text('Are you sure you want to delete - ' + entryTitle + '?');

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', link);
    });

    $('#confirm-delete-modal').find('.modal-footer #confirm').on('click', function(){
        window.location = $(this).data('form');
    });

</script>

<script>
    $('#additions-table').DataTable({
            responsive: true,
            stateSave: true,
            dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
            <'row'<'col-md-6'><'col-md-6'>>
            <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
            buttons: [{
                    extend: 'copy',
                    text: '<i class="fas fa-copy "></i>',
                    // text: '<i class="fas fa-copy "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Copy'
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-search "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Show/Hide Column'
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-alt "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Export CSV'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print "></i>',
                    className: 'btn-segment',
                    titleAttr: 'Print'
                },
            ]

        });

</script>
<script>
    $('#security-groups-table').DataTable({
             responsive: true,
             stateSave: true,
             dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
             <'row'<'col-md-6'><'col-md-6'>>
             <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
             buttons: [{
                     extend: 'copy',
                     text: '<i class="fas fa-copy "></i>',
                     // text: '<i class="fas fa-copy "></i>',
                     className: 'btn-segment',
                     titleAttr: 'Copy'
                 },
                 {
                     extend: 'colvis',
                     text: '<i class="fas fa-search "></i>',
                     className: 'btn-segment',
                     titleAttr: 'Show/Hide Column'
                 },
                 {
                     extend: 'csv',
                     text: '<i class="fas fa-file-alt "></i>',
                     className: 'btn-segment',
                     titleAttr: 'Export CSV'
                 },
                 {
                     extend: 'print',
                     text: '<i class="fas fa-print "></i>',
                     className: 'btn-segment',
                     titleAttr: 'Print'
                 },
             ]

         });

</script>
<script>
    $('#travel-allowance-table').DataTable({
                responsive: true,
                stateSave: true,
                dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
                <'row'<'col-md-6'><'col-md-6'>>
                <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
                buttons: [{
                        extend: 'copy',
                        text: '<i class="fas fa-copy "></i>',
                        // text: '<i class="fas fa-copy "></i>',
                        className: 'btn-segment',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-search "></i>',
                        className: 'btn-segment',
                        titleAttr: 'Show/Hide Column'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-alt "></i>',
                        className: 'btn-segment',
                        titleAttr: 'Export CSV'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print "></i>',
                        className: 'btn-segment',
                        titleAttr: 'Print'
                    },
                ]

            });

</script>
<script>
    $('#deductions-table').DataTable({
                responsive: true,
                stateSave: true,
                dom: `<'row d-flex'<'col'l><'col d-flex justify-content-end'f><'col-auto d-flex justify-content-end'B>>" +
                <'row'<'col-md-6'><'col-md-6'>>
                <'row'<'col-md-12't>><'row'<'col-md-12'ip>>`,
                buttons: [{
                        extend: 'copy',
                        text: '<i class="fas fa-copy "></i>',
                        // text: '<i class="fas fa-copy "></i>',
                        className: 'btn-segment',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-search "></i>',
                        className: 'btn-segment',
                        titleAttr: 'Show/Hide Column'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-alt "></i>',
                        className: 'btn-segment',
                        titleAttr: 'Export CSV'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print "></i>',
                        className: 'btn-segment',
                        titleAttr: 'Print'
                    },
                ]

            });

</script>
@append
