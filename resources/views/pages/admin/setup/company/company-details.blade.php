@extends('layouts.base') 
@section('pageTitle', 'Job Configure') 
@section('content')
<div class="row">
    {{-- <nav class="col-6 pr-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-weight-bold h3" aria-current="page">{{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Fallback Title' }}</li>
        </ol>
    </nav>
    <nav class="col-6 pl-0 justify-end">
        {{ Breadcrumbs::render('setup/job-configure') }}
    </nav> --}}
</div>
<div class="p-4">
    <div class="card py-4">
        <div class="card-body">
            <div class="container-fluid">
                <form>
                    <div class="row">
                        <nav class="col-sm-12">
                            <div class="nav nav-tabs font-weight-bold" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-bank-tab" data-toggle="tab" href="#nav-bank" role="tab" aria-controls="nav-bank"
                                    aria-selected="false">Company Bank</a>
                                <a class="nav-item nav-link" id="nav-security-tab" data-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security"
                                    aria-selected="true">Security Group</a>
                                <a class="nav-item nav-link" id="nav-travel-tab" data-toggle="tab" href="#nav-travel" role="tab" aria-controls="nav-travel" aria-selected="true">
                                        Travel Allowance</a>
                                <a class="nav-item nav-link" id="nav-addition-tab" data-toggle="tab" href="#nav-addition" role="tab" aria-controls="nav-addition"
                                    aria-selected="true">Addition</a>
                                <a class="nav-item nav-link" id="nav-deduction-tab" data-toggle="tab" href="#nav-deduction" role="tab" aria-controls="nav-deduction"
                                    aria-selected="true">Deduction</a>

                            </div>
                        </nav>

                       
                        <div class="tab-content col-sm-12 text-justify pt-4" id="nav-tabContent">

                            {{-- Company Bank --}}
                            <div class="tab-pane fade show active" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
                                    <div class="row pb-3">
                                        <div class="col-auto mr-auto"></div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addCompanyBankPopup">
                                                Add Company Bank
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered table-hover">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Account Name</th>
                                                        <th>Bank Code</th>
                                                        <th>Status</th>                    
                                                        <th>Action</th>
                                                    </tr>
                                                    @foreach($bank as $row)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$row['account_name']}}</td>
                                                        <td>{{$row['bank_code_name']}}</td>
                                                        <td>{{$row['status']}}</td>
                                                        <td><button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                                            data-bank-id="{{$row['id']}}"
                                                            data-bank-code="{{$row['bank_code']}}"        
                                                            data-bank-accout-name="{{$row['account_name']}}"             
                                                            data-bank-status="{{$row['status']}}"
                                                            data-target="#editCompanyBankPopup">EDIT</button></td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                    </div>
                            </div>

                            {{-- Security Group --}}
                            <div class="tab-pane fade" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
                                <div class="row pb-3">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addSecurityGroupPopup">
                                            Add Security Group
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($security as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>{{$row['description']}}</td>
                                                <td>{{$row['status']}}</td>
                                                <td><button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                                    data-security-id="{{$row['id']}}"
                                                    data-security-name="{{$row['name']}}"        
                                                    data-security-description="{{$row['description']}}"             
                                                    data-security-status="{{$row['status']}}"
                                                    data-target="#editSecurityGroupPopup">EDIT</button></td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                

                            <div class="tab-pane fade" id="nav-addition" role="tabpanel" aria-labelledby="nav-addition-tab">
                                <div class="row pb-3">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addCompanyAdditionPopup">
                                            Add Company Addition
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>No</th>
                                                <th>Code</th>                                                
                                                <th>Name</th>
                                                <th>Amount</th>                                                
                                                <th>Action</th>
                                            </tr>
                                            @foreach($additions as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$row['code']}}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>{{$row['amount']}}</td>      
                                                <td><button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                                    data-addition-id="{{$row['id']}}"
                                                    data-addition-code="{{$row['code']}}"
                                                    data-addition-name="{{$row['name']}}"
                                                    data-addition-type="{{$row['type']}}"
                                                    data-addition-amount="{{$row['amount']}}"
                                                    data-addition-statutory="{{$row['statutory']}}"        
                                                    data-addition-eaform="{{$row['id_EaForm']}}"
                                                    data-addition-status="{{$row['status']}}"
                                                    data-target="#editCompanyAdditionPopup">EDIT</button></td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- DEDUCTION --}}
                            <div class="tab-pane fade" id="nav-deduction" role="tabpanel" aria-labelledby="nav-deduction-tab">
                                <div class="row pb-3">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addCompanyDeductionPopup">
                                            Add Company Deduction
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>No</th>
                                                <th>Code</th>                                                
                                                <th>Name</th>
                                                <th>Amount</th>                                                
                                                <th>Action</th>
                                            </tr>
                                            @foreach($deductions as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$row['code']}}</td>
                                                <td>{{$row['name']}}</td>
                                                <td>{{$row['amount']}}</td>      
                                                <td><button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                                    data-deduction-id="{{$row['id']}}"
                                                    data-deduction-code="{{$row['code']}}"
                                                    data-deduction-name="{{$row['name']}}"
                                                    data-deduction-type="{{$row['type']}}"
                                                    data-deduction-amount="{{$row['amount']}}"
                                                    data-deduction-statutory="{{$row['statutory']}}"
                                                    data-deduction-status="{{$row['status']}}"
                                                    data-target="#editCompanyDeductionPopup">EDIT</button></td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                            
                                {{-- TRAVEL ALLOWANCE --}}
                                <div class="tab-pane fade show active" id="nav-travel" role="tabpanel" aria-labelledby="nav-travel-tab">
                                    <div class="row pb-3">
                                        <div class="col-auto mr-auto"></div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addCompanyBankPopup">
                                              Under Maintenance
                                            </button>
                                        </div>
                                    </div>

                            </div>
                        {{-- ADDITION --}}
                            {{--
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.
                            </div> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- ADD COMPANY BANK -->
<div class="modal fade" id="addCompanyBankPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('add_company_bank') }}" id="add_company_bank">
                        @csrf
                        <div class="row pb-5">
                            <div class="col-xl-8">
                                <label class="col-md-5 col-form-label">Account Name*</label>
                                <div class="col-md-7">
                                    <input id="account_name" type="text" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}"
                                        name="account_name" value="{{ old('account_name') }}" required>
                                </div> 
                                <label class="col-md-5 col-form-label">Bank*</label>
                                <div class="col-md-7">
                                    <select class="form-control{{ $errors->has('bank_list') ? ' is-invalid' : '' }}" name="bank_list" id="bank_list">
                                        @foreach($bank_list as $item)
                                        <option value="{{ $item->bank_code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-md-5 col-form-label">Status*</label>
                                <div class="col-md-7">
                                    <select class ="form-control" id="status" name="status">
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

<!-- UPDATE COMPANY BANK -->
<div class="modal fade" id="editCompanyBankPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Company Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('edit_company_bank') }}" id="edit_company_bank">
                        @csrf
                        <div class="row pb-5">
                            <div class="col-xl-8">
                                <input id="company_bank_id" name="company_bank_id" type="hidden">
                                <label class="col-md-5 col-form-label">Account Name*</label>
                                <div class="col-md-7">
                                    <input id="account_name" type="text" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}"
                                        name="account_name" value="{{ old('account_name') }}" required>
                                </div> 
                                <label class="col-md-5 col-form-label">Bank*</label>
                                <div class="col-md-7">
                                    <select class="form-control{{ $errors->has('bank_list') ? ' is-invalid' : '' }}" name="bank_list" id="bank_list">
                                        @foreach($bank_list as $item)
                                        <option value="{{ $item->bank_code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-md-5 col-form-label">Status*</label>
                                <div class="col-md-7">
                                    <select class ="form-control" id="status" name="status">
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

