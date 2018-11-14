@extends('layouts.base') 
@section('pageTitle', 'Leave Setup') 
@section('content')

<div class="p-4">
        <div class="card p-4">
            <div class="card-body">
                <div class="row pb-3">
                    <div class="col-auto mr-auto"></div>
                    <div class="col-auto">
                            <button type="button" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#addBalancePopup">
                                Add Leave Balance
                            </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right tableTools-container"></div>
                        <table class="table display compact table-striped table-bordered table-hover w-100" id="leaveBalanceTable">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Employee Id</th>
                                <th>Leave Balance</th>
                                <th>Carry Forward</th>
                                <th>Leave Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($leavebalance as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['balance']}}</td>
                                <td>{{$row['carry']}}</td>
                                <td>{{$row['leave']}}</td>
                                <td><button class="btn btn-outline-primary waves-effect" data-toggle="modal"
                                    data-balance-id="{{$row['balance_id']}}"
                                    data-balance-emp-id="{{$row['user_id']}}" 
                                    data-balance-leave="{{$row['balance']}}"        
                                    data-balance-carry="{{$row['carry']}}"             
                                    data-balance-type-id="{{$row['type_id']}}"
                                    data-target="#updateLeaveBalance">EDIT</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Leave Balance -->
<div class="modal fade" id="addBalancePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Leave Balance</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add_leave_balance') }}">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <label class="col-md-8 col-form-label">Employee Name*</label>
                            <div class="col-lg-8 col-md-7">
                                <select class="form-control{{ $errors->has('users') ? ' is-invalid' : '' }}" name="users" id="users">
                                    @foreach($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->id }}: {{ $item->name }}</option>
                                    @endforeach
                                  </select>
                            </div>    
                                <label class="col-md-8 col-form-label">Leave Type*</label>
                                <div class="col-lg-8 col-md-7">
                                    <select class="form-control{{ $errors->has('types') ? ' is-invalid' : '' }}" name="types" id="types">
                                    @foreach($types as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <label class="col-md-8 col-form-label">Leave Balance*</label>
                                <div class="col-lg-8 col-md-7">
                                    <input id="leave_balance" type="number" class="form-control{{ $errors->has('leave_balance') ? ' is-invalid' : '' }}"
                                    name="leave_balance" value="{{ old('leave_balance') }}" min="0" value="0" step=".01" required>                                    
                                </div>
                                <label class="col-md-8 col-form-label">Carry Forward*</label>
                                <div class="col-lg-8 col-md-7">
                                    <input id="carry_forward" type="number" class="form-control{{ $errors->has('carry_forward') ? ' is-invalid' : '' }}"
                                    name="carry_forward" value="{{ old('carry_forward') }}" min="0" value="0" step=".01" required>                                    
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

<!-- Edit Leave Balance -->
<div class="modal fade" id="updateLeaveBalance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Leave Balance</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_leave_balance') }}">
                    @csrf
                    <div class="row pb-5">
                        <div class="col-xl-8">
                            <input id="balance_id" name="balance_id" type="hidden"> 
                            <label class="col-md-8 col-form-label">Employee Name*</label>
                            <div class="col-lg-8 col-md-7">
                                <select class="form-control{{ $errors->has('users') ? ' is-invalid' : '' }}" name="users" id="users">
                                    @foreach($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->id }}: {{ $item->name }}</option>
                                    @endforeach
                                  </select>
                            </div>    
                                <label class="col-md-8 col-form-label">Leave Type*</label>
                                <div class="col-lg-8 col-md-7">
                                    <select class="form-control{{ $errors->has('types') ? ' is-invalid' : '' }}" name="types" id="types">
                                    @foreach($types as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <label class="col-md-8 col-form-label">Leave Balance*</label>
                                <div class="col-lg-8 col-md-7">
                                    <input id="leave_balance" type="number" class="form-control{{ $errors->has('leave_balance') ? ' is-invalid' : '' }}"
                                    name="leave_balance" value="{{ old('leave_balance') }}" min="0" value="0" step=".01" required>                                    
                                </div>
                                <label class="col-md-8 col-form-label">Carry Forward*</label>
                                <div class="col-lg-8 col-md-7">
                                    <input id="carry_forward" type="number" class="form-control{{ $errors->has('carry_forward') ? ' is-invalid' : '' }}"
                                    name="carry_forward" value="{{ old('carry_forward') }}" min="0" value="0" step=".01" required>                                    
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