<!-- ADD SECURITY GROUP -->
<div class="modal fade" id="addSecurityGroupPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Security Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_security_group') }}" id="add_security_group">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Security Group Name*</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ old('name') }}" required>
                            </div>
                            <label class="col-md-5 col-form-label">Description*</label> 
                            <div class="col-md-10">                                     
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <label class="col-md-5 col-form-label">Status*</label>
                            <div class="col-md-7">
                                <select class ="form-control" id="status" name="status">
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

<!-- UPDATE SECURITY GROUP -->
<div class="modal fade" id="editSecurityGroupPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Security Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_security_group') }}" id="add_security_group">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="security_group_id" name="security_group_id" type="hidden">
                            <label class="col-md-5 col-form-label">Security Group Name*</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ old('name') }}" required>
                            </div>
                            <label class="col-md-5 col-form-label">Description*</label> 
                            <div class="col-md-10">                                     
                                <textarea name="description" id="description" value="{{ old('description') }}" class="form-control"></textarea>
                            </div>
                            <label class="col-md-5 col-form-label">Status*</label>
                            <div class="col-md-7">
                                <select class ="form-control" id="status" name="status">
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Comapny Addition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('add_company_addition') }}" id="add_company_addition">
                        @csrf
                        <div class="row pb-5">
                            <div class="col-xl-8">
                                <label class="col-md-5 col-form-label">Code*</label>
                                <div class="col-md-7">
                                    <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                        name="code" value="{{ old('code') }}" required>
                                </div>
                                <label class="col-md-5 col-form-label">Name*</label>
                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        name="name" value="{{ old('name') }}" required>
                                </div>
                                <label class="col-md-5 col-form-label">Type*</label>
                                <div class="col-md-7">
                                    <select class ="form-control" id="type" name="type">
                                        <option value="Fixed">Fixed</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                                </div>
                                <label class="col-md-5 col-form-label">Amount</label>
                                <div class="col-md-7">
                                    <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                        name="amount" value="{{ old('amount') }}" required>
                                </div>
                                <label class="col-md-5 col-form-label">Status*</label>
                                <div class="col-md-7">
                                    <select class ="form-control" id="status" name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <label class="col-md-5 col-form-label">Statutory</label>
                                    <div class="checkbox">
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
                                <label class="col-md-5 col-form-label">EA Form*</label>
                                <div class="col-md-7">
                                    <select class="form-control{{ $errors->has('ea_form') ? ' is-invalid' : '' }}" name="ea_form" id="ea_form">
                                        @foreach($ea_form as $item)
                                        <option value="{{ $item->id }}">{{ $item->code }}: {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-md-5 col-form-label">Applies To</label>
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="check_cost_centre" name="checkbox[]" value="PCB"> Cost Centre
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="check_job_grade" name="checkbox[]" value="EPF"> Job Grade
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="check_comfirmed_employee" name="checkbox[]" value="SOCSO"> Confirmed Employee
                                    </label>
                                </div>
                                <label class="col-md-5 col-form-label">Cost Centre</label>
                                <div class="col-md-7">
                                    <input id="cost_centre" type="text" class="tagsinput form-control{{ $errors->has('cost_centre') ? ' is-invalid' : '' }}"
                                        name="cost_centre" required readonly>

                                </div>
                                <label class="col-md-5 col-form-label">Job Grade</label>
                                <div class="col-md-7">
                                    <input id="job_grade" type="text" class="form-control{{ $errors->has('job_grade') ? ' is-invalid' : '' }}"
                                        name="job_grade" value="{{ old('job_grade') }}" required readonly>
                                </div>   
                                {{-- <div class="form-group">
                                    <label>Enter your Skill</label>
                                    <input type="typeahead" name="tags" id="tags" data-role="tagsinput" style="background-color:pink" class="form-control" />
                                   </div>                                                                 --}}
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Comapny Addition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_company_addition') }}" id="add_company_addition">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="company_addition_id" name="company_addition_id" type="hidden">
                            <label class="col-md-5 col-form-label">Code*</label>
                            <div class="col-md-7">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                    name="code" value="{{ old('code') }}" required>
                            </div>
                            <label class="col-md-5 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ old('name') }}" required>
                            </div>
                            <label class="col-md-5 col-form-label">Type*</label>
                            <div class="col-md-7">
                                <select class ="form-control" id="type" name="type">
                                    <option value="Fixed">Fixed</option>
                                    <option value="Custom">Custom</option>
                                </select>
                            </div>
                            <label class="col-md-5 col-form-label">Amount</label>
                            <div class="col-md-7">
                                <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                    name="amount" value="{{ old('amount') }}" required>
                            </div>
                            <label class="col-md-5 col-form-label">Status*</label>
                            <div class="col-md-7">
                                <select class ="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <label class="col-md-5 col-form-label">Statutory</label>
                                <div class="checkbox">
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
                            <label class="col-md-5 col-form-label">EA Form*</label>
                            <div class="col-md-7">
                                <select class="form-control{{ $errors->has('ea_form') ? ' is-invalid' : '' }}" name="ea_form" id="ea_form">
                                    @foreach($ea_form as $item)
                                    <option value="{{ $item->id }}">{{ $item->code }}: {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-md-5 col-form-label">Applies To</label>
                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="check_cost_centre" name="checkbox[]" value="PCB"> Cost Centre
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="check_job_grade" name="checkbox[]" value="EPF"> Job Grade
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="check_comfirmed_employee" name="checkbox[]" value="SOCSO"> Confirmed Employee
                                </label>
                            </div>
                            <label class="col-md-5 col-form-label">Cost Centre</label>
                            <div class="col-md-7">
                                <input id="cost_centre" type="text" class="tagsinput form-control{{ $errors->has('cost_centre') ? ' is-invalid' : '' }}"
                                    name="cost_centre" required readonly>

                            </div>
                            <label class="col-md-5 col-form-label">Job Grade</label>
                            <div class="col-md-7">
                                <input id="job_grade" type="text" class="form-control{{ $errors->has('job_grade') ? ' is-invalid' : '' }}"
                                    name="job_grade" value="{{ old('job_grade') }}" required readonly>
                            </div>   
                            {{-- <div class="form-group">
                                <label>Enter your Skill</label>
                                <input type="typeahead" name="tags" id="tags" data-role="tagsinput" style="background-color:pink" class="form-control" />
                               </div>                                                                 --}}
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
<div class="modal fade" id="addCompanyDeductionPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Comapny Deduction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_company_deduction') }}" id="add_company_addition">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-5 col-form-label">Code*</label>
                            <div class="col-md-7">
                                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                    name="code" value="{{ old('code') }}" required>
                            </div>
                            <label class="col-md-5 col-form-label">Name*</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ old('name') }}" required>
                            </div>
                            <label class="col-md-5 col-form-label">Type*</label>
                            <div class="col-md-7">
                                <select class ="form-control" id="type" name="type">
                                    <option value="Fixed">Fixed</option>
                                    <option value="Custom">Custom</option>
                                </select>
                            </div>
                            <label class="col-md-5 col-form-label">Amount</label>
                            <div class="col-md-7">
                                <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                    name="amount" value="{{ old('amount') }}" required>
                            </div>
                            <label class="col-md-5 col-form-label">Status*</label>
                            <div class="col-md-7">
                                <select class ="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <label class="col-md-5 col-form-label">Statutory</label>
                                <div class="checkbox">
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
                            <label class="col-md-5 col-form-label">Applies To</label>
                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="check_cost_centre" name="checkbox[]" value="PCB"> Cost Centre
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="check_job_grade" name="checkbox[]" value="EPF"> Job Grade
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="check_comfirmed_employee" name="checkbox[]" value="SOCSO"> Confirmed Employee
                                </label>
                            </div>
                            <label class="col-md-5 col-form-label">Cost Centre</label>
                            <div class="col-md-7">
                                <input id="cost_centre" type="text" class="tagsinput form-control{{ $errors->has('cost_centre') ? ' is-invalid' : '' }}"
                                    name="cost_centre" required readonly>

                            </div>
                            <label class="col-md-5 col-form-label">Job Grade</label>
                            <div class="col-md-7">
                                <input id="job_grade" type="text" class="form-control{{ $errors->has('job_grade') ? ' is-invalid' : '' }}"
                                    name="job_grade" value="{{ old('job_grade') }}" required readonly>
                            </div>   
                            {{-- <div class="form-group">
                                <label>Enter your Skill</label>
                                <input type="typeahead" name="tags" id="tags" data-role="tagsinput" style="background-color:pink" class="form-control" />
                               </div>   --}}
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Comapny Deduction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('edit_company_deduction') }}" id="add_company_addition">
                        @csrf
                        <div class="row pb-5">
                            <div class="col-xl-8">
                                <input id="company_deduction_id" name="company_deduction_id" type="hidden">
                                <label class="col-md-5 col-form-label">Code*</label>
                                <div class="col-md-7">
                                    <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                        name="code" value="{{ old('code') }}" required>
                                </div>
                                <label class="col-md-5 col-form-label">Name*</label>
                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        name="name" value="{{ old('name') }}" required>
                                </div>
                                <label class="col-md-5 col-form-label">Type*</label>
                                <div class="col-md-7">
                                    <select class ="form-control" id="type" name="type">
                                        <option value="Fixed">Fixed</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                                </div>
                                <label class="col-md-5 col-form-label">Amount</label>
                                <div class="col-md-7">
                                    <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                        name="amount" value="{{ old('amount') }}" required>
                                </div>
                                <label class="col-md-5 col-form-label">Status*</label>
                                <div class="col-md-7">
                                    <select class ="form-control" id="status" name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <label class="col-md-5 col-form-label">Statutory</label>
                                    <div class="checkbox">
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
                                <label class="col-md-5 col-form-label">Applies To</label>
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="check_cost_centre" name="checkbox[]" value="PCB"> Cost Centre
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="check_job_grade" name="checkbox[]" value="EPF"> Job Grade
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="check_comfirmed_employee" name="checkbox[]" value="SOCSO"> Confirmed Employee
                                    </label>
                                </div>
                                <label class="col-md-5 col-form-label">Cost Centre</label>
                                <div class="col-md-7">
                                    <input id="cost_centre" type="text" class="tagsinput form-control{{ $errors->has('cost_centre') ? ' is-invalid' : '' }}"
                                        name="cost_centre" required readonly>
    
                                </div>
                                <label class="col-md-5 col-form-label">Job Grade</label>
                                <div class="col-md-7">
                                    <input id="job_grade" type="text" class="form-control{{ $errors->has('job_grade') ? ' is-invalid' : '' }}"
                                        name="job_grade" value="{{ old('job_grade') }}" required readonly>
                                </div>   
                                {{-- <div class="form-group">
                                    <label>Enter your Skill</label>
                                    <input type="typeahead" name="tags" id="tags" data-role="tagsinput" style="background-color:pink" class="form-control" />
                                   </div>   --}}
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

@section('js')
    <script>
        $(function(){
            var tags = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            
            prefetch: {
                        url: "/company/tags"
                      }
            });

            tags.initialize();

            $('[name=tags]').tagsinput({
                typeaheadjs: {
                    name: 'tags',
                    source: tags.ttAdapter()
                }
            });

        })
    </script>
@endsection

@endsection